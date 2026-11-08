@extends('layouts.app')

@section('title', 'كاشير الوكالة وإيصالات القبض')
@section('page_title', 'كاشير وكالة بريق (POS & Quick Invoicing)')
@section('page_subtitle', 'تسجيل الدفعات السريعة، إيصالات القبض الفورية، وتقفيل الخزينة اليومية بنقرة زر')

@section('content')
<div class="space-y-6 pt-2" x-data="{ 
    quickClientModal: false, 
    selectedPackage: null,
    amount: '',
    notes: '',
    paymentType: 'down_payment',
    paymentMethod: 'instapay',
    setPackage(title, price, type) {
        this.amount = price;
        this.notes = 'سداد: ' + title;
        this.paymentType = type || 'quick_service';
    }
}">

    <!-- Today's Cash Register Inflows Strip -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-yellow/40 rounded-2xl p-5 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div>
                <span class="text-xs font-bold text-brand-gold flex items-center gap-1.5">
                    <i class="fa-solid fa-cash-register"></i>
                    <span>إجمالي ما دخل الخزينة اليوم ({{ \Carbon\Carbon::today()->format('Y-m-d') }}):</span>
                </span>
                <div class="text-3xl font-black text-white mt-1">
                    {{ number_format($todayTotal, 0) }} <span class="text-base font-bold text-brand-gold">ج.م</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('cashier.settlement') }}" 
                   class="px-4 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover border border-brand-border text-xs text-white font-bold transition flex items-center gap-2 shadow">
                    <i class="fa-solid fa-file-invoice text-brand-gold"></i>
                    <span>تقرير تقفيل الخزينة اليومية</span>
                </a>
            </div>
        </div>

        <!-- Breakdown by Payment Method -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-3 border-t border-brand-border/60">
            <div class="p-3 rounded-xl bg-brand-dark/50 border border-brand-border/40">
                <div class="text-[11px] text-gray-400 font-bold flex items-center justify-between">
                    <span>إنستاباي (InstaPay)</span>
                    <i class="fa-solid fa-bolt text-purple-400"></i>
                </div>
                <div class="text-base font-black text-white mt-1">{{ number_format($todayInstapay) }} ج.م</div>
            </div>

            <div class="p-3 rounded-xl bg-brand-dark/50 border border-brand-border/40">
                <div class="text-[11px] text-gray-400 font-bold flex items-center justify-between">
                    <span>فودافون كاش</span>
                    <i class="fa-solid fa-mobile-screen text-rose-400"></i>
                </div>
                <div class="text-base font-black text-white mt-1">{{ number_format($todayVodafone) }} ج.م</div>
            </div>

            <div class="p-3 rounded-xl bg-brand-dark/50 border border-brand-border/40">
                <div class="text-[11px] text-gray-400 font-bold flex items-center justify-between">
                    <span>نقداً بالخزينة (Cash)</span>
                    <i class="fa-solid fa-money-bill-wave text-emerald-400"></i>
                </div>
                <div class="text-base font-black text-white mt-1">{{ number_format($todayCash) }} ج.م</div>
            </div>

            <div class="p-3 rounded-xl bg-brand-dark/50 border border-brand-border/40">
                <div class="text-[11px] text-gray-400 font-bold flex items-center justify-between">
                    <span>تحويل بنكي رسمي</span>
                    <i class="fa-solid fa-building-columns text-blue-400"></i>
                </div>
                <div class="text-base font-black text-white mt-1">{{ number_format($todayBank) }} ج.م</div>
            </div>
        </div>
    </div>

    <!-- POS Section: Quick Package Selector + Payment Entry Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Quick Service Buttons Grid (1 Column) -->
        <div class="space-y-4">
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-sm space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-bold text-brand-gold flex items-center gap-2">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>الباقات والخدمات السريعة (POS)</span>
                    </h3>
                    <span class="text-[10px] text-gray-400">انقر لتعبئة السعر</span>
                </div>

                <div class="grid grid-cols-1 gap-2.5">
                    @foreach($quickPackages as $pkg)
                    <button type="button" 
                            @click="setPackage('{{ addslashes($pkg['title']) }}', {{ $pkg['price'] }}, 'quick_service')"
                            class="w-full text-right p-3 rounded-xl bg-brand-purple/60 hover:bg-brand-hover border border-brand-border hover:border-brand-yellow/60 transition group flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold text-white group-hover:text-brand-gold transition-colors">
                                {{ $pkg['title'] }}
                            </div>
                            <div class="text-[10px] text-gray-400">خدمة مجهزة بنقرة واحدة</div>
                        </div>
                        <div class="text-left">
                            <span class="text-xs font-black text-brand-gold">{{ number_format($pkg['price']) }}</span>
                            <span class="text-[10px] text-gray-400">ج.م</span>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: The Cashier Payment Processing Form (2 Columns) -->
        <div class="lg:col-span-2">
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-6 shadow-sm space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-brand-gold text-lg"></i>
                        <h2 class="text-base font-bold text-white">تسجيل معاملة قبض جديدة وإصدار إيصال</h2>
                    </div>
                    <span class="text-xs text-gray-400">الكاشير: <span class="text-white font-bold">{{ Auth::user()->name }}</span></span>
                </div>

                <form method="POST" action="{{ route('cashier.payment') }}" class="space-y-4 text-xs">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Client Selection with Quick Add Button -->
                        <div class="md:col-span-2">
                            <div class="flex items-center justify-between mb-1">
                                <label class="font-bold text-gray-300">العميل المستلم منه الدفعة <span class="text-red-400">*</span></label>
                                <button @click="quickClientModal = true" type="button" class="text-brand-gold hover:underline text-[11px] font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <span>+ عميل جديد في 10 ثوانٍ</span>
                                </button>
                            </div>
                            <select name="client_id" required id="cashierClientSelect"
                                    class="w-full px-3 py-2.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="">اختر العميل...</option>
                                @foreach($clients as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->country }}) - هاتف: {{ $c->phone }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Amount -->
                        <div>
                            <label class="block font-bold text-amber-300 mb-1">المبلغ المحصل (ج.م) <span class="text-red-400">*</span></label>
                            <input type="number" step="0.01" name="amount" required x-model="amount"
                                   class="w-full px-3 py-2.5 bg-brand-purple border border-brand-yellow/50 rounded-xl text-white text-sm font-black focus:outline-none focus:border-brand-gold"
                                   placeholder="0.00">
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">طريقة الدفع المستلم بها <span class="text-red-400">*</span></label>
                            <select name="payment_method" required x-model="paymentMethod"
                                    class="w-full px-3 py-2.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="instapay">⚡ إنستاباي (InstaPay)</option>
                                <option value="vodafone_cash">📱 فودافون كاش / محافظ إلكترونية</option>
                                <option value="cash">💵 نقداً بالخزينة (Cash Drawer)</option>
                                <option value="bank_transfer">🏦 تحويل بنكي رسمي</option>
                                <option value="credit_card">💳 فيزا / بطاقة دفع</option>
                            </select>
                        </div>

                        <!-- Payment Type -->
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">نوع الدفعة <span class="text-red-400">*</span></label>
                            <select name="payment_type" required x-model="paymentType"
                                    class="w-full px-3 py-2.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="down_payment">دفعة مقدمة (تعاقد)</option>
                                <option value="milestone">دفعة مرحلية</option>
                                <option value="final_clearance">تصفية حساب وتسليم نهائي</option>
                                <option value="quick_service">خدمة سريعة فورية</option>
                            </select>
                        </div>

                        <!-- Transaction Reference -->
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">رقم عملية التحويل / كود الإيداع (اختياري)</label>
                            <input type="text" name="transaction_reference" 
                                   class="w-full px-3 py-2.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                                   placeholder="مثال: رقم تحويل إنستاباي أو رسالة فودافون كاش">
                        </div>

                        <!-- Project link -->
                        <div class="md:col-span-2">
                            <label class="block font-bold text-gray-300 mb-1">ربط بمشروع معين (اختياري)</label>
                            <select name="project_id" 
                                    class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="">بدون ربط بمشروع (دفعة مباشرة للعميل)</option>
                                @foreach($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->client->name ?? '' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Notes / Item Description -->
                        <div class="md:col-span-2">
                            <label class="block font-bold text-gray-300 mb-1">بيان الإيصال وملاحظات الدفع</label>
                            <textarea name="notes" rows="2" x-model="notes"
                                      class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                                      placeholder="مثال: دفعة جلسة تصوير 10 ريلز لمنتجات الشاورما شاملة المونتاج والتسليم"></textarea>
                        </div>

                    </div>

                    <div class="pt-4 border-t border-brand-border flex items-center justify-between">
                        <div class="text-[11px] text-gray-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-check text-brand-gold"></i>
                            <span>سيتم إصدار إيصال رسمي فوري برقم مسلسل وتوليد رابط واتساب</span>
                        </div>

                        <button type="submit" 
                                class="px-8 py-3 rounded-xl bg-gradient-to-l from-brand-amber via-brand-yellow to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 shadow-lg flex items-center gap-2">
                            <i class="fa-solid fa-print"></i>
                            <span>تسجيل الدفعة وتوليد الإيصال الفوري</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Recent Payments & Invoices Archive -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-history text-brand-gold"></i>
                <span>سجل إيصالات القبض والعمليات الأخيرة</span>
            </h3>
            <span class="text-xs text-gray-400">إجمالي العمليات: {{ $allPayments->total() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border text-gray-400 font-bold">
                        <th class="py-3 px-3">رقم الإيصال</th>
                        <th class="py-3 px-3">العميل</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">طريقة الدفع</th>
                        <th class="py-3 px-3">نوع الدفعة</th>
                        <th class="py-3 px-3">الكاشير</th>
                        <th class="py-3 px-3">التاريخ</th>
                        <th class="py-3 px-3 text-left">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($allPayments as $p)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3.5 px-3 font-mono font-bold text-brand-gold">
                            {{ $p->receipt_number }}
                        </td>
                        <td class="py-3.5 px-3">
                            <div class="font-bold text-white">{{ $p->client->name ?? 'غير محدد' }}</div>
                            <div class="text-[10px] text-gray-400">{{ $p->client->phone ?? '' }}</div>
                        </td>
                        <td class="py-3.5 px-3 font-black text-emerald-400 text-sm">
                            {{ number_format($p->amount, 2) }} ج.م
                        </td>
                        <td class="py-3.5 px-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-purple border border-brand-border text-gray-200">
                                {{ $p->payment_method_arabic }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3 text-gray-300">
                            {{ $p->payment_type_arabic }}
                        </td>
                        <td class="py-3.5 px-3 text-gray-400">
                            {{ $p->cashier->name ?? 'النظام' }}
                        </td>
                        <td class="py-3.5 px-3 text-gray-400">
                            {{ $p->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="py-3.5 px-3 text-left">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- View / Print Receipt -->
                                <a href="{{ route('cashier.receipt', $p->id) }}" target="_blank"
                                   class="px-2.5 py-1 rounded-lg bg-brand-yellow/15 text-brand-gold hover:bg-brand-yellow hover:text-brand-dark font-bold text-xs transition flex items-center gap-1" title="معاينة وتحميل الفاتورة PDF">
                                    <i class="fa-solid fa-file-pdf text-red-400"></i>
                                    <span>فاتورة PDF</span>
                                </a>

                                <!-- WhatsApp direct share with PDF link -->
                                @if($p->client && $p->client->phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $p->client->phone);
                                    if (str_starts_with($cleanPhone, '01') && strlen($cleanPhone) === 11) {
                                        $cleanPhone = '2' . $cleanPhone;
                                    }
                                    $publicUrl = route('public.receipt', $p->receipt_number);
                                    $msg = urlencode("مرحباً {$p->client->name}، مرفق لحضرتك إيصال استلام دفعة رسمية من شركة بريق للتسويق الإلكتروني برقم {$p->receipt_number} بمبلغ " . number_format($p->amount) . " ج.م.\n\n📄 لتحميل الفاتورة الرسمية بصيغة PDF:\n{$publicUrl}\n\nنشكر ثقتكم بوكالة بريق!");
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}?text={{ $msg }}" target="_blank"
                                   class="px-2.5 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500 hover:text-white font-bold text-xs transition flex items-center gap-1" title="مشاركة الفاتورة مع العميل عبر واتساب">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>مشاركة PDF</span>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-gray-400">لا توجد عمليات كاشير مسجلة بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="pt-2">
            {{ $allPayments->links() }}
        </div>
    </div>

    <!-- QUICK CREATE CLIENT MODAL -->
    <div x-show="quickClientModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="quickClientModal = false" 
             class="w-full max-w-md bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تسجيل عميل جديد سريعاً</h3>
                </div>
                <button @click="quickClientModal = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form id="quickClientForm" class="space-y-3 text-xs">
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم العميل / الشركة <span class="text-red-400">*</span></label>
                    <input type="text" id="qc_name" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: مطعم سبيشال">
                </div>
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم البراند (Brand Name)</label>
                    <input type="text" id="qc_brand" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: Special Burger">
                </div>
                <div>
                    <label class="block font-bold text-gray-300 mb-1">رقم الهاتف / الواتساب <span class="text-red-400">*</span></label>
                    <input type="text" id="qc_phone" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="+201012345678">
                </div>
                <div>
                    <label class="block font-bold text-gray-300 mb-1">الدولة</label>
                    <select id="qc_country" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        <option value="مصر">مصر</option>
                        <option value="السعودية">المملكة العربية السعودية</option>
                        <option value="الأردن">المملكة الأردنية</option>
                        <option value="سلطنة عمان">سلطنة عمان</option>
                        <option value="ليبيا">ليبيا</option>
                        <option value="قطر">دولة قطر</option>
                        <option value="الإمارات">دولة الإمارات</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="quickClientModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="button" onclick="submitQuickClient()" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">
                        إضافة واختيار فوراً
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function submitQuickClient() {
    const name = document.getElementById('qc_name').value;
    const brand = document.getElementById('qc_brand').value;
    const phone = document.getElementById('qc_phone').value;
    const country = document.getElementById('qc_country').value;

    if (!name || !phone) {
        alert('يرجى كتابة الاسم ورقم الهاتف على الأقل');
        return;
    }

    fetch('{{ route("cashier.quick-client") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            name: name,
            brand_name: brand,
            phone: phone,
            country: country
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const select = document.getElementById('cashierClientSelect');
            const opt = document.createElement('option');
            opt.value = data.client.id;
            opt.text = data.client.name + ' (' + data.client.country + ') - هاتف: ' + data.client.phone;
            opt.selected = true;
            select.appendChild(opt);

            // Close modal
            document.querySelector('[x-data]').__x.$data.quickClientModal = false;
        }
    })
    .catch(err => {
        alert('حدث خطأ أثناء حفظ العميل: ' + err);
    });
}
</script>
@endsection
