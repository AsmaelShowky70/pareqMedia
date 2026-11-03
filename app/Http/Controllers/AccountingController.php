<?php

namespace App\Http\Controllers;

use App\Models\AccountingCategory;
use App\Models\Client;
use App\Models\FinancialTransaction;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\TreasuryAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployee()) {
            abort(403, 'غير مصرح للموظفين بالدخول للنظام المحاسبي.');
        }

        // Treasuries
        $treasuries = TreasuryAccount::where('is_active', true)->get();
        $totalTreasuryBalance = $treasuries->sum('balance');

        // Categories
        $categories = AccountingCategory::orderBy('type')->orderBy('name')->get();

        // Projects & Clients for filters
        $projects = Project::orderBy('title')->get();
        $clients = Client::orderBy('name')->get();
        $employees = User::where('is_active', true)->get();

        // Transactions Query with Filters
        $query = FinancialTransaction::with(['treasuryAccount', 'category', 'client', 'project', 'user', 'creator']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('treasury_id')) {
            $query->where('treasury_account_id', $request->treasury_id);
        }

        if ($request->filled('category_id')) {
            $query->where('accounting_category_id', $request->category_id);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('transaction_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('transaction_date', '<=', $request->to_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->paginate(15);

        // Overall Totals
        $totalRevenues = FinancialTransaction::where('type', 'revenue')->sum('amount');
        $totalExpenses = FinancialTransaction::where('type', 'expense')->sum('amount');
        $netIncome = $totalRevenues - $totalExpenses;

        // Current Month Stats
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;
        $monthRevenues = FinancialTransaction::where('type', 'revenue')
            ->whereYear('transaction_date', $thisYear)
            ->whereMonth('transaction_date', $thisMonth)
            ->sum('amount');
        $monthExpenses = FinancialTransaction::where('type', 'expense')
            ->whereYear('transaction_date', $thisYear)
            ->whereMonth('transaction_date', $thisMonth)
            ->sum('amount');
        $monthNet = $monthRevenues - $monthExpenses;

        // Project Profitability Breakdown
        $projectProfitability = Project::with(['payments', 'expenses'])
            ->latest()
            ->take(10)
            ->get();

        return view('accounting.index', compact(
            'treasuries',
            'totalTreasuryBalance',
            'categories',
            'projects',
            'clients',
            'employees',
            'transactions',
            'totalRevenues',
            'totalExpenses',
            'netIncome',
            'monthRevenues',
            'monthExpenses',
            'monthNet',
            'projectProfitability'
        ));
    }

    public function storeTransaction(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployee()) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|in:revenue,expense,transfer',
            'amount' => 'required|numeric|min:0.5',
            'treasury_account_id' => 'required|exists:treasury_accounts,id',
            'accounting_category_id' => 'nullable|exists:accounting_categories,id',
            'payment_method' => 'required|string',
            'transaction_date' => 'required|date',
            'description' => 'required|string|max:500',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'user_id' => 'nullable|exists:users,id',
            'reference_number' => 'nullable|string|max:100',
            'target_treasury_id' => 'nullable|required_if:type,transfer|exists:treasury_accounts,id',
        ]);

        DB::transaction(function () use ($validated, $user) {
            $year = date('Y');
            $count = FinancialTransaction::whereYear('created_at', $year)->count() + 1;
            $transactionNumber = sprintf('TXN-%s-%04d', $year, $count);

            $treasury = TreasuryAccount::findOrFail($validated['treasury_account_id']);

            if ($validated['type'] === 'revenue') {
                $treasury->increment('balance', $validated['amount']);
            } elseif ($validated['type'] === 'expense') {
                $treasury->decrement('balance', $validated['amount']);
            } elseif ($validated['type'] === 'transfer') {
                $treasury->decrement('balance', $validated['amount']);
                $targetTreasury = TreasuryAccount::findOrFail($validated['target_treasury_id']);
                $targetTreasury->increment('balance', $validated['amount']);
            }

            FinancialTransaction::create([
                'transaction_number' => $transactionNumber,
                'treasury_account_id' => $validated['treasury_account_id'],
                'accounting_category_id' => $validated['accounting_category_id'] ?? null,
                'type' => $validated['type'],
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'client_id' => $validated['client_id'] ?? null,
                'project_id' => $validated['project_id'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'created_by' => $user->id,
                'reference_number' => $validated['reference_number'] ?? null,
                'transaction_date' => $validated['transaction_date'],
                'description' => $validated['description'],
            ]);

            // Notify General Manager
            $typeLabel = match ($validated['type']) {
                'revenue' => 'إيراد جديد (+)',
                'expense' => 'مصروف جديد (-)',
                'transfer' => 'تحويل بين الخزائن (⇄)',
            };

            PlatformNotification::notifyGM(
                'accounting_entry',
                "قيد محاسبي جديد: {$typeLabel}",
                'تم تسجيل قيد بقيمة '.number_format($validated['amount'], 2)." ج.م عبر {$treasury->name} - {$validated['description']}",
                'receipt',
                '/accounting'
            );
        });

        return back()->with('success', 'تم تسجيل القيد المحاسبي وتحديث رصيد الحساب المالي بنجاح.');
    }

    public function storeTreasury(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:instapay,vodafone_cash,bank,cash',
            'account_number' => 'nullable|string|max:100',
            'balance' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        TreasuryAccount::create($validated);

        return back()->with('success', 'تمت إضافة الحساب المالي / الخزينة بنجاح.');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:revenue,expense',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        AccountingCategory::create($validated);

        return back()->with('success', 'تمت إضافة البند المحاسبي بنجاح.');
    }

    public function reports(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployee()) {
            abort(403);
        }

        $year = (int) $request->get('year', Carbon::now()->year);
        $month = $request->get('month', null);

        // Group revenues by category
        $revenueQuery = FinancialTransaction::with('category')
            ->where('type', 'revenue')
            ->whereYear('transaction_date', $year);

        $expenseQuery = FinancialTransaction::with('category')
            ->where('type', 'expense')
            ->whereYear('transaction_date', $year);

        if ($month) {
            $revenueQuery->whereMonth('transaction_date', $month);
            $expenseQuery->whereMonth('transaction_date', $month);
        }

        $revenuesByCategory = $revenueQuery->get()->groupBy('accounting_category_id');
        $expensesByCategory = $expenseQuery->get()->groupBy('accounting_category_id');

        $totalRev = (float) $revenueQuery->sum('amount');
        $totalExp = (float) $expenseQuery->sum('amount');
        $net = $totalRev - $totalExp;

        $categories = AccountingCategory::all()->keyBy('id');

        // Cash flow by payment method
        $byMethod = FinancialTransaction::whereYear('transaction_date', $year)
            ->select('payment_method', DB::raw('SUM(CASE WHEN type="revenue" THEN amount ELSE -amount END) as net_amount'))
            ->groupBy('payment_method')
            ->get();

        // 12-Month Annual Breakdown matching the Excel Sheet
        $monthNames = [
            1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
            5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
            9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
        ];

        $annualMatrix = [];
        $annualTotalRevenue = 0;
        $annualTotalExpense = 0;

        for ($m = 1; $m <= 12; $m++) {
            $mRev = (float) FinancialTransaction::where('type', 'revenue')
                ->whereYear('transaction_date', $year)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');

            $mExp = (float) FinancialTransaction::where('type', 'expense')
                ->whereYear('transaction_date', $year)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');

            $mNet = $mRev - $mExp;

            $annualTotalRevenue += $mRev;
            $annualTotalExpense += $mExp;

            $annualMatrix[$m] = [
                'month_num' => $m,
                'name' => $monthNames[$m],
                'revenue' => $mRev,
                'expense' => $mExp,
                'net' => $mNet,
            ];
        }

        $annualTotalNet = $annualTotalRevenue - $annualTotalExpense;

        return view('accounting.reports', compact(
            'year',
            'month',
            'revenuesByCategory',
            'expensesByCategory',
            'totalRev',
            'totalExp',
            'net',
            'categories',
            'byMethod',
            'annualMatrix',
            'annualTotalRevenue',
            'annualTotalExpense',
            'annualTotalNet'
        ));
    }

    /**
     * Export Transactions in exact Excel CSV Format matching the client's sheet
     */
    public function exportExcel(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployee()) {
            abort(403);
        }

        $year = (int) $request->get('year', Carbon::now()->year);

        $revCols = ['بلان شهرية', 'تصوير ومونتاج', 'مونتاج', 'تصميمات', 'تصوير إعلانات ممولة', 'خدمات أخرى'];
        $expCols = ['راتب شهري', 'شحن إعلانات ممولة', 'نت', 'اشتراكات مواقع', 'مشتريات', 'صيانة وإصلاحات', 'انتقالات', 'نثريات', 'أخرى', 'تبرعات لله', 'مصاريف تحويل'];

        $filename = "Pariq_Accounting_Sheet_{$year}.csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($year, $revCols, $expCols) {
            $out = fopen('php://output', 'w');
            // Write UTF-8 BOM so Excel opens Arabic correctly
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            $monthNames = [
                1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
                5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
                9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
            ];

            // 1. Sheet Header row 1
            fputcsv($out, array_merge(['التاريخ', 'اسم الموظف', 'البيان', 'الوارد'], array_fill(0, count($revCols) - 1, ''), ['اجمالي الوارد', 'اجمالي المنصرف', 'المنصرف'], array_fill(0, count($expCols) - 1, ''), ['الخزنة']));

            // 2. Sheet Sub-header row 2 with categories
            fputcsv($out, array_merge(['', '', ''], $revCols, ['', ''], $expCols, ['']));

            // Loop 12 months
            $yearMonthlyTotals = [];

            for ($m = 1; $m <= 12; $m++) {
                $txns = FinancialTransaction::with(['category', 'treasuryAccount', 'user'])
                    ->whereYear('transaction_date', $year)
                    ->whereMonth('transaction_date', $m)
                    ->orderBy('transaction_date', 'asc')
                    ->get();

                $mRevTotal = 0;
                $mExpTotal = 0;
                $mCategoryRevs = array_fill_keys($revCols, 0);
                $mCategoryExps = array_fill_keys($expCols, 0);

                foreach ($txns as $tx) {
                    $cName = $tx->category ? $tx->category->name : 'أخرى';
                    $rowRev = array_fill_keys($revCols, '');
                    $rowExp = array_fill_keys($expCols, '');
                    $totalRevRow = 0;
                    $totalExpRow = 0;

                    if ($tx->type === 'revenue') {
                        $colKey = in_array($cName, $revCols) ? $cName : 'خدمات أخرى';
                        $rowRev[$colKey] = $tx->amount;
                        $totalRevRow = $tx->amount;
                        $mRevTotal += $tx->amount;
                        $mCategoryRevs[$colKey] += $tx->amount;
                    } elseif ($tx->type === 'expense') {
                        $colKey = in_array($cName, $expCols) ? $cName : 'أخرى';
                        $rowExp[$colKey] = $tx->amount;
                        $totalExpRow = $tx->amount;
                        $mExpTotal += $tx->amount;
                        $mCategoryExps[$colKey] += $tx->amount;
                    }

                    $employeeName = $tx->user ? $tx->user->name : '';
                    $treasuryName = $tx->treasuryAccount ? $tx->treasuryAccount->name : '';

                    fputcsv($out, array_merge(
                        [$tx->transaction_date ? $tx->transaction_date->format('Y-m-d') : '', $employeeName, $tx->description],
                        array_values($rowRev),
                        [$totalRevRow, $totalExpRow],
                        array_values($rowExp),
                        [$treasuryName]
                    ));
                }

                // Month Total Row
                fputcsv($out, array_merge(
                    ["اجمالي شهر {$monthNames[$m]}", '', ''],
                    array_values($mCategoryRevs),
                    [$mRevTotal, $mExpTotal],
                    array_values($mCategoryExps),
                    ['']
                ));

                $yearMonthlyTotals[$m] = [
                    'name' => $monthNames[$m],
                    'revenue' => $mRevTotal,
                    'expense' => $mExpTotal,
                    'net' => $mRevTotal - $mExpTotal,
                ];
            }

            // Summary Annual Section at bottom
            fputcsv($out, []);
            fputcsv($out, ['', 'الشهر', 'الوارد', 'المنصرف', 'الباقي']);

            $grandRev = 0;
            $grandExp = 0;

            foreach ($yearMonthlyTotals as $ym) {
                fputcsv($out, ['', $ym['name'], $ym['revenue'], $ym['expense'], $ym['net']]);
                $grandRev += $ym['revenue'];
                $grandExp += $ym['expense'];
            }

            fputcsv($out, ['', 'الاجمالي', $grandRev, $grandExp, $grandRev - $grandExp]);

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
