<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientInstallment;
use App\Models\FinancialTransaction;
use App\Models\Payment;
use App\Models\PlatformNotification;
use App\Models\TreasuryAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Support\DatabaseSchemaAligner;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Month / Year Filter for CRM Monthly Renewals & Monthly Tasks
        $monthInput = $request->get('month', Carbon::now()->format('Y-m'));
        try {
            $selectedDate = Carbon::createFromFormat('Y-m', $monthInput)->startOfMonth();
        } catch (\Exception $e) {
            $selectedDate = Carbon::now()->startOfMonth();
        }

        $selectedYear = $selectedDate->year;
        $selectedMonth = $selectedDate->month;

        $currentMonthStr = Carbon::now()->format('Y-m');
        $prevMonthStr = $selectedDate->copy()->subMonth()->format('Y-m');
        $nextMonthStr = $selectedDate->copy()->addMonth()->format('Y-m');

        // Eager load tasks for the selected month and installments
        $clientsQuery = Client::with([
            'tasks' => function ($q) use ($selectedYear, $selectedMonth) {
                $q->where(function ($sub) use ($selectedYear, $selectedMonth) {
                    $sub->whereYear('delivery_deadline', $selectedYear)
                        ->whereMonth('delivery_deadline', $selectedMonth);
                })->orWhere(function ($sub) use ($selectedYear, $selectedMonth) {
                    $sub->whereNull('delivery_deadline')
                        ->whereYear('created_at', $selectedYear)
                        ->whereMonth('created_at', $selectedMonth);
                })->with('assignee');
            },
            'installments' => function ($q) {
                $q->orderBy('due_date', 'asc');
            },
            'projects',
        ])
            ->withCount(['projects', 'tasks', 'payments']);

        if ($request->filled('status')) {
            $clientsQuery->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $clientsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $clients = $clientsQuery->latest()->paginate(12);

        // Overall monthly summary across all clients for selected month
        $totalMonthlyRetainers = Client::where('status', 'active')->sum('monthly_retainer');

        // Approaching & Overdue Installments alert count
        $approachingInstallments = ClientInstallment::with('client')
            ->where('status', 'pending')
            ->where('due_date', '<=', Carbon::now()->addDays(3))
            ->orderBy('due_date', 'asc')
            ->get();

        return view('clients.index', compact(
            'clients',
            'selectedDate',
            'selectedYear',
            'selectedMonth',
            'currentMonthStr',
            'prevMonthStr',
            'nextMonthStr',
            'totalMonthlyRetainers',
            'approachingInstallments',
            'user'
        ));
    }

    public function show(Request $request, Client $client)
    {
        $monthInput = $request->get('month', Carbon::now()->format('Y-m'));
        try {
            $selectedDate = Carbon::createFromFormat('Y-m', $monthInput)->startOfMonth();
        } catch (\Exception $e) {
            $selectedDate = Carbon::now()->startOfMonth();
        }

        $selectedYear = $selectedDate->year;
        $selectedMonth = $selectedDate->month;

        $client->load([
            'projects.tasks',
            'tasks.assignee',
            'invoices.items',
            'payments.cashier',
            'installments' => function ($q) {
                $q->orderBy('due_date', 'asc');
            },
        ]);

        // Monthly filtered tasks for this client
        $monthTasks = $client->tasks->filter(function ($t) use ($selectedYear, $selectedMonth) {
            if ($t->delivery_deadline) {
                return $t->delivery_deadline->year == $selectedYear && $t->delivery_deadline->month == $selectedMonth;
            }

            return $t->created_at->year == $selectedYear && $t->created_at->month == $selectedMonth;
        });

        $projects = $client->projects;
        $treasuries = TreasuryAccount::where('is_active', true)->get();
        $monthContentPlans = $client->contentPlans()->forMonth($selectedYear, $selectedMonth)->orderBy('publish_date', 'asc')->get();

        return view('clients.show', compact('client', 'selectedDate', 'monthTasks', 'monthContentPlans', 'projects', 'treasuries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email',
            'country' => 'required|string',
            'service_package' => 'nullable|string',
            'monthly_retainer' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,lead,completed,paused',
            'notes' => 'nullable|string',
        ]);

        $client = Client::create($validated);

        PlatformNotification::notifyGM(
            'client_added',
            "إضافة عميل جديد: {$client->name}",
            'تم تسجيل العميل بنجاح. قيمة التعاقد الشهري: '.number_format($client->monthly_retainer ?? 0, 2).' ج.م',
            'user-plus',
            "/clients/{$client->id}"
        );

        return back()->with('success', 'تمت إضافة العميل وسجل التعاقد بنجاح.');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email',
            'country' => 'required|string',
            'service_package' => 'nullable|string',
            'monthly_retainer' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,lead,completed,paused',
            'notes' => 'nullable|string',
        ]);

        $client->update($validated);

        return back()->with('success', 'تم تحديث بيانات العميل والتعاقد بنجاح.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return back()->with('success', 'تم حذف العميل بنجاح.');
    }

    // =========================================================================
    // CLIENT PAYMENT INSTALLMENTS (أقساط ودفعات العملاء ومواعيد الاستحقاق)
    // =========================================================================

    public function storeInstallment(Request $request, Client $client)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'due_date' => 'required|date',
            'project_id' => 'nullable|exists:projects,id',
            'notes' => 'nullable|string',
        ]);

        $installment = $client->installments()->create($validated);

        // Check if approaching
        $today = Carbon::today();
        $dueDate = Carbon::parse($validated['due_date'])->startOfDay();
        $diff = $today->diffInDays($dueDate, false);

        if ($diff <= 3) {
            PlatformNotification::notifyGM(
                'installment_approaching',
                "تنبيه استحقاق دفعة مالية: {$client->name}",
                "الدفعة [{$installment->title}] بقيمة ".number_format($installment->amount, 2)." ج.م موعد سدادها خلال {$diff} يوم ({$dueDate->format('Y-m-d')})",
                'bell-ring',
                "/clients/{$client->id}"
            );
        }

        return back()->with('success', 'تمت إضافة الدفعة وموعد استحقاقها بنجاح.');
    }

    public function payInstallment(Request $request, ClientInstallment $installment)
    {
        $validated = $request->validate([
            'paid_amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:instapay,vodafone_cash,cash,bank_transfer,credit_card',
            'transaction_reference' => 'nullable|string|max:100',
            'treasury_account_id' => 'nullable|exists:treasury_accounts,id',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $installment) {
            $installment->update([
                'status' => 'paid',
                'paid_amount' => $validated['paid_amount'],
                'paid_at' => Carbon::now(),
                'payment_method' => $validated['payment_method'],
                'notes' => ($installment->notes ?? '')."\n[سداد دفعة بتاريخ ".Carbon::now()->format('Y-m-d H:i').']: مرجع: '.($validated['transaction_reference'] ?? 'لا يوجد'),
            ]);

            // Create Payment receipt
            $year = date('Y');
            $count = Payment::whereYear('created_at', $year)->count() + 1;
            $receiptNumber = sprintf('REC-%s-%04d', $year, $count);

            DatabaseSchemaAligner::alignPayments();

            $paymentData = [
                'receipt_number' => $receiptNumber,
                'client_id' => $installment->client_id,
                'project_id' => $installment->project_id,
                'cashier_user_id' => Auth::id(),
                'cashier_id' => Auth::id(),
                'amount' => $validated['paid_amount'],
                'payment_type' => 'milestone',
                'payment_method' => $validated['payment_method'],
                'payment_date' => now()->toDateString(),
                'transaction_reference' => $validated['transaction_reference'] ?? null,
                'notes' => "سداد قسط: {$installment->title}",
            ];

            try {
                $availableCols = Schema::getColumnListing('payments');
                if (!empty($availableCols)) {
                    $paymentData = array_intersect_key($paymentData, array_flip($availableCols));
                }
            } catch (\Throwable $e) {}

            Payment::create($paymentData);

            // Update Treasury Account if specified
            if (! empty($validated['treasury_account_id'])) {
                $treasury = TreasuryAccount::find($validated['treasury_account_id']);
                if ($treasury) {
                    $treasury->increment('balance', $validated['paid_amount']);

                    // Create Financial Transaction
                    $txnCount = FinancialTransaction::whereYear('created_at', $year)->count() + 1;
                    $txnNumber = sprintf('TXN-%s-%04d', $year, $txnCount);

                    FinancialTransaction::create([
                        'transaction_number' => $txnNumber,
                        'treasury_account_id' => $treasury->id,
                        'type' => 'revenue',
                        'amount' => $validated['paid_amount'],
                        'payment_method' => $validated['payment_method'],
                        'client_id' => $installment->client_id,
                        'project_id' => $installment->project_id,
                        'created_by' => Auth::id(),
                        'reference_number' => $validated['transaction_reference'] ?? null,
                        'transaction_date' => Carbon::today(),
                        'description' => "تحصيل دفعة مالية: {$installment->title} - عميل: {$installment->client->name}",
                    ]);
                }
            }

            // Notify General Manager
            PlatformNotification::notifyGM(
                'installment_paid',
                "تم تحصيل دفعة من العميل: {$installment->client->name}",
                "تم سداد الدفعة [{$installment->title}] بقيمة ".number_format($validated['paid_amount'], 2)." ج.م بنجاح عبر {$validated['payment_method']}",
                'circle-check',
                "/clients/{$installment->client_id}"
            );
        });

        return back()->with('success', 'تم تسجيل سداد الدفعة وإصدار إيصال القبض وتحديث الحساب المالي بنجاح.');
    }

    public function deleteInstallment(ClientInstallment $installment)
    {
        $installment->delete();

        return back()->with('success', 'تم حذف بند الدفعة بنجاح.');
    }
}
