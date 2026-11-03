@extends('layouts.app')

@section('title', 'نظام الحسابات والمالية المتكامل')
@section('page_title', 'النظام المحاسبي والمالي العام')
@section('page_subtitle', 'إدارة الخزائن والحسابات البنكية، قيود اليومية، تحليل ربحية المشاريع، والمصروفات التفصيلية')

@section('content')
<div class="space-y-6 pt-2" x-data="{ addTxnModal: false, addTreasuryModal: false, addCategoryModal: false, txnType: 'expense' }">

    <!-- Top Financial Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Treasuries Balance -->
        <div class="bg-gradient-to-br from-brand-card via-brand-purple to-brand-card border border-brand-yellow/40 rounded-2xl p-5 shadow-lg relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">إجمالي الأرصدة في كافة الخزائن</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-brand-gold flex items-center justify-center text-lg">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ number_format($totalTreasuryBalance, 2) }} <span class="text-sm font-bold text-brand-gold">ج.م</span>
            </div>
            <div class="mt-2 text-[11px] text-gray-300">
                موزعة على {{ $treasuries->count() }} حسابات وخزائن نقدية وبنكية
            </div>
        </div>

        <!-- Total Revenues -->
        <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow group hover:border-emerald-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">إجمالي الإيرادات المقبوضة</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-arrow-down-left"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ number_format($totalRevenues, 2) }} <span class="text-sm font-bold text-emerald-400">ج.م</span>
            </div>
            <div class="mt-2 text-[11px] text-emerald-400 font-bold">
                إيرادات هذا الشهر: {{ number_format($monthRevenues, 2) }} ج.م
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow group hover:border-rose-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">إجمالي المصروفات والتكاليف</span>
                <div class="w-10 h-10 rounded-xl bg-rose-500/15 text-rose-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-arrow-up-right"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ number_format($totalExpenses, 2) }} <span class="text-sm font-bold text-rose-400">ج.م</span>
            </div>
            <div class="mt-2 text-[11px] text-rose-400 font-bold">
                مصروفات هذا الشهر: {{ number_format($monthExpenses, 2) }} ج.م
            </div>
        </div>

        <!-- Net Operating Income -->
        <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow group hover:border-brand-gold transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">صافي الدخل والأرباح الحقيقية</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-brand-gold flex items-center justify-center text-lg">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="text-2xl font-black {{ $netIncome >= 0 ? 'text-emerald-400' : 'text-rose-400' }} tracking-tight">
                {{ number_format($netIncome, 2) }} <span class="text-sm font-bold text-brand-gold">ج.م</span>
            </div>
            <div class="mt-2 text-[11px] text-gray-300">
                أرباح هذا الشهر الصافية: <strong class="text-emerald-400">{{ number_format($monthNet, 2) }} ج.م</strong>
            </div>
        </div>

    </div>

    <!-- Quick Accounting Action Bar -->
    <div class="flex flex-wrap items-center justify-between gap-3 bg-brand-card/80 border border-brand-border p-4 rounded-2xl">
        <div class="flex flex-wrap items-center gap-2">
            <button @click="txnType = 'revenue'; addTxnModal = true;" type="button" 
                    class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow flex items-center gap-1.5 transition">
                <i class="fa-solid fa-plus-circle"></i>
                <span>تسجيل إيراد قبض (+)</span>
            </button>

            <button @click="txnType = 'expense'; addTxnModal = true;" type="button" 
                    class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs shadow flex items-center gap-1.5 transition">
                <i class="fa-solid fa-minus-circle"></i>
                <span>تسجيل مصروف صرف (-)</span>
            </button>

            <button @click="txnType = 'transfer'; addTxnModal = true;" type="button" 
                    class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow flex items-center gap-1.5 transition">
                <i class="fa-solid fa-right-left"></i>
                <span>تحويل بين الخزائن (⇄)</span>
            </button>
        </div>

        <div class="flex items-center gap-2">
            <button @click="addTreasuryModal = true" type="button" 
                    class="px-3.5 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-gray-200 border border-brand-border font-bold text-xs transition flex items-center gap-1.5">
                <i class="fa-solid fa-wallet text-brand-gold"></i>
                <span>+ إضافة خزينة</span>
            </button>

            <a href="{{ route('accounting.reports') }}" 
               class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow transition flex items-center gap-1.5">
                <i class="fa-solid fa-chart-line"></i>
                <span>قائمة الأرباح والخسائر (P&L)</span>
            </a>
        </div>
    </div>

    <!-- 1. TREASURY ACCOUNTS & FUNDS (الخزائن والحسابات المالية) -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-building-columns text-brand-gold"></i>
                <span>الخزائن والحسابات المالية النشطة ({{ $treasuries->count() }})</span>
            </h3>
            <span class="text-xs text-brand-gold font-bold">الرصيد الإجمالي: {{ number_format($totalTreasuryBalance, 2) }} ج.م</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($treasuries as $tr)
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 shadow-sm hover:border-brand-yellow/50 transition space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-brand-gold">{{ $tr->type_name_arabic }}</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                </div>
                <h4 class="text-base font-black text-white">{{ $tr->name }}</h4>
                <div class="text-[11px] text-gray-400 font-mono">{{ $tr->account_number ?? 'حساب رئيسي' }}</div>
                <div class="pt-2 border-t border-brand-border/40 flex items-center justify-between">
                    <span class="text-xs text-gray-400">الرصيد الحالي:</span>
                    <span class="text-lg font-black text-emerald-400">{{ number_format($tr->balance, 2) }} ج.م</span>
                </div>
            </div>
            @empty
            <div class="col-span-4 p-8 text-center text-gray-400 text-xs">لا توجد خزائن مضافة.</div>
            @endforelse
        </div>
    </div>

    <!-- 2. FINANCIAL TRANSACTIONS JOURNAL (سجل القيود والمعاملات المحاسبية) -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        
        <!-- Filter Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-3 border-b border-brand-border">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-book text-brand-gold"></i>
                <h3 class="text-base font-bold text-white">دفتر اليومية وسجل القيود المحاسبية</h3>
            </div>

            <form method="GET" action="{{ route('accounting.index') }}" class="flex flex-wrap items-center gap-2 text-xs">
                <select name="type" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-2.5 py-1.5 focus:outline-none">
                    <option value="">كافة الأنواع</option>
                    <option value="revenue" {{ request('type') == 'revenue' ? 'selected' : '' }}>إيراد مقبوض (+)</option>
                    <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>مصروف مسدد (-)</option>
                    <option value="transfer" {{ request('type') == 'transfer' ? 'selected' : '' }}>تحويل بين الخزائن</option>
                </select>

                <select name="treasury_id" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-2.5 py-1.5 focus:outline-none">
                    <option value="">كافة الخزائن</option>
                    @foreach($treasuries as $tOpt)
                    <option value="{{ $tOpt->id }}" {{ request('treasury_id') == $tOpt->id ? 'selected' : '' }}>{{ $tOpt->name }}</option>
                    @endforeach
                </select>

                <input type="date" name="from_date" value="{{ request('from_date') }}" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-2.5 py-1.5 focus:outline-none" title="من تاريخ">
                <input type="date" name="to_date" value="{{ request('to_date') }}" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-2.5 py-1.5 focus:outline-none" title="إلى تاريخ">

                @if(request()->anyFilled(['type', 'treasury_id', 'from_date', 'to_date']))
                <a href="{{ route('accounting.index') }}" class="text-gray-400 hover:text-white px-2">إلغاء الفلتر</a>
                @endif
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border text-gray-400 bg-brand-purple/40">
                        <th class="py-3 px-3">رقم القيد</th>
                        <th class="py-3 px-3">التاريخ</th>
                        <th class="py-3 px-3">النوع</th>
                        <th class="py-3 px-3">البيان والتفاصيل</th>
                        <th class="py-3 px-3">البند المحاسبي</th>
                        <th class="py-3 px-3">الخزينة</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">الطرف / المشروع</th>
                        <th class="py-3 px-3">المسجل</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($transactions as $txn)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3 font-mono font-bold text-brand-gold">#{{ $txn->transaction_number }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $txn->transaction_date->format('Y-m-d') }}</td>
                        <td class="py-3 px-3">
                            @if($txn->type === 'revenue')
                            <span class="px-2 py-0.5 rounded-full font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">إيراد (+)</span>
                            @elseif($txn->type === 'expense')
                            <span class="px-2 py-0.5 rounded-full font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30">مصروف (-)</span>
                            @else
                            <span class="px-2 py-0.5 rounded-full font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">تحويل (⇄)</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 font-bold text-white max-w-xs truncate">{{ $txn->description }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $txn->category->name ?? '-' }}</td>
                        <td class="py-3 px-3 text-gray-300 font-semibold">{{ $txn->treasuryAccount->name ?? '-' }}</td>
                        <td class="py-3 px-3 font-black text-sm {{ $txn->type === 'revenue' ? 'text-emerald-400' : 'text-rose-400' }}">
                            {{ $txn->type === 'revenue' ? '+' : '-' }}{{ number_format($txn->amount, 2) }} ج.م
                        </td>
                        <td class="py-3 px-3 text-gray-400">
                            {{ $txn->client->name ?? ($txn->project->title ?? ($txn->user->name ?? '-')) }}
                        </td>
                        <td class="py-3 px-3 text-gray-400 text-[11px]">{{ $txn->creator->name ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-8 text-center text-gray-500">لا توجد قيود مسجلة بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $transactions->links() }}
        </div>
    </div>

    <!-- 3. PROJECT PROFITABILITY ANALYSIS TABLE (تحليل ربحية كل مشروع) -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-brand-gold"></i>
                <span>تحليل ربحية المشروعات (الميزانية vs المصروفات vs صافي الأرباح)</span>
            </h3>
            <span class="text-xs text-gray-400">تحليل فوري لهامش ربح كل مشروع</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border text-gray-400 bg-brand-purple/40">
                        <th class="py-3 px-3">المشروع</th>
                        <th class="py-3 px-3">العميل</th>
                        <th class="py-3 px-3">ميزانية التعاقد</th>
                        <th class="py-3 px-3">المحصل (الإيراد)</th>
                        <th class="py-3 px-3">المصروف المباشر</th>
                        <th class="py-3 px-3">صافي ربح المشروع</th>
                        <th class="py-3 px-3">نسبة هامش الربح</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($projectProfitability as $pProf)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3 font-bold text-white">
                            <a href="{{ route('projects.show', $pProf->id) }}" class="hover:text-brand-gold transition">{{ $pProf->title }}</a>
                        </td>
                        <td class="py-3 px-3 text-gray-300">{{ $pProf->client->name ?? '-' }}</td>
                        <td class="py-3 px-3 font-bold text-white">{{ number_format($pProf->total_budget, 2) }} ج.م</td>
                        <td class="py-3 px-3 font-bold text-emerald-400">{{ number_format($pProf->payments->sum('amount'), 2) }} ج.م</td>
                        <td class="py-3 px-3 font-bold text-rose-400">{{ number_format($pProf->expenses->sum('amount'), 2) }} ج.م</td>
                        <td class="py-3 px-3 font-black text-emerald-400">{{ number_format($pProf->net_profit, 2) }} ج.م</td>
                        <td class="py-3 px-3">
                            <span class="px-2.5 py-0.5 rounded-full font-bold text-[10px] {{ $pProf->profit_margin_percentage >= 50 ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-300' }}">
                                {{ $pProf->profit_margin_percentage }}%
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-500">لا توجد مشاريع لتحليلها.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD TRANSACTION MODAL -->
    <div x-show="addTxnModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addTxnModal = false" 
             class="w-full max-w-xl bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calculator text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تسجيل قيد مالي في الدفتر المحاسبي</h3>
                </div>
                <button @click="addTxnModal = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('accounting.transactions.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-3 gap-2 p-1.5 rounded-xl bg-brand-purple border border-brand-border">
                    <button type="button" @click="txnType = 'revenue'" :class="txnType === 'revenue' ? 'bg-emerald-600 text-white font-bold' : 'text-gray-300'" class="py-2 rounded-lg text-xs transition">إيراد مقبوض (+)</button>
                    <button type="button" @click="txnType = 'expense'" :class="txnType === 'expense' ? 'bg-rose-600 text-white font-bold' : 'text-gray-300'" class="py-2 rounded-lg text-xs transition">مصروف مسدد (-)</button>
                    <button type="button" @click="txnType = 'transfer'" :class="txnType === 'transfer' ? 'bg-blue-600 text-white font-bold' : 'text-gray-300'" class="py-2 rounded-lg text-xs transition">تحويل بين خزائن (⇄)</button>
                </div>
                <input type="hidden" name="type" :value="txnType">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المبلغ (ج.م) <span class="text-red-400">*</span></label>
                        <input type="number" step="0.01" name="amount" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: 4500">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تاريخ المعاملة <span class="text-red-400">*</span></label>
                        <input type="date" name="transaction_date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الخزينة / الحساب المالي <span class="text-red-400">*</span></label>
                        <select name="treasury_account_id" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            @foreach($treasuries as $trItem)
                            <option value="{{ $trItem->id }}">{{ $trItem->name }} ({{ number_format($trItem->balance) }} ج.م)</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Target treasury if transfer -->
                    <div x-show="txnType === 'transfer'">
                        <label class="block font-bold text-blue-300 mb-1">التحويل إلى خزينة:</label>
                        <select name="target_treasury_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            @foreach($treasuries as $trItem2)
                            <option value="{{ $trItem2->id }}">{{ $trItem2->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="txnType !== 'transfer'">
                        <label class="block font-bold text-gray-300 mb-1">البند المحاسبي (التصنيف)</label>
                        <select name="accounting_category_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="">بدون تصنيف محدد</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">[{{ $cat->type_name_arabic }}] {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">طريقة الدفع</label>
                        <select name="payment_method" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="instapay">انستاباي (InstaPay)</option>
                            <option value="vodafone_cash">فودافون كاش</option>
                            <option value="bank_transfer">تحويل بنكي</option>
                            <option value="cash">نقداً (كاش)</option>
                            <option value="credit_card">بطاقة ائتمان</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم المرجع / كود التحويل</label>
                        <input type="text" name="reference_number" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: REF-99238">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">العميل المرتبط (اختياري)</label>
                        <select name="client_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="">لا يوجد</option>
                            @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المشروع المرتبط (اختياري)</label>
                        <select name="project_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="">لا يوجد</option>
                            @foreach($projects as $p)
                            <option value="{{ $p->id }}">{{ $p->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">بيان ووصف القيد <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="2" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="اكتب بياناً تفصيلياً للقيد المالي..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addTxnModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-6 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">
                        حفظ القيد المحاسبي
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ADD TREASURY MODAL -->
    <div x-show="addTreasuryModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addTreasuryModal = false" 
             class="w-full max-w-md bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-wallet text-brand-gold"></i>
                    <span>إضافة خزينة أو حساب مالي جديد</span>
                </h3>
                <button @click="addTreasuryModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form action="{{ route('accounting.treasuries.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم الخزينة / الحساب <span class="text-red-400">*</span></label>
                    <input type="text" name="name" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: فودافون كاش رقم 2">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">نوع الحساب</label>
                    <select name="type" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                        <option value="instapay">انستاباي (InstaPay)</option>
                        <option value="vodafone_cash">محفظة ذكية (فودافون/أورنج/اتصالات)</option>
                        <option value="bank">حساب بنكي تجاري</option>
                        <option value="cash">خزينة المقر (نقدية كاش)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">رقم الحساب / المحفظة</label>
                    <input type="text" name="account_number" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="010...">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الرصيد الافتتاحي (ج.م)</label>
                    <input type="number" step="0.01" name="balance" value="0" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addTreasuryModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ الخزينة</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

