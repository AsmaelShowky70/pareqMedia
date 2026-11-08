@extends('layouts.public')

@section('title', 'خدماتنا الإبداعية والتسويقية المتكاملة')
@section('meta_description', 'استكشف باقات وخدمات وكالة بريق: تصوير سينمائي 4K، مونتاج ريلز وبرومو سريع، تصميم هويات بصرية، وإعلانات ممولة بأعلى عائد على الإنفاق ROAS.')

@section('content')
<!-- Top Hero Header for Services -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-gold transition">الرئيسية</a>
        <span class="text-brand-amber">/</span>
        <span class="text-brand-gold font-bold">خدماتنا الإبداعية المتكاملة</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        حلول تسويقية وإنتاجية تصنع 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">الفارق الحقيقي</span> 
        لأعمالك
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        نقدم منظومة عمل إبداعية متكاملة تغطي كافة مراحل الإنتاج الرقمي من الفكرة والسكريبت، مروراً بالتصوير السينمائي والمونتاج المتقن، وصولاً إلى إدارة الحملات الإعلانية ومضاعفة المبيعات.
    </p>

    <!-- Quick Stats Bar -->
    <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-8 pt-8 text-xs sm:text-sm text-gray-300">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-camera text-brand-gold"></i>
            <span class="font-bold">معدات سينمائية 4K و 60 FPS</span>
        </div>
        <div class="text-purple-600">•</div>
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-bolt text-brand-amber"></i>
            <span class="font-bold">تسليم المسودات خلال 48-72 ساعة</span>
        </div>
        <div class="text-purple-600">•</div>
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span class="font-bold">استهداف دقيق بحساب الـ ROAS</span>
        </div>
    </div>
</section>

<!-- MAIN SERVICES SECTION -->
<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10" x-data="{ activeCategory: 'all' }">
    
    <!-- Category Filter Tabs -->
    <div class="flex flex-wrap items-center justify-center gap-3 mb-14">
        <button type="button" @click="activeCategory = 'all'" 
                :class="activeCategory === 'all' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-grid-2"></i>
            <span>جميع الخدمات (6)</span>
        </button>
        <button type="button" @click="activeCategory = 'video'" 
                :class="activeCategory === 'video' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-video text-amber-400"></i>
            <span>التصوير والمونتاج السينمائي</span>
        </button>
        <button type="button" @click="activeCategory = 'design'" 
                :class="activeCategory === 'design' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-bezier-curve text-purple-300"></i>
            <span>التصميم وبناء الهويات</span>
        </button>
        <button type="button" @click="activeCategory = 'marketing'" 
                :class="activeCategory === 'marketing' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span>الإعلانات الممولة وإدارة النمو</span>
        </button>
    </div>

    <!-- Detailed 6 Services Cards -->
    <div class="space-y-12">
        
        <!-- Service 1: 4K Cinema Shooting -->
        <div id="shooting" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-brand-gold text-xs font-bold">
                        <i class="fa-solid fa-video"></i>
                        <span>الإنتاج المرئي السينمائي 4K</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تصوير فيديو سينمائي احترافي 4K</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نمتلك طواقم تصوير متكاملة بأحدث الكاميرات السينمائية والعدسات الفاخرة لإبراز منتجاتك وخدماتك بأعلى درجات الجاذبية البصرية. نوفر كافة متطلبات الجلسة من إضاءة سينمائية، هندسة صوتية محيطية، وسيناريوهات تصوير تحضيرية (Storyboards).
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> كاميرات سينمائية 4K وعدسات فاخرة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> طاقم تصوير وإضاءة وهندسة صوت احترافية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تصوير جوي بالدرون (Drone 4K)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> سكريبت ومودبورد تحضيري مسبق</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">سعر الجلسة يبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        3,500 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">يشمل التصوير الميداني الكامل + المونتاج المبدئي وتعديلين معتمدين.</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20حجز%20جلسة%20تصوير%20سينمائي%204K" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>حجز جلسة تصوير عبر واتساب</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 2: Video Editing & Fast Reels -->
        <div id="editing" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-bold">
                        <i class="fa-solid fa-film"></i>
                        <span>المونتاج وهوية الفيديو الرقمي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">مونتاج ريلز وبرومو سينمائي سريع (Fast-Paced)</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        المونتاج هو روح الفيديو. نحول المقاطع العادية إلى أعمال سينمائية تخطف الأنظار خلال الثواني الثلاث الأولى (Hook)، مع تصحيح ألوان احترافي (DaVinci Resolve)، مؤثرات صوتية ترفع الحماس (SFX)، وموشن جرافيك تفاعلي يزيد من مدة المشاهدة والانتشار.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> ريلز وشورتس بفكرة الـ Hook السريع للانتشار</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تصحيح ألوان سينمائي (Color Grading & LUTs)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> هندسة ومؤثرات صوتية محفزة (Sound Design)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> كتابة كابشنز ونصوص متحركة متزامنة</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">سعر باقة المونتاج تبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        2,000 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">تسليم فائق السرعة خلال 48 ساعة وبجودة عمودية مثالية للمنصات.</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20باقة%20مونتاج%20ريلز" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>طلب باقة المونتاج عبر واتساب</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 3: Graphic Design & Branding -->
        <div id="design" x-show="activeCategory === 'all' || activeCategory === 'design'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-yellow-500/15 border border-yellow-500/30 text-yellow-300 text-xs font-bold">
                        <i class="fa-solid fa-bezier-curve"></i>
                        <span>الهوية البصرية والتصميم الجرافيكي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تصميمات جرافيك وبناء الهويات البصرية (Branding)</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نصمم لعلامتك التجارية وجهاً بصرياً لا يُنسى. نبدأ من دراسة فلسفة البراند، واختيار باليتة الألوان السيكولوجية والخطوط الطباعية الفاخرة، وحتى تصميم دليل الهوية الكامل (Brand Guidelines)، بوستات السوشيال ميديا، وأغلفة اليوتيوب المصغرة عالية النقر (High CTR Thumbnails).
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> أغلفة يوتيوب مصغرة لرفع نسب النقر (CTR 15%+)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تصميم لوجو وهوية تجارية كاملة بدليل إرشادي</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> بوستات وكاروسيل تثقيفي لمنصات السوشيال ميديا</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تسليم ملفات المصدر الأصلية قابلة للتعديل والطباعة</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">سعر تصميمات الهوية يبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        1,500 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">تصاميم فيكتور دقيقة وعصرية تدعم علامتك التجارية لسنوات قادمة.</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20خدمة%20تصميم%20هوية%20وجرافيك" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>طلب باقة التصميم عبر واتساب</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 4: Media Buying & Sponsored Ads -->
        <div id="ads" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>الإعلانات الممولة ومضاعفة المبيعات</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">الإعلانات الممولة وميديا باينج (Performance Marketing & ROAS)</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        لا نطلق إعلانات عشوائية؛ نحن نستثمر ميزانيتك بحساب رياضي دقيق. ندير حملاتك الممولة على منصات Meta (Facebook & Instagram), TikTok, Snapchat, Google بحساب العائد على الإنفاق الإعلاني (ROAS)، وبناء جماهير مخصصة (Custom & Lookalike Audiences) لاستهداف الشريحة الأكثر استعداداً للشراء فوراً.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> إعلانات Meta و TikTok مع ضبط الـ Pixel و Conversion API</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> اختبارات A/B Testing مستمرة للكرييتف والعناوين</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> استهداف الشرائح الشرائية الأعلى قدرة على الدفع</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> لوحة تحكم وتقارير أداء دورية شفافة بنسب الأرباح</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">إدارة الحملات الشهرية تبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        4,000 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">إدارة يومية متواصلة ومتابعة دقيقة لتقليل تكلفة الاكتساب ومضاعفة المبيعات.</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20إدارة%20حملات%20إعلانات%20ممولة" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>بدء حملة إعلانية ممولة الآن</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 5: Social Media Management -->
        <div id="social" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-orange-500/30 text-orange-400 text-xs font-bold">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>إدارة المحتوى والمجتمع الرقمي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">إدارة كاملة لحسابات السوشيال ميديا (Social Management)</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نتولى حضورك الرقمي بالكامل لتتفرغ لتطوير أعمالك. نعد خطة محتوى شهرية شاملة، نكتب نصوصاً تسويقية مقنعة (Copywriting)، نجدول المنشورات في الساعات الذهبية، ونتابع التفاعل مع الجمهور لتحويل المتابعين إلى عملاء مخلصين لعلامتك التجارية.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> خطة نشر وجدولة شهرية شاملة 30 يوم</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> كتابة كابشنز تسويقية وسيناريوهات تفاعلية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تحليل المنافسين ومتابعة نمو الحسابات والمتابعين</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تنسيق كامل مع مصممي ومصوري الفريق</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">الباقة الشهرية الكاملة تبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        5,000 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">إدارة احترافية شاملة لكافة منصاتك الرقمية (فيسبوك، انستجرام، تيك توك).</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاشتراك%20بباقة%20إدارة%20السوشيال%20ميديا" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>حجز باقة السوشيال ميديا</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service 6: Marketing Strategy & Consulting -->
        <div id="strategy" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-600/40 hover:border-amber-400/60 transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-300 text-xs font-bold">
                        <i class="fa-solid fa-lightbulb"></i>
                        <span>الخطط الاستراتيجية والاستشارات</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">إعداد الخطط التسويقية والاستشارات التوجيهية</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        النجاح في التسويق يبدأ من دراسة عميقة للسوق ومنافسيك وتحديد نقاط القوة التي تجعلك متفرداً. نقوم ببناء خطة تسويقية سنوية أو نصف سنوية توضح لك مسار الحملات، قنوات الوصول الأوفر تكلفة، وهندسة العروض التي تدفع العملاء للطلب الفوري.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تحليل شامل للمنافسين وسلوك السوق المستهدف</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تحديد العميل المثالي (Buyer Persona) بدقة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> هندسة العروض التسويقية ذات الجاذبية العالية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> جلسات استشارية زووم ومتابعة مستمرة</div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-6 border border-purple-800/60 space-y-4 text-center sm:text-right">
                    <div class="text-xs text-gray-400 font-medium">جلسة الاستشارة والخطة تبدأ من:</div>
                    <div class="text-3xl sm:text-4xl font-black text-brand-gold font-mono">
                        3,000 <span class="text-sm font-sans">ج.م</span>
                    </div>
                    <p class="text-[11px] text-gray-400">وثيقة خطة عمل واضحة قابلة للتطبيق الفوري مع جلسة نقاشية مطولة.</p>
                    <div class="pt-2">
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20حجز%20استشارة%20تسويقية%20وخطة%20عمل" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>حجز جلسة استشارية الآن</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- COMMERCIAL PACKAGES COMPARISON TABLE (الباقات الشاملة للشركات) -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            الباقات الشهرية المتكاملة
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">اختر الباقة المناسبة لمرحلة نمو علامتك</h2>
        <p class="text-xs sm:text-sm text-gray-300">باقات مصممة لتلبية احتياجات الشركات الناشئة، المتوسطة، والمؤسسات الكبرى بأسعار تنافسية.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Package 1: Starter -->
        <div class="glass-card-purple rounded-[2rem] p-8 border border-purple-800/60 flex flex-col justify-between hover:-translate-y-2 transition-all duration-300">
            <div class="space-y-4">
                <span class="text-xs font-bold text-gray-400">الباقة الأساسية</span>
                <h3 class="text-2xl font-black text-white">باقة الانطلاق والظهور</h3>
                <div class="text-3xl font-black text-brand-gold font-mono pt-2">
                    7,500 <span class="text-xs font-sans text-gray-300">ج.م / شهرياً</span>
                </div>
                <p class="text-xs text-gray-400 leading-relaxed">مثالية للأنشطة التجارية في بدايتها لبناء وجود قوي وجذب أول دفعة عملاء.</p>
                <div class="space-y-2.5 pt-4 border-t border-purple-800/40 text-xs text-gray-300">
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> 8 فيديوهات ريلز ومونتاج سينمائي</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> 8 تصميمات سوشيال ميديا مميزة</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> كتابة الكابشنز ونشر وجدولة أسبوعية</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> إدارة حملة إعلانية ممولة واحدة</div>
                </div>
            </div>
            <div class="pt-8">
                <a href="https://wa.me/201062330838?text=مرحباً%20بريق،%20أرغب%20في%20الاشتراك%20بباقة%20الانطلاق%20والظهور" 
                   target="_blank"
                   class="w-full py-3 rounded-xl bg-purple-900/50 hover:bg-brand-amber hover:text-brand-dark text-white font-black text-xs border border-purple-600/40 transition flex items-center justify-center gap-2">
                    <span>اختيار باقة الانطلاق</span>
                </a>
            </div>
        </div>

        <!-- Package 2: Growth (Featured with Conic Glow) -->
        <div class="conic-glow-border flex flex-col justify-between hover:-translate-y-2 transition-all duration-300">
            <div class="rounded-[1.4rem] bg-[#17052E] p-8 space-y-4 flex flex-col justify-between h-full">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-brand-gold">الأكثر طلباً وشعبية</span>
                        <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-gradient-to-r from-brand-orange to-brand-gold text-brand-dark">باقة النمو السريع</span>
                    </div>
                    <h3 class="text-2xl font-black text-white">باقة التوسع والانتشار (Growth)</h3>
                    <div class="text-4xl font-black text-brand-gold font-mono pt-2">
                        15,000 <span class="text-xs font-sans text-gray-300">ج.م / شهرياً</span>
                    </div>
                    <p class="text-xs text-gray-300 leading-relaxed">للعلامات التجارية الراغبة في تصدر السوق ومضاعفة المبيعات بصورة قياسية.</p>
                    <div class="space-y-2.5 pt-4 border-t border-purple-700/50 text-xs text-gray-200">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-star text-brand-gold"></i> جلسة تصوير سينمائي ميدانية 4K شهرياً</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-star text-brand-gold"></i> 16 فيديو ريلز بمونتاج Hook وتصحيح ألوان</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-star text-brand-gold"></i> 16 تصميم سوشيال ميديا وأغلفة يوتيوب</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-star text-brand-gold"></i> إدارة حملات ممولة متقدمة على Meta و TikTok</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-star text-brand-gold"></i> تقرير أسبوعي وتحليل دقيق للـ ROAS</div>
                    </div>
                </div>
                <div class="pt-8">
                    <a href="https://wa.me/201062330838?text=مرحباً%20بريق،%20أرغب%20في%20الاشتراك%20بباقة%20النمو%20السريع" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-xl shadow-amber-500/30 hover:brightness-110">
                        <i class="fa-solid fa-crown text-xs"></i>
                        <span>حجز باقة النمو السريع فوراً</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Package 3: Enterprise / Retainer -->
        <div class="glass-card-purple rounded-[2rem] p-8 border border-purple-800/60 flex flex-col justify-between hover:-translate-y-2 transition-all duration-300">
            <div class="space-y-4">
                <span class="text-xs font-bold text-gray-400">للمؤسسات والشركات الكبرى</span>
                <h3 class="text-2xl font-black text-white">باقة النخبة المتكاملة (Retainer)</h3>
                <div class="text-3xl font-black text-brand-gold font-mono pt-2">
                    28,000 <span class="text-xs font-sans text-gray-300">ج.م / شهرياً</span>
                </div>
                <p class="text-xs text-gray-400 leading-relaxed">فريق تسويقي وإنتاجي كامل مخصص لعلامتك التجارية كأنهم موظفون لديك.</p>
                <div class="space-y-2.5 pt-4 border-t border-purple-800/40 text-xs text-gray-300">
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> جلستي تصوير سينمائي شهرياً مع درون</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> عدد غير محدود من الريلز والبوستات حسب الخطة</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> تغطية فعاليات ومؤتمرات وافتتاحات الفروع</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> إدارة شاملة للحملات الإعلانية وميزانيات كبرى</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-amber"></i> مدير حساب مخصص واجتماعات أسبوعية</div>
                </div>
            </div>
            <div class="pt-8">
                <a href="https://wa.me/201062330838?text=مرحباً%20بريق،%20أرغب%20في%20مناقشة%20التعاقد%20على%20باقة%20النخبة%20المتكاملة" 
                   target="_blank"
                   class="w-full py-3 rounded-xl bg-purple-900/50 hover:bg-brand-amber hover:text-brand-dark text-white font-black text-xs border border-purple-600/40 transition flex items-center justify-center gap-2">
                    <span>حجز باقة النخبة وعقد اجتماع</span>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- BOTTOM CTA TO CONTACT -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-purple-500/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">هل لديك متطلبات خاصة أو مشروع بمواصفات محددة؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            نسعد بدراسة مشروعك وتخصيص باقة عمل تناسب ميزانيتك وأهدافك بدقة متناهية. تواصل معنا وسنقدم لك عرض سعر مخصص خلال ساعات.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-gold text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                طلب عرض سعر مخصص
            </a>
            <a href="{{ route('public.portfolio') }}" class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-purple-900/60 border border-purple-600/40 text-white font-bold text-xs transition">
                مشاهدة نماذج أعمالنا السابقة
            </a>
        </div>
    </div>
</section>
@endsection

