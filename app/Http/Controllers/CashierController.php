<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Support\DatabaseSchemaAligner;

class CashierController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Today's cashier statistics
        $todayPayments = Payment::with(['client', 'cashier'])
            ->whereDate('created_at', $today)
            ->latest()
            ->get();

        $todayTotal = $todayPayments->sum('amount');
        $todayInstapay = $todayPayments->where('payment_method', 'instapay')->sum('amount');
        $todayVodafone = $todayPayments->where('payment_method', 'vodafone_cash')->sum('amount');
        $todayCash = $todayPayments->where('payment_method', 'cash')->sum('amount');
        $todayBank = $todayPayments->where('payment_method', 'bank_transfer')->sum('amount');

        // Recent transactions
        $allPayments = Payment::with(['client', 'cashier', 'project'])
            ->latest()
            ->paginate(15);

        $clients = Client::orderBy('name')->get();
        $projects = Project::where('status', 'in_progress')->get();
        $services = Service::where('is_active', true)->get();

        // Quick POS Packages
        $quickPackages = [
            ['title' => 'جلسة تصوير فيديو ريلز (4K)', 'price' => 3500, 'category' => 'video', 'icon' => 'video'],
            ['title' => 'باقة مونتاج 10 ريلز سينمائي', 'price' => 8000, 'category' => 'editing', 'icon' => 'film'],
            ['title' => 'باقة إدارة إعلانات ممولة شهرية', 'price' => 6000, 'category' => 'ads', 'icon' => 'chart'],
            ['title' => 'باقة 12 بوست سوشيال ميديا', 'price' => 4500, 'category' => 'design', 'icon' => 'palette'],
            ['title' => 'تصميم هوية بصرية كاملة وبراندينج', 'price' => 12000, 'category' => 'branding', 'icon' => 'sparkles'],
            ['title' => 'دفعة تعاقد شهري (Retainer)', 'price' => 15000, 'category' => 'retainer', 'icon' => 'receipt'],
        ];

        return view('cashier.index', compact(
            'todayPayments',
            'todayTotal',
            'todayInstapay',
            'todayVodafone',
            'todayCash',
            'todayBank',
            'allPayments',
            'clients',
            'projects',
            'services',
            'quickPackages'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:1',
            'payment_type' => 'required|in:down_payment,milestone,final_clearance,quick_service',
            'payment_method' => 'required|in:instapay,vodafone_cash,cash,bank_transfer,credit_card',
            'transaction_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        // Generate unique receipt number
        $year = date('Y');
        $count = Payment::whereYear('created_at', $year)->count() + 1;
        $receiptNumber = sprintf('REC-%s-%04d', $year, $count);

        // Ensure database schema matches and self-heals in production
        DatabaseSchemaAligner::alignPayments();
        DatabaseSchemaAligner::alignInvoices();

        $paymentData = [
            'receipt_number' => $receiptNumber,
            'client_id' => $validated['client_id'],
            'project_id' => $validated['project_id'] ?? null,
            'cashier_user_id' => Auth::id(),
            'cashier_id' => Auth::id(),
            'amount' => $validated['amount'],
            'payment_type' => $validated['payment_type'],
            'payment_method' => $validated['payment_method'],
            'payment_date' => now()->toDateString(),
            'transaction_reference' => $validated['transaction_reference'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ];

        // Defensive column filtering: only send columns that actually exist in the DB table
        try {
            $availableColumns = Schema::getColumnListing('payments');
            if (!empty($availableColumns)) {
                $paymentData = array_intersect_key($paymentData, array_flip($availableColumns));
            }
        } catch (\Throwable $e) {}

        $payment = Payment::create($paymentData);

        // Check if there is an active invoice for this client to apply payment against
        $openInvoice = Invoice::where('client_id', $validated['client_id'])
            ->whereIn('status', ['unpaid', 'partially_paid'])
            ->orderBy('id', 'asc')
            ->first();

        if ($openInvoice) {
            $payment->update(['invoice_id' => $openInvoice->id]);
            
            $invoiceUpdateData = [];
            if (Schema::hasColumn('invoices', 'paid_amount')) {
                $newPaid = ($openInvoice->paid_amount ?? 0) + $payment->amount;
                $invoiceUpdateData['paid_amount'] = $newPaid;
                if (Schema::hasColumn('invoices', 'balance_due')) {
                    $newBalance = max(0, ($openInvoice->total_amount ?? 0) - $newPaid);
                    $invoiceUpdateData['balance_due'] = $newBalance;
                    $invoiceUpdateData['status'] = $newBalance <= 0 ? 'paid' : 'partially_paid';
                }
            }
            if (!empty($invoiceUpdateData)) {
                $openInvoice->update($invoiceUpdateData);
            }
        }

        return redirect()->route('cashier.receipt', $payment->id)
            ->with('success', "تم تسجيل المعاملة بنجاح وتوليد إيصال القبض رقم: {$payment->receipt_number}");
    }

    public function quickCreateClient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'country' => 'required|string',
        ]);

        $client = Client::create($validated);

        return response()->json([
            'success' => true,
            'client' => $client,
        ]);
    }

    public function receipt(Payment $payment)
    {
        $payment->load(['client', 'cashier', 'project', 'invoice']);

        return view('cashier.receipt', compact('payment'));
    }

    public function settlement(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());
        $carbonDate = Carbon::parse($date);

        $payments = Payment::with(['client', 'cashier'])
            ->whereDate('created_at', $carbonDate)
            ->get();

        $totalIncome = $payments->sum('amount');
        $byMethod = [
            'instapay' => $payments->where('payment_method', 'instapay')->sum('amount'),
            'vodafone_cash' => $payments->where('payment_method', 'vodafone_cash')->sum('amount'),
            'cash' => $payments->where('payment_method', 'cash')->sum('amount'),
            'bank_transfer' => $payments->where('payment_method', 'bank_transfer')->sum('amount'),
        ];

        return view('cashier.settlement', compact('date', 'payments', 'totalIncome', 'byMethod'));
    }
}
