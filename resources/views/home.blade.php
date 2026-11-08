@extends('layouts.public')

@section('title', 'وكالة بريق للإعلام والتصميم | نصنع لعلامتك التجارية بريقاً استثنائياً')
@section('meta_description', 'وكالة بريق حلول تسويق إلكتروني وتصميم جرافيك متكاملة مع تصوير ومونتاج فيديو احترافي سينمائي، تصميم هويات بصرية، وإعلانات ممولة في مصر والسعودية والخليج.')

@section('content')

<!-- FLOATING SIDE SECTION SCROLLSPY DOCK FOR HOMEPAGE (تنقل سينمائي سريع) -->
<nav class="hidden 2xl:flex fixed left-6 top-1/2 -translate-y-1/2 z-40 flex-col items-center gap-3 bg-[#130526]/85 backdrop-blur-xl border border-purple-800/40 py-4 px-2.5 rounded-full shadow-2xl">
    <a href="#hero" class="group relative flex items-center justify-center w-7 h-7" title="الرئيسية">
        <span class="w-2.5 h-2.5 rounded-full bg-brand-gold shadow-[0_0_8px_rgba(251,191,36,0.8)] transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">01. الرئيسية</span>
    </a>
    <a href="#services-summary" class="group relative flex items-center justify-center w-7 h-7" title="خدماتنا">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">02. خدماتنا المتكاملة</span>
    </a>
    <a href="#process-summary" class="group relative flex items-center justify-center w-7 h-7" title="مراحل العمل">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">03. مراحل العمل والإنتاج</span>
    </a>
    <a href="#portfolio-summary" class="group relative flex items-center justify-center w-7 h-7" title="معرض الأعمال">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">04. معرض الأعمال الموثق</span>
    </a>
    <a href="#clients-summary" class="group relative flex items-center justify-center w-7 h-7" title="شركاء النجاح">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">05. شركاء النجاح</span>
    </a>
    <a href="#testimonials-summary" class="group relative flex items-center justify-center w-7 h-7" title="آراء العملاء">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">06. آراء وتقييمات العملاء</span>
    </a>
    <a href="#contact-summary" class="group relative flex items-center justify-center w-7 h-7" title="طلب استشارة">
        <span class="w-2.5 h-2.5 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
        <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">07. تواصل معنا وعرض سعر</span>
    </a>
</nav>

<!-- 1. HERO SECTION -->
<section id="hero" class="relative pt-36 pb-20 lg:pt-48 lg:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10">
    
    @if(session('success_inquiry'))
    <div class="p-4 mb-8 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm flex items-center justify-between shadow-2xl backdrop-blur-md">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-400 text-xl"></i>
            <span class="font-bold">{{ session('success_inquiry') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white transition"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    <!-- FLOATING 3D CREATIVE DESIGN BADGES -->
    <div class="hidden xl:block absolute top-40 right-4 animate-float-slow pointer-events-none">
        <div class="px-4 py-2.5 rounded-2xl bg-[#1D0838]/80 backdrop-blur-xl border border-amber-400/30 text-brand-gold text-xs font-bold shadow-2xl flex items-center gap-2.5 rotate-3">
            <span class="w-8 h-8 rounded-xl bg-amber-500/20 flex items-center justify-center text-brand-amber"><i class="fa-solid fa-video text-sm"></i></span>
            <div>
                <div class="text-[11px] text-white font-black">4K Cinema ProRes</div>
                <div class="text-[9px] text-gray-400 font-medium">تصوير سينمائي ومونتاج</div>
            </div>
        </div>
    </div>

    <div class="hidden xl:block absolute top-72 left-2 animate-float-reverse pointer-events-none">
        <div class="px-4 py-2.5 rounded-2xl bg-[#1D0838]/80 backdrop-blur-xl border border-purple-400/30 text-purple-200 text-xs font-bold shadow-2xl flex items-center gap-2.5 -rotate-3">
            <span class="w-8 h-8 rounded-xl bg-purple-500/20 flex items-center justify-center text-purple-300"><i class="fa-solid fa-bezier-curve text-sm"></i></span>
            <div>
                <div class="text-[11px] text-white font-black">Vector & Brand Identity</div>
                <div class="text-[9px] text-gray-400 font-medium">بناء هويات بصرية متكاملة</div>
            </div>
        </div>
    </div>

    <div class="hidden xl:block absolute bottom-32 right-12 animate-float-reverse pointer-events-none">
        <div class="px-4 py-2.5 rounded-2xl bg-[#1D0838]/80 backdrop-blur-xl border border-emerald-400/30 text-emerald-300 text-xs font-bold shadow-2xl flex items-center gap-2.5 -rotate-2">
            <span class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400"><i class="fa-solid fa-chart-line text-sm"></i></span>
            <div>
                <div class="text-[11px] text-white font-black">+380% ROAS High Growth</div>
                <div class="text-[9px] text-gray-400 font-medium">إعلانات ممولة ومضاعفة المبيعات</div>
            </div>
        </div>
    </div>

    <div class="hidden xl:block absolute bottom-44 left-10 animate-float-slow pointer-events-none">
        <div class="px-4 py-2.5 rounded-2xl bg-[#1D0838]/80 backdrop-blur-xl border border-yellow-400/30 text-brand-gold text-xs font-bold shadow-2xl flex items-center gap-2.5 rotate-2">
            <span class="w-8 h-8 rounded-xl bg-yellow-500/20 flex items-center justify-center text-brand-gold"><i class="fa-solid fa-wand-magic-sparkles text-sm"></i></span>
            <div>
                <div class="text-[11px] text-white font-black">Color Grading & SFX</div>
                <div class="text-[9px] text-gray-400 font-medium">سحر تصحيح الألوان والمؤثرات</div>
            </div>
        </div>
    </div>

    <!-- Hero Content Center -->
    <div class="text-center max-w-4xl mx-auto space-y-7 relative">
        
        <!-- Animated Slogan Pill with Glowing Orbit -->
        <div class="inline-flex items-center gap-2.5 px-6 py-2 rounded-full bg-[#18082B]/90 border border-brand-yellow/40 text-brand-gold text-xs font-bold shadow-[0_0_20px_rgba(245,158,11,0.2)] animate-pulse-glow">
            <span class="w-2 h-2 rounded-full bg-brand-gold animate-ping"></span>
            <i class="fa-solid fa-sparkles text-xs text-brand-amber"></i>
            <span class="tracking-wide">( بريق ، مفتاح نجاحك في التسويق والإبداع الرقمي )</span>
        </div>

        <!-- Primary Headline with Liquid Gradient Shimmer -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white leading-[1.18] tracking-tight">
            نصنع لعلامتك التجارية
            <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl lg:text-8xl">بريقاً استثنائياً</span>
            في الفضاء الرقمي
        </h1>

        <!-- Subtitle -->
        <p class="text-base sm:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed font-normal">
            منصة متكاملة تجمع بين التصوير السينمائي 4K، المونتاج فائق الإبهار، تصميم الهويات البصرية، وإدارة الحملات الإعلانية القائمة على أعلى عائد استثماري.
        </p>

        <!-- Hero Action Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-4 pt-3">
            <a href="{{ route('public.portfolio') }}" 
               class="px-8 py-4 rounded-2xl bg-gradient-to-l from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 active:scale-95 transition shadow-2xl shadow-amber-500/30 flex items-center gap-3 group">
                <span class="w-6 h-6 rounded-full bg-black/20 flex items-center justify-center group-hover:scale-110 transition-transform"><i class="fa-solid fa-play text-xs text-brand-dark"></i></span>
                <span>استكشف معرض الأعمال الحقيقي</span>
            </a>

            <a href="{{ route('public.services') }}" 
               class="px-8 py-4 rounded-2xl bg-[#19092E]/80 hover:bg-[#250C44] border border-purple-500/40 hover:border-brand-gold text-white font-bold text-sm transition shadow-lg flex items-center gap-2.5 backdrop-blur-md">
                <i class="fa-solid fa-layer-group text-brand-gold"></i>
                <span>تفاصيل الخدمات والباقات</span>
            </a>
        </div>

        <!-- HERO SHOWREEL TEASER CARD -->
        <div class="pt-8 max-w-3xl mx-auto">
            <div class="conic-glow-border cursor-pointer group"
                 @click="openMedia('video', '{{ asset('videos/promo_reels_1.mp4') }}', 'شو ريل بريق للإعلام والتصميم 2026', 'لقطات سينمائية ومونتاج إعلاني لأبرز شركاء النجاح في الوطن العربي')">
                
                <div class="relative rounded-[1.4rem] bg-[#0E031A] overflow-hidden aspect-[21/9] sm:aspect-[2.4/1] flex items-center justify-center p-6">
                    
                    <div class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:scale-105 group-hover:opacity-55 transition-all duration-700" 
                         style="background-image: url('{{ asset('images/portfolio/ramez_qlight.webp') }}');"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0E031A] via-[#160627]/80 to-transparent"></div>

                    <div class="absolute top-4 right-4 z-20 flex items-center gap-2 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-purple-500/30 text-[10px] text-brand-gold font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>PARIQ SHOWREEL • سينما 4K</span>
                    </div>

                    <div class="relative z-20 flex flex-col items-center justify-center space-y-3">
                        <div class="relative flex items-center justify-center">
                            <span class="absolute w-20 h-20 rounded-full bg-brand-amber/30 animate-radar"></span>
                            <span class="absolute w-28 h-28 rounded-full bg-purple-500/20 animate-radar" style="animation-delay: 0.8s;"></span>
                            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-brand-orange to-brand-gold text-brand-dark flex items-center justify-center text-xl shadow-2xl group-hover:scale-115 transition-transform duration-300">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-white group-hover:text-brand-gold transition-colors">
                            تشغيل شو ريل وكالة بريق (Showreel)
                        </span>
                    </div>

                    <div class="absolute bottom-4 left-4 z-20 flex items-center gap-2 text-[10px] text-gray-300 font-mono">
                        <i class="fa-solid fa-volume-high text-brand-amber"></i>
                        <span>CINEMA AUDIO • 60 FPS</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- LIVE ANIMATED STATS COUNTER BAR -->
        <div x-data="pariqStatsCounter()" 
             x-init="initObserver($el)"
             class="pt-10 space-y-4">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>إحصائيات موثقة تتحدث بالتزامن مع إنجازات الوكالة اليومية</span>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center font-mono">
                        <span>+</span><span x-text="projects">0</span>
                    </div>
                    <div class="text-xs text-gray-300 mt-1.5 font-bold">مشروع مكتمل بنجاح</div>
                </div>

                <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/20 border border-purple-500/40 text-purple-300 flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                        <span>+</span><span x-text="clients">0</span>
                    </div>
                    <div class="text-xs text-gray-300 mt-1.5 font-bold">عميل سعيد في 6 دول</div>
                </div>

                <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-500/15 border border-yellow-500/30 text-yellow-400 flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center font-mono">
                        <span>+</span><span x-text="years">0</span>
                    </div>
                    <div class="text-xs text-gray-300 mt-1.5 font-bold">سنوات خبرة متواصلة</div>
                </div>

                <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/15 border border-orange-500/30 text-orange-400 flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div class="text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                        <span>+</span><span x-text="team">0</span>
                    </div>
                    <div class="text-xs text-gray-300 mt-1.5 font-bold">مبدع وخبير متخصص</div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 1 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-16 bg-gradient-to-b from-brand-void via-[#100320] to-[#16062C]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
</div>

<!-- 2. MOVING MARQUEE TICKER -->
<div class="py-4 bg-[#140526] border-y border-purple-900/40 overflow-hidden relative z-10 select-none">
    <div class="marquee-track flex items-center gap-8 whitespace-nowrap text-xs sm:text-sm font-bold text-gray-300">
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-camera-retro text-brand-gold"></i> تصوير سينمائي 4K احترافي</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i> مونتاج ريلز وبرومو سريع (Fast-Paced)</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-bezier-curve text-amber-400"></i> تصميم هويات بصرية وبوستات سوشيال ميديا</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-chart-line text-emerald-400"></i> إعلانات ممولة وميديا باينج (ROAS عالي)</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-crown text-brand-gold"></i> بريق ، مفتاح نجاحك في التسويق</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-globe text-cyan-400"></i> شركاؤنا في مصر والسعودية والإمارات والأردن</span>
        <span class="text-brand-yellow">•</span>
        <!-- Seamless Loop Duplicate -->
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-camera-retro text-brand-gold"></i> تصوير سينمائي 4K احترافي</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i> مونتاج ريلز وبرومو سريع (Fast-Paced)</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-bezier-curve text-amber-400"></i> تصميم هويات بصرية وبوستات سوشيال ميديا</span>
        <span class="text-brand-yellow">•</span>
        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-chart-line text-emerald-400"></i> إعلانات ممولة وميديا باينج (ROAS عالي)</span>
    </div>
</div>

<!-- 3. SERVICES SUMMARY SECTION (مع زر انتقال لصفحة الخدمات المستقلة) -->
<section id="services-summary" class="py-24 bg-gradient-to-b from-[#16062C] via-[#1B0736] to-[#120425] relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6 reveal-on-scroll">
            <div class="space-y-3">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    خبراتنا وقدراتنا الإبداعية
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">خدماتنا التسويقية والإبداعية</h2>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl">نغطي كافة مراحل الإنتاج الرقمي تحت سقف واحد بأعلى معايير الإتقان الفني والتجاري.</p>
            </div>
            
            <!-- Direct Link to Dedicated Services Page -->
            <div>
                <a href="{{ route('public.services') }}" 
                   class="inline-flex items-center gap-3 px-6 py-3.5 rounded-2xl bg-purple-900/50 hover:bg-gradient-to-l hover:from-brand-orange hover:to-brand-amber hover:text-brand-dark text-brand-gold font-black text-xs border border-purple-600/40 hover:border-transparent transition shadow-xl group">
                    <span>استكشف تفاصيل وباقات كافة الخدمات</span>
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        @php
            $quickServices = [
                [
                    'id' => 'shooting',
                    'title' => 'تصوير فيديو سينمائي احترافي 4K',
                    'icon' => 'fa-solid fa-video',
                    'icon_color' => 'text-amber-400',
                    'icon_bg' => 'bg-amber-500/15 border-amber-500/30',
                    'desc' => 'تصوير سينمائي عالي الجودة 4K بأحدث الكاميرات والمعدات وطاقم متخصص لإبراز تفاصيل منتجاتك وعلامتك التجارية.',
                    'price' => '3,500',
                ],
                [
                    'id' => 'editing',
                    'title' => 'مونتاج ريلز وبرومو سينمائي سريع',
                    'icon' => 'fa-solid fa-film',
                    'icon_color' => 'text-purple-300',
                    'icon_bg' => 'bg-purple-500/20 border-purple-500/40',
                    'desc' => 'مونتاج ريلز وبروموهات خاطفة للأنظار مع تصحيح ألوان سينمائي، مؤثرات صوتية تحبس الأنفاس، وموشن جرافيك.',
                    'price' => '2,000',
                ],
                [
                    'id' => 'design',
                    'title' => 'تصميمات جرافيك وبناء الهويات البصرية',
                    'icon' => 'fa-solid fa-bezier-curve',
                    'icon_color' => 'text-yellow-400',
                    'icon_bg' => 'bg-yellow-500/15 border-yellow-500/30',
                    'desc' => 'تصميمات سوشيال ميديا استثنائية، أغلفة يوتيوب مصغرة ترفع الـ CTR، وتصميم شعارات وهوية تجارية كاملة.',
                    'price' => '1,500',
                ],
                [
                    'id' => 'ads',
                    'title' => 'الإعلانات الممولة وميديا باينج (ROAS)',
                    'icon' => 'fa-solid fa-chart-line',
                    'icon_color' => 'text-emerald-400',
                    'icon_bg' => 'bg-emerald-500/15 border-emerald-500/30',
                    'desc' => 'إدارة حملات احترافية على Meta, TikTok, Google بحساب دقيق للعائد على الإنفاق واستهداف الشريحة الأكثر شراءً.',
                    'price' => '4,000',
                ],
                [
                    'id' => 'social',
                    'title' => 'إدارة كاملة لحسابات السوشيال ميديا',
                    'icon' => 'fa-solid fa-share-nodes',
                    'icon_color' => 'text-orange-400',
                    'icon_bg' => 'bg-orange-500/15 border-orange-500/30',
                    'desc' => 'تولي كامل لإدارة منصاتك الرقمية: خطة محتوى شهرية، النشر في الأوقات الذهبية، وكتابة الكابشنز والمتابعة.',
                    'price' => '5,000',
                ],
                [
                    'id' => 'strategy',
                    'title' => 'إعداد الخطط التسويقية والاستشارات',
                    'icon' => 'fa-solid fa-lightbulb',
                    'icon_color' => 'text-amber-300',
                    'icon_bg' => 'bg-amber-500/15 border-amber-500/30',
                    'desc' => 'دراسة السوق ومنافسيك لبناء استراتيجية انطلاق تسويقية شاملة تقود علامتك لاحتلال الصدارة وتوليد طلب مستمر.',
                    'price' => '3,000',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quickServices as $srv)
            <div class="glass-card-purple rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <div class="space-y-4 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="w-14 h-14 rounded-2xl {{ $srv['icon_bg'] }} border {{ $srv['icon_color'] }} flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <i class="{{ $srv['icon'] }}"></i>
                        </div>
                        <a href="{{ route('public.services') }}#{{ $srv['id'] }}" class="text-[11px] font-bold text-brand-gold bg-brand-yellow/10 px-3 py-1 rounded-full border border-brand-yellow/20 hover:bg-brand-yellow hover:text-brand-dark transition">
                            تفاصيل الخدمة ⬅️
                        </a>
                    </div>

                    <h3 class="text-xl font-black text-white group-hover:text-brand-gold transition-colors leading-snug">
                        {{ $srv['title'] }}
                    </h3>

                    <p class="text-xs text-gray-300 leading-relaxed font-normal">
                        {{ $srv['desc'] }}
                    </p>
                </div>

                <div class="pt-6 mt-6 border-t border-purple-800/40 flex items-center justify-between text-xs relative z-10">
                    <div>
                        <span class="text-[10px] text-gray-400 block font-medium">تبدأ الباقات من:</span>
                        <span class="text-brand-gold font-black text-base font-mono">
                            {{ $srv['price'] }} <span class="text-xs font-sans">ج.م</span>
                        </span>
                    </div>
                    <a href="{{ route('public.services') }}#{{ $srv['id'] }}" 
                       class="px-4 py-2.5 rounded-xl bg-purple-900/50 hover:bg-brand-amber hover:text-brand-dark text-brand-gold font-black transition flex items-center gap-1.5 border border-purple-700/40">
                        <span>عرض الباقة</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 2 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-20 bg-gradient-to-b from-[#120425] via-[#0E031D] to-[#0A0216]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-purple-500/40 to-transparent"></div>
</div>

<!-- 4. WORK PROCESS SUMMARY (مع زر انتقال لصفحة مراحل العمل ومن نحن) -->
<section id="process-summary" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal-on-scroll">
        <div class="space-y-3">
            <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                منهجية العمل المعتمدة
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white">مراحل عملنا نحو نجاح علامتك</h2>
            <p class="text-xs sm:text-sm text-gray-300 max-w-xl">مسار عمل واضح ومنظم يضمن تحويل الأفكار إلى إنجازات مرئية ذات عائد حقيقي وملموس.</p>
        </div>

        <div>
            <a href="{{ route('public.process') }}" 
               class="inline-flex items-center gap-3 px-6 py-3.5 rounded-2xl bg-purple-900/50 hover:bg-gradient-to-l hover:from-brand-orange hover:to-brand-amber hover:text-brand-dark text-brand-gold font-black text-xs border border-purple-600/40 hover:border-transparent transition shadow-xl group">
                <span>تعرف على منهجيتنا وفريق العمل بالتفصيل</span>
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @php
            $stages = [
                ['num' => '01', 'title' => 'مرحلة الاكتشاف والتحليل', 'desc' => 'فهم نشاطك التجاري، تحليل المنافسين وسلوك الجمهور المستهدف بدقة.', 'icon' => 'fa-solid fa-magnifying-glass-chart'],
                ['num' => '02', 'title' => 'بناء الاستراتيجية والخطة', 'desc' => 'رسم خطة المحتوى الشهرية وتحديد الرسائل التسويقية الفعالة.', 'icon' => 'fa-solid fa-map-location-dot'],
                ['num' => '03', 'title' => 'التحضير قبل الإنتاج', 'desc' => 'كتابة السكريبتات، تجهيز الـ Moodboard، ولوكيشنات التصوير.', 'icon' => 'fa-solid fa-pen-nib'],
                ['num' => '04', 'title' => 'التصوير والإنتاج السينمائي', 'desc' => 'تصوير 4K بأحدث الكاميرات والمعدات وطاقم الإضاءة المحترف.', 'icon' => 'fa-solid fa-video'],
                ['num' => '05', 'title' => 'المونتاج وما بعد الإنتاج', 'desc' => 'مونتاج ريلز سريع، هندسة صوتية، تصحيح ألوان ومؤثرات مبهرة.', 'icon' => 'fa-solid fa-film'],
                ['num' => '06', 'title' => 'الإطلاق والتوزيع الذكي', 'desc' => 'نشر المحتوى في الأوقات الذهبية على منصات التواصل الاجتماعي.', 'icon' => 'fa-solid fa-rocket'],
                ['num' => '07', 'title' => 'الإعلانات الممولة والحملات', 'desc' => 'إطلاق حملات استهداف دقيقة على Meta, TikTok, Google بحساب الـ ROAS.', 'icon' => 'fa-solid fa-bullhorn'],
                ['num' => '08', 'title' => 'التحليل والتحسين المستمر', 'desc' => 'تقارير أداء دورية وتطوير مستمر للحملات لمضاعفة المبيعات.', 'icon' => 'fa-solid fa-arrow-trend-up'],
            ];
        @endphp

        @foreach($stages as $st)
        <div class="glass-card-purple rounded-3xl p-7 relative group hover:-translate-y-2 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <span class="text-3xl font-black text-brand-gold/40 group-hover:text-brand-gold transition-colors font-mono">
                    {{ $st['num'] }}
                </span>
                <div class="w-10 h-10 rounded-xl bg-purple-900/50 border border-purple-600/40 text-brand-gold flex items-center justify-center text-sm group-hover:scale-110 group-hover:bg-amber-500/20 group-hover:border-amber-400 transition-all">
                    <i class="{{ $st['icon'] }}"></i>
                </div>
            </div>

            <h3 class="text-base font-black text-white group-hover:text-brand-gold transition-colors mb-2">
                {{ $st['title'] }}
            </h3>
            
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                {{ $st['desc'] }}
            </p>
        </div>
        @endforeach
    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 3 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-20 bg-gradient-to-b from-[#0A0216] via-[#140526] to-[#1A0733]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
</div>

<!-- 5. PORTFOLIO SHOWCASE SUMMARY (مع زر انتقال لمعرض الأعمال الكامل) -->
<section id="portfolio-summary" class="py-24 bg-gradient-to-b from-[#1A0733] via-[#1F0A3C] to-[#130527] relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6 reveal-on-scroll">
            <div class="space-y-3">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    سجل إنجازاتنا الفعلي الموثق
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">معرض أعمال بريق الحقيقي</h2>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl">نماذج حقيقية من تصميماتنا، أغلفة اليوتيوب عالية النقر، نتائج الحملات الإعلانية، وفيديوهات الإنتاج السينمائي.</p>
            </div>

            <!-- Link to dedicated portfolio page -->
            <div>
                <a href="{{ route('public.portfolio') }}" 
                   class="inline-flex items-center gap-3 px-6 py-3.5 rounded-2xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black text-xs shadow-xl shadow-amber-500/30 hover:brightness-110 transition group">
                    <span>تصفح معرض الأعمال الكامل وحالات النجاح</span>
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Featured Portfolio Cards Grid (Shows Top 6 items) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolioItems->take(6) as $item)
            <div class="glass-card-purple rounded-[2rem] overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-2xl flex flex-col justify-between">
                <div>
                    <div class="relative aspect-video bg-black/60 flex items-center justify-center overflow-hidden cursor-pointer"
                         @click="openMedia('{{ $item->video_url ? 'video' : 'image' }}', '{{ $item->video_url ?: asset($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}')">
                        
                        @if($item->thumbnail)
                        <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" 
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-[#140626] via-black/25 to-transparent z-10"></div>
                        
                        @if($item->video_url)
                        <div class="relative z-20 flex items-center justify-center">
                            <span class="absolute w-16 h-16 rounded-full bg-brand-amber/40 animate-radar"></span>
                            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-brand-orange to-brand-gold text-brand-dark flex items-center justify-center text-lg shadow-2xl group-hover:scale-115 transition-transform">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        @else
                        <div class="absolute bottom-3 left-3 z-20 w-9 h-9 rounded-xl bg-black/70 backdrop-blur text-white flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition duration-200">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                        @endif

                        <span class="absolute top-3 right-3 z-20 text-[10px] font-bold px-3 py-1 rounded-full bg-brand-dark/90 backdrop-blur-md text-brand-gold border border-purple-500/30">
                            {{ $item->category_arabic }}
                        </span>
                    </div>

                    <div class="p-6 space-y-3">
                        <h3 class="text-base font-black text-white group-hover:text-brand-gold transition-colors leading-snug">
                            {{ $item->title }}
                        </h3>

                        <div class="text-xs text-brand-amber font-bold flex items-center gap-1.5">
                            <i class="fa-solid fa-building text-[10px]"></i>
                            <span>{{ $item->client_name }}</span>
                            @if($item->client_country)
                            <span>• {{ $item->client_country }}</span>
                            @endif
                        </div>

                        @if($item->metrics)
                        <div class="p-2.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-brand-gold font-bold flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-brand-orange"></i>
                            <span>{{ $item->metrics }}</span>
                        </div>
                        @endif

                        <p class="text-xs text-gray-300 leading-relaxed pt-1 font-normal">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0">
                    <button type="button"
                            @click="openMedia('{{ $item->video_url ? 'video' : 'image' }}', '{{ $item->video_url ?: asset($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}')"
                            class="w-full py-2.5 rounded-xl bg-purple-900/40 hover:bg-gradient-to-l hover:from-brand-orange hover:to-brand-amber hover:text-brand-dark text-brand-gold font-bold text-xs border border-purple-600/40 hover:border-transparent transition flex items-center justify-center gap-2 shadow">
                        <i class="fa-solid {{ $item->video_url ? 'fa-play' : 'fa-expand' }}"></i>
                        <span>{{ $item->video_url ? 'تشغيل ومعاينة الفيديو' : 'معاينة بالحجم الكامل' }}</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-gray-400">
                <i class="fa-solid fa-sparkles text-3xl text-brand-gold mb-3"></i>
                <p class="text-sm">يتم تحديث قائمة الأعمال الإبداعية بصورة دورية...</p>
            </div>
            @endforelse
        </div>

        <!-- View All Portfolio CTA -->
        <div class="text-center pt-12">
            <a href="{{ route('public.portfolio') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-purple-900/60 hover:bg-brand-amber hover:text-brand-dark text-white font-black text-xs border border-purple-500/40 transition shadow-xl">
                <span>مشاهدة كافة أعمال الوكالة وحالات النجاح (Full Portfolio)</span>
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 4 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-20 bg-gradient-to-b from-[#130527] via-[#0E031E] to-[#070110]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-purple-500/40 to-transparent"></div>
</div>

<!-- 6. REAL CLIENTS & PARTNERS WALL -->
<section id="clients-summary" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            شركاء النجاح المعتمدون
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">علامات تجارية وضعت ثقتها في بريق</h2>
        <p class="text-xs sm:text-sm text-gray-300">من كبرى الشركات والمؤسسات الطبية والتعليمية والمطاعم في مصر والسعودية والوطن العربي</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        @php
            $clientLogos = [
                ['img' => 'client_77.webp', 'name' => 'Welfare Dairy', 'desc' => 'منتجات ألبان (مصر)'],
                ['img' => 'client_78.webp', 'name' => 'Shawrmaker', 'desc' => 'مطاعم (الأردن)'],
                ['img' => 'client_79.webp', 'name' => 'Majesty Health', 'desc' => 'مستشفى بالرياض'],
                ['img' => 'client_80.webp', 'name' => 'The Met Hub', 'desc' => 'مول تجاري مصري'],
                ['img' => 'client_81.webp', 'name' => 'Fox ATVs', 'desc' => 'سياحة مغامرة (عمان)'],
                ['img' => 'client_82.webp', 'name' => 'صيدليات رحيق', 'desc' => 'سلسلة صيدليات (ليبيا)'],
                ['img' => 'client_83.webp', 'name' => 'Crystal Auto', 'desc' => 'كماليات سيارات'],
                ['img' => 'client_84.webp', 'name' => '4Trend', 'desc' => 'دعاية وإعلان'],
                ['img' => 'client_85.webp', 'name' => 'Qatar University', 'desc' => 'جامعة قطرية'],
                ['img' => 'client_86.webp', 'name' => 'أكاديمية القائد', 'desc' => 'تأهيل عسكري'],
                ['img' => 'client_87.webp', 'name' => 'A One', 'desc' => 'مؤسسة تعليمية'],
                ['img' => 'client_88.webp', 'name' => 'بن الحسيني', 'desc' => 'مطاحن قهوة عريقة'],
            ];
        @endphp

        @foreach($clientLogos as $cl)
        <div class="glass-card-purple rounded-3xl p-5 hover:-translate-y-2 transition-all duration-300 flex flex-col items-center justify-center text-center group shadow-xl">
            <div class="w-16 h-16 rounded-2xl bg-[#110322]/80 border border-purple-700/40 flex items-center justify-center p-2.5 mb-3 group-hover:scale-110 group-hover:border-amber-400/50 transition-all">
                <img src="{{ asset('images/clients/' . $cl['img']) }}" alt="{{ $cl['name'] }}" class="max-w-full max-h-full object-contain filter brightness-95 group-hover:brightness-110">
            </div>
            <span class="text-xs font-black text-white group-hover:text-brand-gold transition leading-snug">{{ $cl['name'] }}</span>
            <span class="text-[10px] text-gray-400 mt-1 font-medium">{{ $cl['desc'] }}</span>
        </div>
        @endforeach
    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 5 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-20 bg-gradient-to-b from-[#070110] via-[#120424] to-[#180730]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
</div>

<!-- 7. CLIENT TESTIMONIALS & REVIEWS -->
<section id="testimonials-summary" class="py-24 bg-gradient-to-b from-[#180730] via-[#1E093C] to-[#140528] relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
            <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                قصص نجاح نعتز بها
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white">ماذا يقول عملاؤنا عن العمل معنا؟</h2>
            <p class="text-xs sm:text-sm text-gray-300">شهادات موثقة من أصحاب الشركات والمؤسسات التي ساهمنا في نمو علاماتهم التجارية</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            <div class="glass-card-purple rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-2xl space-y-5 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center gap-1.5 text-brand-gold text-sm">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed italic">
                        "فريق بريق تولى إدارة الحملات الإعلانية وتصوير الفيديوهات الطبية للمجمع بالرياض. النتيجة كانت تضاعف حجوزات العيادات بنسبة تجاوزت 180% في أول شهرين."
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-purple-800/40">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-orange to-brand-gold text-brand-dark font-black flex items-center justify-center text-base shadow-lg group-hover:scale-105 transition-transform">
                        ع
                    </div>
                    <div>
                        <div class="text-xs font-black text-white">د. عبد الرحمن المجيدي</div>
                        <div class="text-[11px] text-brand-amber font-bold">مجمع ماجستي الطبي (الرياض، السعودية)</div>
                    </div>
                </div>
            </div>

            <div class="glass-card-purple rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-2xl space-y-5 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center gap-1.5 text-brand-gold text-sm">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed italic">
                        "جودة تصوير الريلز والمونتاج السينمائي أحدثت ضجة كبيرة على تيك توك وانستجرام. الفيديوهات حققت ملايين المشاهدات وجلبت لنا طوابير زبائن في فرعنا الجديد."
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-purple-800/40">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 text-white font-black flex items-center justify-center text-base shadow-lg group-hover:scale-105 transition-transform">
                        ح
                    </div>
                    <div>
                        <div class="text-xs font-black text-white">أ. حسام الدين غانم</div>
                        <div class="text-[11px] text-brand-amber font-bold">مؤسس Shawrmaker (عَمّان، الأردن)</div>
                    </div>
                </div>
            </div>

            <div class="glass-card-purple rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-2xl space-y-5 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="flex items-center gap-1.5 text-brand-gold text-sm">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed italic">
                        "الاحترافية في التزام مواعيد التسليم وتصميم الهوية الإعلانية جعلت بريق شريكنا الدائم لكافة علاماتنا التجارية. أنصح بهم بشدة لكل صاحب مشروع يريد نمواً حقيقياً."
                    </p>
                </div>
                <div class="flex items-center gap-3.5 pt-5 border-t border-purple-800/40">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-yellow-500 text-brand-dark font-black flex items-center justify-center text-base shadow-lg group-hover:scale-105 transition-transform">
                        س
                    </div>
                    <div>
                        <div class="text-xs font-black text-white">م. سيف النمر</div>
                        <div class="text-[11px] text-brand-amber font-bold">مدير تسويق شركة ألبان (القاهرة، مصر)</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SECTION COLOR GRADIENT TRANSITION 6 -->
<div class="relative w-full overflow-hidden leading-none z-10">
    <div class="h-20 bg-gradient-to-b from-[#140528] via-[#0E031E] to-[#19062F]"></div>
    <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
</div>

<!-- 8. CONSULTATION & CONTACT FORM (نموذج الاستشارة المباشر في الصفحة الرئيسية) -->
<section id="contact-summary" class="py-24 bg-gradient-to-b from-[#19062F] via-[#21093E] to-[#0A0216] relative z-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card-purple rounded-[2rem] p-8 sm:p-14 shadow-2xl relative overflow-hidden border border-purple-500/40">
            
            <div class="text-center max-w-xl mx-auto mb-10 space-y-3 relative z-10">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    ابدأ قصة نجاح علامتك اليوم
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white">احصل على استشارة تسويقية وعرض سعر فوري</h2>
                <p class="text-xs sm:text-sm text-gray-300">أخبرنا بما تحتاجه وسيتواصل معك مستشار وكالة بريق لمناقشة خطة العمل المخصصة لمشروعك.</p>
            </div>

            <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-5 text-xs relative z-10">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">اسمك الكريم <span class="text-brand-orange">*</span></label>
                        <input type="text" name="name" required placeholder="محمد أحمد" 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-2">اسم البراند أو النشاط التجاري</label>
                        <input type="text" name="brand_name" placeholder="اسم علامتك التجارية" 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">رقم الهاتف أو الواتساب <span class="text-brand-orange">*</span></label>
                        <input type="text" name="phone" required placeholder="+2010... أو +966..." 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="example@brand.com" 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">الخدمة التي تهمك أكثر</label>
                        <select name="service_interested" 
                                class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition">
                            <option value="تصوير ومونتاج فيديو ريلز 4K">تصوير ومونتاج فيديو ريلز وسينما 4K</option>
                            <option value="إعلانات ممولة وميديا باينج">إعلانات ممولة وميديا باينج (Meta, TikTok)</option>
                            <option value="تصميمات جرافيك وبناء هوية بصرية">تصميمات جرافيك وبناء هوية بصرية</option>
                            <option value="إدارة كاملة لحسابات السوشيال ميديا">إدارة كاملة لحسابات السوشيال ميديا</option>
                            <option value="استشارة وبناء خطة تسويقية كاملة">استشارة وبناء خطة تسويقية كاملة</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-2">الميزانية المتوقعة للمشروع</label>
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
                    <label class="block font-bold text-gray-300 mb-2">أخبرنا بنبذة عن أهدافك ورؤيتك</label>
                    <textarea name="message" rows="3" placeholder="اكتب لنا ملخصاً سريعاً عما تود تحقيقه لعلامتك التجارية..." 
                              class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-gold rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-gold transition"></textarea>
                </div>

                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-gradient-to-l from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 shadow-2xl shadow-amber-500/30 transition flex items-center justify-center gap-2.5 active:scale-95">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>إرسال طلب الاستشارة التسويقية الفورية</span>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-purple-800/40 text-center">
                <a href="{{ route('public.contact') }}" class="text-xs text-brand-gold hover:text-white transition font-bold inline-flex items-center gap-1.5">
                    <span>أو تفضل بزيارة صفحة التواصل الكاملة وقنوات الاتصال المباشرة</span>
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                </a>
            </div>

        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    function pariqStatsCounter() {
        return {
            started: false,
            projects: 0,
            clients: 0,
            years: 0,
            team: 0,
            targets: {
                projects: 480,
                clients: 125,
                years: 6,
                team: 18
            },
            initObserver(el) {
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        if (entries[0].isIntersecting) {
                            this.startCount();
                            observer.disconnect();
                        }
                    }, { threshold: 0.15 });
                    observer.observe(el);
                } else {
                    this.startCount();
                }
            },
            startCount() {
                if (this.started) return;
                this.started = true;
                const duration = 2200;
                const steps = 60;
                const stepTime = duration / steps;
                let step = 0;

                const timer = setInterval(() => {
                    step++;
                    const progress = step / steps;
                    const ease = 1 - Math.pow(1 - progress, 3);

                    this.projects = Math.floor(ease * this.targets.projects);
                    this.clients = Math.floor(ease * this.targets.clients);
                    this.years = Math.floor(ease * this.targets.years);
                    this.team = Math.floor(ease * this.targets.team);

                    if (step >= steps) {
                        this.projects = this.targets.projects;
                        this.clients = this.targets.clients;
                        this.years = this.targets.years;
                        this.team = this.targets.team;
                        clearInterval(timer);
                    }
                }, stepTime);
            }
        }
    }
</script>
@endpush
