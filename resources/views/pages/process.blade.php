@extends('layouts.public')

@section('title', 'من نحن ومنهجية العمل والإنتاج')
@section('meta_description', 'تعرف على قصة وكالة بريق ومنهجية العمل المعتمدة من 8 مراحل لإنتاج المحتوى السينمائي والتسويق الرقمي عالي التأثير.')

@section('content')
<!-- Hero Header for Process & About -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-gold transition">الرئيسية</a>
        <span class="text-brand-amber">/</span>
        <span class="text-brand-gold font-bold">من نحن ومنهجية العمل</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        شغف الإبداع المدعوم بـ 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">منهجية علمية دقيقة</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        في وكالة بريق، لا نترك شيئاً للصدفة. نؤمن بأن النجاح في التسويق وصناعة المحتوى هو نتيجة معادلة منضبطة تجمع بين الرؤية الفنية السينمائية والاستراتيجية التسويقية القائمة على الأرقام والعائد المالي.
    </p>

    <!-- Key Principles Badges -->
    <div class="flex flex-wrap items-center justify-center gap-3 pt-8 text-xs font-bold text-gray-300">
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ التزام صارم بمواعيد التسليم</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ جودة سينمائية 4K قياسية</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ تركيز على الـ ROAS والمبيعات</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ طواقم متخصصة تحت سقف واحد</span>
    </div>
</section>

<!-- 1. ABOUT PARIQ AGENCY STORY (قصة بريق وفلسفتنا) -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-8 sm:p-14 border border-purple-600/40 shadow-2xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-brand-gold text-xs font-bold">
                    <i class="fa-solid fa-crown"></i>
                    <span>فلسفة وكالة بريق</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-white">لماذا تأسست بريق وما الذي يجعلنا مختلفين؟</h2>
                <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                    تأسست وكالة بريق لسد فجوة كبرى يعاني منها معظم أصحاب الأعمال: الشركات التي تقدم تصويراً سينمائياً غالباً لا تفهم في أرقام التسويق والعائد الإعلاني، وشركات الإعلانات غالباً لا تمتلك حساً بصرياً أو معدات إنتاجية فائقة.
                </p>
                <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                    لذلك دمجنا الاثنين معاً! نوفر لك طاقم إنتاج سينمائي متكامل 4K يعمل جنباً إلى جنب مع خبراء إعلانات ممولة ومحللي سلوك المشترين. النتيجة: محتوى يبهر العين ويدفع العميل للشراء في نفس اللحظة.
                </p>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-4 border-t border-purple-800/40 text-center">
                    <div class="p-4 rounded-2xl bg-[#120324] border border-purple-800/40">
                        <div class="text-2xl font-black text-brand-gold font-mono">+6</div>
                        <div class="text-[11px] text-gray-400 mt-1 font-bold">سنوات خبرة متواصلة</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#120324] border border-purple-800/40">
                        <div class="text-2xl font-black text-white font-mono">+480</div>
                        <div class="text-[11px] text-gray-400 mt-1 font-bold">مشروع منجز بنجاح</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#120324] border border-purple-800/40 col-span-2 sm:col-span-1">
                        <div class="text-2xl font-black text-brand-gold font-mono">6 دول</div>
                        <div class="text-[11px] text-gray-400 mt-1 font-bold">تغطية إقليمية كاملة</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="conic-glow-border">
                    <div class="rounded-[1.4rem] bg-[#0E031A] p-6 space-y-4">
                        <h3 class="text-base font-black text-white flex items-center gap-2">
                            <i class="fa-solid fa-gem text-brand-amber"></i>
                            <span>قيمنا الجوهرية الأربعة:</span>
                        </h3>
                        <div class="space-y-3 text-xs text-gray-300">
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-gold block mb-1">1. الأرقام فوق الآراء:</strong>
                                نجاح الحملة يُقاس بالمبيعات والـ ROAS والمشاهدات الحقيقية وليس بالمجاملات.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-gold block mb-1">2. احترام المواعيد:</strong>
                                تسليم النسخ الأولية خلال 48-72 ساعة والتزام صارم بجدول النشر الشهري.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-gold block mb-1">3. الإتقان السينمائي:</strong>
                                استخدام كاميرات 4K وإضاءة وهندسة صوت احترافية دون أي تنازل.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-gold block mb-1">4. الشفافية الكاملة:</strong>
                                تقارير أداء دورية توضح أين صُرفت كل قرش وما العائد المحقق.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2. THE 8-STEP COMPLETE PRODUCTION ROADMAP (مراحل العمل بالتفصيل) -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            خريطة الطريق المعتمدة
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">المراحل الثمانية للإنتاج والتسويق في بريق</h2>
        <p class="text-xs sm:text-sm text-gray-300">منظومة عمل متسلسلة تضمن وضوح المهام وسرعة الإنجاز وتحقيق أعلى عائد على استثمارك.</p>
    </div>

    @php
        $detailedStages = [
            [
                'num' => '01',
                'title' => 'مرحلة الاكتشاف وتحليل النشاط (Discovery & Audit)',
                'icon' => 'fa-solid fa-magnifying-glass-chart',
                'duration' => 'اليوم 1 - 2',
                'desc' => 'نعقد جلسة اكتشاف معمقة لفهم طبيعة منتجاتك، دراسة منافسيك المباشرين، تحليل سلوك الشريحة المستهدفة، واستخراج نقاط القوة التي سنركز عليها في الرسائل الإعلانية.',
                'deliverables' => ['تقرير فحص الحضور الرقمي والمنافسين', 'تحديد هوية العميل المثالي (Persona)', 'تحديد الأهداف التسويقية القابلة للقياس (KPIs)']
            ],
            [
                'num' => '02',
                'title' => 'بناء الاستراتيجية وخطة المحتوى (Content Strategy)',
                'icon' => 'fa-solid fa-map-location-dot',
                'duration' => 'اليوم 3 - 4',
                'desc' => 'رسم خطة المحتوى الشهرية كاملة (30 يوماً). نحدد الموضوعات، زوايا الطرح، الأفكار الفيرال للريلز، وهندسة العروض التسويقية التي تدفع الزبائن لطلب الخدمة فوراً.',
                'deliverables' => ['تقويم النشر وجدولة المنشورات والريلز', 'الرسائل التسويقية لكل منصة (Meta, TikTok)', 'هندسة العروض الخاصة والحوافز الشرائية']
            ],
            [
                'num' => '03',
                'title' => 'التحضير قبل الإنتاج وكتابة السكريبتات (Pre-Production)',
                'icon' => 'fa-solid fa-pen-nib',
                'duration' => 'اليوم 5 - 6',
                'desc' => 'كتابة نصوص الفيديوهات الإعلانية بأسلوب الـ Hook والخطف البصري خلال أول 3 ثوانٍ، تجهيز لوحات الإلهام البصري (Moodboards)، واختيار مواقع التصوير والممثلين أو المنتجات.',
                'deliverables' => ['سكريبتات تصوير مفصلة مشهداً بمشهد', 'مودبورد الألوان والإضاءة والموسيقى', 'قائمة المعدات وطاقم العمل المخصص']
            ],
            [
                'num' => '04',
                'title' => 'التصوير والإنتاج السينمائي 4K (4K Cinema Production)',
                'icon' => 'fa-solid fa-video',
                'duration' => 'اليوم 7 - 8',
                'desc' => 'نزول طاقم التصوير الميداني بكاميرات سينمائية 4K وعدسات فاخرة، مع إضاءة متطورة وهندسة صوتية محيطية، وتصوير جوي بالدرون لالتقاط كل تفاصيل منتجك بأعلى بريق.',
                'deliverables' => ['مادة خام سينمائية بدقة 4K ProRes', 'لقطات زوايا متعددة (Multi-Camera)', 'تسجيل صوتي نقي بميكروفونات سينمائية']
            ],
            [
                'num' => '05',
                'title' => 'المونتاج وما بعد الإنتاج (Post-Production, Color & SFX)',
                'icon' => 'fa-solid fa-film',
                'duration' => 'اليوم 9 - 11',
                'desc' => 'المرحلة السحرية: تقطيع سريع يناسب ريلز وتيك توك، تصحيح ألوان سينمائي بأعلى معايير DaVinci Resolve، هندسة ومؤثرات صوتية محفزة (SFX)، وإضافة موشن جرافيك ونصوص متحركة.',
                'deliverables' => ['النسخ الأولية للفيديوهات للمراجعة', 'تصحيح ألوان احترافي مطابق لهوية البراند', 'إخراج نهائي بأعلى جودة عمودية وأفقية']
            ],
            [
                'num' => '06',
                'title' => 'الإطلاق والتوزيع الذكي (Scheduled Publishing)',
                'icon' => 'fa-solid fa-rocket',
                'duration' => 'طوال الشهر',
                'desc' => 'نشر المحتوى وفق جدول زمني دقيق في الساعات الذهبية لتواجد جمهورك، مع كتابة كابشنز مقنعة، واختيار الهاشتاجات النشطة، والتفاعل السريع لرفع خوارزميات المنصات.',
                'deliverables' => ['جدولة دقيقة بأحدث أدوات النشر الآلي', 'كابشنز إعلانية بأسلوب الـ Copywriting', 'متابعة تفاعل الساعات الأولى لكل منشور']
            ],
            [
                'num' => '07',
                'title' => 'الإعلانات الممولة وميديا باينج (Performance Ads & Scaling)',
                'icon' => 'fa-solid fa-bullhorn',
                'duration' => 'طوال الشهر',
                'desc' => 'إطلاق حملات استهداف دقيقة على Meta, TikTok, Google بحساب الـ ROAS، اختبار مستمر للأشكال الإعلانية (A/B Testing)، وتوسيع الميزانيات على الإعلانات الأكثر ربحية.',
                'deliverables' => ['إدارة يومية ومتابعة الميزانيات بدقة', 'إعادة استهداف زوار الموقع والمتفاعلين (Retargeting)', 'تقليل تكلفة الاكتساب ومضاعفة الطلبات']
            ],
            [
                'num' => '08',
                'title' => 'التحليل والتحسين المستمر (Reporting & Optimization)',
                'icon' => 'fa-solid fa-arrow-trend-up',
                'duration' => 'نهاية كل دورة',
                'desc' => 'تقديم تقرير رقمي شفاف يوضح نتائج كل حملة: عدد المشاهدات، النقرات، المبيعات المحققة، ونسبة العائد على الاستثمار، مع وضع توصيات التطوير للشهر التالي.',
                'deliverables' => ['تقرير أداء رقمي مرئي وشامل', 'جلسة نقاشية شهرية لتقييم النتائج', 'خطة التطوير والتوسع للمرحلة القادمة']
            ],
        ];
    @endphp

    <div class="space-y-6">
        @foreach($detailedStages as $st)
        <div class="glass-card-purple rounded-3xl p-7 sm:p-9 border border-purple-800/60 hover:border-amber-400/60 transition-all duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                
                <!-- Stage Number & Icon -->
                <div class="lg:col-span-3 flex items-center gap-4">
                    <span class="text-4xl sm:text-5xl font-black text-brand-gold font-mono">{{ $st['num'] }}</span>
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center justify-center text-xl mb-1">
                            <i class="{{ $st['icon'] }}"></i>
                        </div>
                        <span class="text-[11px] font-bold text-gray-400">{{ $st['duration'] }}</span>
                    </div>
                </div>

                <!-- Stage Details -->
                <div class="lg:col-span-5 space-y-2">
                    <h3 class="text-lg sm:text-xl font-black text-white">{{ $st['title'] }}</h3>
                    <p class="text-xs text-gray-300 leading-relaxed font-normal">{{ $st['desc'] }}</p>
                </div>

                <!-- Deliverables -->
                <div class="lg:col-span-4 bg-[#110322] rounded-2xl p-4 border border-purple-800/40 space-y-2 text-xs">
                    <span class="text-[10px] font-bold text-brand-amber uppercase block">مخرجات المرحلة المعتمدة:</span>
                    @foreach($st['deliverables'] as $deliv)
                    <div class="flex items-center gap-2 text-gray-300 text-[11px]">
                        <i class="fa-solid fa-circle-check text-emerald-400 text-[10px]"></i>
                        <span>{{ $deliv }}</span>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- 3. PRODUCTION TECH STACK & ARSENAL (المعدات والبرمجيات المعتمدة) -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10 border-t border-purple-900/40">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            عتادنا وأدواتنا التقنية
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">أحدث التقنيات والمعدات العالمية</h2>
        <p class="text-xs sm:text-sm text-gray-300">نستثمر في أرقى الكاميرات والبرمجيات العالمية لضمان أعلى معايير الجودة لعلامتك التجارية.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Hardware -->
        <div class="glass-card-purple rounded-3xl p-8 space-y-4 border border-purple-800/60">
            <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center justify-center text-xl">
                <i class="fa-solid fa-camera"></i>
            </div>
            <h3 class="text-xl font-black text-white">معدات التصوير السينمائي</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                كاميرات Sony FX السينمائية، عدسات G-Master، مانعات اهتزاز DJI Ronin، إضاءات Aputure الاحترافية، وميكروفونات Rode اللاسلكية لنقاء صوت مطلق.
            </p>
        </div>

        <!-- Software -->
        <div class="glass-card-purple rounded-3xl p-8 space-y-4 border border-purple-800/60">
            <div class="w-12 h-12 rounded-2xl bg-purple-500/20 border border-purple-500/40 text-purple-300 flex items-center justify-center text-xl">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
            <h3 class="text-xl font-black text-white">برمجيات المونتاج والتلوين</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                برنامج DaVinci Resolve Studio العالمي لتصحيح الألوان السينمائي، وحزمة Adobe Creative Cloud كاملة (Premiere, After Effects, Photoshop, Illustrator).
            </p>
        </div>

        <!-- Ad Platforms -->
        <div class="glass-card-purple rounded-3xl p-8 space-y-4 border border-purple-800/60">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <h3 class="text-xl font-black text-white">منصات الإعلانات والبيانات</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                إدارة معتمدة على Meta Business Manager, TikTok Ads Manager, Google Analytics 4, وربط متقدم لـ Conversion API لتتبع كل مبيعة بدقة.
            </p>
        </div>
    </div>
</section>

<!-- BOTTOM CTA -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-purple-500/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">مستعد لبدء أولى خطوات نجاح علامتك معنا؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            احجز جلسة استشارة واكتشاف مجانية وسنقوم بوضع خطة عمل مفصلة لمشروعك خلال 48 ساعة.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-gold text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                حجز جلسة استشارة واكتشاف
            </a>
            <a href="{{ route('public.services') }}" class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-purple-900/60 border border-purple-600/40 text-white font-bold text-xs transition">
                استعراض خدماتنا وباقات الأسعار
            </a>
        </div>
    </div>
</section>
@endsection

