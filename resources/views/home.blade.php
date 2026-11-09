@extends('layouts.public')

@section('title', 'وكالة بريق للإعلام والتصميم | بريق مفتاح نجاحك في التسويق')
@section('meta_description', 'وكالة بريق: نصنع لعلامتك التجارية بريقاً استثنائياً في العالم الرقمي. حلول تسويق إلكتروني، تصوير سينمائي 4K ومونتاج ريلز، تصميم هويات بصرية، وإعلانات ممولة.')

@section('content')

<!-- =========================================================================
     1. HERO SECTION (مع ستايل متحرك في الخلفية وبدون الأيقونات الطافية)
     ========================================================================= -->
<section id="hero" class="relative min-h-[92vh] flex items-center justify-center pt-28 pb-16 lg:pt-36 lg:pb-24 px-4 sm:px-6 lg:px-8 overflow-hidden z-10">
    
    <!-- Animated Interactive Ambient Mesh / Particle Canvas in Background (GoMedia Style) -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <canvas id="hero-particle-canvas" class="w-full h-full opacity-60"></canvas>
        <div class="absolute inset-0 bg-radial-gradient from-transparent via-[#08020F]/60 to-[#06010D]"></div>
        
        <!-- Ambient Glowing Rings -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full border border-amber-500/10 animate-pulse-glow pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[950px] h-[950px] rounded-full border border-purple-500/10 pointer-events-none"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10 w-full">
        
        @if(session('success_inquiry'))
        <div class="p-4 mb-6 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm flex items-center justify-between shadow-2xl backdrop-blur-md">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-400 text-xl"></i>
                <span class="font-bold">{{ session('success_inquiry') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white transition"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Right Column: Slogan, Headline & CTAs (RTL Start) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-right">
                
                <!-- Slogan Pill with Radiant Brand Colors (بريق مفتاح نجاحك في التسويق) -->
                <div class="inline-flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2 sm:py-2.5 rounded-full bg-[#18082B]/90 border border-brand-orange/40 text-white text-[11px] sm:text-sm font-extrabold shadow-[0_0_25px_rgba(255,148,32,0.3)] animate-pulse-glow max-w-full">
                    <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-brand-orange animate-ping shrink-0"></span>
                    <span class="text-brand-orange text-xs sm:text-base">✦</span>
                    <span class="tracking-wide">بريق ، مفتاح نجاحك في التسويق</span>
                    <span class="text-brand-orange text-xs sm:text-base">✦</span>
                </div>

                <!-- Main Headline (مع حل مشكلة قطع كلمة التسويق من الأسفل نهائياً) -->
                <div class="space-y-3 sm:space-y-4">
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-normal tracking-tight">
                        بريق مفتاح نجاحك 
                        <span class="gold-gradient-text block mt-1 sm:mt-2 text-4xl sm:text-6xl lg:text-7xl xl:text-8xl leading-normal pb-3 overflow-visible">في التسويق</span>
                    </h1>

                    <!-- Subtitle under slogan in smaller font as requested -->
                    <p class="text-base sm:text-xl lg:text-2xl text-gray-200 font-bold max-w-2xl leading-relaxed pt-1">
                        نصنع لعلامتك التجارية بريقاً استثنائياً في العالم الرقمي
                    </p>
                    <p class="text-xs sm:text-sm text-gray-400 max-w-xl leading-relaxed font-normal">
                        منظومة إبداعية متكاملة تجمع بين التصوير السينمائي، المونتاج فائق الجاذبية، وتصميم الهويات البصرية، وإدارة الحملات الإعلانية القائمة على أعلى عائد استثماري.
                    </p>
                </div>

                <!-- Hero Action Buttons & Scroll Indicator -->
                <!-- Actions & Scroll Indicator (اسحب للأسفل بجانب مشاهدة أعمالنا في نفس السطر) -->
                <div class="pt-2">
                    <div class="flex flex-wrap items-center lg:justify-start justify-center gap-3 sm:gap-4 w-full">
                        <!-- زر تواصل معنا -->
                        <a href="{{ route('public.contact') }}" 
                           class="w-full sm:w-auto px-7 sm:px-8 py-3.5 sm:py-4 rounded-2xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs sm:text-sm hover:brightness-110 active:scale-95 transition shadow-2xl shadow-orange-500/30 flex items-center justify-center gap-2.5 group">
                            <span>تواصل معنا الآن</span>
                            <i class="fa-solid fa-paper-plane text-xs group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </a>

                        <!-- زر مشاهدة أعمالنا -->
                        <a href="{{ route('public.portfolio') }}" 
                           class="w-full sm:w-auto px-7 sm:px-8 py-3.5 sm:py-4 rounded-2xl bg-[#19092E]/80 hover:bg-[#250C44] border-2 border-brand-orange/50 hover:border-brand-orange text-white font-bold text-xs sm:text-sm transition shadow-lg flex items-center justify-center gap-2 backdrop-blur-md group">
                            <span class="w-6 h-6 rounded-full bg-brand-orange/20 text-brand-orange flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play text-[10px]"></i>
                            </span>
                            <span>مشاهدة أعمالنا</span>
                        </a>

                        <!-- اسحب للأسفل بجانب زر مشاهدة أعمالنا -->
                        <a href="#stats-summary" class="inline-flex items-center gap-2 px-3 py-2 text-xs text-gray-400 hover:text-brand-orange transition group shrink-0">
                            <div class="w-5 h-8 rounded-full border-2 border-gray-400 group-hover:border-brand-orange flex items-start justify-center p-1 transition-colors">
                                <span class="w-1.5 h-2 rounded-full bg-brand-orange animate-bounce"></span>
                            </div>
                            <span class="font-bold tracking-wider text-[11px] whitespace-nowrap">اسحب للأسفل</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Left Column: Official Animated Video in 3D Sculpted Lightning Bolt (فيديو بريق في مجسم البرق المضيء) -->
            <div class="lg:col-span-5 flex justify-center items-center relative py-4 lg:py-0">
                
                <!-- SVG Definition for Cross-Browser Lightning ClipPath -->
                <svg class="absolute w-0 h-0" aria-hidden="true" focusable="false">
                    <defs>
                        <clipPath id="pariq-lightning-clip" clipPathUnits="objectBoundingBox">
                            <polygon points="0.38,0 0.82,0 0.56,0.38 0.90,0.38 0.20,1 0.42,0.52 0.12,0.52" />
                        </clipPath>
                    </defs>
                </svg>

                <div class="relative w-64 sm:w-72 lg:w-80 h-80 sm:h-96 lg:h-[420px] flex items-center justify-center group"
                     x-data="{ isMuted: true }">
                    
                    <!-- 1. Ambient Background Lightning Glow -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand-orange/35 via-amber-500/20 to-purple-600/20 blur-3xl animate-pulse-glow pointer-events-none"></div>

                    <!-- 2. Outer Sculpted 3D Metallic Golden Lightning Frame -->
                    <div class="relative w-full h-full p-1.5 transition-transform duration-500 group-hover:scale-105"
                         style="filter: drop-shadow(0 0 25px rgba(255, 148, 32, 0.75)) drop-shadow(0 15px 35px rgba(0,0,0,0.9));">
                        
                        <!-- Golden Beveled Lightning Rim -->
                        <div class="w-full h-full p-1 bg-gradient-to-b from-[#FFA726] via-[#FF7A00] to-[#BC6200]"
                             style="clip-path: url(#pariq-lightning-clip); -webkit-clip-path: polygon(38% 0%, 82% 0%, 56% 38%, 90% 38%, 20% 100%, 42% 52%, 12% 52%);">
                            
                            <!-- Inner Lightning Core with Video -->
                            <div class="w-full h-full bg-[#08020F] relative overflow-hidden flex items-center justify-center"
                                 style="clip-path: url(#pariq-lightning-clip); -webkit-clip-path: polygon(38% 0%, 82% 0%, 56% 38%, 90% 38%, 20% 100%, 42% 52%, 12% 52%);">
                                
                                <video id="hero-lightning-video" 
                                       playsinline 
                                       preload="auto"
                                       autoplay
                                       muted
                                       loop
                                       poster="{{ asset('videos/bariq-poster.jpg') }}"
                                       class="w-full h-full object-cover scale-110 pointer-events-auto cursor-pointer"
                                       @click="
                                           $el.muted = !$el.muted;
                                           isMuted = $el.muted;
                                       ">
                                    <source src="{{ asset('videos/bariq.mp4') }}" type="video/mp4">
                                    <source src="{{ asset('videos/bariq.webm') }}" type="video/webm">
                                </video>

                            </div>

                        </div>

                    </div>

                    <!-- Sound Toggle Floating Badge -->
                    <button type="button" 
                            @click="
                                const v = document.getElementById('hero-lightning-video');
                                v.muted = !v.muted;
                                isMuted = v.muted;
                            "
                            class="absolute -bottom-4 mx-auto px-3.5 py-1.5 rounded-full bg-[#18082B]/95 hover:bg-brand-orange hover:text-brand-dark text-white text-[10px] font-black border border-brand-orange/60 transition flex items-center gap-1.5 shadow-2xl backdrop-blur-md z-30">
                        <i class="fa-solid" :class="isMuted ? 'fa-volume-xmark text-amber-400' : 'fa-volume-high text-emerald-400'"></i>
                        <span x-text="isMuted ? 'تشغيل الصوت' : 'كتم الصوت'"></span>
                    </button>

                </div>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     2. LIVE ANIMATED STATS COUNTER BAR (احصائيات زي مهي موجودة)
     ========================================================================= -->
<section id="stats-summary" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div x-data="pariqStatsCounter()" 
         x-init="initObserver($el)"
         class="space-y-6">
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-6">
            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1 text-center border border-purple-800/40">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-orange-500/15 border border-brand-orange/30 text-brand-orange flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-brand-orange flex items-center justify-center font-mono">
                    <span>+</span><span x-text="projects">0</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-300 mt-1 font-bold">مشروع مكتمل بنجاح</div>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1 text-center border border-purple-800/40">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-purple-500/20 border border-purple-500/40 text-purple-300 flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                    <span>+</span><span x-text="clients">0</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-300 mt-1 font-bold">عميل سعيد في 6 دول</div>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1 text-center border border-purple-800/40">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-amber-500/15 border border-brand-peach/30 text-brand-peach flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-brand-peach flex items-center justify-center font-mono">
                    <span>+</span><span x-text="years">0</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-300 mt-1 font-bold">سنوات خبرة متواصلة</div>
            </div>

            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1 text-center border border-purple-800/40">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-orange-500/15 border border-orange-500/30 text-orange-400 flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                    <span>+</span><span x-text="team">0</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-300 mt-1 font-bold">مبدع وخبير متخصص</div>
            </div>
        </div>

    </div>
</section>

<!-- =========================================================================
     4. SUCCESS PARTNERS DUAL REVERSE MARQUEE (لوجوهات شركاء النجاح بحركة عكسية)
     (سكشن فاتح أنيق مثل جو ميديا وإيسنس مع دوران وتلوين عند الوقوف)
     ========================================================================= -->
<section class="py-20 bg-gradient-to-b from-[#F8FAFC] via-white to-[#F1F5F9] text-slate-800 relative z-10 overflow-hidden border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center space-y-3">
        <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-orange-100 border border-orange-200">
            شركاء النجاح المعتمدون
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-slate-900">
            علامات تجارية كبرى وضعت ثقتها في بريق
        </h2>
        <p class="text-xs sm:text-sm text-slate-600 max-w-2xl mx-auto">
            نتشرف بالعمل مع رواد الأعمال وكبرى الشركات والمؤسسات الطبية والتعليمية في مصر والسعودية والوطن العربي
        </p>
    </div>

    <!-- Dual Reverse Marquee Tracks -->
    <div class="space-y-6 overflow-hidden py-4">
        
        <!-- Row 1: Moves Left to Right -->
        <div class="marquee-reverse-track flex items-center gap-6 whitespace-nowrap select-none">
            @php
                $partnersRow1 = [
                    ['name' => 'Mercedes-Benz', 'icon' => 'fa-brands fa-monero', 'type' => 'سيارات فاخرة'],
                    ['name' => 'فوري Fawry', 'icon' => 'fa-solid fa-credit-card', 'type' => 'مدفوعات رقمية'],
                    ['name' => 'ASUS ROG', 'icon' => 'fa-solid fa-laptop-code', 'type' => 'تقنية وأجهزة'],
                    ['name' => 'بلتون Beltone', 'icon' => 'fa-solid fa-chart-line', 'type' => 'استثمار ومالية'],
                    ['name' => 'داماك DAMAC', 'icon' => 'fa-solid fa-city', 'type' => 'تطوير عقاري'],
                    ['name' => 'بنده Panda', 'icon' => 'fa-solid fa-basket-shopping', 'type' => 'تجزئة وسوبرماركت'],
                    ['name' => 'سيمنز Siemens', 'icon' => 'fa-solid fa-bolt', 'type' => 'هندسة وتكنولوجيا'],
                    ['name' => 'GSK Global', 'icon' => 'fa-solid fa-capsules', 'type' => 'أدوية وصحة'],
                    ['name' => 'باتشي Patchi', 'icon' => 'fa-solid fa-gift', 'type' => 'شوكولاتة وهدايا'],
                ];
            @endphp

            @for($i = 0; $i < 2; $i++)
                @foreach($partnersRow1 as $p)
                <div class="partner-card inline-flex items-center gap-3.5 px-6 py-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-brand-orange transition-all duration-300 cursor-pointer transform hover:-translate-y-2 hover:rotate-2">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center text-brand-orange text-lg group-hover:scale-110 transition-transform">
                        <i class="{{ $p['icon'] }}"></i>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-slate-800 partner-name transition-colors">{{ $p['name'] }}</div>
                        <div class="text-[10px] text-slate-500 font-medium">{{ $p['type'] }}</div>
                    </div>
                </div>
                @endforeach
            @endfor
        </div>

        <!-- Row 2: Moves Right to Left (Opposite Direction) -->
        <div class="marquee-track flex items-center gap-6 whitespace-nowrap select-none">
            @php
                $partnersRow2 = [
                    ['name' => 'Welfare Dairy', 'img' => 'client_77.webp', 'type' => 'ألبان وتغذية'],
                    ['name' => 'Shawrmaker Jordan', 'img' => 'client_78.webp', 'type' => 'سلسلة مطاعم'],
                    ['name' => 'مجمع ماجستي الطبي', 'img' => 'client_79.webp', 'type' => 'رعاية صحية'],
                    ['name' => 'The Met Hub', 'img' => 'client_80.webp', 'type' => 'مجمعات تجارية'],
                    ['name' => 'Fox ATVs Oman', 'img' => 'client_81.webp', 'type' => 'سياحة وترفيه'],
                    ['name' => 'صيدليات رحيق', 'img' => 'client_82.webp', 'type' => 'صيدليات ودواء'],
                    ['name' => 'Crystal Auto', 'img' => 'client_83.webp', 'type' => 'خدمات سيارات'],
                    ['name' => 'جامعة قطر', 'img' => 'client_85.webp', 'type' => 'تعليم عالي'],
                    ['name' => 'مطاحن بن الحسيني', 'img' => 'client_88.webp', 'type' => 'أغذية وقهوة'],
                ];
            @endphp

            @for($i = 0; $i < 2; $i++)
                @foreach($partnersRow2 as $p)
                <div class="partner-card inline-flex items-center gap-3.5 px-6 py-4 rounded-2xl bg-white border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-brand-orange transition-all duration-300 cursor-pointer transform hover:-translate-y-2 hover:-rotate-2">
                    <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1.5 overflow-hidden">
                        <img src="{{ asset('images/clients/' . $p['img']) }}" alt="{{ $p['name'] }}" class="max-w-full max-h-full object-contain filter grayscale group-hover:grayscale-0 transition-all">
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-slate-800 partner-name transition-colors">{{ $p['name'] }}</div>
                        <div class="text-[10px] text-slate-500 font-medium">{{ $p['type'] }}</div>
                    </div>
                </div>
                @endforeach
            @endfor
        </div>

    </div>
</section>

<!-- =========================================================================
     5. 10 SERVICES 3D COVERFLOW CAROUSEL (شكل تقليب دائري ثلاثي الأبعاد زي essenceadvertising.com)
     ========================================================================= -->
<section id="services-summary" class="py-24 bg-gradient-to-b from-[#08020F] via-[#140626] to-[#0A0216] relative z-10 overflow-hidden"
         x-data="{ 
             activeIdx: 0, 
             services: [
                 { id: 1, slug: 'video-shooting', title: 'تصوير الفيديو السينمائي', category: 'إنتاج سينمائي 4K', icon: 'fa-solid fa-video', desc: 'تصوير فيديوهات دعائية، بروموهات، كواليس، أو محتوى مخصص للسوشيال ميديا، بأسلوب عصري وجودة عالية تعبر عن هويتك.', img: '{{ asset('images/portfolio/social_4.webp') }}' },
                 { id: 2, slug: 'video-editing', title: 'مونتاج الفيديو السريع', category: 'ريلز وبرومو فائق الجاذبية', icon: 'fa-solid fa-film', desc: 'نستخدم أحدث برامج المونتاج لنقدم فيديوهات عصرية عالية الجودة، بتأثيرات بصرية وصوتية احترافية، وتلوين دقيق، مما يضمن إخراجاً جذاباً يحقق أهدافك ويوصل رسالتك بوضوح.', img: '{{ asset('images/portfolio/social_2.webp') }}' },
                 { id: 3, slug: 'social-media', title: 'إدارة وسائل التواصل الاجتماعي', category: 'نمو وتفاعل رقمي', icon: 'fa-solid fa-share-nodes', desc: 'نُدير حساباتك على مختلف المنصات من خلال إنشاء محتوى جذاب، وتصميم منشورات احترافية، والتفاعل مع الجمهور، إلى جانب دراسة أفضل أوقات النشر لتحقيق أقصى وصول وتفاعل.', img: '{{ asset('images/portfolio/social_1.webp') }}' },
                 { id: 4, slug: 'paid-ads', title: 'الإعلانات الممولة', category: 'حملات بأعلى عائد ROAS', icon: 'fa-solid fa-chart-line', desc: 'نصمم ونُدير حملات إعلانية احترافية تستهدف جمهورك بدقة عبر المنصات الرقمية المختلفة، لزيادة الانتشار وتحقيق أهدافك التسويقية.', img: '{{ asset('images/portfolio/ad_result_69.webp') }}' },
                 { id: 5, slug: 'photography', title: 'جلسات التصوير الفوتوغرافي', category: 'منتجات وأماكن وفعاليات', icon: 'fa-solid fa-camera', desc: 'جلسات تصوير احترافية للمنتجات، الأماكن، الفعاليات، أو فريق العمل، باستخدام أحدث المعدات لإبراز كل التفاصيل بأعلى دقة.', img: '{{ asset('images/portfolio/free_delivery.webp') }}' },
                 { id: 6, slug: 'graphic-design', title: 'تصميم الجرافيك الإبداعي', category: 'أغلفة وسوشيال ميديا', icon: 'fa-solid fa-bezier-curve', desc: 'إبداع في التصميم البصري يعكس هوية علامتك التجارية ويجذب انتباه جمهورك المستهدف.', img: '{{ asset('images/portfolio/ramez_qlight.webp') }}' },
                 { id: 7, slug: 'branding', title: 'الهوية البصرية والبراندينج', category: 'بناء العلامات التجارية', icon: 'fa-solid fa-palette', desc: 'نساعدك على بناء هوية قوية لعلامتك التجارية من الألف إلى الياء، تعزز وجودك في السوق وتزيد من ثقة العملاء.', img: '{{ asset('images/portfolio/logo_1.webp') }}' },
                 { id: 8, slug: 'marketing-strategy', title: 'إعداد الخطط والاستراتيجيات', category: 'تحليل ودراسة سوق شاملة', icon: 'fa-solid fa-lightbulb', desc: 'نضع خطط تسويقية شاملة ومخصصة تناسب أهدافك، مدعومة بتحليل السوق والمنافسين.', img: '{{ asset('images/portfolio/ad_result_70.webp') }}' },
                 { id: 9, slug: 'data-analysis', title: 'تحليل البيانات والتقارير', category: 'قياس دقيق للأداء والنتائج', icon: 'fa-solid fa-chart-pie', desc: 'نقيس الأداء، ونحلل النتائج بدقة، ونقدم لك تقارير واضحة تساعدك في اتخاذ قرارات مدروسة.', img: '{{ asset('images/portfolio/ad_result_72.webp') }}' },
                 { id: 10, slug: 'content-writing', title: 'صناعة وكتابة المحتوى', category: 'سيناريوهات ونصوص تسويقية', icon: 'fa-solid fa-pen-nib', desc: 'نكتب محتوى مبتكر بأسلوب احترافي بعيداً عن التكرار، لكي نجذب الجمهور من أول جملة وتصل رسالتك بأسرع شكل وبأسلوب سلس.', img: '{{ asset('images/portfolio/social_3.webp') }}' }
             ],
             next() { this.activeIdx = (this.activeIdx + 1) % this.services.length; },
             prev() { this.activeIdx = (this.activeIdx - 1 + this.services.length) % this.services.length; },
             getCardStyle(idx) {
                 const total = this.services.length;
                 let diff = idx - this.activeIdx;
                 if (diff > total / 2) diff -= total;
                 if (diff < -total / 2) diff += total;
                 const absDiff = Math.abs(diff);
                 if (absDiff > 2) return 'display: none;';
                 const translateX = diff * (window.innerWidth < 640 ? 230 : (window.innerWidth < 1024 ? 280 : 330));
                 const scale = 1 - (absDiff * 0.14);
                 const rotateY = diff * -18;
                 const zIndex = 30 - (absDiff * 10);
                 const opacity = 1 - (absDiff * 0.35);
                 return `transform: translateX(${translateX}px) scale(${scale}) perspective(1000px) rotateY(${rotateY}deg); z-index: ${zIndex}; opacity: ${opacity};`;
             }
         }">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Header with Title and "عرض جميع الخدمات" Button -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="space-y-3">
                <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
                    حلول إبداعية متكاملة
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">
                    خدماتنا التسويقية والإبداعية (10 خدمات)
                </h2>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl">
                    نقدم مجموعة واسعة من الخدمات الإبداعية والتسويقية التي تساعد علامتك على الظهور، النمو، وبناء حضور قوي في السوق.
                </p>
            </div>
            
            <!-- زر عرض جميع الخدمات ينقل علي صفحة خدماتنا -->
            <div>
                <a href="{{ route('public.services') }}" 
                   class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs transition shadow-xl shadow-orange-500/20 hover:brightness-110 group">
                    <span>عرض جميع الخدمات</span>
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- 3D Coverflow Horizontal Carousel Container (essenceadvertising.com style) -->
        <div class="relative py-6">
            
            <!-- Carousel Track -->
            <div class="relative h-[430px] sm:h-[470px] w-full flex items-center justify-center overflow-hidden">
                <template x-for="(srv, idx) in services" :key="srv.id">
                    <div @click="activeIdx = idx"
                         :style="getCardStyle(idx)"
                         :class="activeIdx === idx ? 'border-2 border-brand-orange shadow-[0_0_50px_rgba(255,148,32,0.35)]' : 'border border-purple-800/50 hover:border-brand-orange/60'"
                         class="absolute w-[270px] sm:w-[320px] md:w-[360px] h-[390px] sm:h-[430px] rounded-3xl overflow-hidden cursor-pointer transition-all duration-500 ease-out shadow-2xl group flex flex-col justify-between select-none bg-[#110423]">
                         
                         <!-- Full Background Card Image with Gradient Overlay -->
                         <img :src="srv.img" :alt="srv.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-108">
                         <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                         
                         <!-- Top Category & Number Pill -->
                         <div class="relative z-10 p-5 flex items-center justify-between">
                             <span class="px-3 py-1 rounded-full bg-black/75 backdrop-blur-md border border-brand-orange/40 text-[11px] font-black text-brand-orange font-mono"
                                   x-text="'0' + srv.id"></span>
                             <div class="w-9 h-9 rounded-2xl bg-brand-orange text-brand-dark flex items-center justify-center text-xs shadow-lg">
                                 <i :class="srv.icon"></i>
                             </div>
                         </div>
                         
                         <!-- Bottom Content: Category, Title, Description, and Link Button -->
                         <div class="relative z-10 p-5 sm:p-6 space-y-2 text-right">
                             <div class="text-[10px] sm:text-[11px] font-bold text-brand-peach uppercase tracking-wider" x-text="srv.category"></div>
                             <h3 class="text-base sm:text-xl font-black text-white group-hover:text-brand-orange transition-colors" x-text="srv.title"></h3>
                             <p class="text-[11px] sm:text-xs text-gray-300 line-clamp-2 leading-relaxed" x-text="srv.desc"></p>
                             
                             <div class="pt-2">
                                 <a :href="'{{ route('public.services') }}#' + srv.slug" 
                                    @click.stop
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-orange hover:bg-brand-orangeHover text-brand-dark font-black text-[11px] transition shadow-lg active:scale-95">
                                     <span>عرض تفاصيل هذه الخدمة</span>
                                     <i class="fa-solid fa-arrow-left text-[9px]"></i>
                                 </a>
                             </div>
                         </div>
                         
                    </div>
                </template>
            </div>

            <!-- Bottom Navigation Controls: Arrows + Progress Bar (01 --------- 10) -->
            <div class="flex items-center justify-center gap-5 sm:gap-7 mt-8">
                <!-- Prev Button -->
                <button type="button" @click="prev()" 
                        aria-label="الخدمة السابقة"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#150626] border border-purple-800/60 hover:border-brand-orange hover:bg-brand-orange hover:text-brand-dark text-white flex items-center justify-center transition shadow-lg active:scale-95">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

                <!-- 01 ---- Progress Track ---- 10 -->
                <div class="flex items-center gap-3 w-48 sm:w-72">
                    <span class="font-mono text-xs sm:text-sm font-black text-brand-orange" x-text="(activeIdx + 1 < 10 ? '0' : '') + (activeIdx + 1)">01</span>
                    <div class="flex-grow h-1.5 bg-purple-950 rounded-full overflow-hidden relative border border-purple-800/40">
                        <div class="h-full bg-gradient-to-r from-brand-orange to-brand-peach transition-all duration-300 rounded-full"
                             :style="'width: ' + (((activeIdx + 1) / services.length) * 100) + '%'"></div>
                    </div>
                    <span class="font-mono text-xs sm:text-sm font-bold text-gray-400">10</span>
                </div>

                <!-- Next Button -->
                <button type="button" @click="next()" 
                        aria-label="الخدمة التالية"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#150626] border border-purple-800/60 hover:border-brand-orange hover:bg-brand-orange hover:text-brand-dark text-white flex items-center justify-center transition shadow-lg active:scale-95">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     6. COMPACT WORKS RIBBON / SLIDER (معرض الأعمال في شكل مبسط مش واخد حيز كبير)
     (بطاقات متحركة في شكل شريطي وعند الضغط تفتح عرض العمل نفسه - edigitaal)
     ========================================================================= -->
<section id="portfolio-summary" class="py-20 bg-[#090212] relative z-10 border-y border-purple-900/40 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="space-y-2">
            <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
                نماذج من أعمالنا
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-white">أعمالنا وسجل إنجازاتنا الموثق</h2>
            <p class="text-xs text-gray-300">بطاقات تفاعلية لأبرز إنتاجاتنا: انقر على أي بطاقة لتشغيل العمل فوراً</p>
        </div>

        <a href="{{ route('public.portfolio') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-purple-900/50 hover:bg-brand-orange hover:text-brand-dark text-brand-peach font-black text-xs border border-purple-700/40 hover:border-transparent transition shadow">
            <span>تصفح كامل المعرض الموثق</span>
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
        </a>
    </div>

    <!-- Continuous Auto-Scrolling Ribbon with Mouse/Touch Grab & Speed Dragging (edigitaal style) -->
    <div x-data="{
             isDown: false,
             startX: 0,
             scrollLeft: 0,
             isPaused: false,
             speed: 1.2,
             initTicker() {
                 const el = this.$refs.slider;
                 if (!el) return;
                 const run = () => {
                     if (!this.isDown && !this.isPaused) {
                         el.scrollLeft += this.speed;
                         if (el.scrollLeft >= (el.scrollWidth / 2)) {
                             el.scrollLeft = 0;
                         }
                     }
                     requestAnimationFrame(run);
                 };
                 requestAnimationFrame(run);
             },
             startDrag(e) {
                 this.isDown = true;
                 this.startX = e.pageX - this.$refs.slider.offsetLeft;
                 this.scrollLeft = this.$refs.slider.scrollLeft;
             },
             stopDrag() {
                 this.isDown = false;
             },
             drag(e) {
                 if (!this.isDown) return;
                 e.preventDefault();
                 const x = e.pageX - this.$refs.slider.offsetLeft;
                 const walk = (x - this.startX) * 2.2;
                 this.$refs.slider.scrollLeft = this.scrollLeft - walk;
             },
             startTouch(e) {
                 this.isDown = true;
                 this.startX = e.touches[0].pageX - this.$refs.slider.offsetLeft;
                 this.scrollLeft = this.$refs.slider.scrollLeft;
             },
             touchDrag(e) {
                 if (!this.isDown) return;
                 const x = e.touches[0].pageX - this.$refs.slider.offsetLeft;
                 const walk = (x - this.startX) * 2.2;
                 this.$refs.slider.scrollLeft = this.scrollLeft - walk;
             }
         }"
         x-init="initTicker()"
         class="relative select-none">
        
        <div x-ref="slider"
             @mouseenter="isPaused = true"
             @mouseleave="isPaused = false; stopDrag()"
             @mousedown="startDrag($event)"
             @mouseup="stopDrag()"
             @mousemove="drag($event)"
             @touchstart.passive="startTouch($event)"
             @touchend="stopDrag()"
             @touchmove="touchDrag($event)"
             class="overflow-x-auto pb-4 no-scrollbar cursor-grab active:cursor-grabbing flex items-center gap-5 px-4 sm:px-8 w-full"
             style="scroll-behavior: auto;">
            
            <div class="flex items-center gap-5 w-max">
                @for($loopIdx = 0; $loopIdx < 2; $loopIdx++)
                    @foreach($portfolioItems->take(10) as $item)
                    @php
                        $thumbUrl = $item->thumbnail;
                        $finalThumb = $thumbUrl ? (str_starts_with($thumbUrl, 'http') ? $thumbUrl : asset(ltrim($thumbUrl, '/'))) : asset('images/portfolio/social_1.webp');
                        $finalMedia = $item->video_url ?: $finalThumb;
                        $mediaType = $item->video_url ? 'video' : ($item->category === 'branding' ? 'branding' : 'image');
                        $aspectType = $item->category === 'reels' ? 'vertical' : 'landscape';
                    @endphp
                    <div class="w-72 sm:w-80 flex-shrink-0 glass-card-purple rounded-2xl overflow-hidden border border-purple-800/50 hover:border-brand-orange transition-all duration-300 group cursor-pointer shadow-xl hover:-translate-y-2 select-none"
                         @click="openMedia('{{ $mediaType }}', '{{ $finalMedia }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ $aspectType }}')">
                        
                        <div class="relative aspect-video bg-black/60 overflow-hidden">
                            <img src="{{ $finalThumb }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 pointer-events-none">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#150626] via-transparent to-transparent opacity-80 pointer-events-none"></div>
                            
                            @if($item->video_url)
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-brand-orange text-brand-dark flex items-center justify-center text-sm shadow-xl group-hover:scale-115 transition-transform">
                                    <i class="fa-solid fa-play mr-0.5"></i>
                                </div>
                            </div>
                            @else
                            <div class="absolute bottom-2 left-2 w-8 h-8 rounded-lg bg-black/70 text-white flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                            @endif

                            <span class="absolute top-2.5 right-2.5 text-[9px] font-bold px-2.5 py-1 rounded-full bg-black/80 backdrop-blur text-brand-peach border border-purple-500/30 pointer-events-none">
                                {{ $item->category_arabic }}
                            </span>
                        </div>

                        <div class="p-4 space-y-1.5 text-right pointer-events-none">
                            <h4 class="text-xs sm:text-sm font-black text-white group-hover:text-brand-orange transition-colors line-clamp-1">
                                {{ $item->title }}
                            </h4>
                            <div class="text-[10px] text-gray-400 font-medium">
                                {{ $item->client_name }} @if($item->client_country) • {{ $item->client_country }} @endif
                            </div>
                        </div>

                    </div>
                    @endforeach
                @endfor
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     7. WORK PROCESS / METHODOLOGY (مراحل العمل بشكل ابداعي من خريطة الطريق المتعدد)
     ========================================================================= -->
<section id="process-summary" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
            خريطة الطريق المتعددة للإنتاج
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">مراحل عملنا نحو نجاح علامتك</h2>
        <p class="text-xs sm:text-sm text-gray-300">مسار عمل منظم ومترابط يحول الأفكار إلى إنجازات مرئية ذات عائد حقيقي وملموس</p>
    </div>

    <!-- Creative Interactive Timeline Roadmap with Connected Nodes -->
    <div class="relative">
        
        <!-- Connecting Center Glowing Line (Desktop) -->
        <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-brand-orange via-brand-peach to-purple-600 -translate-y-1/2 z-0 opacity-40"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
            @php
                $roadmapStages = [
                    ['num' => '01', 'title' => 'الاكتشاف والتحليل', 'desc' => 'فهم نشاطك التجاري، تحليل المنافسين، واستخراج نقاط القوة.', 'icon' => 'fa-solid fa-magnifying-glass-chart', 'step' => 'المرحلة 1'],
                    ['num' => '02', 'title' => 'الاستراتيجية والخطة', 'desc' => 'رسم خطة المحتوى الشهرية وتحديد الرسائل التسويقية الفعالة.', 'icon' => 'fa-solid fa-map-location-dot', 'step' => 'المرحلة 2'],
                    ['num' => '03', 'title' => 'التحضير والسكريبتات', 'desc' => 'كتابة سيناريوهات الخطف البصري وتجهيز لوحات الإلهام.', 'icon' => 'fa-solid fa-pen-nib', 'step' => 'المرحلة 3'],
                    ['num' => '04', 'title' => 'التصوير السينمائي', 'desc' => 'تصوير 4K بأحدث الكاميرات والمعدات وطواقم الإضاءة الاحترافية.', 'icon' => 'fa-solid fa-video', 'step' => 'المرحلة 4'],
                    ['num' => '05', 'title' => 'المونتاج والتلوين', 'desc' => 'تقطيع سريع، تلوين DaVinci، ومؤثرات صوتية وموشن جرافيك.', 'icon' => 'fa-solid fa-film', 'step' => 'المرحلة 5'],
                    ['num' => '06', 'title' => 'الإطلاق والنشر الذكي', 'desc' => 'نشر المحتوى في الأوقات الذهبية على منصات التواصل.', 'icon' => 'fa-solid fa-rocket', 'step' => 'المرحلة 6'],
                    ['num' => '07', 'title' => 'الحملات الممولة', 'desc' => 'إطلاق حملات استهداف دقيقة على Meta و TikTok بحساب الـ ROAS.', 'icon' => 'fa-solid fa-bullhorn', 'step' => 'المرحلة 7'],
                    ['num' => '08', 'title' => 'التحليل والمضاعفة', 'desc' => 'تقارير أداء دورية وتطوير مستمر لزيادة المبيعات والانتشار.', 'icon' => 'fa-solid fa-arrow-trend-up', 'step' => 'المرحلة 8'],
                ];
            @endphp

            @foreach($roadmapStages as $st)
            <div class="glass-card-purple rounded-3xl p-6 relative group hover:-translate-y-2 transition-all duration-300 border border-purple-800/60 hover:border-brand-orange shadow-xl flex flex-col justify-between">
                
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-black text-brand-orange/40 group-hover:text-brand-orange transition-colors font-mono">
                            {{ $st['num'] }}
                        </span>
                        <div class="w-10 h-10 rounded-xl bg-orange-500/15 border border-brand-orange/30 text-brand-orange flex items-center justify-center text-sm group-hover:scale-110 group-hover:bg-brand-orange group-hover:text-brand-dark transition-all">
                            <i class="{{ $st['icon'] }}"></i>
                        </div>
                    </div>

                    <div class="text-[10px] text-brand-peach font-bold uppercase tracking-wider mb-1">{{ $st['step'] }}</div>
                    <h3 class="text-base font-black text-white group-hover:text-brand-orange transition-colors mb-2">
                        {{ $st['title'] }}
                    </h3>
                    
                    <p class="text-xs text-gray-300 leading-relaxed font-normal">
                        {{ $st['desc'] }}
                    </p>
                </div>

                <div class="pt-4 mt-4 border-t border-purple-800/40 flex items-center gap-1.5 text-[10px] text-gray-400 group-hover:text-brand-peach transition-colors">
                    <i class="fa-solid fa-circle-check text-brand-orange text-[9px]"></i>
                    <span>مخرجات معتمدة وموثقة</span>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- =========================================================================
     8. CIRCULAR ORBIT FEEDBACK / TESTIMONIALS (فيدباك منوع بين فيديو طولي وصور)
     (يُعرض في شكل دائري متحرك شبة جو ميديا ويكون اللوجو في النص)
     ========================================================================= -->
<section id="testimonials-summary" class="py-24 bg-gradient-to-b from-[#0A0216] via-[#150628] to-[#08020F] relative z-10 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
                قصص نجاح وآراء شركائنا
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white">آراء العملاء وفيديوهات الفيدباك</h2>
            <p class="text-xs sm:text-sm text-gray-300">فيدباك منوع بين فيديوهات ريلز طولية وصور تقييمات موثقة من أصحاب الأعمال</p>
        </div>

        <!-- Center Glowing Logo with Surrounding Testimonial Cards (Orbit Showcase) -->
        <div class="relative max-w-5xl mx-auto py-8">
            
            <!-- Center Glowing Bariq Logo -->
            <div class="hidden md:flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 flex-col items-center justify-center pointer-events-none">
                <div class="relative w-28 h-28 rounded-full bg-gradient-to-tr from-[#FF9420] via-[#FFBA70] to-[#BC6200] p-1 shadow-[0_0_60px_rgba(255,148,32,0.5)] animate-pulse-glow flex items-center justify-center">
                    <div class="w-full h-full rounded-full bg-[#0E031A] flex items-center justify-center p-4">
                        <img src="{{ asset('images/logo.png') }}" alt="بريق" class="w-14 h-14 object-contain">
                    </div>
                </div>
                <span class="text-xs font-black text-brand-orange mt-2 drop-shadow">بريق للإعلام</span>
            </div>

            <!-- Surrounding Mixed Cards (Vertical Videos & Image Reviews) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Feedback 1: Vertical Reel Video -->
                <div class="glass-card-purple rounded-3xl p-6 hover:-translate-y-2 transition-all duration-300 border border-purple-800/60 hover:border-brand-orange shadow-2xl space-y-4 cursor-pointer group"
                     @click="openMedia('video', '{{ asset('videos/food_commercial.mp4') }}', 'فيدباك مطاعم شاورماكر (عمان - الأردن)', 'شهادة وتجربة تصوير الفيديوهات الترويجية وزيادة المبيعات', 'vertical')">
                    
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full bg-brand-orange/20 text-brand-orange font-black text-[10px] flex items-center gap-1.5">
                            <i class="fa-solid fa-mobile-screen"></i>
                            <span>فيديو ريلز طولي</span>
                        </span>
                        <div class="text-brand-orange text-xs flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>

                    <div class="relative aspect-[9/10] bg-black/80 rounded-2xl overflow-hidden border border-purple-700/40 flex items-center justify-center">
                        <img src="{{ asset('images/portfolio/social_4.webp') }}" alt="شاورماكر" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-brand-orange text-brand-dark flex items-center justify-center text-sm shadow-xl group-hover:scale-115 transition-transform">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        <span class="absolute bottom-2 inset-x-2 text-center text-[10px] text-white bg-black/70 backdrop-blur rounded-lg py-1 font-bold">
                            انقر لمشاهدة فيديو الفيدباك
                        </span>
                    </div>

                    <div class="text-right">
                        <h4 class="text-xs font-black text-white">أ. حسام الدين غانم</h4>
                        <p class="text-[10px] text-brand-peach font-bold">مؤسس Shawrmaker (عمان، الأردن)</p>
                    </div>
                </div>

                <!-- Feedback 2: Doctor Video Review (Vertical) -->
                <div class="glass-card-purple rounded-3xl p-6 hover:-translate-y-2 transition-all duration-300 border border-purple-800/60 hover:border-brand-orange shadow-2xl space-y-4 cursor-pointer group"
                     @click="openMedia('video', '{{ asset('videos/promo_reels_1.mp4') }}', 'مجمع ماجستي الطبي (الرياض)', 'تجربة مضاعفة حجوزات العيادات بنسبة 180% خلال أول شهرين', 'vertical')">
                    
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full bg-brand-orange/20 text-brand-orange font-black text-[10px] flex items-center gap-1.5">
                            <i class="fa-solid fa-mobile-screen"></i>
                            <span>فيديو ريلز طولي</span>
                        </span>
                        <div class="text-brand-orange text-xs flex gap-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>

                    <div class="relative aspect-[9/10] bg-black/80 rounded-2xl overflow-hidden border border-purple-700/40 flex items-center justify-center">
                        <img src="{{ asset('images/portfolio/ramez_qlight.webp') }}" alt="ماجستي" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-brand-orange text-brand-dark flex items-center justify-center text-sm shadow-xl group-hover:scale-115 transition-transform">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        <span class="absolute bottom-2 inset-x-2 text-center text-[10px] text-white bg-black/70 backdrop-blur rounded-lg py-1 font-bold">
                            انقر لمشاهدة فيديو الفيدباك
                        </span>
                    </div>

                    <div class="text-right">
                        <h4 class="text-xs font-black text-white">د. عبد الرحمن المجيدي</h4>
                        <p class="text-[10px] text-brand-peach font-bold">مجمع ماجستي الطبي (الرياض، السعودية)</p>
                    </div>
                </div>

                <!-- Feedback 3: Image Review & Testimonial -->
                <div class="glass-card-purple rounded-3xl p-6 hover:-translate-y-2 transition-all duration-300 border border-purple-800/60 hover:border-brand-orange shadow-2xl space-y-4 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-purple-900/50 text-purple-200 font-bold text-[10px] flex items-center gap-1.5">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span>تقييم كتابي موثق</span>
                            </span>
                            <div class="text-brand-orange text-xs flex gap-1">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <p class="text-xs text-gray-300 leading-relaxed italic">
                            "الاحترافية في التزام مواعيد التسليم وتصميم الهوية الإعلانية جعلت بريق شريكنا الدائم لكافة علاماتنا التجارية. أنصح بهم بشدة لكل صاحب مشروع يريد نمواً حقيقياً."
                        </p>
                    </div>

                    <div class="pt-4 border-t border-purple-800/40 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-orange to-brand-peach text-brand-dark font-black flex items-center justify-center text-sm">
                            س
                        </div>
                        <div class="text-right">
                            <h4 class="text-xs font-black text-white">م. سيف النمر</h4>
                            <p class="text-[10px] text-brand-peach font-bold">مدير تسويق شركة ألبان (القاهرة)</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     9. WHY CHOOSE BARIQ (باند ليه تختار بريق - متطابق مع تصميم جو ميديا في ملف العميل)
     ========================================================================= -->
<section class="py-20 relative z-10 border-t border-purple-900/40">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Unified Luxury Card (Goo Media Style from Client Doc) -->
        <div class="glass-card-purple rounded-3xl p-8 sm:p-12 border border-brand-orange/40 shadow-2xl relative overflow-hidden text-center space-y-10">
            
            <!-- Ambient Background Energy Gradients -->
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-brand-orange/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl pointer-events-none"></div>

            <!-- Headline & Subtitle with Clean Overflow & Typography -->
            <div class="space-y-3 relative z-10">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-normal">
                    جاهز نخلي علامتك تظهر بشكل مختلف؟
                </h2>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto">
                    تواصل معنا اليوم ودعنا نحول أفكارك إلى واقع يحقق أهدافك
                </p>
            </div>

            <!-- Connected Horizontal Timeline (4 Features on Center Line) -->
            <div class="relative py-4 z-10">
                
                <!-- Center Horizontal Connected Line -->
                <div class="hidden md:block absolute top-7 left-14 right-14 h-1 bg-gradient-to-r from-brand-orange via-brand-peach to-brand-orange opacity-40 z-0"></div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-4 relative z-10">
                    
                    <!-- Feature 1: تواصل مباشر -->
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark flex items-center justify-center text-xl font-black shadow-lg shadow-orange-500/30 ring-4 ring-[#16062C]">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white">تواصل مباشر</h4>
                            <p class="text-[11px] text-gray-300 mt-1">نرد بسرعة ونفهم احتياجك</p>
                        </div>
                    </div>

                    <!-- Feature 2: تنفيذ سريع -->
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark flex items-center justify-center text-xl font-black shadow-lg shadow-orange-500/30 ring-4 ring-[#16062C]">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white">تنفيذ سريع</h4>
                            <p class="text-[11px] text-gray-300 mt-1">خطوات واضحة دون تأخير</p>
                        </div>
                    </div>

                    <!-- Feature 3: تحقيق الهدف -->
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark flex items-center justify-center text-xl font-black shadow-lg shadow-orange-500/30 ring-4 ring-[#16062C]">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white">تحقيق الهدف</h4>
                            <p class="text-[11px] text-gray-300 mt-1">خطة ملموسة لعلامتك</p>
                        </div>
                    </div>

                    <!-- Feature 4: إبداع بلا حدود -->
                    <div class="flex flex-col items-center text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark flex items-center justify-center text-xl font-black shadow-lg shadow-orange-500/30 ring-4 ring-[#16062C]">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white">إبداع بلا حدود</h4>
                            <p class="text-[11px] text-gray-300 mt-1">أفكار تسويقية مبتكرة</p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Golden Action CTA Button -->
            <div class="pt-2 relative z-10">
                <a href="{{ route('public.contact') }}" 
                   class="inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-sm hover:brightness-110 active:scale-95 transition shadow-2xl shadow-orange-500/40 group">
                    <span>تواصل معنا الآن</span>
                    <i class="fa-solid fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     10. DIRECT CONSULTATION FORM ON HOMEPAGE
     ========================================================================= -->
<section id="contact-summary" class="py-14 sm:py-20 bg-gradient-to-b from-[#16062C] via-[#1B0736] to-[#08020F] relative z-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card-purple rounded-2xl sm:rounded-[2rem] p-5 sm:p-10 lg:p-14 shadow-2xl relative overflow-hidden border border-brand-orange/40">
            
            <div class="text-center max-w-xl mx-auto mb-10 space-y-3 relative z-10">
                <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
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
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-2">اسم البراند أو النشاط التجاري</label>
                        <input type="text" name="brand_name" placeholder="اسم علامتك التجارية" 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">رقم الهاتف أو الواتساب <span class="text-brand-orange">*</span></label>
                        <input type="text" name="phone" required placeholder="+2010... أو +966..." 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="example@brand.com" 
                               class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">الخدمة التي تهمك أكثر</label>
                        <select name="service_interested" 
                                class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
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
                                class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition">
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
                              class="w-full px-4 py-3.5 bg-[#120422] border border-purple-800/60 focus:border-brand-orange rounded-2xl text-white text-xs focus:outline-none focus:ring-1 focus:ring-brand-orange transition"></textarea>
                </div>

                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-sm hover:brightness-110 shadow-2xl shadow-orange-500/30 transition flex items-center justify-center gap-2.5 active:scale-95">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>إرسال طلب الاستشارة التسويقية الفورية</span>
                </button>
            </form>

        </div>

    </div>
</section>

@endsection

@push('styles')
<style>
    /* Reverse Marquee Motion */
    @keyframes marqueeReverse {
        0% { transform: translateX(50%); }
        100% { transform: translateX(0%); }
    }
    .marquee-reverse-track {
        display: flex;
        width: 200%;
        animation: marqueeReverse 30s linear infinite;
    }
    .marquee-reverse-track:hover, .marquee-track:hover {
        animation-play-state: paused;
    }

    /* Partner Card Hover Color & Tilt */
    .partner-card:hover .partner-name {
        color: #FF9420 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Particle Canvas Animation for Hero Background
    (function initHeroCanvas() {
        const canvas = document.getElementById('hero-particle-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width = canvas.width = canvas.offsetWidth;
        let height = canvas.height = canvas.offsetHeight;

        window.addEventListener('resize', () => {
            if (!canvas) return;
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
        });

        const particles = [];
        const count = 45;
        const colors = ['#FF9420', '#FFBA70', '#3F147E', '#1B082B'];

        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                radius: Math.random() * 2.5 + 1,
                color: colors[Math.floor(Math.random() * colors.length)],
                vx: (Math.random() - 0.5) * 0.6,
                vy: (Math.random() - 0.5) * 0.6,
                alpha: Math.random() * 0.6 + 0.2
            });
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);

            for (let i = 0; i < particles.length; i++) {
                const p = particles[i];
                p.x += p.vx;
                p.y += p.vy;

                if (p.x < 0) p.x = width;
                if (p.x > width) p.x = 0;
                if (p.y < 0) p.y = height;
                if (p.y > height) p.y = 0;

                ctx.save();
                ctx.globalAlpha = p.alpha;
                ctx.fillStyle = p.color;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();

                // Connect nearby particles
                for (let j = i + 1; j < particles.length; j++) {
                    const p2 = particles[j];
                    const dist = Math.hypot(p.x - p2.x, p.y - p2.y);
                    if (dist < 110) {
                        ctx.save();
                        ctx.globalAlpha = (1 - dist / 110) * 0.18;
                        ctx.strokeStyle = '#FFBA70';
                        ctx.lineWidth = 0.6;
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.stroke();
                        ctx.restore();
                    }
                }
            }

            requestAnimationFrame(animate);
        }
        animate();
    })();

    // Stats Counter
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
                const duration = 2000;
                const steps = 50;
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
