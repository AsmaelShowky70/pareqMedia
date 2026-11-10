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
        <canvas id="hero-particle-canvas" class="w-full h-full opacity-70"></canvas>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-15%,rgba(62,36,197,0.40),rgba(63,20,126,0.22)_45%,transparent_80%)]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#080210]/60 to-[#080210]"></div>
        
        <!-- Ambient Glowing Rings with Vibrant Electric Indigo & Brand Orange -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full border-2 border-[#3E24C5]/35 shadow-[0_0_60px_rgba(62,36,197,0.30)] animate-pulse-glow pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[950px] h-[950px] rounded-full border-2 border-[#FF9420]/25 shadow-[0_0_60px_rgba(255,148,32,0.20)] pointer-events-none"></div>
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
                <div class="inline-flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2 sm:py-2.5 rounded-full bg-[#1B082B]/95 border-2 border-[#FF9420]/70 text-white text-[11px] sm:text-sm font-extrabold shadow-[0_0_30px_rgba(255,148,32,0.45)] animate-pulse-glow max-w-full">
                    <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-[#FF9420] animate-ping shrink-0"></span>
                    <span class="text-[#FF9420] text-xs sm:text-base">✦</span>
                    <span class="tracking-wide text-white">بريق ، مفتاح نجاحك في التسويق</span>
                    <span class="text-[#FF9420] text-xs sm:text-base">✦</span>
                </div>

                <!-- Main Headline -->
                <div class="space-y-3 sm:space-y-4">
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-normal tracking-tight">
                        بريق مفتاح نجاحك 
                        <span class="bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#FF9420] bg-clip-text text-transparent block mt-1 sm:mt-2 text-4xl sm:text-6xl lg:text-7xl xl:text-8xl leading-normal pb-3 overflow-visible drop-shadow-[0_4px_30px_rgba(255,148,32,0.45)]">في التسويق</span>
                    </h1>

                    <!-- Subtitle under slogan in smaller font as requested -->
                    <p class="text-base sm:text-xl lg:text-2xl text-gray-100 font-bold max-w-2xl leading-relaxed pt-1">
                        نصنع لعلامتك التجارية بريقاً استثنائياً في العالم الرقمي
                    </p>
                    <p class="text-xs sm:text-sm text-gray-300 max-w-xl leading-relaxed font-normal">
                        منظومة إبداعية متكاملة تجمع بين التصوير السينمائي، المونتاج فائق الجاذبية، وتصميم الهويات البصرية، وإدارة الحملات الإعلانية القائمة على أعلى عائد استثماري.
                    </p>
                </div>

                <!-- Hero Action Buttons & Scroll Indicator -->
                <div class="pt-2">
                    <div class="flex flex-wrap items-center lg:justify-start justify-center gap-3 sm:gap-4 w-full">
                        <!-- زر تواصل معنا (Glowing Brand Gradient) -->
                        <a href="{{ route('public.contact') }}" 
                           class="w-full sm:w-auto px-7 sm:px-8 py-3.5 sm:py-4 rounded-2xl bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black text-xs sm:text-sm hover:brightness-110 active:scale-95 transition shadow-[0_0_35px_rgba(255,148,32,0.55)] flex items-center justify-center gap-2.5 group">
                            <span>تواصل معنا الآن</span>
                            <i class="fa-solid fa-paper-plane text-xs group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </a>

                        <!-- زر مشاهدة أعمالنا (Electric Indigo Border & Ambient Night BG) -->
                        <a href="{{ route('public.portfolio') }}" 
                           class="w-full sm:w-auto px-7 sm:px-8 py-3.5 sm:py-4 rounded-2xl bg-[#1B082B]/90 hover:bg-[#250C44] border-2 border-[#3E24C5] hover:border-[#FF9420] text-white font-bold text-xs sm:text-sm transition shadow-[0_0_25px_rgba(62,36,197,0.35)] flex items-center justify-center gap-2 backdrop-blur-md group">
                            <span class="w-6 h-6 rounded-full bg-[#FF9420]/20 text-[#FF9420] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play text-[10px]"></i>
                            </span>
                            <span>مشاهدة أعمالنا</span>
                        </a>

                        <!-- اسحب للأسفل بجانب زر مشاهدة أعمالنا -->
                        <a href="#video-showcase" class="inline-flex items-center gap-2 px-3 py-2 text-xs text-gray-300 hover:text-[#FF9420] transition group shrink-0">
                            <div class="w-5 h-8 rounded-full border-2 border-gray-400 group-hover:border-[#FF9420] flex items-start justify-center p-1 transition-colors">
                                <span class="w-1.5 h-2 rounded-full bg-[#FF9420] animate-bounce"></span>
                            </div>
                            <span class="font-bold tracking-wider text-[11px] whitespace-nowrap">اسحب للأسفل</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Left Column: Official Pariq Animated Interactive Centerpiece (اللوجو الجانبي مع الأشكال والأنيميشن التفاعلي والمدارات الفضائية) -->
            <div class="lg:col-span-5 flex justify-center items-center relative py-8 lg:py-0">
                
                <!-- Main Orbital Ecosystem Container with 3D Tilt Interaction -->
                <div class="relative w-72 h-72 sm:w-96 sm:h-96 lg:w-[460px] lg:h-[460px] flex items-center justify-center select-none"
                     x-data="{ x: 0, y: 0, isHovered: false }"
                     @mousemove="
                         const r = $el.getBoundingClientRect();
                         x = (($event.clientX - r.left) / r.width - 0.5) * 16;
                         y = (($event.clientY - r.top) / r.height - 0.5) * -16;
                     "
                     @mouseenter="isHovered = true"
                     @mouseleave="isHovered = false; x = 0; y = 0"
                     :style="isHovered 
                         ? `transform: perspective(1000px) rotateY(${x}deg) rotateX(${y}deg); transition: transform 0.12s ease-out;` 
                         : 'transform: perspective(1000px) rotateY(0deg) rotateX(0deg); transition: transform 0.6s ease-out;'">

                    <!-- 1. Deep Atmospheric Radial Glow Fields (إضاءة نيون ثلاثية الأبعاد) -->
                    <div class="absolute inset-4 rounded-full bg-gradient-to-tr from-[#FF9420]/35 via-[#3E24C5]/30 to-[#3F147E]/30 blur-3xl animate-pulse-glow pointer-events-none"></div>
                    <div class="absolute w-44 h-44 rounded-full bg-[#FF9420]/25 blur-2xl pointer-events-none"></div>

                    <!-- 2. Outer Electric Indigo Orbit Ring with Smooth Clockwise Rotation -->
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-[#3E24C5]/40 animate-[spin_45s_linear_infinite] pointer-events-none">
                        <!-- Orbiting Satellites on Outer Ring -->
                        <div class="absolute -top-1.5 right-1/4 w-3.5 h-3.5 rounded-full bg-[#3E24C5] shadow-[0_0_16px_#3E24C5] animate-ping"></div>
                        <div class="absolute -bottom-1.5 left-1/4 w-2.5 h-2.5 rounded-full bg-[#3E24C5] shadow-[0_0_12px_#3E24C5]"></div>
                    </div>

                    <!-- 3. Middle Vivid Brand Orange Orbit Ring with Counter-Clockwise Rotation -->
                    <div class="absolute inset-5 sm:inset-7 rounded-full border-2 border-dashed border-[#FF9420]/55 animate-[spin_28s_linear_infinite_reverse] pointer-events-none">
                        <!-- Orbiting Satellites on Middle Ring -->
                        <div class="absolute top-3 right-6 w-3 h-3 rounded-full bg-[#FF9420] shadow-[0_0_20px_#FF9420] animate-ping"></div>
                        <div class="absolute bottom-5 left-8 w-2.5 h-2.5 rounded-full bg-[#FFBA70] shadow-[0_0_14px_#FFBA70] animate-pulse"></div>
                    </div>

                    <!-- 4. Inner Fine Aura Ring with Pulsing Glow -->
                    <div class="absolute inset-12 sm:inset-16 rounded-full border border-[#FFBA70]/30 animate-pulse-glow pointer-events-none"></div>

                    <!-- 5. Studio HUD Precision Corner Brackets (أقواس وزوايا تقنية سينمائية) -->
                    <span class="absolute top-6 left-6 w-3.5 h-3.5 border-t-2 border-l-2 border-[#FF9420]/60 rounded-tl-sm pointer-events-none"></span>
                    <span class="absolute top-6 right-6 w-3.5 h-3.5 border-t-2 border-r-2 border-[#3E24C5]/60 rounded-tr-sm pointer-events-none"></span>
                    <span class="absolute bottom-6 left-6 w-3.5 h-3.5 border-b-2 border-l-2 border-[#3E24C5]/60 rounded-bl-sm pointer-events-none"></span>
                    <span class="absolute bottom-6 right-6 w-3.5 h-3.5 border-b-2 border-r-2 border-[#FF9420]/60 rounded-br-sm pointer-events-none"></span>

                    <!-- 6. Floating 3D Capability Badges around Logo (بطاقات مهارات بريق ثلاثية الأبعاد) -->
                    <!-- Top-Right: 4K Cinema ProRes -->
                    <div class="hidden sm:flex absolute -top-3 -right-2 lg:-right-6 animate-float-slow pointer-events-auto z-20">
                        <div class="flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-[#1B082B]/90 backdrop-blur-xl border border-[#FF9420]/50 shadow-[0_10px_25px_rgba(255,148,32,0.25)] hover:scale-105 hover:border-[#FF9420] transition-all group/badge">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#BC6200] to-[#FF9420] flex items-center justify-center text-black font-black shadow-md shadow-orange-500/30">
                                <i class="fa-solid fa-video text-xs"></i>
                            </span>
                            <div class="text-right">
                                <div class="text-[11px] font-black text-white flex items-center gap-1.5">
                                    <span>4K Cinema ProRes</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#FF9420] animate-ping"></span>
                                </div>
                                <div class="text-[9px] text-gray-300 font-medium">تصوير سينمائي 60FPS</div>
                            </div>
                        </div>
                    </div>

                    <!-- Top-Left: Vector & Brand Identity -->
                    <div class="hidden sm:flex absolute -top-2 -left-2 lg:-left-6 animate-float-reverse pointer-events-auto z-20">
                        <div class="flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-[#1B082B]/90 backdrop-blur-xl border border-[#3E24C5]/60 shadow-[0_10px_25px_rgba(62,36,197,0.30)] hover:scale-105 hover:border-[#3E24C5] transition-all group/badge">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#3F147E] to-[#3E24C5] flex items-center justify-center text-white font-black shadow-md shadow-indigo-500/30">
                                <i class="fa-solid fa-bezier-curve text-xs"></i>
                            </span>
                            <div class="text-right">
                                <div class="text-[11px] font-black text-white">Brand Identity</div>
                                <div class="text-[9px] text-[#FFBA70] font-medium">هويات بصرية متكاملة</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom-Right: High Growth ROAS -->
                    <div class="hidden sm:flex absolute -bottom-3 -right-2 lg:-right-4 animate-float-reverse pointer-events-auto z-20">
                        <div class="flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-[#1B082B]/90 backdrop-blur-xl border border-emerald-500/50 shadow-[0_10px_25px_rgba(16,185,129,0.25)] hover:scale-105 hover:border-emerald-400 transition-all group/badge">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-700 to-emerald-500 flex items-center justify-center text-white font-black shadow-md shadow-emerald-500/30">
                                <i class="fa-solid fa-chart-line text-xs"></i>
                            </span>
                            <div class="text-right">
                                <div class="text-[11px] font-black text-white flex items-center gap-1.5">
                                    <span>+380% ROAS</span>
                                    <i class="fa-solid fa-arrow-trend-up text-[10px] text-emerald-400"></i>
                                </div>
                                <div class="text-[9px] text-gray-300 font-medium">إعلانات ونمو مبيعات</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom-Left: Fast-Paced Reels -->
                    <div class="hidden sm:flex absolute -bottom-2 -left-2 lg:-left-4 animate-float-slow pointer-events-auto z-20">
                        <div class="flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-[#1B082B]/90 backdrop-blur-xl border border-[#FFBA70]/50 shadow-[0_10px_25px_rgba(255,186,112,0.25)] hover:scale-105 hover:border-[#FFBA70] transition-all group/badge">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#BC6200] to-[#FFBA70] flex items-center justify-center text-black font-black shadow-md shadow-amber-500/30">
                                <i class="fa-solid fa-bolt text-xs"></i>
                            </span>
                            <div class="text-right">
                                <div class="text-[11px] font-black text-white">Fast-Paced Reels</div>
                                <div class="text-[9px] text-gray-300 font-medium">مونتاج ريلز يخطف العين</div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Centerpiece: The Pure Transparent Pariq Logo (اللوجو الشفاف النقي مع البريق والكبسولة) -->
                    <div class="relative z-10 flex flex-col items-center justify-center group animate-float-slow">
                        
                        <!-- Transparent Logo Image with Luxury Depth Shadows -->
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="PARIQ AGENCY" 
                             class="relative w-52 sm:w-64 lg:w-80 object-contain filter drop-shadow-[0_15px_40px_rgba(255,148,32,0.55)] group-hover:scale-108 transition-all duration-700 ease-out select-none">

                        <!-- Brand Identity Capsule under Logo -->
                        <div class="mt-2.5 px-4 py-1.5 rounded-full bg-[#1B082B]/95 border border-[#FF9420]/60 text-[10px] sm:text-[11px] font-black text-white shadow-2xl flex items-center gap-2 backdrop-blur-md group-hover:border-[#FF9420] transition-colors">
                            <span class="w-2 h-2 rounded-full bg-[#FF9420] animate-ping"></span>
                            <span class="tracking-widest bg-gradient-to-r from-white via-[#FFBA70] to-[#FF9420] bg-clip-text text-transparent">PARIQ CREATIVE AGENCY</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     2. OFFICIAL PARIQ SHOWREEL VIDEO SECTION (فيديو شو ريل وكالة بريق في مكانه المعتمد)
     ========================================================================= -->
<section id="video-showcase" class="py-14 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-8 space-y-2">
        <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
            فيديو شو ريل وكالة بريق الرسمي
        </span>
        <h2 class="text-2xl sm:text-4xl font-black text-white">شاهد إبداع بريق في دقيقة واحدة</h2>
        <p class="text-xs sm:text-sm text-gray-300">أعمالنا السينمائية ومونتاجنا الإعلاني بملء الشاشة بجودة فائقة</p>
    </div>

    <!-- 16:9 (1920x1080) Horizontal Video Frame -->
    <div class="conic-glow-border rounded-3xl overflow-hidden shadow-2xl relative group" 
         x-data="{ isMuted: true, isPlaying: true }">
        
        <div class="relative aspect-video w-full bg-[#08020F] rounded-[1.4rem] overflow-hidden flex items-center justify-center">
            
            <video id="pariq-hero-video" 
                   playsinline 
                   preload="auto"
                   autoplay
                   muted
                   loop
                   controls
                   poster="{{ asset('videos/bariq-poster.jpg') }}"
                   class="w-full h-full object-contain bg-black">
                <source src="{{ asset('videos/bariq.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/bariq.webm') }}" type="video/webm">
                متصفحك لا يدعم تشغيل الفيديو المباشر.
            </video>

            <!-- Top Video Info Bar -->
            <div class="absolute top-2.5 right-2.5 sm:top-4 sm:right-4 z-20 flex items-center gap-1.5 sm:gap-2 px-2.5 py-1 sm:px-3.5 sm:py-1.5 rounded-full bg-black/80 backdrop-blur-md border border-brand-orange/40 text-[9px] sm:text-[11px] text-white font-bold pointer-events-none">
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-brand-orange animate-ping"></span>
                <span>PARIQ SHOWREEL • 4K</span>
            </div>

            <!-- Bottom Left Actions: Sound Toggle + Fullscreen Modal -->
            <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 z-20 flex items-center gap-1.5 sm:gap-2">
                <!-- Sound Toggle Button -->
                <button type="button" 
                        @click="
                            const v = document.getElementById('pariq-hero-video');
                            v.muted = !v.muted;
                            isMuted = v.muted;
                            if (v.paused) { v.play(); }
                        "
                        class="px-2.5 py-1.5 sm:px-3.5 sm:py-2 rounded-xl bg-black/80 hover:bg-brand-orange hover:text-brand-dark text-white font-bold text-[10px] sm:text-xs backdrop-blur-md border border-white/20 transition flex items-center gap-1 sm:gap-1.5 shadow-lg active:scale-95">
                    <i class="fa-solid" :class="isMuted ? 'fa-volume-xmark text-amber-400' : 'fa-volume-high text-emerald-400'"></i>
                    <span x-text="isMuted ? 'تشغيل الصوت' : 'كتم الصوت'"></span>
                </button>

                <!-- Fullscreen Modal Button -->
                <button type="button" 
                        @click="openMedia('video', '{{ asset('videos/bariq.mp4') }}', 'شو ريل وكالة بريق الرسمي 2026', 'أحدث إنتاجات وكالة بريق للتسويق والتصوير السينمائي والمونتاج الإعلاني')"
                        class="px-2.5 py-1.5 sm:px-3.5 sm:py-2 rounded-xl bg-black/80 hover:bg-brand-orange hover:text-brand-dark text-white font-bold text-[10px] sm:text-xs backdrop-blur-md border border-white/20 transition flex items-center gap-1 sm:gap-1.5 shadow-lg active:scale-95">
                    <i class="fa-solid fa-expand"></i>
                    <span>نافذة كاملة</span>
                </button>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     3. LIVE ANIMATED STATS COUNTER BAR (احصائيات وكالة بريق المعتمدة)
     ========================================================================= -->
<script>
    function pariqStatsCounter() {
        const pTarget = {{ (int) ($stats['projects_count'] ?? 480) }};
        const cTarget = {{ (int) ($stats['clients_count'] ?? 125) }};
        const yTarget = {{ (int) ($stats['years_count'] ?? 6) }};
        const tTarget = {{ (int) ($stats['team_count'] ?? 18) }};

        return {
            started: false,
            projects: pTarget,
            clients: cTarget,
            years: yTarget,
            team: tTarget,
            targets: {
                projects: pTarget,
                clients: cTarget,
                years: yTarget,
                team: tTarget
            },
            initObserver(el) {
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        if (entries[0] && entries[0].isIntersecting) {
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
                this.projects = 0;
                this.clients = 0;
                this.years = 0;
                this.team = 0;
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
        };
    }
    window.pariqStatsCounter = pariqStatsCounter;
</script>

<section id="stats-summary" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div x-data="pariqStatsCounter()" 
         x-init="initObserver($el)"
         class="space-y-6">
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            <!-- Card 1: Projects (Featured active orange border/glow as in Image 2) -->
            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-[#1B082B]/95 backdrop-blur-md transition-all duration-300 group hover:-translate-y-1 text-center border-2 border-[#FF9420] shadow-[0_0_35px_rgba(255,148,32,0.45)]">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-[#FF9420]/25 border border-[#FF9420] text-[#FF9420] flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#FF9420] flex items-center justify-center font-mono">
                    <span>+</span><span x-text="projects !== undefined && projects !== null ? projects : '{{ $stats['projects_count'] ?? 480 }}'">{{ $stats['projects_count'] ?? 480 }}</span>
                </div>
                <div class="text-[11px] sm:text-xs text-white mt-1 font-bold">{{ $stats['projects_label'] ?? 'مشروع مكتمل بنجاح' }}</div>
            </div>

            <!-- Card 2: Clients -->
            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-[#1B082B]/95 backdrop-blur-md transition-all duration-300 group hover:-translate-y-1 text-center border-2 border-[#3E24C5]/70 hover:border-[#FF9420] shadow-[0_0_25px_rgba(62,36,197,0.35)] hover:shadow-[0_0_35px_rgba(255,148,32,0.4)]">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-[#3E24C5]/30 border border-[#3E24C5] text-[#FFBA70] flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                    <span>+</span><span x-text="clients !== undefined && clients !== null ? clients : '{{ $stats['clients_count'] ?? 125 }}'">{{ $stats['clients_count'] ?? 125 }}</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-200 mt-1 font-bold">{{ $stats['clients_label'] ?? 'عميل سعيد في 6 دول' }}</div>
            </div>

            <!-- Card 3: Years -->
            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-[#1B082B]/95 backdrop-blur-md transition-all duration-300 group hover:-translate-y-1 text-center border-2 border-[#3E24C5]/70 hover:border-[#FF9420] shadow-[0_0_25px_rgba(62,36,197,0.35)] hover:shadow-[0_0_35px_rgba(255,148,32,0.4)]">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-[#BC6200]/30 border border-[#FFBA70]/70 text-[#FFBA70] flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#FFBA70] flex items-center justify-center font-mono">
                    <span>+</span><span x-text="years !== undefined && years !== null ? years : '{{ $stats['years_count'] ?? 6 }}'">{{ $stats['years_count'] ?? 6 }}</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-200 mt-1 font-bold">{{ $stats['years_label'] ?? 'سنوات خبرة متواصلة' }}</div>
            </div>

            <!-- Card 4: Team -->
            <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-[#1B082B]/95 backdrop-blur-md transition-all duration-300 group hover:-translate-y-1 text-center border-2 border-[#3E24C5]/70 hover:border-[#FF9420] shadow-[0_0_25px_rgba(62,36,197,0.35)] hover:shadow-[0_0_35px_rgba(255,148,32,0.4)]">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-[#FF9420]/25 border border-[#FF9420] text-[#FF9420] flex items-center justify-center mx-auto mb-2.5 sm:mb-3 text-lg sm:text-xl group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                    <span>+</span><span x-text="team !== undefined && team !== null ? team : '{{ $stats['team_count'] ?? 18 }}'">{{ $stats['team_count'] ?? 18 }}</span>
                </div>
                <div class="text-[11px] sm:text-xs text-gray-200 mt-1 font-bold">{{ $stats['team_label'] ?? 'مبدع وخبير متخصص' }}</div>
            </div>
        </div>

    </div>
</section>

<!-- =========================================================================
     4. SUCCESS PARTNERS DUAL REVERSE MARQUEE (لوجوهات شركاء النجاح بحركة عكسية)
     (سكشن مدعوم لحظياً من لوحة التحكم CMS مع دوران وتلوين عند الوقوف)
     ========================================================================= -->
<section class="py-20 bg-gradient-to-b from-[#080210] via-[#1B082B] to-[#0A0214] text-white relative z-10 overflow-hidden border-y-2 border-[#3E24C5]/50 shadow-[0_0_50px_rgba(62,36,197,0.25)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center space-y-3">
        <span class="text-xs font-black text-[#FF9420] uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#FF9420]/15 border border-[#FF9420]/50 shadow-[0_0_15px_rgba(255,148,32,0.3)]">
            شركاء النجاح المعتمدون
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">
            علامات تجارية كبرى وضعت ثقتها في بريق
        </h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto">
            نتشرف بالعمل مع رواد الأعمال وكبرى الشركات والمؤسسات الطبية والتعليمية في مصر والسعودية والوطن العربي
        </p>
    </div>

    @php
        $partnersList = (isset($partners) && $partners->isNotEmpty()) ? $partners : collect();
        if ($partnersList->isEmpty()) {
            $partnersRow1 = [
                ['name' => 'Mercedes-Benz', 'icon' => 'fa-brands fa-monero', 'img' => null, 'type' => 'سيارات فاخرة'],
                ['name' => 'فوري Fawry', 'icon' => 'fa-solid fa-credit-card', 'img' => null, 'type' => 'مدفوعات رقمية'],
                ['name' => 'ASUS ROG', 'icon' => 'fa-solid fa-laptop-code', 'img' => null, 'type' => 'تقنية وأجهزة'],
                ['name' => 'بلتون Beltone', 'icon' => 'fa-solid fa-chart-line', 'img' => null, 'type' => 'استثمار ومالية'],
                ['name' => 'داماك DAMAC', 'icon' => 'fa-solid fa-city', 'img' => null, 'type' => 'تطوير عقاري'],
                ['name' => 'بنده Panda', 'icon' => 'fa-solid fa-basket-shopping', 'img' => null, 'type' => 'تجزئة وسوبرماركت'],
                ['name' => 'سيمنز Siemens', 'icon' => 'fa-solid fa-bolt', 'img' => null, 'type' => 'هندسة وتكنولوجيا'],
                ['name' => 'GSK Global', 'icon' => 'fa-solid fa-capsules', 'img' => null, 'type' => 'أدوية وصحة'],
                ['name' => 'باتشي Patchi', 'icon' => 'fa-solid fa-gift', 'img' => null, 'type' => 'شوكولاتة وهدايا'],
            ];
            $partnersRow2 = [
                ['name' => 'Welfare Dairy', 'img' => asset('images/clients/client_77.webp'), 'icon' => null, 'type' => 'ألبان وتغذية'],
                ['name' => 'Shawrmaker Jordan', 'img' => asset('images/clients/client_78.webp'), 'icon' => null, 'type' => 'سلسلة مطاعم'],
                ['name' => 'مجمع ماجستي الطبي', 'img' => asset('images/clients/client_79.webp'), 'icon' => null, 'type' => 'رعاية صحية'],
                ['name' => 'The Met Hub', 'img' => asset('images/clients/client_80.webp'), 'icon' => null, 'type' => 'مجمعات تجارية'],
                ['name' => 'Fox ATVs Oman', 'img' => asset('images/clients/client_81.webp'), 'icon' => null, 'type' => 'سياحة وترفيه'],
                ['name' => 'صيدليات رحيق', 'img' => asset('images/clients/client_82.webp'), 'icon' => null, 'type' => 'صيدليات ودواء'],
                ['name' => 'Crystal Auto', 'img' => asset('images/clients/client_83.webp'), 'icon' => null, 'type' => 'خدمات سيارات'],
                ['name' => 'جامعة قطر', 'img' => asset('images/clients/client_85.webp'), 'icon' => null, 'type' => 'تعليم عالي'],
                ['name' => 'مطاحن بن الحسيني', 'img' => asset('images/clients/client_88.webp'), 'icon' => null, 'type' => 'أغذية وقهوة'],
            ];
        } else {
            $partnersRow1 = [];
            $partnersRow2 = [];
            foreach ($partnersList as $pIdx => $pItem) {
                $rawLogo = $pItem instanceof \App\Models\Partner ? $pItem->display_logo : ($pItem->logo_url ?? null);
                if ($rawLogo && str_contains($rawLogo, 'drive.google.com')) {
                    if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $rawLogo, $matches)) {
                        $rawLogo = 'https://lh3.googleusercontent.com/d/' . $matches[1];
                    }
                }
                $pData = [
                    'name' => $pItem->name,
                    'type' => $pItem->category ?: 'شريك نجاح',
                    'img' => $rawLogo,
                    'icon' => $rawLogo ? null : 'fa-solid fa-building',
                ];
                if ($pIdx % 2 === 0) {
                    $partnersRow1[] = $pData;
                } else {
                    $partnersRow2[] = $pData;
                }
            }
            if (empty($partnersRow2)) {
                $partnersRow2 = $partnersRow1;
            }
        }
    @endphp

    <!-- Dual Reverse Marquee Tracks -->
    <div class="space-y-6 overflow-hidden py-4">
        
        <!-- Row 1: Moves Left to Right -->
        <div class="marquee-reverse-track flex items-center gap-6 whitespace-nowrap select-none">
            @for($i = 0; $i < 2; $i++)
                @foreach($partnersRow1 as $p)
                <div class="partner-card inline-flex items-center gap-3.5 px-6 py-4 rounded-2xl bg-[#1B082B]/95 border-2 border-[#3E24C5]/50 shadow-[0_8px_30px_rgba(0,0,0,0.7)] hover:shadow-[0_0_35px_rgba(255,148,32,0.45)] hover:border-[#FF9420] transition-all duration-300 cursor-pointer transform hover:-translate-y-2 hover:rotate-2">
                    <div class="w-10 h-10 rounded-xl bg-black/60 border border-[#3E24C5]/60 flex items-center justify-center p-1.5 overflow-hidden relative">
                        @if(!empty($p['img']))
                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" 
                                 class="max-w-full max-h-full object-contain filter group-hover:scale-110 transition-transform"
                                 referrerpolicy="no-referrer"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                            <span style="display: none;" class="w-full h-full items-center justify-center text-xs font-black text-white bg-gradient-to-tr from-[#FF9420] to-[#3E24C5] rounded-lg">
                                {{ mb_substr($p['name'], 0, 1, 'UTF-8') }}
                            </span>
                        @else
                            <i class="{{ $p['icon'] ?? 'fa-solid fa-building' }} text-[#FF9420] text-lg"></i>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-white partner-name transition-colors">{{ $p['name'] }}</div>
                        <div class="text-[10px] text-[#FFBA70] font-medium">{{ $p['type'] }}</div>
                    </div>
                </div>
                @endforeach
            @endfor
        </div>

        <!-- Row 2: Moves Right to Left (Opposite Direction) -->
        <div class="marquee-track flex items-center gap-6 whitespace-nowrap select-none">
            @for($i = 0; $i < 2; $i++)
                @foreach($partnersRow2 as $p)
                <div class="partner-card inline-flex items-center gap-3.5 px-6 py-4 rounded-2xl bg-[#1B082B]/95 border-2 border-[#3E24C5]/50 shadow-[0_8px_30px_rgba(0,0,0,0.7)] hover:shadow-[0_0_35px_rgba(255,148,32,0.45)] hover:border-[#FF9420] transition-all duration-300 cursor-pointer transform hover:-translate-y-2 hover:-rotate-2">
                    <div class="w-10 h-10 rounded-xl bg-black/60 border border-[#3E24C5]/60 flex items-center justify-center p-1.5 overflow-hidden relative">
                        @if(!empty($p['img']))
                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" 
                                 class="max-w-full max-h-full object-contain filter group-hover:scale-110 transition-transform"
                                 referrerpolicy="no-referrer"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                            <span style="display: none;" class="w-full h-full items-center justify-center text-xs font-black text-white bg-gradient-to-tr from-[#FF9420] to-[#3E24C5] rounded-lg">
                                {{ mb_substr($p['name'], 0, 1, 'UTF-8') }}
                            </span>
                        @else
                            <i class="{{ $p['icon'] ?? 'fa-solid fa-building' }} text-[#FF9420] text-lg"></i>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-black text-white partner-name transition-colors">{{ $p['name'] }}</div>
                        <div class="text-[10px] text-[#FFBA70] font-medium">{{ $p['type'] }}</div>
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
             autoplayTimer: null,
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
             next() { 
                 this.activeIdx = (this.activeIdx + 1) % this.services.length; 
                 this.resetTimer();
             },
             prev() { 
                 this.activeIdx = (this.activeIdx - 1 + this.services.length) % this.services.length; 
                 this.resetTimer();
             },
             startAutoplay() {
                 this.stopAutoplay();
                 this.progress = 0;
                 this.progressTimer = setInterval(() => {
                     if (this.progress < 100) {
                         this.progress += 1;
                     }
                 }, 50);
                 this.autoplayTimer = setInterval(() => { 
                     this.next(); 
                 }, 5000);
             },
             resetTimer() {
                 this.startAutoplay();
             },
             stopAutoplay() {
                 if (this.autoplayTimer) clearInterval(this.autoplayTimer);
                 if (this.progressTimer) clearInterval(this.progressTimer);
                 this.autoplayTimer = null;
                 this.progressTimer = null;
             },
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
         }"
         x-init="startAutoplay()">
    
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
                         :class="activeIdx === idx ? 'border-2 border-[#FF9420] shadow-[0_0_60px_rgba(255,148,32,0.6),0_0_90px_rgba(62,36,197,0.4)]' : 'border-2 border-[#3E24C5]/60 hover:border-[#FF9420] shadow-[0_0_25px_rgba(62,36,197,0.3)]'"
                         class="absolute w-[270px] sm:w-[320px] md:w-[360px] h-[390px] sm:h-[430px] rounded-3xl overflow-hidden cursor-pointer transition-all duration-500 ease-out shadow-2xl group flex flex-col justify-between select-none bg-[#1B082B]">
                         
                         <!-- Full Background Card Image with Gradient Overlay -->
                         <img :src="srv.img" :alt="srv.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-108">
                         <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                         
                         <!-- Top Category & Number Pill -->
                         <div class="relative z-10 p-5 flex items-center justify-between">
                             <span class="px-3 py-1 rounded-full bg-black/85 backdrop-blur-md border border-[#FF9420]/60 text-[11px] font-black text-[#FF9420] font-mono shadow-md"
                                   x-text="'0' + srv.id"></span>
                             <div class="w-9 h-9 rounded-2xl bg-[#FF9420] text-black flex items-center justify-center text-xs shadow-[0_0_15px_rgba(255,148,32,0.5)]">
                                 <i :class="srv.icon"></i>
                             </div>
                         </div>
                         
                         <!-- Bottom Content: Category, Title, Description, and Link Button -->
                         <div class="relative z-10 p-5 sm:p-6 space-y-2 text-right">
                             <div class="text-[10px] sm:text-[11px] font-bold text-[#FFBA70] uppercase tracking-wider" x-text="srv.category"></div>
                             <h3 class="text-base sm:text-xl font-black text-white group-hover:text-[#FF9420] transition-colors" x-text="srv.title"></h3>
                             <p class="text-[11px] sm:text-xs text-gray-200 line-clamp-2 leading-relaxed" x-text="srv.desc"></p>
                             
                             <div class="pt-2">
                                 <a :href="'{{ route('public.services') }}#' + srv.slug" 
                                    @click.stop
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black text-[11px] transition shadow-[0_0_20px_rgba(255,148,32,0.4)] active:scale-95">
                                     <span>عرض تفاصيل هذه الخدمة</span>
                                     <i class="fa-solid fa-arrow-left text-[9px]"></i>
                                 </a>
                             </div>
                         </div>
                         
                    </div>
                </template>
            </div>

            <!-- Bottom Navigation Controls: Arrows + Live 5s Countdown Bar -->
            <div class="flex items-center justify-center gap-5 sm:gap-7 mt-8">
                <!-- Prev Button -->
                <button type="button" @click="prev()" 
                        aria-label="الخدمة السابقة"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#1B082B] border-2 border-[#3E24C5]/70 hover:border-[#FF9420] hover:bg-[#FF9420] hover:text-black text-white flex items-center justify-center transition shadow-[0_0_20px_rgba(62,36,197,0.3)] active:scale-95">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

                <!-- Dual Visual Track: Current Service + Live 5s Countdown Bar -->
                <div class="flex flex-col items-center gap-2 w-56 sm:w-80">
                    <div class="flex items-center justify-between w-full text-[11px] font-mono">
                        <span class="font-black text-[#FF9420]" x-text="(activeIdx + 1 < 10 ? '0' : '') + (activeIdx + 1)">01</span>
                        <span class="text-[10px] text-[#FFBA70] flex items-center gap-1 font-sans">
                            <i class="fa-solid fa-clock-rotate-left text-[9px] animate-spin-slow"></i>
                            <span>تبديل تلقائي كل 5ث</span>
                        </span>
                        <span class="font-bold text-gray-300">10</span>
                    </div>
                    <!-- Dynamic 5-Second Countdown Track -->
                    <div class="w-full h-2 bg-black rounded-full overflow-hidden relative border border-[#3E24C5]/60 p-0.5">
                        <div class="h-full bg-gradient-to-r from-[#3E24C5] via-[#FF9420] to-[#FFBA70] rounded-full transition-all duration-100 ease-linear shadow-[0_0_10px_#FF9420]"
                             :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>

                <!-- Next Button -->
                <button type="button" @click="next()" 
                        aria-label="الخدمة التالية"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#1B082B] border-2 border-[#3E24C5]/70 hover:border-[#FF9420] hover:bg-[#FF9420] hover:text-black text-white flex items-center justify-center transition shadow-[0_0_20px_rgba(62,36,197,0.3)] active:scale-95">
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
<section id="portfolio-summary" class="py-20 bg-gradient-to-b from-[#080210] via-[#1B082B] to-[#0A0214] relative z-10 border-y-2 border-[#3E24C5]/40 shadow-[0_0_40px_rgba(62,36,197,0.2)] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="space-y-2">
            <span class="text-xs font-black text-[#FF9420] uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#FF9420]/15 border border-[#FF9420]/40 shadow-[0_0_15px_rgba(255,148,32,0.25)]">
                نماذج من أعمالنا
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-white">أعمالنا وسجل إنجازاتنا الموثق</h2>
            <p class="text-xs text-gray-300">بطاقات تفاعلية لأبرز إنتاجاتنا: انقر على أي بطاقة لتشغيل العمل فوراً</p>
        </div>

        <a href="{{ route('public.portfolio') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#1B082B] hover:bg-[#FF9420] hover:text-black text-[#FFBA70] font-black text-xs border-2 border-[#3E24C5]/70 hover:border-transparent transition shadow-[0_0_20px_rgba(62,36,197,0.3)]">
            <span>تصفح كامل المعرض الموثق</span>
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
        </a>
    </div>

    @if(isset($portfolioItems) && $portfolioItems->count() === 1)
        @php
            $singleItem = $portfolioItems->first();
            $thumbUrl = $singleItem->thumbnail;
            $finalThumb = $thumbUrl ? (str_starts_with($thumbUrl, 'http') ? $thumbUrl : asset(ltrim($thumbUrl, '/'))) : asset('images/portfolio/social_1.webp');
            $finalMedia = $singleItem->video_url ?: $finalThumb;
            $mediaType = $singleItem->video_url ? 'video' : ($singleItem->category === 'branding' ? 'branding' : 'image');
            $aspectType = $singleItem->category === 'reels' ? 'vertical' : 'landscape';
        @endphp
        <!-- Single Featured Item Spotlight Showcase (عرض العمل المنفرد كما تم إضافته بالـ CMS بدون تكرار مصطنع) -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="glass-card-purple rounded-3xl overflow-hidden border-2 border-[#FF9420] shadow-[0_0_50px_rgba(255,148,32,0.45)] group cursor-pointer transition-all duration-300 hover:scale-[1.01]"
                 @click="openMedia('{{ $mediaType }}', '{{ $finalMedia }}', '{{ addslashes($singleItem->title) }}', '{{ addslashes($singleItem->description ?? '') }}', '{{ $aspectType }}')">
                <div class="relative aspect-video bg-black/70 overflow-hidden">
                    <img src="{{ $finalThumb }}" alt="{{ $singleItem->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B082B] via-black/30 to-transparent"></div>
                    
                    @if($singleItem->video_url)
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="relative flex items-center justify-center">
                            <span class="absolute w-20 h-20 rounded-full bg-[#FF9420]/30 animate-radar"></span>
                            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-[#FF9420] to-[#FFBA70] text-black flex items-center justify-center text-xl shadow-[0_0_30px_rgba(255,148,32,0.6)] group-hover:scale-115 transition-transform duration-300">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="absolute bottom-3 left-3 w-10 h-10 rounded-xl bg-black/70 text-white flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition">
                        <i class="fa-solid fa-expand"></i>
                    </div>
                    @endif

                    <span class="absolute top-4 right-4 text-xs font-bold px-3.5 py-1.5 rounded-full bg-black/85 backdrop-blur text-[#FFBA70] border border-[#3E24C5]/60">
                        {{ $singleItem->category_arabic }}
                    </span>

                    @if($singleItem->metrics)
                    <span class="absolute top-4 left-4 text-xs font-bold px-3.5 py-1.5 rounded-full bg-[#FF9420] text-black shadow-lg font-black">
                        {{ $singleItem->metrics }}
                    </span>
                    @endif
                </div>

                <div class="p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-right">
                    <div>
                        <h3 class="text-lg sm:text-2xl font-black text-white group-hover:text-[#FF9420] transition-colors">
                            {{ $singleItem->title }}
                        </h3>
                        <div class="text-xs sm:text-sm text-[#FFBA70] font-bold mt-1">
                            {{ $singleItem->client_name }} @if($singleItem->client_country) • {{ $singleItem->client_country }} @endif
                        </div>
                        @if($singleItem->description)
                        <p class="text-xs text-gray-300 mt-2 line-clamp-2 max-w-2xl font-normal">{{ $singleItem->description }}</p>
                        @endif
                    </div>
                    <button type="button" class="shrink-0 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black text-xs shadow-lg group-hover:brightness-110 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-play text-xs"></i>
                        <span>تشغيل ومعاينة العمل</span>
                    </button>
                </div>
            </div>
        </div>
    @elseif(isset($portfolioItems) && $portfolioItems->count() > 1)
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
             dir="ltr"
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
                @foreach($portfolioItems as $item)
                @php
                    $thumbUrl = $item->thumbnail;
                    $finalThumb = $thumbUrl ? (str_starts_with($thumbUrl, 'http') ? $thumbUrl : asset(ltrim($thumbUrl, '/'))) : asset('images/portfolio/social_1.webp');
                    $finalMedia = $item->video_url ?: $finalThumb;
                    $mediaType = $item->video_url ? 'video' : ($item->category === 'branding' ? 'branding' : 'image');
                    $aspectType = $item->category === 'reels' ? 'vertical' : 'landscape';
                @endphp
                <div class="w-72 sm:w-80 flex-shrink-0 glass-card-purple rounded-2xl overflow-hidden border-2 border-[#3E24C5]/60 hover:border-[#FF9420] transition-all duration-300 group cursor-pointer shadow-[0_10px_30px_rgba(0,0,0,0.8)] hover:shadow-[0_0_35px_rgba(255,148,32,0.4)] hover:-translate-y-2 select-none"
                     @click="openMedia('{{ $mediaType }}', '{{ $finalMedia }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ $aspectType }}')">
                    
                    <div class="relative aspect-video bg-black/60 overflow-hidden">
                        <img src="{{ $finalThumb }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 pointer-events-none">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1B082B] via-transparent to-transparent opacity-80 pointer-events-none"></div>
                        
                        @if($item->video_url)
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#FF9420] to-[#FFBA70] text-black flex items-center justify-center text-sm shadow-[0_0_20px_rgba(255,148,32,0.6)] group-hover:scale-115 transition-transform">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        @else
                        <div class="absolute bottom-2 left-2 w-8 h-8 rounded-lg bg-black/70 text-white flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            <i class="fa-solid fa-expand"></i>
                        </div>
                        @endif

                        <span class="absolute top-2.5 right-2.5 text-[9px] font-bold px-2.5 py-1 rounded-full bg-black/85 backdrop-blur text-[#FFBA70] border border-[#FF9420]/40 pointer-events-none">
                            {{ $item->category_arabic }}
                        </span>
                    </div>

                    <div class="p-4 space-y-1.5 text-right pointer-events-none">
                        <h4 class="text-xs sm:text-sm font-black text-white group-hover:text-[#FF9420] transition-colors line-clamp-1">
                            {{ $item->title }}
                        </h4>
                        <div class="text-[10px] text-gray-400 font-medium">
                            {{ $item->client_name }} @if($item->client_country) • {{ $item->client_country }} @endif
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

        </div>

    </div>
    @endif
</section>

<!-- =========================================================================
     7. WORK PROCESS / METHODOLOGY (مراحل العمل بشكل ابداعي من خريطة الطريق المتعدد)
     ========================================================================= -->
<section id="process-summary" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-black text-[#FF9420] uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#FF9420]/15 border border-[#FF9420]/40 shadow-[0_0_15px_rgba(255,148,32,0.25)]">
            خريطة الطريق المتعددة للإنتاج
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">مراحل عملنا نحو نجاح علامتك</h2>
        <p class="text-xs sm:text-sm text-gray-300">مسار عمل منظم ومترابط يحول الأفكار إلى إنجازات مرئية ذات عائد حقيقي وملموس</p>
    </div>

    <!-- Creative Interactive Timeline Roadmap with Connected Nodes -->
    <div class="relative">
        
        <!-- Connecting Center Glowing Line (Desktop) -->
        <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-1.5 bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#3E24C5] -translate-y-1/2 z-0 opacity-80 shadow-[0_0_20px_rgba(255,148,32,0.4)]"></div>

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
            <div class="glass-card-purple rounded-3xl p-6 relative group hover:-translate-y-2 transition-all duration-300 border-2 border-[#3E24C5]/60 hover:border-[#FF9420] shadow-[0_10px_30px_rgba(0,0,0,0.8)] hover:shadow-[0_0_35px_rgba(255,148,32,0.4)] flex flex-col justify-between">
                
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-black text-[#FFBA70]/70 group-hover:text-[#FF9420] transition-colors font-mono">
                            {{ $st['num'] }}
                        </span>
                        <div class="w-10 h-10 rounded-xl bg-[#FF9420]/20 border border-[#FF9420]/50 text-[#FF9420] flex items-center justify-center text-sm group-hover:scale-110 group-hover:bg-[#FF9420] group-hover:text-black transition-all shadow-[0_0_15px_rgba(255,148,32,0.3)]">
                            <i class="{{ $st['icon'] }}"></i>
                        </div>
                    </div>

                    <div class="text-[10px] text-[#FFBA70] font-bold uppercase tracking-wider mb-1">{{ $st['step'] }}</div>
                    <h3 class="text-base font-black text-white group-hover:text-[#FF9420] transition-colors mb-2">
                        {{ $st['title'] }}
                    </h3>
                    
                    <p class="text-xs text-gray-200 leading-relaxed font-normal">
                        {{ $st['desc'] }}
                    </p>
                </div>

                <div class="pt-4 mt-4 border-t border-[#3E24C5]/40 flex items-center gap-1.5 text-[10px] text-gray-300 group-hover:text-[#FFBA70] transition-colors">
                    <i class="fa-solid fa-circle-check text-[#FF9420] text-[9px]"></i>
                    <span>مخرجات معتمدة وموثقة</span>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- =========================================================================
     8. GOO MEDIA 3D CIRCULAR ORBIT FEEDBACK & TESTIMONIALS (فيدباك دائري متحرك ثلاثي الأبعاد)
     (فيدباك منوع بين فيديو مقاس طولي وصور في شكل دائري متحرك شبة جو ميديا واللوجو في النص)
     ========================================================================= -->
<section id="testimonials-summary" class="py-24 bg-gradient-to-b from-[#080210] via-[#1B082B] to-[#0A0214] relative z-10 overflow-hidden border-t-2 border-[#3E24C5]/30">
    
    <!-- Ambient Orbital Background Lighting -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[600px] bg-gradient-to-tr from-[#FF9420]/20 via-[#3E24C5]/30 to-[#3F147E]/40 blur-[100px] rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-black text-[#FF9420] uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#FF9420]/15 border border-[#FF9420]/40 inline-flex items-center gap-2 shadow-[0_0_15px_rgba(255,148,32,0.25)]">
                <i class="fa-solid fa-sparkles text-[#FF9420]"></i>
                <span>قصص نجاح موثقة من شركائنا</span>
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                آراء العملاء وفيديوهات الفيدباك
            </h2>
            <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
                فيدباك منوع بين فيديوهات ريلز طولية وصور تقييمات موثقة من أصحاب الأعمال تروي قصص النجاح الحقيقية مع بريق
            </p>
        </div>

        @php
            $testimonialsList = [];
            $rawTestimonials = (isset($testimonials) && $testimonials->isNotEmpty()) ? $testimonials : collect();
            if ($rawTestimonials->isEmpty()) {
                $testimonialsList = [
                    [
                        'id' => 1,
                        'name' => 'أ. حسام الدين غانم',
                        'title' => 'مؤسس Shawrmaker',
                        'country' => 'عمان، الأردن',
                        'type' => 'video_reel',
                        'rating' => 5,
                        'thumb' => asset('images/portfolio/social_4.webp'),
                        'media' => asset('videos/food_commercial.mp4'),
                        'content' => 'شهادة وتجربة تصوير الفيديوهات الترويجية وزيادة المبيعات بنسبة 140%',
                    ],
                    [
                        'id' => 2,
                        'name' => 'د. عبد الرحمن المجيدي',
                        'title' => 'مجمع ماجستي الطبي',
                        'country' => 'الرياض، السعودية',
                        'type' => 'video_reel',
                        'rating' => 5,
                        'thumb' => asset('images/portfolio/ramez_qlight.webp'),
                        'media' => asset('videos/promo_reels_1.mp4'),
                        'content' => 'تجربة مضاعفة حجوزات العيادات بنسبة 180% خلال أول شهرين مع وكالة بريق',
                    ],
                    [
                        'id' => 3,
                        'name' => 'م. سيف النمر',
                        'title' => 'مدير تسويق شركة ألبان',
                        'country' => 'القاهرة، مصر',
                        'type' => 'text_review',
                        'rating' => 5,
                        'thumb' => null,
                        'media' => null,
                        'content' => 'الاحترافية في التزام مواعيد التسليم وتصميم الهوية الإعلانية جعلت بريق شريكنا الدائم لكافة علاماتنا التجارية. أنصح بهم بشدة لكل صاحب مشروع يريد نمواً حقيقياً.',
                    ],
                    [
                        'id' => 4,
                        'name' => 'أ. يوسف الكعبي',
                        'title' => 'مؤسس شركة Crystal Auto',
                        'country' => 'الدوحة، قطر',
                        'type' => 'video_reel',
                        'rating' => 5,
                        'thumb' => asset('images/portfolio/social_2.webp'),
                        'media' => asset('videos/bariq.mp4'),
                        'content' => 'أفضل جودة تصوير ومونتاج إعلانات تعاملت معها على الإطلاق. اهتمام مذهل بكل التفاصيل.',
                    ],
                    [
                        'id' => 5,
                        'name' => 'د. سارة المنصور',
                        'title' => 'المدير التنفيذي لمجموعة رحيق',
                        'country' => 'الكويت',
                        'type' => 'text_review',
                        'rating' => 5,
                        'thumb' => null,
                        'media' => null,
                        'content' => 'فريق مبدع ومتعاون جداً، الحملات الإعلانية حققت لنا مبيعات فاقت توقعاتنا للربع الأول.',
                    ],
                    [
                        'id' => 6,
                        'name' => 'م. طارق المهندس',
                        'title' => 'The Met Hub العقارية',
                        'country' => 'دبي، الإمارات',
                        'type' => 'video_reel',
                        'rating' => 5,
                        'thumb' => asset('images/portfolio/social_1.webp'),
                        'media' => asset('videos/bariq.webm'),
                        'content' => 'إتقان حقيقي لتصوير المعالم والمشاريع بأسلوب سينمائي فائق الاحترافية.',
                    ],
                ];
            } else {
                foreach ($rawTestimonials as $t) {
                    $tThumb = $t->thumbnail ? (str_starts_with($t->thumbnail, 'http') ? $t->thumbnail : asset(ltrim($t->thumbnail, '/'))) : null;
                    $tMedia = $t->media_url ? (str_starts_with($t->media_url, 'http') ? $t->media_url : asset(ltrim($t->media_url, '/'))) : null;
                    $testimonialsList[] = [
                        'id' => $t->id,
                        'name' => $t->client_name,
                        'title' => $t->client_title ?? '',
                        'country' => $t->client_country ?? '',
                        'type' => $t->type,
                        'rating' => $t->rating ?? 5,
                        'thumb' => $tThumb ?: asset('images/portfolio/social_4.webp'),
                        'media' => $tMedia,
                        'content' => $t->content,
                    ];
                }
            }
        @endphp

        <!-- GOO MEDIA 3D ORBIT INTERACTIVE COMPONENT -->
        <div x-data="{
                 items: {{ Js::from($testimonialsList) }},
                 angleOffset: 0,
                 isPaused: false,
                 orbitTimer: null,
                 activeMobileIdx: 0,
                 hoveredIdx: null,
                 initOrbit() {
                     // Continuous smooth orbital rotation
                     this.orbitTimer = setInterval(() => {
                         if (!this.isPaused) {
                             this.angleOffset = (this.angleOffset + 0.35) % 360;
                         }
                     }, 40);
                 },
                 getOrbitStyle(idx) {
                     const total = this.items.length;
                     const baseAngle = (idx * (360 / total)) + this.angleOffset;
                     const rad = (baseAngle * Math.PI) / 180;
                     
                     // Elliptical 3D radius
                     const rx = 390;
                     const ry = 190;
                     const x = Math.cos(rad) * rx;
                     const y = Math.sin(rad) * ry;
                     
                     // 3D Depth effects based on sin(rad)
                     const depth = Math.sin(rad); // -1 (back) to +1 (front)
                     const scale = 0.82 + ((depth + 1) * 0.16); // 0.82 to 1.14
                     const zIndex = Math.round(20 + ((depth + 1) * 15)); // 20 to 50
                     const opacity = 0.70 + ((depth + 1) * 0.15); // 0.70 to 1.0
                     
                     if (this.hoveredIdx === idx) {
                         return `transform: translate(-50%, -50%) translate3d(${x}px, ${y}px, 50px) scale(${scale * 1.15}); z-index: 60; opacity: 1;`;
                     }
                     
                     return `transform: translate(-50%, -50%) translate3d(${x}px, ${y}px, 0px) scale(${scale}); z-index: ${zIndex}; opacity: ${opacity};`;
                 },
                 rotateLeft() {
                     this.angleOffset = (this.angleOffset - (360 / this.items.length) + 360) % 360;
                 },
                 rotateRight() {
                     this.angleOffset = (this.angleOffset + (360 / this.items.length)) % 360;
                 }
             }"
             x-init="initOrbit()"
             class="relative select-none">

            <!-- DESKTOP 3D CIRCULAR ORBIT STAGE (Goo Media Style) -->
            <div class="hidden lg:block relative w-full h-[580px] my-6">
                
                <!-- Concentric Orbital Ring Tracks (SVG Radar/Solar Rings) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <!-- Outer Orbit Ring -->
                    <div class="w-[820px] h-[420px] rounded-[50%] border-2 border-[#3E24C5]/60 border-dashed animate-spin-slow shadow-[0_0_40px_rgba(62,36,197,0.3)] opacity-80"></div>
                    <!-- Mid Orbit Ring with Glowing Points -->
                    <div class="absolute w-[660px] h-[340px] rounded-[50%] border-2 border-[#FF9420]/50 shadow-[0_0_40px_rgba(255,148,32,0.25)]"></div>
                    <!-- Inner Orbit Ring -->
                    <div class="absolute w-[480px] h-[250px] rounded-[50%] border-2 border-[#3E24C5]/40 opacity-60"></div>
                </div>

                <!-- Center Glowing Pariq Logo Badge (نواة بريق المركزية المتوهجة) -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 flex flex-col items-center justify-center pointer-events-none">
                    <div class="relative w-32 h-32 rounded-full bg-gradient-to-tr from-[#FF9420] via-[#3E24C5] to-[#FFBA70] p-1.5 shadow-[0_0_80px_rgba(62,36,197,0.7),0_0_40px_rgba(255,148,32,0.5)] animate-pulse-glow flex items-center justify-center">
                        <div class="w-full h-full rounded-full bg-[#1B082B] flex flex-col items-center justify-center p-3 relative overflow-hidden">
                            <!-- Rotating Radar Sweep Line -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-[#FF9420]/25 to-transparent animate-spin-slow pointer-events-none"></div>
                            
                            <img src="{{ asset('images/logo.png') }}" alt="بريق للأعلام" class="w-14 h-14 object-contain filter drop-shadow-[0_4px_15px_rgba(255,148,32,0.6)]">
                            <span class="text-[10px] font-black text-[#FF9420] mt-1 tracking-wider uppercase font-mono">PARIQ</span>
                        </div>
                    </div>
                    <span class="text-xs font-black text-white mt-2 px-4 py-1.5 rounded-full bg-[#1B082B]/95 border-2 border-[#3E24C5]/60 shadow-[0_0_20px_rgba(62,36,197,0.35)] tracking-wide">
                        بريق للإعلام والتسويق
                    </span>
                </div>

                <!-- Satellite Orbiting Cards (Reels & Verified Testimonials) -->
                <div class="absolute inset-0">
                    <template x-for="(item, idx) in items" :key="item.id">
                        <div class="absolute top-1/2 left-1/2 cursor-pointer transition-all duration-300 ease-out select-none group/orbitCard"
                             :style="getOrbitStyle(idx)"
                             @mouseenter="isPaused = true; hoveredIdx = idx"
                             @mouseleave="isPaused = false; hoveredIdx = null"
                             @click="item.type === 'video_reel' ? openMedia('video', item.media, item.name, item.content, 'vertical') : openMedia('image', item.thumb, item.name, item.content, 'landscape')">
                            
                            <!-- Video Reel Card (Vertical 9:14 Aspect) -->
                            <template x-if="item.type === 'video_reel'">
                                <div class="w-56 glass-card-purple rounded-2xl overflow-hidden border-2 border-[#3E24C5]/70 group-hover/orbitCard:border-[#FF9420] shadow-2xl transition-all duration-300 bg-[#1B082B]/95 p-2.5 space-y-2 group-hover/orbitCard:shadow-[0_0_45px_rgba(255,148,32,0.6)]">
                                    <div class="relative aspect-[9/11] rounded-xl overflow-hidden bg-black/80 flex items-center justify-center">
                                        <img :src="item.thumb" :alt="item.name" class="w-full h-full object-cover group-hover/orbitCard:scale-108 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                                        
                                        <!-- Play Button -->
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-[#FF9420] to-[#FFBA70] text-black flex items-center justify-center text-sm shadow-[0_0_20px_rgba(255,148,32,0.6)] group-hover/orbitCard:scale-115 transition-transform duration-300">
                                                <i class="fa-solid fa-play mr-0.5"></i>
                                            </div>
                                        </div>

                                        <!-- Top Badge -->
                                        <span class="absolute top-2 right-2 px-2.5 py-0.5 rounded-full bg-black/85 backdrop-blur text-[9px] font-black text-[#FF9420] flex items-center gap-1 border border-[#FF9420]/50">
                                            <i class="fa-solid fa-mobile-screen"></i>
                                            <span>ريلز طولي</span>
                                        </span>
                                    </div>

                                    <div class="space-y-1 text-right px-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-xs font-black text-white group-hover/orbitCard:text-[#FF9420] transition-colors truncate" x-text="item.name"></h4>
                                            <div class="text-[#FF9420] text-[9px] flex gap-0.5">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="text-[10px] text-[#FFBA70] font-bold truncate" x-text="item.title + (item.country ? ' • ' + item.country : '')"></div>
                                        <p class="text-[10px] text-gray-200 line-clamp-1 italic" x-text="'«' + item.content + '»'"></p>
                                    </div>
                                </div>
                            </template>

                            <!-- Text / Image Review Card -->
                            <template x-if="item.type !== 'video_reel'">
                                <div class="w-60 glass-card-purple rounded-2xl border-2 border-[#3E24C5]/70 group-hover/orbitCard:border-[#FF9420] shadow-2xl transition-all duration-300 bg-[#1B082B]/95 p-4 space-y-2.5 group-hover/orbitCard:shadow-[0_0_45px_rgba(255,148,32,0.6)]">
                                    <div class="flex items-center justify-between">
                                        <span class="px-2.5 py-0.5 rounded-full bg-[#3E24C5]/30 text-[9px] font-bold text-[#FFBA70] border border-[#3E24C5]/60 flex items-center gap-1">
                                            <i class="fa-solid fa-comment-dots"></i>
                                            <span>تقييم موثق</span>
                                        </span>
                                        <div class="text-[#FF9420] text-[9px] flex gap-0.5">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>

                                    <p class="text-[11px] text-gray-200 line-clamp-3 leading-relaxed italic text-right" x-text="'«' + item.content + '»'"></p>

                                    <div class="pt-2 border-t border-[#3E24C5]/40 flex items-center gap-2.5 text-right">
                                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#FF9420] to-[#FFBA70] text-black font-black flex items-center justify-center text-xs shrink-0"
                                             x-text="item.name.charAt(0)"></div>
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-black text-white truncate group-hover/orbitCard:text-[#FF9420] transition-colors" x-text="item.name"></h4>
                                            <div class="text-[9px] text-gray-300 truncate" x-text="item.title + (item.country ? ' • ' + item.country : '')"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </template>
                </div>

                <!-- Orbital Interactive Controls -->
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 z-30 flex items-center gap-4 px-4 py-2 rounded-2xl bg-[#1B082B]/90 backdrop-blur-md border-2 border-[#3E24C5]/60 shadow-[0_0_25px_rgba(62,36,197,0.35)]">
                    <button type="button" @click="rotateLeft()" 
                            class="w-8 h-8 rounded-xl bg-[#000000] border border-[#3E24C5]/60 hover:bg-[#FF9420] hover:text-black text-white flex items-center justify-center text-xs transition" title="تدوير لليسار">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    
                    <button type="button" @click="isPaused = !isPaused" 
                            class="px-3 py-1.5 rounded-xl bg-[#FF9420]/15 border border-[#FF9420]/50 hover:bg-[#FF9420] hover:text-black text-[#FFBA70] text-[11px] font-bold flex items-center gap-1.5 transition">
                        <i class="fa-solid" :class="isPaused ? 'fa-play text-emerald-400' : 'fa-pause text-amber-400'"></i>
                        <span x-text="isPaused ? 'استئناف الدوران' : 'إيقاف مؤقت'"></span>
                    </button>
                    
                    <button type="button" @click="rotateRight()" 
                            class="w-8 h-8 rounded-xl bg-[#000000] border border-[#3E24C5]/60 hover:bg-[#FF9420] hover:text-black text-white flex items-center justify-center text-xs transition" title="تدوير لليمين">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </div>

            </div>

            <!-- MOBILE & TABLET RESPONSIVE ORBIT CAROUSEL (< 1024px) -->
            <div class="lg:hidden space-y-6">
                <!-- Mobile Center Glowing Logo with Pulsing Rings -->
                <div class="flex flex-col items-center justify-center py-4 relative">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-brand-orange to-amber-400 p-1 shadow-[0_0_40px_rgba(255,148,32,0.6)] animate-pulse-glow flex items-center justify-center">
                        <div class="w-full h-full rounded-full bg-[#0D031A] flex flex-col items-center justify-center p-2">
                            <img src="{{ asset('images/logo.png') }}" alt="بريق" class="w-12 h-12 object-contain">
                        </div>
                    </div>
                    <span class="text-xs font-black text-brand-orange mt-2">بريق للإعلام والتسويق</span>
                </div>

                <!-- Mobile Active Card Showcase -->
                <div class="relative max-w-sm mx-auto">
                    <template x-for="(item, idx) in items" :key="'mob-' + item.id">
                        <div x-show="activeMobileIdx === idx" 
                             x-transition:enter="transition ease-out duration-300 transform"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="glass-card-purple rounded-3xl p-5 border-2 border-brand-orange shadow-2xl space-y-4 cursor-pointer"
                             @click="item.type === 'video_reel' ? openMedia('video', item.media, item.name, item.content, 'vertical') : openMedia('image', item.thumb, item.name, item.content, 'landscape')">
                            
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-black"
                                      :class="item.type === 'video_reel' ? 'bg-amber-500/20 text-brand-orange border border-brand-orange/40' : 'bg-purple-500/20 text-purple-300 border border-purple-500/40'">
                                    <i class="fa-solid" :class="item.type === 'video_reel' ? 'fa-mobile-screen' : 'fa-comment-dots'"></i>
                                    <span x-text="item.type === 'video_reel' ? 'فيديو ريلز طولي' : 'تقييم موثق'"></span>
                                </span>
                                <div class="text-brand-orange text-xs flex gap-0.5">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                            </div>

                            <template x-if="item.thumb">
                                <div class="relative aspect-video rounded-2xl overflow-hidden bg-black/80 flex items-center justify-center">
                                    <img :src="item.thumb" :alt="item.name" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                        <div class="w-12 h-12 rounded-full bg-brand-orange text-brand-dark flex items-center justify-center text-sm shadow-xl">
                                            <i class="fa-solid fa-play mr-0.5"></i>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <p class="text-xs text-gray-200 italic leading-relaxed text-right" x-text="'«' + item.content + '»'"></p>

                            <div class="pt-3 border-t border-purple-800/40 flex items-center justify-between text-right">
                                <div>
                                    <h4 class="text-sm font-black text-white" x-text="item.name"></h4>
                                    <span class="text-xs text-brand-peach font-bold" x-text="item.title + (item.country ? ' • ' + item.country : '')"></span>
                                </div>
                                <span class="text-[11px] font-bold text-brand-orange">انقر للمعاينة ←</span>
                            </div>
                        </div>
                    </template>

                    <!-- Mobile Navigation Arrows & Dots -->
                    <div class="flex items-center justify-between mt-6 px-2">
                        <button type="button" 
                                @click="activeMobileIdx = (activeMobileIdx - 1 + items.length) % items.length" 
                                class="w-10 h-10 rounded-xl bg-purple-950 border border-purple-700/60 text-white flex items-center justify-center">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        
                        <div class="flex items-center gap-1.5">
                            <template x-for="(item, idx) in items" :key="'dot-' + idx">
                                <span @click="activeMobileIdx = idx"
                                      class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                      :class="activeMobileIdx === idx ? 'w-6 bg-brand-orange' : 'w-2 bg-purple-800/60'"></span>
                            </template>
                        </div>

                        <button type="button" 
                                @click="activeMobileIdx = (activeMobileIdx + 1) % items.length" 
                                class="w-10 h-10 rounded-xl bg-purple-950 border border-purple-700/60 text-white flex items-center justify-center">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     9. WHY CHOOSE BARIQ (باند ليه تختار بريق - تفاعلي فائق الحركة والديناميكية)
     ========================================================================= -->
<section class="py-20 relative z-10 border-t border-purple-900/40"
         x-data="{ 
             activeStep: 1, 
             autoPlay: true, 
             stepTimer: null,
             init() {
                 this.stepTimer = setInterval(() => {
                     if (this.autoPlay) {
                         this.activeStep = (this.activeStep % 4) + 1;
                     }
                 }, 2800);
             }
         }"
         @mouseenter="autoPlay = false"
         @mouseleave="autoPlay = true">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Unified Luxury Interactive Card -->
        <div class="glass-card-purple rounded-3xl p-8 sm:p-14 border border-brand-orange/50 shadow-[0_0_50px_rgba(255,148,32,0.15)] hover:border-brand-orange transition-all duration-500 relative overflow-hidden text-center space-y-10 group/card">
            
            <!-- Ambient Background Energy Gradients -->
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-brand-orange/15 blur-3xl pointer-events-none group-hover/card:bg-brand-orange/20 transition-all duration-700"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-purple-600/25 blur-3xl pointer-events-none group-hover/card:bg-purple-600/30 transition-all duration-700"></div>

            <!-- Headline & Subtitle with Dynamic Micro-Badge -->
            <div class="space-y-3 relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-brand-orange/10 border border-brand-orange/30 text-brand-orange text-[11px] font-black tracking-widest uppercase">
                    <span class="w-2 h-2 rounded-full bg-brand-orange animate-ping"></span>
                    <span>منهجية العمل المتكاملة</span>
                </div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-normal">
                    جاهز نخلي علامتك تظهر بشكل مختلف؟
                </h2>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto leading-relaxed">
                    تواصل معنا اليوم ودعنا نحول أفكارك إلى واقع يحقق أهدافك
                </p>
            </div>

            <!-- Connected Horizontal Timeline with Flowing Laser Pulse (تسلسل عمليات متناسق) -->
            <div class="relative pt-4 pb-6 z-10">
                
                <!-- Center Horizontal Connected Line with Flowing Laser & Progress Beam (Desktop) -->
                <!-- يبدأ من منتصف المربع الأول 01 وينتهي عند منتصف المربع الأخير 04 بدون أي بروز خارجي -->
                <div class="hidden md:block absolute top-[5.25rem] -translate-y-1/2 right-[12.5%] left-[12.5%] h-1.5 sm:h-2 bg-[#1B0A33] rounded-full overflow-hidden z-0 border border-purple-800/50 shadow-inner">
                    <!-- Flowing Infinite Electric Laser Beam (حركة أنيميشن مستمرة تتدفق عبر تسلسل العمليات من الخطوة 1 إلى 4) -->
                    <div class="pipeline-laser-beam absolute top-0 h-full w-32 sm:w-44 bg-gradient-to-l from-transparent via-[#FFE3B8] via-[#FF9420] to-transparent"></div>
                    
                    <!-- Dynamic Progress Bar based on active step (RTL: يمتد من اليمين لليسار حسب الخطوة النشطة) -->
                    <div class="absolute top-0 right-0 h-full bg-gradient-to-l from-brand-orange via-amber-400 to-brand-peach transition-all duration-700 ease-out rounded-full shadow-[0_0_15px_#FF9420]"
                         :style="'width: ' + (((activeStep - 1) / 3) * 100) + '%;'"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 relative z-10">
                    
                    <!-- Step 1: تواصل مباشر -->
                    <div @mouseenter="activeStep = 1; autoPlay = false"
                         @click="activeStep = 1"
                         class="flex flex-col items-center text-center px-2 pt-1 pb-3 cursor-pointer select-none group/step relative">
                        
                        <!-- Step Pill Badge -->
                        <div class="h-6 flex items-center justify-center mb-2">
                            <span class="text-[10px] font-mono font-black px-2.5 py-0.5 rounded-full border transition-all duration-300"
                                  :class="activeStep === 1 ? 'bg-brand-orange text-brand-dark border-brand-orange shadow-[0_0_12px_#FF9420]' : 'bg-[#140526] text-gray-400 border-purple-800/60'">
                                01
                            </span>
                        </div>

                        <!-- Icon Container with Animated Ping & Subtle Glow (بدون أي مربع كبير محيط) -->
                        <div class="relative w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center z-10 my-0.5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-xl sm:text-2xl font-black transition-all duration-300"
                                 :class="activeStep === 1 ? 'scale-110 ring-4 ring-amber-400/80 shadow-[0_0_28px_rgba(255,148,32,0.9)] bg-gradient-to-tr from-brand-orange to-amber-300 text-brand-dark' : 'scale-100 ring-2 ring-purple-900/60 bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark opacity-90 group-hover/step:opacity-100 group-hover/step:scale-105'">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                            <span x-show="activeStep === 1" 
                                  x-transition.opacity
                                  class="absolute -inset-1 rounded-2xl bg-brand-orange/40 animate-ping pointer-events-none"></span>
                        </div>

                        <div class="mt-3 space-y-1">
                            <h4 class="text-xs sm:text-sm font-black transition-colors duration-300"
                                :class="activeStep === 1 ? 'text-brand-orange drop-shadow' : 'text-white'">
                                تواصل مباشر
                            </h4>
                            <p class="text-[10px] sm:text-[11px] transition-colors duration-300 leading-snug"
                               :class="activeStep === 1 ? 'text-white font-bold' : 'text-gray-300'">
                                نرد بسرعة ونفهم احتياجك
                            </p>
                        </div>
                    </div>

                    <!-- Step 2: تنفيذ سريع -->
                    <div @mouseenter="activeStep = 2; autoPlay = false"
                         @click="activeStep = 2"
                         class="flex flex-col items-center text-center px-2 pt-1 pb-3 cursor-pointer select-none group/step relative">
                        
                        <div class="h-6 flex items-center justify-center mb-2">
                            <span class="text-[10px] font-mono font-black px-2.5 py-0.5 rounded-full border transition-all duration-300"
                                  :class="activeStep === 2 ? 'bg-brand-orange text-brand-dark border-brand-orange shadow-[0_0_12px_#FF9420]' : 'bg-[#140526] text-gray-400 border-purple-800/60'">
                                02
                            </span>
                        </div>

                        <div class="relative w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center z-10 my-0.5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-xl sm:text-2xl font-black transition-all duration-300"
                                 :class="activeStep === 2 ? 'scale-110 ring-4 ring-amber-400/80 shadow-[0_0_28px_rgba(255,148,32,0.9)] bg-gradient-to-tr from-brand-orange to-amber-300 text-brand-dark' : 'scale-100 ring-2 ring-purple-900/60 bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark opacity-90 group-hover/step:opacity-100 group-hover/step:scale-105'">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <span x-show="activeStep === 2" 
                                  x-transition.opacity
                                  class="absolute -inset-1 rounded-2xl bg-brand-orange/40 animate-ping pointer-events-none"></span>
                        </div>

                        <div class="mt-3 space-y-1">
                            <h4 class="text-xs sm:text-sm font-black transition-colors duration-300"
                                :class="activeStep === 2 ? 'text-brand-orange drop-shadow' : 'text-white'">
                                تنفيذ سريع
                            </h4>
                            <p class="text-[10px] sm:text-[11px] transition-colors duration-300 leading-snug"
                               :class="activeStep === 2 ? 'text-white font-bold' : 'text-gray-300'">
                                خطوات واضحة دون تأخير
                            </p>
                        </div>
                    </div>

                    <!-- Step 3: تحقيق الهدف -->
                    <div @mouseenter="activeStep = 3; autoPlay = false"
                         @click="activeStep = 3"
                         class="flex flex-col items-center text-center px-2 pt-1 pb-3 cursor-pointer select-none group/step relative">
                        
                        <div class="h-6 flex items-center justify-center mb-2">
                            <span class="text-[10px] font-mono font-black px-2.5 py-0.5 rounded-full border transition-all duration-300"
                                  :class="activeStep === 3 ? 'bg-brand-orange text-brand-dark border-brand-orange shadow-[0_0_12px_#FF9420]' : 'bg-[#140526] text-gray-400 border-purple-800/60'">
                                03
                            </span>
                        </div>

                        <div class="relative w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center z-10 my-0.5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-xl sm:text-2xl font-black transition-all duration-300"
                                 :class="activeStep === 3 ? 'scale-110 ring-4 ring-amber-400/80 shadow-[0_0_28px_rgba(255,148,32,0.9)] bg-gradient-to-tr from-brand-orange to-amber-300 text-brand-dark' : 'scale-100 ring-2 ring-purple-900/60 bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark opacity-90 group-hover/step:opacity-100 group-hover/step:scale-105'">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <span x-show="activeStep === 3" 
                                  x-transition.opacity
                                  class="absolute -inset-1 rounded-2xl bg-brand-orange/40 animate-ping pointer-events-none"></span>
                        </div>

                        <div class="mt-3 space-y-1">
                            <h4 class="text-xs sm:text-sm font-black transition-colors duration-300"
                                :class="activeStep === 3 ? 'text-brand-orange drop-shadow' : 'text-white'">
                                تحقيق الهدف
                            </h4>
                            <p class="text-[10px] sm:text-[11px] transition-colors duration-300 leading-snug"
                               :class="activeStep === 3 ? 'text-white font-bold' : 'text-gray-300'">
                                خطة ملموسة لعلامتك
                            </p>
                        </div>
                    </div>

                    <!-- Step 4: إبداع بلا حدود -->
                    <div @mouseenter="activeStep = 4; autoPlay = false"
                         @click="activeStep = 4"
                         class="flex flex-col items-center text-center px-2 pt-1 pb-3 cursor-pointer select-none group/step relative">
                        
                        <div class="h-6 flex items-center justify-center mb-2">
                            <span class="text-[10px] font-mono font-black px-2.5 py-0.5 rounded-full border transition-all duration-300"
                                  :class="activeStep === 4 ? 'bg-brand-orange text-brand-dark border-brand-orange shadow-[0_0_12px_#FF9420]' : 'bg-[#140526] text-gray-400 border-purple-800/60'">
                                04
                            </span>
                        </div>

                        <div class="relative w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center z-10 my-0.5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-xl sm:text-2xl font-black transition-all duration-300"
                                 :class="activeStep === 4 ? 'scale-110 ring-4 ring-amber-400/80 shadow-[0_0_28px_rgba(255,148,32,0.9)] bg-gradient-to-tr from-brand-orange to-amber-300 text-brand-dark' : 'scale-100 ring-2 ring-purple-900/60 bg-gradient-to-tr from-[#FF7A00] to-brand-orange text-brand-dark opacity-90 group-hover/step:opacity-100 group-hover/step:scale-105'">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                            </div>
                            <span x-show="activeStep === 4" 
                                  x-transition.opacity
                                  class="absolute -inset-1 rounded-2xl bg-brand-orange/40 animate-ping pointer-events-none"></span>
                        </div>

                        <div class="mt-3 space-y-1">
                            <h4 class="text-xs sm:text-sm font-black transition-colors duration-300"
                                :class="activeStep === 4 ? 'text-brand-orange drop-shadow' : 'text-white'">
                                إبداع بلا حدود
                            </h4>
                            <p class="text-[10px] sm:text-[11px] transition-colors duration-300 leading-snug"
                               :class="activeStep === 4 ? 'text-white font-bold' : 'text-gray-300'">
                                أفكار تسويقية مبتكرة
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Golden Action CTA Button with Ambient Glow and Shimmer -->
            <div class="pt-2 relative z-10 flex justify-center">
                <a href="{{ route('public.contact') }}" 
                   class="relative inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-sm hover:brightness-110 active:scale-95 transition-all duration-300 shadow-[0_0_35px_rgba(255,148,32,0.45)] hover:shadow-[0_0_55px_rgba(255,148,32,0.7)] group overflow-hidden">
                    <!-- Subtle Internal Shimmer -->
                    <span class="shimmer-sweep pointer-events-none"></span>
                    <span class="relative z-10">تواصل معنا الآن</span>
                    <i class="fa-solid fa-paper-plane relative z-10 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- =========================================================================
     10. DIRECT CONSULTATION FORM ON HOMEPAGE
     ========================================================================= -->
<section id="contact-summary" class="py-14 sm:py-20 bg-gradient-to-b from-[#080210] via-[#1B082B] to-[#000000] border-t-2 border-[#3E24C5]/40 shadow-[0_-10px_40px_rgba(62,36,197,0.25)] relative z-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card-purple rounded-2xl sm:rounded-[2rem] p-5 sm:p-10 lg:p-14 shadow-2xl relative overflow-hidden border-2 border-[#3E24C5]/60 hover:border-[#FF9420] transition-colors">
            
            <div class="text-center max-w-xl mx-auto mb-10 space-y-3 relative z-10">
                <span class="text-xs font-black text-[#FF9420] uppercase tracking-widest px-4 py-1.5 rounded-full bg-[#FF9420]/15 border border-[#FF9420]/50 shadow-[0_0_15px_rgba(255,148,32,0.3)]">
                    ابدأ قصة نجاح علامتك اليوم
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white">احصل على استشارة تسويقية وعرض سعر فوري</h2>
                <p class="text-xs sm:text-sm text-gray-300">أخبرنا بما تحتاجه وسيتواصل معك مستشار وكالة بريق لمناقشة خطة العمل المخصصة لمشروعك.</p>
            </div>

            <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-5 text-xs relative z-10">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-200 mb-2">اسمك الكريم <span class="text-[#FF9420]">*</span></label>
                        <input type="text" name="name" required placeholder="محمد أحمد" 
                               class="w-full px-4 py-3.5 bg-[#1B082B]/90 border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-200 mb-2">اسم البراند أو النشاط التجاري</label>
                        <input type="text" name="brand_name" placeholder="اسم علامتك التجارية" 
                               class="w-full px-4 py-3.5 bg-[#1B082B]/90 border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-200 mb-2">رقم الهاتف أو الواتساب <span class="text-[#FF9420]">*</span></label>
                        <input type="text" name="phone" required placeholder="+2010... أو +966..." 
                               class="w-full px-4 py-3.5 bg-[#1B082B]/90 border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-200 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="example@brand.com" 
                               class="w-full px-4 py-3.5 bg-[#1B082B]/90 border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-gray-200 mb-2">الخدمة التي تهمك أكثر</label>
                        <select name="service_interested" 
                                class="w-full px-4 py-3.5 bg-[#1B082B] border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                            <option value="تصوير ومونتاج فيديو ريلز 4K">تصوير ومونتاج فيديو ريلز وسينما 4K</option>
                            <option value="إعلانات ممولة وميديا باينج">إعلانات ممولة وميديا باينج (Meta, TikTok)</option>
                            <option value="تصميمات جرافيك وبناء هوية بصرية">تصميمات جرافيك وبناء هوية بصرية</option>
                            <option value="إدارة كاملة لحسابات السوشيال ميديا">إدارة كاملة لحسابات السوشيال ميديا</option>
                            <option value="استشارة وبناء خطة تسويقية كاملة">استشارة وبناء خطة تسويقية كاملة</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-200 mb-2">الميزانية المتوقعة للمشروع</label>
                        <select name="budget_range" 
                                class="w-full px-4 py-3.5 bg-[#1B082B] border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition">
                            <option value="أقل من 10,000 ج.م">أقل من 10,000 ج.م</option>
                            <option value="10,000 - 25,000 ج.م">10,000 - 25,000 ج.م</option>
                            <option value="25,000 - 50,000 ج.م">25,000 - 50,000 ج.م</option>
                            <option value="أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)">أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-200 mb-2">أخبرنا بنبذة عن أهدافك ورؤيتك</label>
                    <textarea name="message" rows="3" placeholder="اكتب لنا ملخصاً سريعاً عما تود تحقيقه لعلامتك التجارية..." 
                              class="w-full px-4 py-3.5 bg-[#1B082B]/90 border-2 border-[#3E24C5]/50 focus:border-[#FF9420] rounded-2xl text-white text-xs focus:outline-none focus:ring-2 focus:ring-[#FF9420]/40 transition"></textarea>
                </div>

                <button type="submit" 
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] text-black font-black text-sm hover:brightness-110 shadow-[0_0_35px_rgba(255,148,32,0.55)] transition flex items-center justify-center gap-2.5 active:scale-95">
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

    /* Flowing Laser / Energy Beam across Timeline */
    @keyframes flowingEnergy {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .energy-beam-line {
        background: linear-gradient(90deg, rgba(255,148,32,0.1) 0%, rgba(255,148,32,0.85) 50%, rgba(255,186,112,0.2) 100%);
        background-size: 200% 100%;
        animation: flowingEnergy 2.4s linear infinite;
    }

    /* Shimmer Sweep on Golden Action Buttons */
    @keyframes shimmerSweep {
        0% { transform: translateX(-150%) skewX(-20deg); }
        100% { transform: translateX(250%) skewX(-20deg); }
    }
    .shimmer-sweep {
        position: absolute;
        inset: 0;
        width: 50%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.45), transparent);
        animation: shimmerSweep 3.2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    // Particle Canvas Animation for Hero Background with Vibrant Pariq Palette
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
        const count = 55;
        const colors = ['#FF9420', '#FFBA70', '#3E24C5', '#3F147E', '#BC6200'];

        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                radius: Math.random() * 2.8 + 1.2,
                color: colors[Math.floor(Math.random() * colors.length)],
                vx: (Math.random() - 0.5) * 0.65,
                vy: (Math.random() - 0.5) * 0.65,
                alpha: Math.random() * 0.7 + 0.3
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

                // Connect nearby particles with luminous gradient stroke
                for (let j = i + 1; j < particles.length; j++) {
                    const p2 = particles[j];
                    const dist = Math.hypot(p.x - p2.x, p.y - p2.y);
                    if (dist < 120) {
                        ctx.save();
                        ctx.globalAlpha = (1 - dist / 120) * 0.32;
                        ctx.strokeStyle = (i % 2 === 0) ? '#FF9420' : '#3E24C5';
                        ctx.lineWidth = 0.8;
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
</script>
@endpush
