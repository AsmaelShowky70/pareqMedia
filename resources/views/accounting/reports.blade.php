@extends('layouts.app')

@section('title', 'قائمة الأرباح والخسائر والتقارير المالية')
@section('page_title', 'قائمة الدخل والتقارير المالية التفصيلية (P&L)')
@section('page_subtitle', 'تحليل الإيرادات والمصروفات وصافي الأرباح السنوية والشهرية لوكالة بريق')

@section('content')
<div class="space-y-6 pt-2">

    <!-- Top Filter & Actions Bar -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        
        <form method="GET" action="{{ route('accounting.reports') }}" class="flex flex-wrap items-center gap-3 text-xs">
            <div class="flex items-center gap-1.5">
                <span class="text-gray-400">السنة المالية:</span>
                <select name="year" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-3 py-1.5 focus:outline-none focus:border-brand-gold">
                    @for($y = date('Y') + 1; $y >= 2024; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex items-center gap-1.5">
                <span class="text-gray-400">الشهر:</span>
                <select name="month" onchange="this.form.submit()" class="bg-brand-purple border border-brand-border rounded-xl text-white px-3 py-1.5 focus:outline-none focus:border-brand-gold">
                    <option value="">كامل السنة</option>
                    @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>شهر {{ $m }}</option>
                    @endfor
                </select>
            </div>
        </form>

        <div class="flex items-center gap-2">
            <a href="{{ route('accounting.export-excel', ['year' => $year]) }}" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow flex items-center gap-1.5 transition">
                <i class="fa-solid fa-file-excel"></i>
                <span>تصدير شيت إكسيل (CSV)</span>
            </a>
            <a href="{{ route('accounting.index') }}" class="px-4 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-gray-300 font-bold text-xs border border-brand-border transition">
                ← العودة للحسابات
            </a>
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>طباعة التقرير</span>
            </button>
        </div>
    </div>

    <!-- P&L Financial Statement Card -->
    <div class="bg-brand-card/95 border border-brand-border rounded-2xl p-6 shadow-2xl space-y-6">
        
        <!-- Statement Header -->
        <div class="text-center pb-4 border-b border-brand-border space-y-1">
            <h2 class="text-xl font-black text-white">قائمة الأرباح والخسائر الشاملة (Profit & Loss Statement)</h2>
            <p class="text-xs text-brand-gold font-bold">وكالة بريق للتسويق الإلكتروني | السنة المالية: {{ $year }} {{ $month ? ' - شهر ' . $month : '' }}</p>
        </div>

        <!-- Statement Summary Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <div class="p-4 rounded-xl bg-emerald-950/20 border border-emerald-500/30">
                <div class="text-xs text-gray-400 font-bold">إجمالي الإيرادات</div>
                <div class="text-2xl font-black text-emerald-400 mt-1">{{ number_format($totalRev, 2) }} ج.م</div>
            </div>
            <div class="p-4 rounded-xl bg-rose-950/20 border border-rose-500/30">
                <div class="text-xs text-gray-400 font-bold">إجمالي التكاليف والمصروفات</div>
                <div class="text-2xl font-black text-rose-400 mt-1">{{ number_format($totalExp, 2) }} ج.م</div>
            </div>
            <div class="p-4 rounded-xl bg-brand-purple border border-brand-yellow/40">
                <div class="text-xs text-brand-gold font-bold">صافي الربح النهائي</div>
                <div class="text-2xl font-black text-white mt-1">{{ number_format($net, 2) }} ج.م</div>
            </div>
        </div>

        <!-- Section 1: Revenues Breakdown -->
        <div class="space-y-3 pt-2">
            <h3 class="text-sm font-black text-emerald-400 flex items-center gap-2 border-b border-emerald-500/20 pb-2">
                <i class="fa-solid fa-arrow-down-left"></i>
                <span>أولاً: بنود الإيرادات والمبيعات (Revenues)</span>
            </h3>

            <div class="space-y-2 text-xs">
                @forelse($revenuesByCategory as $catId => $txns)
                @php $cat = $categories->get($catId); @endphp
                <div class="flex items-center justify-between p-3 rounded-xl bg-brand-purple/50 border border-brand-border/40">
                    <span class="font-bold text-white">{{ $cat ? $cat->name : 'إيرادات عامة غير مصنفة' }}</span>
                    <span class="font-black text-emerald-400 text-sm">{{ number_format($txns->sum('amount'), 2) }} ج.م</span>
                </div>
                @empty
                <div class="p-4 text-center text-gray-500 text-xs">لا توجد إيرادات مسجلة لهذه الفترة.</div>
                @endforelse

                <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 font-black text-xs text-emerald-300">
                    <span>مجموع الإيرادات الكلية:</span>
                    <span class="text-sm">{{ number_format($totalRev, 2) }} ج.م</span>
                </div>
            </div>
        </div>

        <!-- Section 2: Operating Expenses Breakdown -->
        <div class="space-y-3 pt-2">
            <h3 class="text-sm font-black text-rose-400 flex items-center gap-2 border-b border-rose-500/20 pb-2">
                <i class="fa-solid fa-arrow-up-right"></i>
                <span>ثانياً: بنود التكاليف والمصروفات التشغيلية (Operating Expenses)</span>
            </h3>

            <div class="space-y-2 text-xs">
                @forelse($expensesByCategory as $catId => $txns)
                @php $cat = $categories->get($catId); @endphp
                <div class="flex items-center justify-between p-3 rounded-xl bg-brand-purple/50 border border-brand-border/40">
                    <span class="font-bold text-white">{{ $cat ? $cat->name : 'مصروفات عامة' }}</span>
                    <span class="font-black text-rose-400 text-sm">{{ number_format($txns->sum('amount'), 2) }} ج.م</span>
                </div>
                @empty
                <div class="p-4 text-center text-gray-500 text-xs">لا توجد مصروفات مسجلة لهذه الفترة.</div>
                @endforelse

                <div class="flex items-center justify-between p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 font-black text-xs text-rose-300">
                    <span>مجموع المصروفات الكلية:</span>
                    <span class="text-sm">{{ number_format($totalExp, 2) }} ج.م</span>
                </div>
            </div>
        </div>

        <!-- Section 3: Cash Flow by Payment Method -->
        <div class="space-y-3 pt-2">
            <h3 class="text-sm font-black text-brand-gold flex items-center gap-2 border-b border-brand-border pb-2">
                <i class="fa-solid fa-money-bill-transfer"></i>
                <span>ثالثاً: التدفق النقدي حسب قنوات الدفع (Cash Flow)</span>
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                @foreach($byMethod as $m)
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border">
                    <div class="text-gray-400 font-bold capitalize">{{ $m->payment_method }}</div>
                    <div class="text-base font-black text-white mt-1">{{ number_format($m->net_amount, 2) }} ج.م</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Section 4: Annual 12-Month Matrix (مطابق لجدول الإكسيل السنوي) -->
        <div class="space-y-3 pt-4 border-t border-brand-border">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-white flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-brand-gold"></i>
                    <span>رابعاً: الجدول الختامي السنوي للشهور (الوارد، المنصرف، الباقي) - لسنة {{ $year }}</span>
                </h3>
                <span class="text-[11px] text-gray-400">مطابق لنموذج شيت الإكسيل المعتمد للوكالة</span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-brand-border">
                <table class="w-full text-right text-xs">
                    <thead>
                        <tr class="bg-brand-dark/90 text-gray-400 border-b border-brand-border text-[11px] font-bold">
                            <th class="py-3 px-4">الشهر</th>
                            <th class="py-3 px-4 text-center">الوارد (ج.م)</th>
                            <th class="py-3 px-4 text-center">المنصرف (ج.م)</th>
                            <th class="py-3 px-4 text-center">الباقي / صافي الربح (ج.م)</th>
                            <th class="py-3 px-4 text-center">حالة الشهر</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/40">
                        @foreach($annualMatrix as $item)
                        <tr class="hover:bg-brand-hover/40 transition {{ $item['month_num'] == date('n') && $year == date('Y') ? 'bg-brand-yellow/5' : '' }}">
                            <td class="py-3 px-4 font-bold text-white flex items-center gap-2">
                                <span>{{ $item['name'] }}</span>
                                @if($item['month_num'] == date('n') && $year == date('Y'))
                                <span class="px-1.5 py-0.5 rounded text-[9px] bg-brand-yellow/20 text-brand-gold font-bold">الحالي</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center font-bold text-emerald-400">
                                {{ number_format($item['revenue'], 2) }}
                            </td>
                            <td class="py-3 px-4 text-center font-bold text-rose-400">
                                {{ number_format($item['expense'], 2) }}
                            </td>
                            <td class="py-3 px-4 text-center font-black {{ $item['net'] >= 0 ? 'text-white' : 'text-rose-400' }}">
                                {{ number_format($item['net'], 2) }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($item['revenue'] == 0 && $item['expense'] == 0)
                                <span class="text-gray-500 text-[10px]">لا توجد حركات</span>
                                @elseif($item['net'] > 0)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">فائض ربحي</span>
                                @elseif($item['net'] < 0)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/15 text-rose-300 border border-rose-500/30">عجز مالي</span>
                                @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-500/15 text-gray-300">متوازن</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-brand-dark font-black text-sm border-t-2 border-brand-yellow/40 text-brand-gold">
                            <td class="py-3.5 px-4 text-white font-black">الإجمالي السنوي العام:</td>
                            <td class="py-3.5 px-4 text-center text-emerald-400">{{ number_format($annualTotalRevenue, 2) }} ج.م</td>
                            <td class="py-3.5 px-4 text-center text-rose-400">{{ number_format($annualTotalExpense, 2) }} ج.م</td>
                            <td class="py-3.5 px-4 text-center {{ $annualTotalNet >= 0 ? 'text-white' : 'text-rose-400' }}">{{ number_format($annualTotalNet, 2) }} ج.م</td>
                            <td class="py-3.5 px-4 text-center text-xs">
                                <span class="px-2 py-0.5 rounded bg-brand-yellow/20 text-brand-gold font-bold">ختام السنة</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

