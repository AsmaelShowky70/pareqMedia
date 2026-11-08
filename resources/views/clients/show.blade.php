@extends('layouts.app')

@section('title', 'ملف العميل: ' . $client->name)
@section('page_title', $client->name)
@section('page_subtitle', 'سجل التعاقد الشهري، جدول الدفعات والأقساط، والمهام المجدولة')

@section('content')
<div class="space-y-6 pt-2" x-data="{ addInstallmentModal: false, payInstallmentModal: false, activeInstallment: null }">

    <!-- Top Client Banner -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-6 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <h2 class="text-2xl font-black text-white">{{ $client->name }}</h2>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $client->status === 'active' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-500/20 text-slate-300' }}">
                        {{ $client->status === 'active' ? 'تعاقد نشط' : $client->status }}
                    </span>
                </div>
                @if($client->brand_name)
                <div class="text-sm text-brand-gold font-bold">البراند: {{ $client->brand_name }}</div>
                @endif
                <div class="text-xs text-gray-400 flex flex-wrap items-center gap-4 pt-1">
                    <span><i class="fa-solid fa-earth-americas text-brand-gold ml-1"></i>{{ $client->country }}</span>
                    <span><i class="fa-solid fa-phone text-brand-gold ml-1"></i>{{ $client->phone }}</span>
                    @if($client->service_package)
                    <span><i class="fa-solid fa-box text-brand-gold ml-1"></i>{{ $client->service_package }}</span>
                    @endif
                    <span class="text-emerald-400 font-bold"><i class="fa-solid fa-repeat ml-1"></i>التجديد الشهري: {{ number_format($client->monthly_retainer ?? 0, 2) }} ج.م</span>
                </div>
            </div>

            <!-- WhatsApp & Actions -->
            <div class="flex items-center gap-2">
                @if($client->phone)
                @php $cleanPhone = preg_replace('/[^0-9]/', '', $client->phone); @endphp
                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" 
                   class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition flex items-center gap-1.5">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>محادثة واتساب</span>
                </a>
                @endif

                <button @click="addInstallmentModal = true" type="button" 
                        class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow transition flex items-center gap-1.5">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span>+ إضافة دفعة / قسط</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Financial Stats for this client -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">إجمالي ما تم تحصيله</div>
            <div class="text-xl font-black text-emerald-400 mt-1">{{ number_format($client->total_paid, 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">قيمة التعاقد الشهري المتكرر</div>
            <div class="text-xl font-black text-white mt-1">{{ number_format($client->monthly_retainer ?? 0, 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">الأقساط المتبقية مستحقة السداد</div>
            @php $pendingSum = $client->installments->where('status', 'pending')->sum('amount'); @endphp
            <div class="text-xl font-black text-amber-400 mt-1">{{ number_format($pendingSum, 2) }} ج.م</div>
        </div>
    </div>

    <!-- 1. CLIENT PAYMENT INSTALLMENTS SCHEDULE (جدول دفعات وأقساط العميل) -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-credit-card text-brand-gold text-base"></i>
                <h3 class="text-base font-bold text-white">جدول دفعات وأقساط العميل ومواعيد الاستحقاق</h3>
            </div>
            <button @click="addInstallmentModal = true" type="button" class="text-xs text-brand-gold font-bold hover:underline">
                + إضافة دفعة جديدة
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border/60 text-gray-400">
                        <th class="py-3 px-3">الدفعة / البيان</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">تاريخ الاستحقاق</th>
                        <th class="py-3 px-3">حالة الدفعة والمتابعة</th>
                        <th class="py-3 px-3">طريقة السداد</th>
                        <th class="py-3 px-3 text-left">إجراء</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($client->installments as $installment)
                    @php $urg = $installment->urgency_info; @endphp
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3 font-bold text-white">{{ $installment->title }}</td>
                        <td class="py-3 px-3 font-black text-emerald-400">{{ number_format($installment->amount, 2) }} ج.م</td>
                        <td class="py-3 px-3 text-gray-300 font-bold">{{ $installment->due_date->format('Y-m-d') }}</td>
                        <td class="py-3 px-3">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $urg['badge'] }}">
                                {{ $urg['label'] }}
                            </span>
                        </td>
                        <td class="py-3 px-3 text-gray-400">{{ $installment->payment_method ?? 'في انتظار التحصيل' }}</td>
                        <td class="py-3 px-3 text-left">
                            @if($installment->status !== 'paid')
                            <button @click="activeInstallment = {{ json_encode($installment) }}; payInstallmentModal = true;" 
                                    class="px-3 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition">
                                تسجيل السداد
                            </button>
                            @else
                            <span class="text-emerald-400 font-bold text-xs"><i class="fa-solid fa-check-circle ml-1"></i>مسدد</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-400">لم يتم جدول دفعات أو أقساط لهذا العميل بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. MONTHLY TASKS FOR THIS CLIENT (فلتر مهام هذا العميل شهرياً) -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-brand-gold"></i>
                    <span>مهام العميل لشهر: {{ $selectedDate->translatedFormat('F Y') }}</span>
                </h3>
                <p class="text-xs text-gray-400">متابعة كافة المهام المنفذة أو المجدولة لهذا العميل في هذا الشهر بالتحديد</p>
            </div>

            <!-- Month Switcher for this client -->
            <form method="GET" action="{{ route('clients.show', $client->id) }}" class="flex items-center gap-2">
                <span class="text-xs text-gray-400">اختر الشهر:</span>
                <input type="month" name="month" value="{{ $selectedDate->format('Y-m') }}" onchange="this.form.submit()"
                       class="bg-brand-purple border border-brand-border rounded-xl text-xs text-white px-2.5 py-1.5 focus:outline-none focus:border-brand-gold">
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-2">
            @forelse($monthTasks as $task)
            <div class="p-3.5 rounded-xl bg-brand-purple/60 border border-brand-border space-y-2 text-xs">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h4 class="font-bold text-white">{{ $task->title }}</h4>
                        <span class="text-[11px] text-brand-gold font-bold">المسؤول: {{ $task->assignee->name ?? 'غير محدد' }}</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $task->status_badge }}">
                        {{ $task->status_label }}
                    </span>
                </div>
                <div class="flex items-center justify-between text-gray-400 text-[11px] pt-1 border-t border-brand-border/40">
                    <span>موعد التسليم: <strong class="text-white">{{ $task->delivery_deadline ? $task->delivery_deadline->format('Y-m-d') : 'مفتوح' }}</strong></span>
                    @if($task->delivery_link)
                    <a href="{{ $task->delivery_link }}" target="_blank" class="text-emerald-400 hover:underline font-bold flex items-center gap-1">
                        <i class="fa-solid fa-link"></i>
                        <span>رابط التسليم</span>
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-2 p-8 text-center text-gray-400 text-xs bg-brand-purple/30 rounded-xl">
                لا توجد مهام مسجلة لهذا العميل في شهر {{ $selectedDate->translatedFormat('F Y') }}.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 3. MONTHLY CONTENT PUBLISHING PLAN FOR THIS CLIENT (خطة وجدول النشر الشهري للعميل) -->
    @if(Auth::user()->isAdmin() || Auth::user()->isContentCreator())
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-brand-gold"></i>
                    <span>خطة وجدول النشر لشهر: {{ $selectedDate->translatedFormat('F Y') }} ({{ $monthContentPlans->count() }} منشور)</span>
                </h3>
                <p class="text-xs text-gray-400">متابعة مواعيد نشر الريلز والبوستات والروابط ومراجعات العميل لهذا الشهر</p>
            </div>

            <a href="{{ route('content-plans.index', ['client_id' => $client->id, 'year' => $selectedDate->year, 'month' => $selectedDate->month]) }}" 
               class="px-3.5 py-1.5 rounded-xl bg-brand-yellow/15 hover:bg-brand-yellow/25 text-brand-gold border border-brand-yellow/30 text-xs font-bold transition flex items-center gap-1.5">
                <i class="fa-solid fa-up-right-from-square"></i>
                <span>فتح التقويم والجدول الكامل</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border/60 text-gray-400 text-[11px]">
                        <th class="py-2.5 px-3">اسم المحتوى</th>
                        <th class="py-2.5 px-3">النوع</th>
                        <th class="py-2.5 px-3 text-center">أقصى موعد لتسليم العميل</th>
                        <th class="py-2.5 px-3 text-center">ميعاد النشر</th>
                        <th class="py-2.5 px-3 text-center">حالة التنفيذ</th>
                        <th class="py-2.5 px-3 text-center">حالة النشر</th>
                        <th class="py-2.5 px-3 text-center">المحتوى</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($monthContentPlans as $plan)
                    @php
                        $tBadge = $plan->type_badge;
                        $pBadge = $plan->publishing_status_badge;
                        $prBadge = $plan->production_status_badge;
                    @endphp
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-2.5 px-3 font-bold text-white">{{ $plan->title }}</td>
                        <td class="py-2.5 px-3">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $tBadge['badge'] }}">
                                <i class="fa-solid {{ $tBadge['icon'] }} ml-1"></i>{{ $tBadge['label'] }}
                            </span>
                        </td>
                        <td class="py-2.5 px-3 text-center text-gray-300">
                            {{ $plan->client_delivery_deadline ? $plan->client_delivery_deadline->format('Y-m-d') : '-' }}
                        </td>
                        <td class="py-2.5 px-3 text-center font-bold text-white">
                            {{ $plan->publish_date->format('Y-m-d') }}
                            <span class="text-[10px] text-brand-gold block">{{ $plan->publish_time ?? '18:00' }}</span>
                        </td>
                        <td class="py-2.5 px-3 text-center">
                            <span class="px-2 py-0.5 rounded text-[10px] {{ $prBadge['class'] }}">{{ $prBadge['label'] }}</span>
                        </td>
                        <td class="py-2.5 px-3 text-center">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $pBadge['class'] }}">{{ $pBadge['label'] }}</span>
                        </td>
                        <td class="py-2.5 px-3 text-center">
                            @if($plan->content_url)
                                <a href="{{ $plan->content_url }}" target="_blank" class="text-indigo-400 hover:underline font-bold text-[11px] inline-flex items-center gap-1">
                                    <i class="fa-brands fa-google-drive text-amber-400"></i>
                                    <span>معاينة</span>
                                </a>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-400">
                            لا توجد منشورات مجدولة لهذا العميل في شهر {{ $selectedDate->translatedFormat('F Y') }}.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 3. Payments & Receipts History -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-lg space-y-4">
        <h3 class="text-base font-bold text-white flex items-center gap-2">
            <i class="fa-solid fa-receipt text-brand-gold"></i>
            <span>سجل إيصالات القبض والمدفوعات السابقة ({{ $client->payments->count() }})</span>
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border/60 text-gray-400">
                        <th class="py-3 px-3">رقم الإيصال</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">طريقة الدفع</th>
                        <th class="py-3 px-3">المستلم (الكاشير)</th>
                        <th class="py-3 px-3">التاريخ</th>
                        <th class="py-3 px-3 text-left">طباعة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($client->payments as $pmt)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3 font-bold text-brand-gold">#{{ $pmt->receipt_number }}</td>
                        <td class="py-3 px-3 font-black text-emerald-400">{{ number_format($pmt->amount, 2) }} ج.م</td>
                        <td class="py-3 px-3 text-gray-300">{{ $pmt->payment_method_arabic }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $pmt->cashier->name ?? '-' }}</td>
                        <td class="py-3 px-3 text-gray-400">{{ $pmt->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-3 text-left">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('cashier.receipt', $pmt->id) }}" target="_blank" class="px-2.5 py-1 rounded bg-brand-purple hover:bg-brand-hover text-brand-gold font-bold flex items-center gap-1" title="معاينة وتحميل الفاتورة PDF">
                                    <i class="fa-solid fa-file-pdf text-red-400"></i>
                                    <span>فاتورة PDF</span>
                                </a>
                                @if($client->phone)
                                @php
                                    $cleanClientPhone = preg_replace('/[^0-9]/', '', $client->phone);
                                    if (str_starts_with($cleanClientPhone, '01') && strlen($cleanClientPhone) === 11) {
                                        $cleanClientPhone = '2' . $cleanClientPhone;
                                    }
                                    $publicRecUrl = route('public.receipt', $pmt->receipt_number);
                                    $recMsg = urlencode("مرحباً {$client->name}، مرفق لحضرتك إيصال استلام دفعة رسمية من شركة بريق برقم {$pmt->receipt_number} بمبلغ " . number_format($pmt->amount) . " ج.م.\n\n📄 لتحميل الفاتورة PDF:\n{$publicRecUrl}\n\nنشكر ثقتكم بوكالة بريق!");
                                @endphp
                                <a href="https://wa.me/{{ $cleanClientPhone }}?text={{ $recMsg }}" target="_blank" class="p-1 rounded bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500 hover:text-white transition" title="مشاركة الفاتورة مع العميل عبر واتساب">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-400">لا توجد إيصالات مسجلة بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD INSTALLMENT MODAL -->
    <div x-show="addInstallmentModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addInstallmentModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calendar-plus text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">إضافة دفعة / قسط مالي للعميل</h3>
                </div>
                <button @click="addInstallmentModal = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('clients.installments.store', $client->id) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">بيان الدفعة <span class="text-red-400">*</span></label>
                    <input type="text" name="title" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: دفعة التعاقد الأولى، قسط شهر نوفمبر...">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المبلغ المطلوب (ج.م) <span class="text-red-400">*</span></label>
                        <input type="number" step="0.01" name="amount" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: 5000">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تاريخ استحقاق الدفعة <span class="text-red-400">*</span></label>
                        <input type="date" name="due_date" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">المشروع المرتبط بالدفعة (اختياري)</label>
                    <select name="project_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                        <option value="">بدون ربط بمشروع معين (عام)</option>
                        @foreach($projects as $p)
                        <option value="{{ $p->id }}">{{ $p->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات إضافية</label>
                    <textarea name="notes" rows="2" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addInstallmentModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ القسط</button>
                </div>
            </form>
        </div>
    </div>

    <!-- PAY INSTALLMENT MODAL -->
    <div x-show="payInstallmentModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="payInstallmentModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check-double text-emerald-400 text-lg"></i>
                    <h3 class="text-base font-bold text-white">تسجيل سداد وتحصيل الدفعة</h3>
                </div>
                <button @click="payInstallmentModal = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/installments/' + (activeInstallment ? activeInstallment.id : '') + '/pay'" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">الدفعة:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple/70 text-white font-bold" x-text="activeInstallment ? activeInstallment.title : ''"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المبلغ المسدد (ج.م) <span class="text-red-400">*</span></label>
                        <input type="number" step="0.01" name="paid_amount" required :value="activeInstallment ? activeInstallment.amount : 0" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">طريقة السداد <span class="text-red-400">*</span></label>
                        <select name="payment_method" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="instapay">انستاباي (InstaPay)</option>
                            <option value="vodafone_cash">فودافون كاش</option>
                            <option value="bank_transfer">تحويل بنكي</option>
                            <option value="cash">نقداً (كاش)</option>
                            <option value="credit_card">بطاقة ائتمان</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">إيداع إلى الخزينة / الحساب المالي:</label>
                    <select name="treasury_account_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                        @foreach($treasuries as $tr)
                        <option value="{{ $tr->id }}">{{ $tr->name }} (رصيده: {{ number_format($tr->balance) }} ج.م)</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">رقم مرجع التحويل / كود العملية</label>
                    <input type="text" name="transaction_reference" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: IP-99238128">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="payInstallmentModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black shadow">
                        تأكيد السداد وإصدار الإيصال
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
