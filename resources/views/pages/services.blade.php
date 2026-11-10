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

<!-- MAIN SERVICES SECTION (10 خدمات متكاملة بدون تسعير مع قالب صورة احترافي لكل خدمة) -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10" x-data="{ activeCategory: 'all' }">
    
    <!-- Section Header -->
    <div class="text-center max-w-3xl mx-auto mb-12 space-y-3">
        <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30 inline-flex items-center gap-2">
            <i class="fa-solid fa-sparkles text-brand-orange"></i>
            <span>منظومة متكاملة من 10 خدمات متخصصة</span>
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight">خدماتنا التسويقية والإبداعية</h1>
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed max-w-2xl mx-auto">
            نقدم حلولاً مدروسة تجمع بين دقة الاستهداف وأعلى جودة إنتاج سينمائي ورقمي لبناء حضور استثنائي لعلامتك التجارية.
        </p>
    </div>
    
    <!-- Category Filter Tabs -->
    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14">
        <button type="button" @click="activeCategory = 'all'" 
                :class="activeCategory === 'all' ? 'bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black shadow-[0_0_25px_rgba(255,148,32,0.55)] scale-105' : 'bg-[#1B082B] text-gray-200 hover:text-white border-2 border-[#3E24C5]/60 hover:border-[#FF9420]'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-layer-group"></i>
            <span>كافة الخدمات (10)</span>
        </button>
        <button type="button" @click="activeCategory = 'video'" 
                :class="activeCategory === 'video' ? 'bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black shadow-[0_0_25px_rgba(255,148,32,0.55)] scale-105' : 'bg-[#1B082B] text-gray-200 hover:text-white border-2 border-[#3E24C5]/60 hover:border-[#FF9420]'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-video text-[#FF9420]"></i>
            <span>الإنتاج المرئي والمونتاج</span>
        </button>
        <button type="button" @click="activeCategory = 'design'" 
                :class="activeCategory === 'design' ? 'bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black shadow-[0_0_25px_rgba(255,148,32,0.55)] scale-105' : 'bg-[#1B082B] text-gray-200 hover:text-white border-2 border-[#3E24C5]/60 hover:border-[#FF9420]'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-bezier-curve text-[#FFBA70]"></i>
            <span>التصميم والبراندينج</span>
        </button>
        <button type="button" @click="activeCategory = 'marketing'" 
                :class="activeCategory === 'marketing' ? 'bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black shadow-[0_0_25px_rgba(255,148,32,0.55)] scale-105' : 'bg-[#1B082B] text-gray-200 hover:text-white border-2 border-[#3E24C5]/60 hover:border-[#FF9420]'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span>التسويق والإعلانات الممولة</span>
        </button>
        <button type="button" @click="activeCategory = 'strategy'" 
                :class="activeCategory === 'strategy' ? 'bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black shadow-[0_0_25px_rgba(255,148,32,0.55)] scale-105' : 'bg-[#1B082B] text-gray-200 hover:text-white border-2 border-[#3E24C5]/60 hover:border-[#FF9420]'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-lightbulb text-[#FFBA70]"></i>
            <span>الخطط وتحليل البيانات والمحتوى</span>
        </button>
    </div>

    <!-- 10 Detailed Services (Without Pricing - With Custom Image Frames) -->
    <div class="space-y-12">
        
        <!-- Service 1: تصوير الفيديو (Odd: Text Right, Image Left) -->
        <div id="video-shooting" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <!-- Watermark Number & Ambient Glow -->
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">01</div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-brand-orange/10 blur-3xl pointer-events-none group-hover:bg-brand-orange/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-orange/15 border border-brand-orange/40 text-brand-orange text-xs font-black shadow-sm">
                        <i class="fa-solid fa-video"></i>
                        <span>الخدمة 01 • إنتاج مرئي سينمائي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">تصوير الفيديو السينمائي</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        تصوير فيديوهات دعائية، بروموهات، كواليس، أو محتوى مخصص للسوشيال ميديا، بأسلوب عصري وجودة سينمائية فائقة تعبر عن هوية علامتك التجارية وتخطف انتباه الجمهور.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>كاميرات سينمائية 4K وعدسات فاخرة</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>طاقم إضاءة وهندسة صوت احترافية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>سكريبت ومودبورد تحضيري مسبق</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصوير جوي بالدرون (Drone 4K)</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-2">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/social_4.webp') }}" alt="تصوير الفيديو" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-camera text-brand-orange ml-1"></i> معدات تصوير سينمائي 4K
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تصوير%20الفيديو" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 2: مونتاج الفيديو (Even: Image Right, Text Left on desktop) -->
        <div id="video-editing" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">02</div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-600/10 blur-3xl pointer-events-none group-hover:bg-purple-600/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-black shadow-sm">
                        <i class="fa-solid fa-film"></i>
                        <span>الخدمة 02 • بوست برودكشن وسينما</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">مونتاج الفيديو السريع</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نستخدم أحدث برامج المونتاج لنقدم فيديوهات عصرية عالية الجودة، بتأثيرات بصرية وصوتية احترافية، وتلوين دقيق، مما يضمن إخراجاً جذاباً يحقق أهدافك ويوصل رسالتك بوضوح.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تقطيع سريع يخطف الانتباه في أول 3 ثوانٍ</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصحيح ألوان سينمائي (DaVinci Resolve)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>هندسة صوتية وتأثيرات SFX محيطية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>موشن جرافيك وترجمات ديناميكية عصرية</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-1">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/social_2.webp') }}" alt="مونتاج الفيديو" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-clapperboard text-brand-orange ml-1"></i> مونتاج ريلز وإعلانات سريعة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20مونتاج%20الفيديو" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 3: إدارة وسائل التواصل الاجتماعي (Odd) -->
        <div id="social-media" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">03</div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-brand-orange/10 blur-3xl pointer-events-none group-hover:bg-brand-orange/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/40 text-brand-orange text-xs font-black shadow-sm">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>الخدمة 03 • حضور رقمي شامل</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">إدارة وسائل التواصل الاجتماعي</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نُدير حساباتك على مختلف المنصات من خلال إنشاء محتوى جذاب، وتصميم منشورات احترافية، والتفاعل مع الجمهور، إلى جانب دراسة أفضل أوقات النشر لتحقيق أقصى وصول وتفاعل مستمر.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>خطة محتوى شهرية (30 يوماً) وجدولة دقيقة</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>كتابة كابشنز تسويقية بأسلوب الـ Copywriting</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>التفاعل مع الرسائل والتعليقات ورفع الـ Reach</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تقرير شهري رقمي شفاف لمؤشرات النمو</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-2">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/social_1.webp') }}" alt="إدارة وسائل التواصل" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-hashtag text-brand-orange ml-1"></i> حضور قوي على كافة المنصات
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20إدارة%20حسابات%20السوشيال%20ميديا" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 4: الإعلانات الممولة (Even) -->
        <div id="paid-ads" x-show="activeCategory === 'all' || activeCategory === 'marketing'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">04</div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none group-hover:bg-emerald-500/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-xs font-black shadow-sm">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>الخدمة 04 • ميديا باينج وعائد ROAS عالي</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">الإعلانات الممولة</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نصمم ونُدير حملات إعلانية احترافية تستهدف جمهورك بدقة عبر المنصات الرقمية المختلفة، لزيادة الانتشار وتحقيق أعلى عائد على الإنفاق الإعلاني (ROAS).
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-emerald-400/20 text-emerald-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>إدارة معتمدة على Meta, TikTok, Google, Snapchat</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-emerald-400/20 text-emerald-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تقليل تكلفة الاكتساب ومضاعفة المبيعات</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-emerald-400/20 text-emerald-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>اختبارات مستمرة للكرياتيف والنصوص (A/B Testing)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-emerald-400/20 text-emerald-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>ربط بكسل متقدم و CAPI لتتبع كل عملية شراء</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-1">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/ad_result_69.webp') }}" alt="الإعلانات الممولة" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-arrow-trend-up text-emerald-400 ml-1"></i> عائد إعلاني موثق يتجاوز ROAS 6.8x
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20الإعلانات%20الممولة" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 5: تصوير صور (Odd) -->
        <div id="photography" x-show="activeCategory === 'all' || activeCategory === 'video'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">05</div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-brand-orange/10 blur-3xl pointer-events-none group-hover:bg-brand-orange/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/40 text-brand-orange text-xs font-black shadow-sm">
                        <i class="fa-solid fa-camera"></i>
                        <span>الخدمة 05 • فوتوغرافي فائق الدقة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">جلسات التصوير الفوتوغرافي</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        جلسات تصوير احترافية للمنتجات، الأماكن، الفعاليات، أو فريق العمل، باستخدام أحدث المعدات والإضاءة الاستوديو لإبراز كل التفاصيل بأعلى دقة.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصوير المنتجات في استوديو مجهز بالكامل</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصوير المأكولات والمطاعم بأعلى شهية بصرية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصوير الفعاليات والمؤتمرات وتغطيات حية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>معالجة رقمية وريتاتش دقيق للألوان والظلال</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-2">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/free_delivery.webp') }}" alt="تصوير صور" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-image text-brand-orange ml-1"></i> جلسات تصوير احترافية للمنتجات
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20جلسات%20التصوير%20الفوتوغرافي" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 6: تصميم الجرافيك (Even) -->
        <div id="graphic-design" x-show="activeCategory === 'all' || activeCategory === 'design'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">06</div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-600/10 blur-3xl pointer-events-none group-hover:bg-purple-600/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-black shadow-sm">
                        <i class="fa-solid fa-bezier-curve"></i>
                        <span>الخدمة 06 • فن بصري يجذب الانتباه</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">تصميم الجرافيك الإبداعي</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        إبداع في التصميم البصري يعكس هوية علامتك التجارية بدقة، ويجذب انتباه جمهورك المستهدف من خلال تراكيب وتناغمات لونية عصرية.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصاميم بوستات السوشيال ميديا وعروض البيع</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>أغلفة يوتيوب مصغرة ترفع نسبة النقر CTR</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>بنرات ومواد إعلانية رقمية متوافقة مع المنصات</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>إعلانات المجلات والبروشورات والمطبوعات</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-1">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/ramez_qlight.webp') }}" alt="تصميم الجرافيك" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-palette text-brand-orange ml-1"></i> أغلفة وتصاميم سوشيال ميديا استثنائية
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تصميم%20الجرافيك" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 7: البراندينج والهوية البصرية (Odd) -->
        <div id="branding" x-show="activeCategory === 'all' || activeCategory === 'design'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">07</div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-brand-orange/10 blur-3xl pointer-events-none group-hover:bg-brand-orange/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/40 text-brand-orange text-xs font-black shadow-sm">
                        <i class="fa-solid fa-palette"></i>
                        <span>الخدمة 07 • بناء العلامات التجارية</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">البراندينج والهوية البصرية</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نساعدك على بناء هوية قوية لعلامتك التجارية من الألف إلى الياء، تعزز وجودك في السوق وتزيد من ثقة العملاء وولائهم.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصميم الشعار (Logo Design) بفلسفة تعكس رؤيتك</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>اختيار الألوان والخطوط الرسمية المتناسقة</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>دليل الهوية البصرية الشامل (Brand Guidelines)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تصميم المطبوعات والتغليف والموك اب الواقعي</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-2">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/logo_1.webp') }}" alt="البراندينج" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-fingerprint text-brand-orange ml-1"></i> هوية تجارية متكاملة ترسخ في الأذهان
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20البراندينج%20وبناء%20الهوية%20البصرية" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 8: إعداد الخطط والاستراتيجيات (Even) -->
        <div id="marketing-strategy" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">08</div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none group-hover:bg-amber-500/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/15 border border-brand-peach/30 text-brand-peach text-xs font-black shadow-sm">
                        <i class="fa-solid fa-lightbulb"></i>
                        <span>الخدمة 08 • رؤية تسويقية مدروسة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">إعداد الخطط والاستراتيجيات</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نضع خطط تسويقية شاملة ومخصصة تناسب أهدافك، مدعومة بتحليل السوق والمنافسين وتحديد دقيق للجمهور المستهدف.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تحليل السوق والمنافسين والفرص السانحة</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>رسم مسار رحلة العميل (Customer Journey)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تحديد الميزانيات وقنوات التسويق ذات أعلى عائد</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>وضع مؤشرات قياس أداء ربع سنوية وسنوية</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-1">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/ad_result_70.webp') }}" alt="الخطط والاستراتيجيات" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-compass text-brand-orange ml-1"></i> استراتيجية نمو ومبيعات مستدامة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20استشارة%20وإعداد%20خطة%20تسويقية%20شاملة" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 9: تحليل البيانات والتقارير (Odd) -->
        <div id="data-analysis" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">09</div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none group-hover:bg-cyan-500/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 text-xs font-black shadow-sm">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>الخدمة 09 • قرارات مبنية على الأرقام</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">تحليل البيانات والتقارير</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نقيس الأداء، ونحلل النتائج بدقة، ونقدم لك تقارير واضحة تساعدك في اتخاذ قرارات مدروسة تضاعف مبيعاتك وتقلل هدر الميزانيات.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-cyan-400/20 text-cyan-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>لوحات تحكم رقمية Dashboard لحظية وتفاعلية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-cyan-400/20 text-cyan-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تتبع معدلات التحويل وتكلفة اكتساب العميل</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-cyan-400/20 text-cyan-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>تقارير دورية مبسطة باللغة العربية مع رسوم بيانية</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-cyan-400/20 text-cyan-400 flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>توصيات عملية قابلة للتنفيذ الفوري للمبيعات</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-2">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/ad_result_72.webp') }}" alt="تحليل البيانات" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-chart-line text-cyan-400 ml-1"></i> تقارير أداء ذكية لقرارات مدروسة
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20تحليل%20البيانات%20والتقارير" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>طلب هذه الخدمة المباشرة</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Service 10: كتابة المحتوى (Even) -->
        <div id="content-writing" x-show="activeCategory === 'all' || activeCategory === 'strategy'" 
             class="relative rounded-[2.2rem] p-6 sm:p-10 lg:p-12 bg-gradient-to-br from-[#130426]/90 via-[#180730]/85 to-[#0E031E]/95 border border-purple-800/60 hover:border-brand-orange/80 transition-all duration-500 shadow-2xl hover:shadow-[0_0_45px_rgba(255,148,32,0.18)] group overflow-hidden">
            
            <div class="absolute top-3 left-6 text-7xl sm:text-8xl font-black text-white/[0.04] select-none font-mono pointer-events-none group-hover:text-brand-orange/[0.08] transition-colors">10</div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-purple-600/10 blur-3xl pointer-events-none group-hover:bg-purple-600/15 transition-all"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-7 space-y-5 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs font-black shadow-sm">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span>الخدمة 10 • صياغة إبداعية مقنعة</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight group-hover:text-brand-orange transition-colors">صناعة وكتابة المحتوى</h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        نكتب محتوى مبتكر بأسلوب احترافي بعيداً عن التكرار، لكي نجذب الجمهور من أول جملة وتصل رسالتك بأسرع شكل وبأسلوب سلس يحول المتابعين إلى عملاء.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>كتابة سكريبتات ريلز وفيديوهات قصيرة بفكرة الخطف</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>نصوص إعلانية محفزة على الشراء (Copywriting)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>كابشنز سوشيال ميديا تزيد التفاعل والتعليقات</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#1b0a33]/60 border border-purple-800/40 text-gray-200 text-xs">
                            <span class="w-6 h-6 rounded-lg bg-brand-orange/20 text-brand-orange flex items-center justify-center text-xs shrink-0"><i class="fa-solid fa-check"></i></span>
                            <span>محتوى مواقع إلكترونية وكتيبات تعريفية للشركات</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Visual Image Frame -->
                <div class="lg:col-span-5 bg-[#140528]/80 rounded-2xl p-4 border border-purple-800/60 hover:border-brand-orange/50 transition shadow-inner space-y-4 lg:order-1">
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/60 border border-purple-700/40 group/img">
                        <img src="{{ asset('images/portfolio/social_3.webp') }}" alt="كتابة المحتوى" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 right-3 text-[11px] font-bold text-white bg-black/75 px-3 py-1.5 rounded-xl backdrop-blur-md border border-brand-orange/40 shadow-lg">
                            <i class="fa-solid fa-feather-pointed text-brand-orange ml-1"></i> نصوص مقنعة تحول المتابعين إلى مشترين
                        </span>
                    </div>
                    <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الاستفسار%20عن%20خدمة%20كتابة%20المحتوى%20والسكريبتات" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-orange-500/20 hover:brightness-110 active:scale-95">
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
