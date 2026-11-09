@extends('layouts.public')

@section('title', 'خدماتنا الإبداعية والتسويقية المتكاملة')
@section('meta_description', 'استكشف الـ 10 خدمات الإبداعية والتسويقية لوكالة بريق: تصوير الفيديو، مونتاج الفيديو، إدارة السوشيال ميديا، الإعلانات الممولة، تصوير صور، تصميم الجرافيك، البراندينج، إعداد الخطط والاستراتيجيات، تحليل البيانات، وكتابة المحتوى.')

@section('content')
<!-- Top Hero Header for Services -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-orange transition">الرئيسية</a>
        <span class="text-brand-orange">/</span>
        <span class="text-brand-orange font-bold">خدماتنا الإبداعية والتسويقية</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        حلول تسويقية وإنتاجية تصنع 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">الفارق الحقيقي</span> 
        لعلامتك التجارية
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        نقدم منظومة عمل إبداعية متكاملة تغطي كافة مراحل الإنتاج الرقمي من الفكرة والسكريبت، مروراً بالتصوير والمونتاج المتقن، وصولاً إلى إدارة الحملات الإعلانية ومضاعفة المبيعات.
    </p>

    <!-- Trust Badges -->
    <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-8 pt-8 text-xs sm:text-sm text-gray-300">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-camera text-brand-orange"></i>
            <span class="font-bold">معدات سينمائية 4K و 60 FPS</span>
        </div>
        <div class="text-purple-600">•</div>
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-bolt text-brand-orange"></i>
            <span class="font-bold">تسليم المسودات خلال 48-72 ساعة</span>
        </div>
        <div class="text-purple-600">•</div>
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span class="font-bold">استهداف دقيق بحساب الـ ROAS</span>
        </div>
    </div>
</section>

<!-- MAIN SERVICES SECTION (10 خدمات متكاملة بدون تسعير مع قالب صورة لكل خدمة) -->
<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10" x-data="{ activeCategory: 'all' }">
    
    <!-- Category Filter Tabs -->
    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14">
        <button type="button" @click="activeCategory = 'all'" 
                :class="activeCategory === 'all' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-layer-group"></i>
            <span>كافة الخدمات (10)</span>
        </button>
        <button type="button" @click="activeCategory = 'video'" 
                :class="activeCategory === 'video' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-video text-brand-orange"></i>
            <span>الإنتاج المرئي والمونتاج</span>
        </button>
        <button type="button" @click="activeCategory = 'design'" 
                :class="activeCategory === 'design' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-bezier-curve text-purple-300"></i>
            <span>التصميم والبراندينج</span>
        </button>
        <button type="button" @click="activeCategory = 'marketing'" 
                :class="activeCategory === 'marketing' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span>التسويق والإعلانات الممولة</span>
        </button>
        <button type="button" @click="activeCategory = 'strategy'" 
                :class="activeCategory === 'strategy' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-lightbulb text-brand-peach"></i>
            <span>الخطط وتحليل البيانات والمحتوى</span>
        </button>
    </div>

    <!-- 10 Detailed Services (Without Pricing - With Custom Image Frames) -->
    <div class="space-y-12">
        
        <!-- Service 1: تصوير الفيديو -->
        <div id="video-shooting" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/30 text-brand-orange text-xs font-bold">
                        <i class="fa-solid fa-video"></i>
                        <span>الخدمة 01 • إنتاج مرئي سينمائي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تصوير الفيديو</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        تصوير فيديوهات دعائية، بروموهات، كواليس، أو محتوى مخصص للسوشيال ميديا، بأسلوب عصري وجودة عالية تعبر عن هويتك.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> كاميرات سينمائية 4K وعدسات فاخرة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> طاقم إضاءة وهندسة صوت احترافية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> سكريبت ومودبورد تحضيري مسبق</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصوير جوي بالدرون (Drone 4K)</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame (قالب الصورة بدلاً من السعر) -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/social_4.webp') }}" alt="تصوير الفيديو" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            معدات تصوير سينمائي 4K
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تصوير%20الفيديو" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 2: مونتاج الفيديو -->
        <div id="video-editing" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-bold">
                        <i class="fa-solid fa-film"></i>
                        <span>الخدمة 02 • بوست برودكشن وسينما</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">مونتاج الفيديو</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نستخدم أحدث برامج المونتاج لنقدم فيديوهات عصرية عالية الجودة، بتأثيرات بصرية وصوتية احترافية، وتلوين دقيق، مما يضمن إخراجاً جذاباً يحقق أهدافك ويوصل رسالتك بوضوح.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تقطيع سريع يخطف الانتباه في أول 3 ثوانٍ</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصحيح ألوان سينمائي (DaVinci Resolve)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> هندسة صوتية وتأثيرات SFX محيطية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> موشن جرافيك وترجمات ديناميكية</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/social_2.webp') }}" alt="مونتاج الفيديو" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            مونتاج ريلز وإعلانات سريعة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20مونتاج%20الفيديو" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 3: إدارة وسائل التواصل الاجتماعي -->
        <div id="social-media" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/30 text-brand-orange text-xs font-bold">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>الخدمة 03 • حضور رقمي شامل</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">إدارة وسائل التواصل الاجتماعي</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نُدير حساباتك على مختلف المنصات من خلال إنشاء محتوى جذاب، وتصميم منشورات احترافية، والتفاعل مع الجمهور، إلى جانب دراسة أفضل أوقات النشر لتحقيق أقصى وصول وتفاعل، مع تحليل الأداء وتحسينه باستمرار.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> خطة محتوى شهرية (30 يوماً) وجدولة دقيقة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> كتابة كابشنز تسويقية بأسلوب الـ Copywriting</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> التفاعل مع الرسائل والتعليقات ورفع الـ Reach</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تقرير شهري رقمي شفاف لمؤشرات النمو</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/social_1.webp') }}" alt="إدارة وسائل التواصل" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            حضور قوي على كافة المنصات
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20إدارة%20حسابات%20السوشيال%20ميديا" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 4: الإعلانات الممولة -->
        <div id="paid-ads" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>الخدمة 04 • ميديا باينج وعائد ROAS عالي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">الإعلانات الممولة</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نصمم ونُدير حملات إعلانية احترافية تستهدف جمهورك بدقة عبر المنصات الرقمية المختلفة، لزيادة الانتشار وتحقيق أهدافك التسويقية.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> إدارة معتمدة على Meta, TikTok, Google, Snapchat</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تقليل تكلفة الاكتساب ومضاعفة المبيعات</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> اختبارات مستمرة للكرياتيف والنصوص (A/B Testing)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> ربط بكسل متقدم و CAPI لتتبع كل عملية شراء</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/ad_result_69.webp') }}" alt="الإعلانات الممولة" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            عائد إعلاني موثق يتجاوز ROAS 6.8x
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20الإعلانات%20الممولة" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 5: تصوير صور -->
        <div id="photography" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/30 text-brand-orange text-xs font-bold">
                        <i class="fa-solid fa-camera"></i>
                        <span>الخدمة 05 • فوتوغرافي فائق الدقة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تصوير صور</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        جلسات تصوير احترافية للمنتجات، الأماكن، الفعاليات، أو فريق العمل، باستخدام أحدث المعدات لإبراز كل التفاصيل بأعلى دقة.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصوير المنتجات في استوديو مجهز بالكامل</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصوير المأكولات والمطاعم بأعلى شهية بصرية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصوير الفعاليات والمؤتمرات وتغطيات حية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> معالجة رقمية وريتاتش دقيق للألوان والظلال</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/free_delivery.webp') }}" alt="تصوير صور" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            جلسات تصوير احترافية للمنتجات
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20جلسات%20التصوير%20الفوتوغرافي" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 6: تصميم الجرافيك -->
        <div id="graphic-design" x-show="activeCategory === 'all' || activeCategory === 'design'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-bold">
                        <i class="fa-solid fa-bezier-curve"></i>
                        <span>الخدمة 06 • فن بصري يجذب الانتباه</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تصميم الجرافيك</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        إبداع في التصميم البصري يعكس هوية علامتك التجارية ويجذب انتباه جمهورك المستهدف.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصاميم بوستات السوشيال ميديا وعروض البيع</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> أغلفة يوتيوب مصغرة ترفع نسبة النقر CTR</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> بنرات ومواد إعلانية رقمية متوافقة مع المنصات</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> إعلانات المجلات والبروشورات والمطبوعات</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/ramez_qlight.webp') }}" alt="تصميم الجرافيك" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            أغلفة وتصاميم سوشيال ميديا استثنائية
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تصميم%20الجرافيك" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 7: البراندينج والهوية البصرية -->
        <div id="branding" x-show="activeCategory === 'all' || activeCategory === 'design'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/30 text-brand-orange text-xs font-bold">
                        <i class="fa-solid fa-palette"></i>
                        <span>الخدمة 07 • بناء العلامات التجارية</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">البراندينج والهوية البصرية</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نساعدك على بناء هوية قوية لعلامتك التجارية من الألف إلى الياء، تعزز وجودك في السوق وتزيد من ثقة العملاء.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصميم الشعار (Logo Design) بفلسفة تعكس رؤيتك</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> اختيار الألوان والخطوط الرسمية المتناسقة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> دليل الهوية البصرية الشامل (Brand Guidelines)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تصميم المطبوعات والتغليف والموك اب الواقعي</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/logo_1.webp') }}" alt="البراندينج" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            هوية تجارية متكاملة ترسخ في الأذهان
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20البراندينج%20وبناء%20الهوية%20البصرية" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 8: إعداد الخطط والاستراتيجيات -->
        <div id="marketing-strategy" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-brand-peach/30 text-brand-peach text-xs font-bold">
                        <i class="fa-solid fa-lightbulb"></i>
                        <span>الخدمة 08 • رؤية تسويقية مدروسة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">إعداد الخطط والاستراتيجيات</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نضع خطط تسويقية شاملة ومخصصة تناسب أهدافك، مدعومة بتحليل السوق والمنافسين.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تحليل السوق والمنافسين والفرص السانحة</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> رسم مسار رحلة العميل (Customer Journey)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تحديد الميزانيات وقنوات التسويق ذات أعلى عائد</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> وضع مؤشرات قياس أداء ربع سنوية وسنوية</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/ad_result_70.webp') }}" alt="الخطط والاستراتيجيات" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            استراتيجية نمو ومبيعات مستدامة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20استشارة%20وإعداد%20خطة%20تسويقية%20شاملة" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 9: تحليل البيانات والتقارير -->
        <div id="data-analysis" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 text-xs font-bold">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>الخدمة 09 • قرارات مبنية على الأرقام</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">تحليل البيانات والتقارير</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نقيس الأداء، ونحلل النتائج بدقة، ونقدم لك تقارير واضحة تساعدك في اتخاذ قرارات مدروسة.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> لوحات تحكم رقمية Dashboard لحظية وتفاعلية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تتبع معدلات التحويل وتكلفة اكتساب العميل</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> تقارير دورية مبسطة باللغة العربية مع رسوم بيانية</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> توصيات عملية قابلة للتنفيذ الفوري للمبيعات</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/ad_result_72.webp') }}" alt="تحليل البيانات" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            تقارير أداء ذكية لقرارات مدروسة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تحليل%20البيانات%20والتقارير" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 10: كتابة المحتوى -->
        <div id="content-writing" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="glass-card-purple rounded-[2rem] p-8 sm:p-12 border border-purple-700/50 hover:border-brand-orange transition-all duration-300 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-bold">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span>الخدمة 10 • صياغة إبداعية مقنعة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white">كتابة المحتوى</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نكتب محتوى مبتكر بأسلوب احترافي بعيداً عن التكرار، لكي نجذب الجمهور من أول جملة وتصل رسالتك بأسرع شكل وبأسلوب سلس.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> كتابة سكريبتات ريلز وفيديوهات قصيرة بفكرة الخطف</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> نصوص إعلانية محفزة على الشراء (Copywriting)</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> كابشنز سوشيال ميديا تزيد التفاعل والتعليقات</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-brand-orange"></i> محتوى مواقع إلكترونية وكتيبات تعريفية للشركات</div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#120324] rounded-2xl p-4 border border-purple-800/60 space-y-4">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group">
                        <img src="{{ asset('images/portfolio/social_3.webp') }}" alt="كتابة المحتوى" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/70 px-3 py-1 rounded-lg backdrop-blur">
                            نصوص مقنعة تحول المتابعين إلى مشترين
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20كتابة%20المحتوى%20والسكريبتات" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- BOTTOM CTA -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-brand-orange/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">هل تحتاج باقة مخصصة تجمع أكثر من خدمة؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            نقوم بتصميم خطط إنتاج وتسويق مخصصة تدمج التصوير والمونتاج وإدارة الإعلانات لتلبية أهداف نشاطك التجاري بأفضل عائد استثماري.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                طلب استشارة تسويقية مخصصة
            </a>
            <a href="https://wa.me/201062330838" target="_blank" class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-purple-900/60 border border-brand-orange/50 text-white font-bold text-xs transition flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                <span>محادثة واتساب مباشرة</span>
            </a>
        </div>
    </div>
</section>
@endsection
