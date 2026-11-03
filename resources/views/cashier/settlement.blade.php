@extends('layouts.app')

@section('title', 'تقفيل الخزينة اليومية')
@section('page_title', 'تقرير تسوية وتقفيل الخزينة اليومية')
@section('page_subtitle', 'مطابقة التحصيلات النقدية والإلكترونية لليوم وإغلاق الوردية')

@section('content')
<div class="space-y-6 pt-2">

    <!-- Date Filter & Actions -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <form method="GET" action="{{ route('cashier.settlement') }}" class="flex items-center gap-3">
            <label class="text-xs font-bold text-gray-300">تاريخ التسوية:</label>
            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" 
                   class="px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-xs text-white focus:outline-none focus:border-brand-gold">
            <button type="submit" class="px-3 py-1.5 bg-brand-hover border border-brand-border rounded-xl text-xs text-white">تحديث</button>
        </form>

        <div class="flex items-center gap-2">
            <a href="{{ route('cashier.index') }}" class="px-4 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-xs font-bold text-gray-300 border border-brand-border">
                <i class="fa-solid fa-arrow-right ml-1"></i>العودة للكاشير
            </a>
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow">
                <i class="fa-solid fa-print ml-1"></i>طباعة التقرير
            </button>
        </div>
    </div>

    <!-- Settlement Overview Card -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-6 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-brand-border">
            <div>
                <span class="text-xs text-brand-gold font-bold">تقرير إقفال حسابات الخزينة اليومية:</span>
                <h2 class="text-xl font-black text-white mt-1">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d F Y') }}</h2>
            </div>
            <div class="text-left">
                <div class="text-xs text-gray-400">إجمالي المقبوضات لليوم:</div>
                <div class="text-3xl font-black text-emerald-400 font-mono">{{ number_format($totalIncome, 2) }} <span class="text-sm font-bold text-gray-300">ج.م</span></div>
            </div>
        </div>

        <!-- Breakdown Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-4 rounded-xl bg-purple-500/10 border border-purple-500/20">
                <div class="flex items-center justify-between text-xs text-purple-300 font-bold mb-1">
                    <span>إنستاباي (InstaPay)</span>
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="text-xl font-black text-white">{{ number_format($byMethod['instapay'], 2) }} ج.م</div>
                <div class="text-[10px] text-gray-400 mt-1">مطابقة مع رصيد حساب البنك</div>
            </div>

            <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20">
                <div class="flex items-center justify-between text-xs text-rose-300 font-bold mb-1">
                    <span>فودافون كاش ومحافظ</span>
                    <i class="fa-solid fa-mobile-screen"></i>
                </div>
                <div class="text-xl font-black text-white">{{ number_format($byMethod['vodafone_cash'], 2) }} ج.م</div>
                <div class="text-[10px] text-gray-400 mt-1">مطابقة مع رصيد محفظة الشركة</div>
            </div>

            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                <div class="flex items-center justify-between text-xs text-emerald-300 font-bold mb-1">
                    <span>نقداً بالخزينة (Cash Drawer)</span>
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div class="text-xl font-black text-white">{{ number_format($byMethod['cash'], 2) }} ج.م</div>
                <div class="text-[10px] text-gray-400 mt-1">المبلغ الفعلي الموجود بالدرج</div>
            </div>

            <div class="p-4 rounded-xl bg-blue-500/10 border border-blue-500/20">
                <div class="flex items-center justify-between text-xs text-blue-300 font-bold mb-1">
                    <span>تحويلات بنكية رسمية</span>
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="text-xl font-black text-white">{{ number_format($byMethod['bank_transfer'], 2) }} ج.م</div>
                <div class="text-[10px] text-gray-400 mt-1">إشعارات تحويل الحساب الجاري</div>
            </div>
        </div>

        <!-- Detailed Transactions List for the Day -->
        <div class="space-y-3 pt-4 border-t border-brand-border">
            <h3 class="text-xs font-bold text-gray-300">تفاصيل فواتير وإيصالات هذا اليوم ({{ $payments->count() }} إيصال):</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead>
                        <tr class="border-b border-brand-border text-gray-400">
                            <th class="py-2 px-3">رقم الإيصال</th>
                            <th class="py-2 px-3">الوقت</th>
                            <th class="py-2 px-3">العميل</th>
                            <th class="py-2 px-3">المبلغ</th>
                            <th class="py-2 px-3">طريقة الدفع</th>
                            <th class="py-2 px-3">البيان</th>
                            <th class="py-2 px-3">المستلم</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/40">
                        @forelse($payments as $p)
                        <tr>
                            <td class="py-3 px-3 font-mono text-brand-gold font-bold">{{ $p->receipt_number }}</td>
                            <td class="py-3 px-3 text-gray-400">{{ $p->created_at->format('h:i A') }}</td>
                            <td class="py-3 px-3 font-bold text-white">{{ $p->client->name ?? '-' }}</td>
                            <td class="py-3 px-3 font-black text-emerald-400">{{ number_format($p->amount, 2) }} ج.م</td>
                            <td class="py-3 px-3">{{ $p->payment_method_arabic }}</td>
                            <td class="py-3 px-3 text-gray-300">{{ $p->notes ?? '-' }}</td>
                            <td class="py-3 px-3 text-gray-400">{{ $p->cashier->name ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">لا توجد عمليات قبض مسجلة في هذا التاريخ.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
