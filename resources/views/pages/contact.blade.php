@extends('layouts.public')

@section('title', 'تواصل معنا واحصل على استشارة تسويقية فورية')
@section('meta_description', 'تواصل مع فريق وكالة بريق للإعلام والتصميم لطلب استشارة تسويقية مجانية وعرض سعر فوري لمشروعك في مصر والسعودية والخليج.')

@section('content')
<!-- Hero Header for Contact -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-gold transition">الرئيسية</a>
        <span class="text-brand-amber">/</span>
        <span class="text-brand-gold font-bold">تواصل معنا وعرض سعر</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        ابدأ قصة نجاح علامتك 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">التجارية اليوم</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        نسعد بمناقشة أهدافك وطموحاتك التسويقية. أرسل لنا تفاصيل مشروعك أو تواصل معنا عبر الواتساب مباشرة، وسيتواصل معك أحد مستشاري بريق لمناقشة خطة العمل المخصصة لمشروعك.
    </p>

    <!-- Trust Badges -->
    <div class="flex flex-wrap items-center justify-center gap-4 pt-8 text-xs font-bold text-gray-300">
        <div class="px-4 py-2 rounded-xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center gap-2">
            <i class="fa-solid fa-clock"></i>
            <span>استجابة وتواصل خلال ساعات قليلة</span>
        </div>
        <div class="px-4 py-2 rounded-xl bg-purple-500/15 border border-purple-500/30 text-purple-300 flex items-center gap-2">
            <i class="fa-solid fa-comments"></i>
            <span>استشارة مبدئية مجانية 100%</span>
        </div>
        <div class="px-4 py-2 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center gap-2">
            <i class="fa-solid fa-shield-halved"></i>
            <span>عقود رسمية وسرية تامة للمعلومات</span>
        </div>
    </div>
</section>

<!-- MAIN CONTACT FORM & DETAILS SECTION -->
<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
    
    @if(session('success_inquiry'))
    <div class="p-5 mb-10 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm flex items-center justify-between shadow-2xl backdrop-blur-md">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-400 text-2xl"></i>
            <div>
                <strong class="block text-white">تم استلام طلبك بنجاح!</strong>
                <span>{{ session('success_inquiry') }}</span>
            </div>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white transition"><i class="fa-solid fa-xmark text-lg"></i></button>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Left Column: Direct Communication Channels & Regional Presence (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- WhatsApp Priority Card -->
            <div class="conic-glow-border">
                <div class="rounded-[1.4rem] bg-[#140526] p-7 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-emerald-400 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>الرد السريع والمباشر (24/7)</span>
                        </span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-white">تحدث معنا عبر واتساب مباشرة</h3>
                    <p class="text-xs text-gray-300 leading-relaxed font-normal">
                        إذا كنت في عجلة من أمرك أو ترغب في استشارة فورية وعرض سعر سريع لمشروعك، تحدث مع مدير الحسابات لدينا الآن.
                    </p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-tr from-[#128C7E] to-[#25D366] text-white font-black text-xs transition flex items-center justify-center gap-2 shadow-xl shadow-emerald-500/20 hover:scale-[1.02] active:scale-95">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>بدء محادثة واتساب فورية</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Direct Contact Information Cards -->
            <div class="glass-card-purple rounded-3xl p-7 space-y-5 border border-purple-800/60">
                <h3 class="text-base font-black text-white border-b border-purple-800/40 pb-3">قنوات الاتصال المباشرة</h3>
                
                <div class="space-y-4 text-xs">
                    <!-- Phone -->
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center justify-center text-base">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 block font-medium">الاتصال الهاتفي المباشر:</span>
                            <a href="tel:+201062330838" dir="ltr" class="text-white hover:text-brand-gold font-mono font-bold text-sm transition">+20 106 233 0838</a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 border border-purple-500/40 text-purple-300 flex items-center justify-center text-base">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 block font-medium">البريد الإلكتروني الرسمي:</span>
                            <a href="mailto:contact@pariqagency.com" class="text-white hover:text-brand-gold font-mono transition">contact@pariqagency.com</a>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-yellow-500/15 border border-yellow-500/30 text-brand-gold flex items-center justify-center text-base">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 block font-medium">ساعات العمل الرسمية:</span>
                            <span class="text-white font-medium">السبت إلى الخميس: 9:00 ص - 6:00 م (توقيت القاهرة / مكة)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regional Coverage Card (توسيع نطاق خدماتنا ودول العمل حسب طلب العميل) -->
            <div class="glass-card-purple rounded-3xl p-7 space-y-4 border border-purple-800/60">
                <div class="flex items-center justify-between border-b border-purple-800/40 pb-3">
                    <h3 class="text-base font-black text-white flex items-center gap-2">
                        <i class="fa-solid fa-earth-americas text-brand-orange"></i>
                        <span>نطاق خدماتنا وتغطيتنا الإقليمية والدولية</span>
                    </h3>
                    <span class="px-2.5 py-1 rounded-full bg-brand-orange/20 text-brand-orange font-bold text-[10px]">
                        12+ دولة عربية
                    </span>
                </div>
                
                <p class="text-xs text-gray-300 leading-relaxed font-normal">
                    نقدم خدماتنا ونمتلك شركاء نجاح موثقين ومشاريع قائمة في كافة أرجاء الخليج العربي والشرق الأوسط وشمال أفريقيا:
                </p>
                
                <div class="grid grid-cols-2 gap-2.5 pt-1 text-xs text-gray-300 font-bold">
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>جمهورية مصر العربية</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>المملكة العربية السعودية</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>الإمارات العربية المتحدة</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>دولة الكويت</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>دولة قطر</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>سلطنة عُمان</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>المملكة الأردنية الهاشمية</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>مملكة البحرين</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>جمهورية العراق</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-purple-900/30 border border-purple-700/30 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-brand-orange text-xs"></i>
                        <span>دولة ليبيا</span>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-orange-500/10 border border-brand-orange/20 text-center text-[11px] text-brand-peach font-bold">
                    ✦ نوفر عقوداً رسمية وتنسيقاً مرناً وتحويلات بنكية معتمدة لكافة الدول العربية
                </div>
            </div>

        </div>

        <!-- Right Column: Interactive Consultation Request Form (7 cols) -->
        <div class="lg:col-span-7">
            <div class="glass-card-purple rounded-[2.5rem] p-8 sm:p-12 border border-purple-500/40 shadow-2xl space-y-6">
                
                <div class="space-y-2 border-b border-purple-800/40 pb-5">
                    <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-3.5 py-1 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                        نموذج الاستشارة المباشر
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white">أخبرنا بما ترغب في تحقيقه لعلامتك التجارية</h2>
                    <p class="text-xs text-gray-300">سيتواصل معك مستشار وكالة بريق لمناقشة خطة العمل المخصصة لمشروعك.</p>
                </div>

                <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4 text-xs">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">اسمك الكريم <span class="text-brand-orange">*</span></label>
                            <input type="text" name="name" required placeholder="محمد أحمد" 
                                   class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">اسم النشاط أو العلامة التجارية</label>
                            <input type="text" name="brand_name" placeholder="اسم علامتك التجارية" 
                                   class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">رقم الهاتف أو الواتساب <span class="text-brand-orange">*</span></label>
                            <input type="text" name="phone" required placeholder="+2010... أو +966..." 
                                   class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">البريد الإلكتروني</label>
                            <input type="email" name="email" placeholder="example@brand.com" 
                                   class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">الخدمة التي تهمك أكثر</label>
                            <select name="service_interested" 
                                    class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                                <option value="تصوير ومونتاج فيديو ريلز 4K">تصوير ومونتاج فيديو ريلز وسينما 4K</option>
                                <option value="إعلانات ممولة وميديا باينج">إعلانات ممولة وميديا باينج (Meta, TikTok)</option>
                                <option value="تصميمات جرافيك وبناء هوية بصرية">تصميمات جرافيك وبناء هوية بصرية</option>
                                <option value="إدارة كاملة لحسابات السوشيال ميديا">إدارة كاملة لحسابات السوشيال ميديا</option>
                                <option value="استشارة وبناء خطة تسويقية كاملة">استشارة وبناء خطة تسويقية كاملة</option>
                                <option value="باقة تسويق وإنتاج شهرية متكاملة">باقة تسويق وإنتاج شهرية متكاملة</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1.5">الميزانية المتوقعة للمشروع</label>
                            <select name="budget_range" 
                                    class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                                <option value="أقل من 10,000 ج.م">أقل من 10,000 ج.م</option>
                                <option value="10,000 - 25,000 ج.م">10,000 - 25,000 ج.م</option>
                                <option value="25,000 - 50,000 ج.م">25,000 - 50,000 ج.م</option>
                                <option value="أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)">أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1.5">أخبرنا بنبذة عن أهدافك ورؤيتك</label>
                        <textarea name="message" rows="4" placeholder="اكتب لنا ملخصاً سريعاً عما تود تحقيقه لعلامتك التجارية..." 
                                  class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 rounded-2xl bg-gradient-to-l from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 shadow-2xl shadow-amber-500/30 transition flex items-center justify-center gap-2.5 active:scale-95">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        <span>إرسال طلب الاستشارة التسويقية الفورية</span>
                    </button>
                </form>

            </div>
        </div>

    </div>

</section>

<!-- FREQUENTLY ASKED QUESTIONS SECTION (الأسئلة الشائعة) -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto relative z-10" x-data="{ activeFaq: 0 }">
    <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            إجابات واضحة وسريعة
        </span>
        <h2 class="text-3xl sm:text-4xl font-black text-white">الأسئلة الأكثر شيوعاً قبل بدء التعاقد</h2>
        <p class="text-xs sm:text-sm text-gray-300">كل ما تحتاج لمعرفته حول طريقة العمل والأسعار والضمانات</p>
    </div>

    <div class="space-y-4">
        @php
            $faqs = [
                [
                    'q' => 'كيف تبدأ خطوات العمل بعد إرسال طلب الاستشارة؟',
                    'a' => 'نتواصل معك خلال ساعات قليلة عبر الواتساب أو الهاتف لعقد جلسة اكتشاف سريعة لفهم أهدافك وميزانيتك، ثم نقدم لك خطة عمل مفصلة وعرض سعر فوري. بمجرد اعتماد العرض، نوقع العقد ونبدأ فوراً في كتابة السكريبتات والتحضير للإنتاج.'
                ],
                [
                    'q' => 'هل تقدمون خدمات التصوير والمونتاج خارج مصر؟',
                    'a' => 'نعم بالتأكيد! لدينا شركاء نجاح دائمون في السعودية والأردن والإمارات وقطر وعُمان. نوفر طواقم تصوير ميدانية مجهزة، بالإضافة إلى خدمات المونتاج السحابي عن بُعد وإدارة الحملات الإعلانية لكافة الدول العربية.'
                ],
                [
                    'q' => 'كم تستغرق مدة تسليم جلسات التصوير والمونتاج؟',
                    'a' => 'نسلم النسخ المبدئية لفيديوهات الريلز والبرومو خلال 48 إلى 72 ساعة من موعد انتهاء جلسة التصوير، ونعتمد الملاحظات والتعديلات فوراً لضمان سرعة النشر واستثمار الترندات.'
                ],
                [
                    'q' => 'كيف تضمنون تحقيق أعلى عائد على الحملات الإعلانية (ROAS)؟',
                    'a' => 'نعتمد على استراتيجية متكاملة تجمع بين الفيديوهات الإعلانية عالية الجاذبية (Hook)، واستهداف دقيق للجمهور الشرائي المستعد للدفع، مع اختبار مستمر (A/B Testing) للكرييتف والميزانيات لتحقيق أقصى ربحية ممكنة.'
                ],
                [
                    'q' => 'ما هي خيارات وطرق الدفع والتعاقد المتاحة؟',
                    'a' => 'نوفر خيارات سداد مرنة تناسب الشركات: تحويل بنكي رسمي، كاشير إلكتروني، إنستاباي، وفواتير رسمية معتمدة مع باقات شهرية أو عقود سنوية ميسرة.'
                ]
            ];
        @endphp

        @foreach($faqs as $idx => $faq)
        <div class="glass-card-purple rounded-3xl overflow-hidden transition-all duration-200">
            <button type="button" 
                    @click="activeFaq = (activeFaq === {{ $idx }} ? null : {{ $idx }})"
                    class="w-full p-6 text-right font-black text-sm sm:text-base text-white flex items-center justify-between gap-4 hover:text-brand-gold transition">
                <span>{{ $faq['q'] }}</span>
                <i class="fa-solid fa-chevron-down text-xs text-brand-gold transition-transform duration-300"
                   :class="activeFaq === {{ $idx }} ? 'rotate-180 text-brand-amber' : ''"></i>
            </button>
            <div x-show="activeFaq === {{ $idx }}" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="px-6 pb-6 text-xs sm:text-sm text-gray-300 leading-relaxed border-t border-purple-800/40 pt-4">
                {{ $faq['a'] }}
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

