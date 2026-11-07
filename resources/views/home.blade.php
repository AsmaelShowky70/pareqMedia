<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وكالة بريق للإعلام والتصميم | نصنع لعلامتك التجارية بريقاً استثنائياً</title>
    
    @include('partials.pwa-meta')
    
    <meta name="description" content="وكالة بريق حلول تسويق إلكتروني وتصميم جرافيك متكاملة مع تصوير ومونتاج فيديو احترافي سينمائي، تصميم هويات بصرية، وإعلانات ممولة في مصر والسعودية والخليج.">
    <meta name="keywords" content="بريق, وكالة بريق, تصميم جرافيك, تصوير سينمائي, مونتاج ريلز, هوية بصرية, اعلانات ممولة, pariq agency, creative studio">

    <!-- Fonts: Cairo & Space Grotesk for Numbers -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS with custom Pariq Violet-Orange Palette -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { 
                        cairo: ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            void: '#05010A',
                            dark: '#08020F',
                            darker: '#0C0317',
                            deep: '#120522',
                            purple: '#1B0733',
                            purpleLight: '#260B46',
                            card: '#1F0B38',
                            hover: '#2D1050',
                            border: '#3F166F',
                            borderGlow: 'rgba(168, 85, 247, 0.35)',
                            orange: '#FF5E00',
                            amber: '#FF9500',
                            yellow: '#F59E0B',
                            gold: '#FBBF24',
                            goldLight: '#FDE68A',
                        }
                    },
                    animation: {
                        'float-slow': 'floatSlow 7s ease-in-out infinite',
                        'float-reverse': 'floatReverse 8s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 4s ease-in-out infinite',
                        'radar': 'radarWave 2.5s cubic-bezier(0, 0.2, 0.8, 1) infinite',
                        'shimmer': 'textShimmer 4s ease-in-out infinite alternate',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js 3.x -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary-orange: #FF6A00;
            --primary-amber: #FF9E0B;
            --primary-gold: #FBBF24;
            --primary-purple: #160728;
            --purple-glow: rgba(147, 51, 234, 0.3);
            --amber-glow: rgba(245, 158, 11, 0.3);
        }

        body { 
            font-family: 'Cairo', sans-serif; 
            background-color: #06010D; 
            color: #F3F4F6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Ambient Cursor Light Following Mouse */
        #ambient-cursor-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, rgba(147, 51, 234, 0.1) 40%, transparent 70%);
            filter: blur(40px);
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        @media (hover: hover) and (pointer: fine) {
            #ambient-cursor-glow { opacity: 1; }
        }

        /* Top Laser Progress Bar */
        #scroll-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #FF5E00 0%, #FF9500 50%, #FBBF24 100%);
            box-shadow: 0 0 14px rgba(245, 158, 11, 0.9), 0 0 24px rgba(255, 94, 0, 0.6);
            z-index: 9999;
            transition: width 0.1s ease-out;
        }

        /* Liquid Shimmer Text */
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFF1C5 0%, #FBBF24 25%, #F59E0B 55%, #FF6A00 85%, #FBBF24 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 5s linear infinite;
        }

        .purple-gradient-text {
            background: linear-gradient(135deg, #E9D5FF 0%, #C084FC 50%, #A855F7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes textShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Glow Spheres in Background */
        .glow-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(130px);
            z-index: 0;
            will-change: transform;
        }

        @keyframes floatSlow {
            0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
            33% { transform: translate(30px, -25px) scale(1.08) rotate(3deg); }
            66% { transform: translate(-20px, 20px) scale(0.95) rotate(-2deg); }
        }

        @keyframes floatReverse {
            0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
            33% { transform: translate(-30px, 25px) scale(1.06) rotate(-3deg); }
            66% { transform: translate(25px, -20px) scale(0.94) rotate(2deg); }
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.65; transform: scale(1); }
            50% { opacity: 0.95; transform: scale(1.05); }
        }

        /* Radar Pulse Animation */
        @keyframes radarWave {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* Audio Visualizer Jumping Bars */
        @keyframes soundEqualizer {
            0%, 100% { height: 6px; }
            50% { height: 26px; }
        }
        .eq-bar-1 { animation: soundEqualizer 0.8s ease-in-out infinite 0.1s; }
        .eq-bar-2 { animation: soundEqualizer 1.1s ease-in-out infinite 0.3s; }
        .eq-bar-3 { animation: soundEqualizer 0.7s ease-in-out infinite 0.2s; }
        .eq-bar-4 { animation: soundEqualizer 1.2s ease-in-out infinite 0.4s; }
        .eq-bar-5 { animation: soundEqualizer 0.9s ease-in-out infinite 0.15s; }

        /* Rotating Conic Border for Hero Showreel Teaser */
        .conic-glow-border {
            position: relative;
            z-index: 1;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.6), rgba(168, 85, 247, 0.7), rgba(255, 94, 0, 0.6));
            box-shadow: 0 0 35px rgba(245, 158, 11, 0.2), 0 0 60px rgba(147, 51, 234, 0.15);
            transition: all 0.4s ease;
        }
        .conic-glow-border:hover {
            box-shadow: 0 0 45px rgba(245, 158, 11, 0.4), 0 0 85px rgba(147, 51, 234, 0.3);
            transform: translateY(-4px);
        }

        /* Marquee Motion */
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(50%); }
        }
        .marquee-track {
            display: flex;
            width: 200%;
            animation: marquee 32s linear infinite;
        }
        .marquee-track:hover {
            animation-play-state: paused;
        }

        /* Scroll Reveal System */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(35px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-100 { transition-delay: 0.1s; }
        .reveal-delay-200 { transition-delay: 0.2s; }
        .reveal-delay-300 { transition-delay: 0.3s; }
        .reveal-delay-400 { transition-delay: 0.4s; }

        /* Luminous Section Transition Gradients */
        .section-gradient-divider {
            position: relative;
            width: 100%;
            height: 100px;
            pointer-events: none;
            overflow: hidden;
            z-index: 10;
        }

        /* Glassmorphism Classes */
        .glass-card-purple {
            background: linear-gradient(135deg, rgba(31, 11, 56, 0.65) 0%, rgba(18, 5, 34, 0.85) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(147, 51, 234, 0.25);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.7);
        }
        .glass-card-purple:hover {
            border-color: rgba(245, 158, 11, 0.5);
            box-shadow: 0 25px 50px -12px rgba(245, 158, 11, 0.18), 0 0 30px rgba(147, 51, 234, 0.2);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-track { background: #06010D; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #3F166F 0%, #FF9500 100%); 
            border-radius: 4px; 
        }
        ::-webkit-scrollbar-thumb:hover { background: #FBBF24; }
    </style>
</head>

<body class="bg-brand-void text-gray-100 overflow-x-hidden selection:bg-brand-amber selection:text-brand-dark" 
      x-data="{ 
          mobileNav: false, 
          activeFilter: 'all', 
          activeServiceCategory: 'all',
          activeFaq: 0,
          previewModal: false, 
          showBackToTop: false,
          currentSection: 'hero',
          activeMedia: { type: '', src: '', embedSrc: '', title: '', desc: '' },
          openMedia(mediaType, src, title, desc) {
              let type = mediaType;
              let embed = '';
              if (type === 'video' && src) {
                  const ytMatch = src.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/);
                  if (ytMatch) {
                      type = 'youtube';
                      embed = 'https://www.youtube-nocookie.com/embed/' + ytMatch[1] + '?autoplay=1&rel=0';
                  } else if (src.includes('vimeo.com/')) {
                      const vimeoMatch = src.match(/vimeo\.com\/(?:video\/)?(\d+)/);
                      if (vimeoMatch) {
                          type = 'vimeo';
                          embed = 'https://player.vimeo.com/video/' + vimeoMatch[1] + '?autoplay=1';
                      }
                  } else if (src.includes('drive.google.com/file/d/')) {
                      const gdMatch = src.match(/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/);
                      if (gdMatch) {
                          type = 'iframe';
                          embed = 'https://drive.google.com/file/d/' + gdMatch[1] + '/preview';
                      }
                  } else {
                      type = 'video';
                      embed = src;
                  }
              }
              this.activeMedia = { type: type, src: src, embedSrc: embed, title: title, desc: desc };
              this.previewModal = true;
          },
          closeMedia() {
              this.previewModal = false;
              this.activeMedia = { type: '', src: '', embedSrc: '', title: '', desc: '' };
          }
      }"
      @scroll.window="showBackToTop = (window.pageYOffset > 400)">

    <!-- Ambient Cursor Glow Spotlight Follower -->
    <div id="ambient-cursor-glow"></div>

    <!-- Top Laser Scroll Progress Indicator -->
    <div id="scroll-progress-bar"></div>

    <!-- Floating Background Glowing Orbs (Orange & Purple Energy Field) -->
    <div class="glow-orb w-[650px] h-[650px] bg-purple-900/30 -top-40 -right-40 animate-float-slow"></div>
    <div class="glow-orb w-[550px] h-[550px] bg-amber-500/15 top-[28rem] -left-48 animate-float-reverse"></div>
    <div class="glow-orb w-[750px] h-[750px] bg-purple-950/40 top-[70rem] right-10 animate-float-slow"></div>
    <div class="glow-orb w-[600px] h-[600px] bg-orange-600/10 top-[120rem] left-1/4 animate-pulse-glow"></div>
    <div class="glow-orb w-[800px] h-[800px] bg-purple-900/25 top-[180rem] -right-40 animate-float-reverse"></div>
    <div class="glow-orb w-[650px] h-[650px] bg-amber-600/15 bottom-40 left-10 animate-float-slow"></div>

    <!-- FLOATING SIDE SECTION SCROLLSPY DOCK (تنقل سينمائي سلس بين السكاشن) -->
    <nav class="hidden 2xl:flex fixed left-6 top-1/2 -translate-y-1/2 z-40 flex-col items-center gap-3 bg-[#130526]/85 backdrop-blur-xl border border-purple-800/40 py-4 px-2.5 rounded-full shadow-2xl">
        <a href="#hero" class="group relative flex items-center justify-center w-7 h-7" title="الرئيسية">
            <span class="w-2.5 h-2.5 rounded-full bg-brand-gold shadow-[0_0_8px_rgba(251,191,36,0.8)] transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">01. الرئيسية</span>
        </a>
        <a href="#services" class="group relative flex items-center justify-center w-7 h-7" title="خدماتنا">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">02. خدماتنا المتكاملة</span>
        </a>
        <a href="#process" class="group relative flex items-center justify-center w-7 h-7" title="مراحل العمل">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">03. مراحل العمل والإنتاج</span>
        </a>
        <a href="#portfolio" class="group relative flex items-center justify-center w-7 h-7" title="معرض الأعمال">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">04. معرض الأعمال الموثق</span>
        </a>
        <a href="#clients" class="group relative flex items-center justify-center w-7 h-7" title="شركاء النجاح">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">05. شركاء النجاح</span>
        </a>
        <a href="#testimonials" class="group relative flex items-center justify-center w-7 h-7" title="آراء العملاء">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">06. آراء وتقييمات العملاء</span>
        </a>
        <a href="#faq" class="group relative flex items-center justify-center w-7 h-7" title="الأسئلة الشائعة">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">07. الأسئلة الشائعة</span>
        </a>
        <a href="#contact" class="group relative flex items-center justify-center w-7 h-7" title="طلب استشارة">
            <span class="w-2 h-2 rounded-full bg-gray-500 group-hover:bg-brand-amber transition-all group-hover:scale-125"></span>
            <span class="absolute left-9 px-3 py-1 bg-brand-card text-brand-gold text-xs font-bold rounded-lg opacity-0 pointer-events-none group-hover:opacity-100 transition whitespace-nowrap shadow-lg border border-purple-800/50">08. تواصل معنا وعرض سعر</span>
        </a>
    </nav>

    <!-- 1. HEADER & GLASSMORPHIC NAVBAR -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#08020F]/85 backdrop-blur-2xl border-b border-purple-900/30 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Identity Logo with Ambient Glow -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                <div class="relative flex items-center justify-center">
                    <span class="absolute -inset-1.5 rounded-2xl bg-gradient-to-r from-brand-orange to-brand-gold opacity-30 group-hover:opacity-75 blur-md transition duration-300"></span>
                    <img src="{{ asset('images/logo.png') }}" alt="بريق للتسويق والتصميم" class="relative h-12 w-auto object-contain drop-shadow group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black gold-gradient-text tracking-wide leading-none">بريق</span>
                    <span class="text-[9px] text-brand-amber font-extrabold tracking-widest mt-0.5 uppercase">Creative Media Agency</span>
                </div>
            </a>

            <!-- Desktop Nav Links with Hover Underline Glow -->
            <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-xs font-bold text-gray-300">
                <a href="#hero" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>الرئيسية</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#services" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>خدماتنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#process" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>منهجية العمل</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#portfolio" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>معرض الأعمال</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#clients" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>عملاؤنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#testimonials" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>آراء العملاء</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#faq" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>الأسئلة الشائعة</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
                <a href="#contact" class="relative py-2 hover:text-brand-gold transition-colors duration-200 group">
                    <span>تواصل معنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-gold scale-x-0 group-hover:scale-x-100 transition-transform origin-right duration-300"></span>
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2.5 rounded-xl bg-purple-900/60 hover:bg-purple-800/80 border border-purple-500/30 text-purple-200 font-bold text-xs transition duration-200 shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-gauge-high text-brand-gold"></i>
                    <span>لوحة التحكم</span>
                </a>
                @endauth

                <a href="#contact" 
                   class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-xs font-black rounded-xl group bg-gradient-to-br from-brand-orange via-brand-amber to-brand-gold shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40 transition-all duration-300">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-200 bg-brand-dark/30 rounded-[10px] group-hover:bg-opacity-0 text-white flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-brand-gold group-hover:rotate-12 transition-transform"></i>
                        <span>طلب استشارة مجانية</span>
                    </span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center gap-2 lg:hidden">
                @auth
                <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-xl bg-brand-amber text-brand-dark font-black text-xs flex items-center gap-1 shadow">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>اللوحة</span>
                </a>
                @endauth
                <button @click="mobileNav = !mobileNav" class="text-gray-300 hover:text-brand-gold p-2 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown with Smooth Transitions -->
        <div x-show="mobileNav" 
             @click.away="mobileNav = false" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-[#110423]/95 backdrop-blur-2xl border-b border-purple-800/50 px-6 py-5 space-y-3.5 text-sm font-bold shadow-2xl">
            
            @auth
            <a href="{{ route('dashboard') }}" @click="mobileNav = false" class="w-full py-3 px-4 rounded-xl bg-gradient-to-l from-brand-amber to-brand-gold text-brand-dark font-black text-center flex items-center justify-center gap-2 shadow">
                <i class="fa-solid fa-gauge-high"></i>
                <span>الانتقال للوحة التحكم وإدارة المهام</span>
            </a>
            @endauth

            <a href="#hero" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">الرئيسية</a>
            <a href="#services" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">خدماتنا المتكاملة</a>
            <a href="#process" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">منهجية العمل</a>
            <a href="#portfolio" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">معرض الأعمال</a>
            <a href="#clients" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">عملاؤنا</a>
            <a href="#testimonials" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">آراء العملاء</a>
            <a href="#faq" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">الأسئلة الشائعة</a>
            <a href="#contact" @click="mobileNav = false" class="block py-1.5 hover:text-brand-gold transition-colors">تواصل معنا</a>
            <div class="pt-3 border-t border-purple-800/40">
                <a href="#contact" @click="mobileNav = false" class="block py-3 text-center rounded-xl bg-gradient-to-r from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-xs shadow-lg">
                    طلب استشارة تسويقية مجانية فوراً
                </a>
            </div>
        </div>
    </header>

    <!-- 2. HERO SECTION (قمة الإبداع البصري والأنيميشن التفاعلي) -->
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

        <!-- FLOATING 3D CREATIVE DESIGN BADGES (عناصر تصميم عائمة ثلاثية الأبعاد) -->
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
                <a href="#portfolio" 
                   class="px-8 py-4 rounded-2xl bg-gradient-to-l from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 active:scale-95 transition shadow-2xl shadow-amber-500/30 flex items-center gap-3 group">
                    <span class="w-6 h-6 rounded-full bg-black/20 flex items-center justify-center group-hover:scale-110 transition-transform"><i class="fa-solid fa-play text-xs text-brand-dark"></i></span>
                    <span>استكشف معرض الأعمال الحقيقي</span>
                </a>

                <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" target="_blank" 
                   class="px-8 py-4 rounded-2xl bg-[#19092E]/80 hover:bg-[#250C44] border border-purple-500/40 hover:border-brand-gold text-white font-bold text-sm transition shadow-lg flex items-center gap-2.5 backdrop-blur-md">
                    <i class="fa-brands fa-whatsapp text-emerald-400 text-lg"></i>
                    <span>استشارة مجانية عبر واتساب</span>
                </a>
            </div>

            <!-- HERO CENTERPIECE: INTERACTIVE SHOWREEL TEASER CARD (فيديو شو ريل تفاعلي مبهر) -->
            <div class="pt-8 max-w-3xl mx-auto">
                <div class="conic-glow-border cursor-pointer group"
                     @click="openMedia('video', '{{ asset('videos/promo_reels_1.mp4') }}', 'شو ريل بريق للإعلام والتصميم 2026', 'لقطات سينمائية مختارة ومونتاج إعلاني لأبرز شركاء النجاح في الوطن العربي')">
                    
                    <div class="relative rounded-[1.4rem] bg-[#0E031A] overflow-hidden aspect-[21/9] sm:aspect-[2.4/1] flex items-center justify-center p-6">
                        
                        <!-- Video poster / Ambient Background with Grid -->
                        <div class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:scale-105 group-hover:opacity-55 transition-all duration-700" 
                             style="background-image: url('{{ asset('images/portfolio/ramez_qlight.webp') }}');"></div>
                        
                        <!-- Purple-Amber Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0E031A] via-[#160627]/80 to-transparent"></div>

                        <!-- Top Tag -->
                        <div class="absolute top-4 right-4 z-20 flex items-center gap-2 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-purple-500/30 text-[10px] text-brand-gold font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>PARIQ SHOWREEL • سينما 4K</span>
                        </div>

                        <!-- Center Play Button with Triple Radar Waves -->
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

                        <!-- Bottom Audio Equalizer Waveform Indicator -->
                        <div class="absolute bottom-4 left-4 z-20 flex items-end gap-1.5 h-6">
                            <span class="w-1 bg-brand-gold rounded-full eq-bar-1"></span>
                            <span class="w-1 bg-brand-amber rounded-full eq-bar-2"></span>
                            <span class="w-1 bg-purple-400 rounded-full eq-bar-3"></span>
                            <span class="w-1 bg-brand-gold rounded-full eq-bar-4"></span>
                            <span class="w-1 bg-emerald-400 rounded-full eq-bar-5"></span>
                            <span class="text-[10px] text-gray-300 font-mono ml-2">4K • 60 FPS AUDIO</span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- LIVE ANIMATED STATS COUNTER BAR (أرقام وإحصائيات موثقة تزيد بسلاسة) -->
            <div x-data="pariqStatsCounter()" 
                 x-init="initObserver($el)"
                 class="pt-10 space-y-4">
                
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>إحصائيات موثقة تتحدث بالتزامن مع إنجازات الوكالة اليومية</span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Stat 1 -->
                    <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center font-mono">
                            <span>+</span><span x-text="projects">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1.5 font-bold">مشروع مكتمل بنجاح</div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-2xl bg-purple-500/20 border border-purple-500/40 text-purple-300 flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-white flex items-center justify-center font-mono">
                            <span>+</span><span x-text="clients">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1.5 font-bold">عميل سعيد في 6 دول</div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="p-6 rounded-3xl glass-card-purple transition-all duration-300 group hover:-translate-y-1">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-500/15 border border-yellow-500/30 text-yellow-400 flex items-center justify-center mx-auto mb-3 text-xl group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center font-mono">
                            <span>+</span><span x-text="years">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1.5 font-bold">سنوات خبرة متواصلة</div>
                    </div>

                    <!-- Stat 4 -->
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

    <!-- SECTION COLOR GRADIENT TRANSITION 1 (Hero -> Ticker & Services) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-16 bg-gradient-to-b from-brand-void via-[#100320] to-[#16062C]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
    </div>

    <!-- 3. AMBIENT MOVING MARQUEE TICKER (شريط سينمائي متحرك) -->
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
            <span class="text-brand-yellow">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-crown text-brand-gold"></i> بريق ، مفتاح نجاحك في التسويق</span>
        </div>
    </div>

    <!-- 4. SERVICES SECTION (خدمات إبداعية مع تدرج لوني وبطاقات تفاعلية) -->
    <section id="services" class="py-24 bg-gradient-to-b from-[#16062C] via-[#1B0736] to-[#120425] relative z-10">
        
        <!-- Subtle radial amber aura behind services -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            
            <div class="text-center max-w-2xl mx-auto mb-12 space-y-3 reveal-on-scroll">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    خبراتنا وقدراتنا الإبداعية
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">خدماتنا التسويقية والإبداعية المتكاملة</h2>
                <p class="text-xs sm:text-sm text-gray-300">نغطي كافة مراحل الإنتاج الرقمي تحت سقف واحد بأعلى معايير الإتقان الفني والتجاري.</p>
            </div>

            <!-- Services Filter Tabs with Amber Pill Active State -->
            <div class="flex flex-wrap items-center justify-center gap-3 mb-14 reveal-on-scroll reveal-delay-100">
                <button type="button" @click="activeServiceCategory = 'all'" 
                        :class="activeServiceCategory === 'all' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#1F0A38] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-grid-2"></i>
                    <span>جميع الخدمات (6)</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'video'" 
                        :class="activeServiceCategory === 'video' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#1F0A38] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-video text-amber-400"></i>
                    <span>التصوير والمونتاج السينمائي</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'design'" 
                        :class="activeServiceCategory === 'design' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#1F0A38] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-bezier-curve text-purple-300"></i>
                    <span>التصميم وبناء الهويات</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'marketing'" 
                        :class="activeServiceCategory === 'marketing' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#1F0A38] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-emerald-400"></i>
                    <span>الإعلانات الممولة وإدارة النمو</span>
                </button>
            </div>

            @php
                $staticServices = [
                    [
                        'id' => 'shooting',
                        'title' => 'تصوير فيديو سينمائي احترافي 4K',
                        'category' => 'video',
                        'category_name' => 'تصوير سينمائي',
                        'icon' => 'fa-solid fa-video',
                        'icon_color' => 'text-amber-400',
                        'icon_bg' => 'bg-amber-500/15 border-amber-500/30',
                        'desc' => 'تصوير سينمائي عالي الجودة 4K بأحدث الكاميرات والمعدات وطاقم متخصص لإبراز تفاصيل منتجاتك وعلامتك التجارية بأعلى جاذبية.',
                        'features' => ['كاميرات سينمائية 4K وعدسات فاخرة', 'طاقم تصوير وإضاءة وهندسة صوت كاملة', 'تصوير جوي درون بدقة فائقة', 'سكريبت ومودبورد تحضيري متقن'],
                        'price' => '3,500',
                    ],
                    [
                        'id' => 'editing',
                        'title' => 'مونتاج ريلز وبرومو سينمائي سريع',
                        'category' => 'video',
                        'category_name' => 'مونتاج وهوية فيديو',
                        'icon' => 'fa-solid fa-film',
                        'icon_color' => 'text-purple-300',
                        'icon_bg' => 'bg-purple-500/20 border-purple-500/40',
                        'desc' => 'مونتاج ريلز وبروموهات خاطفة للأنظار مع تصحيح ألوان سينمائي، مؤثرات صوتية تحبس الأنفاس، وموشن جرافيك لزيادة مدة المشاهدة والانتشار.',
                        'features' => ['ريلز وشورتس بفكرة الـ Hook السريع', 'تصحيح ألوان سينمائي (Color Grading)', 'هندسة ومؤثرات صوتية محفزة (SFX)', 'تسليم سريع مع تطبيق التعديلات المطلوبة'],
                        'price' => '2,000',
                    ],
                    [
                        'id' => 'design',
                        'title' => 'تصميمات جرافيك وبناء الهويات البصرية',
                        'category' => 'design',
                        'category_name' => 'تصميم وهوية',
                        'icon' => 'fa-solid fa-bezier-curve',
                        'icon_color' => 'text-yellow-400',
                        'icon_bg' => 'bg-yellow-500/15 border-yellow-500/30',
                        'desc' => 'تصميمات سوشيال ميديا استثنائية، أغلفة يوتيوب مصغرة ترفع الـ CTR، وتصميم شعارات وهوية تجارية كاملة بأعلى دقة فنية.',
                        'features' => ['أغلفة يوتيوب CTR لرفع نسب النقر للمشاهدة', 'بوستات سوشيال ميديا وكاروسيل تثقيفي', 'تصميم لوجو ودليل الهوية الكامل (Brand Guidelines)', 'ملفات مفتوحة قابلة للطباعة والنشر'],
                        'price' => '1,500',
                    ],
                    [
                        'id' => 'ads',
                        'title' => 'الإعلانات الممولة وميديا باينج (ROAS)',
                        'category' => 'marketing',
                        'category_name' => 'إعلانات ونمو',
                        'icon' => 'fa-solid fa-chart-line',
                        'icon_color' => 'text-emerald-400',
                        'icon_bg' => 'bg-emerald-500/15 border-emerald-500/30',
                        'desc' => 'إدارة حملات احترافية على Meta, TikTok, Google بحساب دقيق للعائد على الإنفاق (ROAS) واستراتيجيات لاستهداف الشريحة الأكثر شراءً.',
                        'features' => ['إعلانات Meta (انستجرام وفيسبوك) بذكاء', 'إعلانات TikTok لتحقيق الفيرال والمبيعات', 'استهداف الجماهير الأكثر استعداداً للشراء', 'تقارير دورية وشفافة لمعدل العائد المالي'],
                        'price' => '4,000',
                    ],
                    [
                        'id' => 'social',
                        'title' => 'إدارة كاملة لحسابات السوشيال ميديا',
                        'category' => 'marketing',
                        'category_name' => 'إدارة المحتوى',
                        'icon' => 'fa-solid fa-share-nodes',
                        'icon_color' => 'text-orange-400',
                        'icon_bg' => 'bg-orange-500/15 border-orange-500/30',
                        'desc' => 'تولي كامل لإدارة منصاتك الرقمية: خطة محتوى شهرية، النشر في الأوقات الذهبية، كتابة الكابشنز، ومتابعة نمو الحسابات والتفاعل.',
                        'features' => ['خطة نشر شهرية شاملة 30 يوم', 'نشر وجدولة بالأوقات الذهبية للجمهور', 'كتابة نصوص تسويقية مقنعة (Copywriting)', 'تحليل المنافسين وزيادة المتابعين الحقيقيين'],
                        'price' => '5,000',
                    ],
                    [
                        'id' => 'strategy',
                        'title' => 'إعداد الخطط التسويقية والاستشارات',
                        'category' => 'marketing',
                        'category_name' => 'استراتيجية وخطط',
                        'icon' => 'fa-solid fa-lightbulb',
                        'icon_color' => 'text-amber-300',
                        'icon_bg' => 'bg-amber-500/15 border-amber-500/30',
                        'desc' => 'دراسة السوق ومنافسيك لبناء استراتيجية انطلاق تسويقية شاملة تقود علامتك لاحتلال الصدارة وتوليد طلب مستمر.',
                        'features' => ['تحليل شامل لنقاط القوة والفرص التنافسية', 'تحديد شريحة العملاء المثالية (Persona)', 'هندسة العروض التسويقية المربحة', 'جلسات استشارية ومتابعة خطة العمل'],
                        'price' => '3,000',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($staticServices as $srv)
                <div x-show="activeServiceCategory === 'all' || activeServiceCategory === '{{ $srv['category'] }}'"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="glass-card-purple rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    
                    <!-- Top subtle glowing corner gradient -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-amber-500/10 to-transparent pointer-events-none rounded-tr-3xl"></div>

                    <div class="space-y-4 relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl {{ $srv['icon_bg'] }} border {{ $srv['icon_color'] }} flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300 shadow-md">
                                <i class="{{ $srv['icon'] }}"></i>
                            </div>
                            <span class="text-[11px] font-bold text-brand-gold bg-brand-yellow/10 px-3 py-1 rounded-full border border-brand-yellow/20">
                                {{ $srv['category_name'] }}
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-white group-hover:text-brand-gold transition-colors leading-snug">
                            {{ $srv['title'] }}
                        </h3>

                        <p class="text-xs text-gray-300 leading-relaxed font-normal">
                            {{ $srv['desc'] }}
                        </p>

                        <!-- Features bullets with glowing checkmarks -->
                        <div class="space-y-2 pt-3 border-t border-purple-800/40 text-xs text-gray-300">
                            @foreach($srv['features'] as $feat)
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-check text-brand-amber text-xs"></i>
                                <span>{{ $feat }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-purple-800/40 flex items-center justify-between text-xs relative z-10">
                        <div>
                            <span class="text-[10px] text-gray-400 block font-medium">تبدأ الباقات من:</span>
                            <span class="text-brand-gold font-black text-base font-mono">
                                {{ $srv['price'] }} <span class="text-xs font-sans">ج.م</span>
                            </span>
                        </div>
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20خدمة:%20{{ urlencode($srv['title']) }}" 
                           target="_blank"
                           class="px-4 py-2.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black transition flex items-center gap-2 shadow-lg shadow-amber-500/20 hover:brightness-110 active:scale-95">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>طلب الخدمة</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION COLOR GRADIENT TRANSITION 2 (Services -> Work Process) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#120425] via-[#0E031D] to-[#0A0216]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-purple-500/40 to-transparent"></div>
    </div>

    <!-- 5. OUR 8-STEP CONNECTED WORK PROCESS (مسار العمل الإبداعي المتصل) -->
    <section id="process" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
            <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                منهجية العمل المعتمدة
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white">مراحل عملنا نحو نجاح علامتك التجارية</h2>
            <p class="text-xs sm:text-sm text-gray-300">مسار عمل واضح ومنظم يضمن تحويل الأفكار إلى إنجازات مرئية ذات عائد حقيقي وملموس.</p>
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
                <!-- Connected energy node accent -->
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

                <!-- Bottom accent bar -->
                <div class="mt-4 pt-3 border-t border-purple-800/30 flex items-center justify-between text-[10px] text-gray-400">
                    <span class="group-hover:text-brand-amber transition-colors font-bold">خطوة معتمدة في بريق</span>
                    <i class="fa-solid fa-arrow-left text-brand-gold opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- SECTION COLOR GRADIENT TRANSITION 3 (Process -> Portfolio) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#0A0216] via-[#140526] to-[#1A0733]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
    </div>

    <!-- 6. REAL PORTFOLIO & WORK SHOWCASE (معرض الأعمال الحقيقي مع أنيميشن الفلترة) -->
    <section id="portfolio" class="py-24 bg-gradient-to-b from-[#1A0733] via-[#1F0A3C] to-[#130527] relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12 space-y-3 reveal-on-scroll">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    سجل إنجازاتنا الفعلي الموثق
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">معرض أعمال بريق الحقيقي</h2>
                <p class="text-xs sm:text-sm text-gray-300">نماذج حقيقية من تصميماتنا، أغلفة اليوتيوب عالية النقر، نتائج الحملات الإعلانية، وفيديوهات الإنتاج السينمائي.</p>
            </div>

            <!-- Category Filter Pills with Smooth Transitions -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12 reveal-on-scroll reveal-delay-100">
                <button type="button" @click="activeFilter = 'all'" 
                        :class="activeFilter === 'all' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    جميع الأعمال
                </button>
                <button type="button" @click="activeFilter = 'youtube_thumbnail'" 
                        :class="activeFilter === 'youtube_thumbnail' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    أغلفة يوتيوب مصغرة (CTR)
                </button>
                <button type="button" @click="activeFilter = 'ad_results'" 
                        :class="activeFilter === 'ad_results' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    نتائج الحملات الإعلانية الموثقة
                </button>
                <button type="button" @click="activeFilter = 'social_design'" 
                        :class="activeFilter === 'social_design' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    تصميمات سوشيال ميديا
                </button>
                <button type="button" @click="activeFilter = 'branding'" 
                        :class="activeFilter === 'branding' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    تصميم لوجو وهويات بصرية
                </button>
                <button type="button" @click="activeFilter = 'video_reels'" 
                        :class="activeFilter === 'video_reels' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                        class="px-4 py-2 rounded-xl text-xs transition-all duration-200">
                    فيديوهات ريلز وسينما
                </button>
            </div>

            <!-- Portfolio Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($portfolioItems as $item)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $item->category }}'"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="glass-card-purple rounded-3xl overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-2xl flex flex-col justify-between">
                    
                    <div>
                        <!-- Thumbnail Box with Zoom & Radar Play -->
                        <div class="relative aspect-video bg-black/60 flex items-center justify-center overflow-hidden cursor-pointer"
                             @click="openMedia('{{ $item->video_url ? 'video' : 'image' }}', '{{ $item->video_url ?: asset($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}')">
                            
                            @if($item->thumbnail)
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-[#140626] via-black/25 to-transparent z-10"></div>
                            
                            @if($item->video_url)
                            <!-- Video Play Icon with Radar Ring -->
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

                            <!-- Category Badge -->
                            <span class="absolute top-3 right-3 z-20 text-[10px] font-bold px-3 py-1 rounded-full bg-brand-dark/90 backdrop-blur-md text-brand-gold border border-purple-500/30">
                                {{ $item->category_arabic }}
                            </span>
                        </div>

                        <!-- Card Body -->
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
                <!-- Fallback Mock Cards if portfolio table is empty -->
                <div class="col-span-full py-12 text-center text-gray-400">
                    <i class="fa-solid fa-sparkles text-3xl text-brand-gold mb-3"></i>
                    <p class="text-sm">يتم تحديث قائمة الأعمال الإبداعية بصورة دورية...</p>
                </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- SECTION COLOR GRADIENT TRANSITION 4 (Portfolio -> Clients) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#130527] via-[#0E031E] to-[#070110]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-purple-500/40 to-transparent"></div>
    </div>

    <!-- 7. REAL CLIENTS & PARTNERS WALL (شركاء النجاح المعتمدون) -->
    <section id="clients" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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

    <!-- SECTION COLOR GRADIENT TRANSITION 5 (Clients -> Testimonials) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#070110] via-[#120424] to-[#180730]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
    </div>

    <!-- 8. CLIENT TESTIMONIALS & REVIEWS (آراء وتقييمات شركاء النجاح) -->
    <section id="testimonials" class="py-24 bg-gradient-to-b from-[#180730] via-[#1E093C] to-[#140528] relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
                <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                    قصص نجاح نعتز بها
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white">ماذا يقول عملاؤنا عن العمل معنا؟</h2>
                <p class="text-xs sm:text-sm text-gray-300">شهادات موثقة من أصحاب الشركات والمؤسسات التي ساهمنا في نمو علاماتهم التجارية</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
                <!-- Review 1 -->
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

                <!-- Review 2 -->
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

                <!-- Review 3 -->
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

    <!-- SECTION COLOR GRADIENT TRANSITION 6 (Testimonials -> FAQ) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#140528] via-[#0E031E] to-[#080212]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-purple-500/40 to-transparent"></div>
    </div>

    <!-- 9. FAQ ACCORDION SECTION (الأسئلة الأكثر شيوعاً) -->
    <section id="faq" class="py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3 reveal-on-scroll">
            <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
                إجابات واضحة وسريعة
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-white">الأسئلة الشائعة حول خدماتنا</h2>
            <p class="text-xs sm:text-sm text-gray-300">كل ما تحتاج لمعرفته حول طريقة العمل والأسعار وسرعة البدء والتسليم</p>
        </div>

        <div class="space-y-4">
            @php
                $faqs = [
                    [
                        'q' => 'ما هي الخطوات للبدء في مشروع جديد مع بريق؟',
                        'a' => 'تبدأ الخطوات بطلب استشارة مجانية عبر النموذج أو الواتساب، ثم نعقد جلسة اكتشاف سريعة لفهم أهدافك، ونقدم لك خطة عمل مخصصة وعرض سعر فوري. بمجرد الاعتماد، يبدأ فريقنا فوراً في كتابة السكريبتات والتجهيز للتصوير والإنتاج.'
                    ],
                    [
                        'q' => 'هل تقدمون خدمات التصوير والمونتاج خارج مصر؟',
                        'a' => 'نعم بالتأكيد! لدينا عملاء في السعودية والأردن والإمارات وقطر وعُمان. نوفر طواقم تصوير ميدانية، بالإضافة إلى خدمات المونتاج السحابي عن بُعد وإدارة الحملات الإعلانية لكافة الدول العربية.'
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
                        'q' => 'ما هي طرق الدفع والتعاقد المتاحة؟',
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

    <!-- SECTION COLOR GRADIENT TRANSITION 7 (FAQ -> Contact) -->
    <div class="relative w-full overflow-hidden leading-none z-10">
        <div class="h-20 bg-gradient-to-b from-[#080212] via-[#110321] to-[#19062F]"></div>
        <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
    </div>

    <!-- 10. CONSULTATION & CONTACT FORM (نموذج الاستشارة المضيء والفوري) -->
    <section id="contact" class="py-24 bg-gradient-to-b from-[#19062F] via-[#21093E] to-[#0A0216] relative z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="glass-card-purple rounded-[2rem] p-8 sm:p-14 shadow-2xl relative overflow-hidden border border-purple-500/40">
                
                <!-- Glowing Ambient Accent inside card -->
                <div class="absolute -top-24 -right-24 w-60 h-60 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-60 h-60 bg-purple-600/30 rounded-full blur-3xl pointer-events-none"></div>

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
                                <option value="تصوير ومونتاج فيديو ريلز">تصوير ومونتاج فيديو ريلز وسينما 4K</option>
                                <option value="إعلانات ممولة وميديا باينج">إعلانات ممولة وميديا باينج (Meta, TikTok)</option>
                                <option value="تصميمات جرافيك وهوية بصرية">تصميمات جرافيك وبناء هوية بصرية</option>
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

            </div>

        </div>
    </section>

    <!-- 11. FOOTER -->
    <footer class="bg-brand-void border-t border-purple-900/50 py-14 px-4 sm:px-6 lg:px-8 relative z-10 text-xs text-gray-400">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-right">
            
            <div class="flex items-center gap-3.5">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-10 w-auto object-contain">
                <div>
                    <div class="text-xl font-black gold-gradient-text">بريق للتسويق الإلكتروني والتصميم</div>
                    <div class="text-[11px] text-gray-400 mt-0.5">مفتاح نجاحك في التسويق والإبداع • جميع الحقوق محفوظة © {{ date('Y') }}</div>
                </div>
            </div>

            <!-- Social Media Channels with Neon Hover Halos -->
            <div class="flex items-center gap-3 text-lg">
                <a href="https://wa.me/201062330838?text=مرحباً%20بريق" target="_blank" class="w-10 h-10 rounded-xl bg-purple-950/60 hover:bg-emerald-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://facebook.com" target="_blank" class="w-10 h-10 rounded-xl bg-purple-950/60 hover:bg-blue-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="w-10 h-10 rounded-xl bg-purple-950/60 hover:bg-pink-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://tiktok.com" target="_blank" class="w-10 h-10 rounded-xl bg-purple-950/60 hover:bg-white hover:text-black border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            </div>

        </div>
    </footer>

    <!-- 12. FLOATING WHATSAPP CONSULTATION WIDGET (زر واتساب العائم بنبضات الرادار) -->
    <div id="pariq-whatsapp-floating" class="fixed bottom-6 right-4 sm:right-6 z-40 flex items-center group">
        <!-- Interactive Tooltip Pill -->
        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
           target="_blank" 
           class="hidden sm:flex items-center gap-2 px-4 py-2 ml-3 rounded-full bg-[#18082B]/95 border border-emerald-500/40 text-white text-xs font-bold shadow-2xl backdrop-blur-md transform transition-all group-hover:scale-105 group-hover:border-emerald-400">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>طلب استشارة فورية عبر واتساب 💬</span>
        </a>

        <!-- Glowing Pulse WhatsApp Action Button -->
        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
           target="_blank" 
           aria-label="تواصل مع بريق عبر واتساب"
           class="relative w-14 h-14 rounded-full bg-gradient-to-tr from-[#128C7E] to-[#25D366] text-white flex items-center justify-center text-2xl shadow-2xl shadow-emerald-500/30 hover:scale-110 active:scale-95 transition-all duration-300">
            <span class="absolute inset-0 rounded-full bg-emerald-400/30 animate-ping -z-10"></span>
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <!-- 13. FLOATING BACK TO TOP BUTTON -->
    <button type="button" 
            x-show="showBackToTop" 
            x-transition 
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            aria-label="الرجوع للأعلى"
            class="fixed bottom-24 right-5 sm:right-7 z-40 w-11 h-11 rounded-full bg-[#1A0833]/90 border border-purple-600/40 hover:border-brand-gold text-brand-gold hover:text-white flex items-center justify-center text-sm shadow-xl backdrop-blur-md hover:scale-110 active:scale-95 transition-all" 
            style="display: none;">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- 14. UNIVERSAL PREVIEW MODAL (LIGHTBOX FOR VIDEOS & IMAGES) -->
    <div x-show="previewModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl" 
         style="display: none;">
        
        <div @click.away="closeMedia()" 
             class="w-full max-w-4xl glass-card-purple rounded-[2rem] p-6 shadow-2xl relative space-y-4 border border-purple-500/50">
            
            <button @click="closeMedia()" 
                    class="absolute -top-12 left-0 text-white hover:text-brand-gold text-2xl transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Media Container -->
            <div class="aspect-video bg-black rounded-2xl overflow-hidden flex items-center justify-center relative shadow-inner">
                <template x-if="previewModal && activeMedia.type === 'video'">
                    <video :src="activeMedia.src" controls autoplay playsinline class="w-full h-full object-contain"></video>
                </template>
                <template x-if="previewModal && (activeMedia.type === 'youtube' || activeMedia.type === 'vimeo' || activeMedia.type === 'iframe')">
                    <iframe :src="activeMedia.embedSrc" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </template>
                <template x-if="previewModal && activeMedia.type === 'image'">
                    <img :src="activeMedia.src" :alt="activeMedia.title" class="w-full h-full object-contain">
                </template>
            </div>

            <div class="space-y-1 text-right">
                <h3 class="text-lg font-black text-white" x-text="activeMedia.title"></h3>
                <p class="text-xs text-gray-300" x-text="activeMedia.desc"></p>
            </div>
        </div>
    </div>

    <!-- Script for Live Count-Up Animation & Ambient Cursor Follower & Scroll Reveals -->
    <script>
        // 1. Live Stats Counter with Cubic Easing
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

        // 2. Ambient Cursor Light Following Mouse
        document.addEventListener('DOMContentLoaded', function () {
            const cursorLight = document.getElementById('ambient-cursor-glow');
            if (cursorLight && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                let mouseX = window.innerWidth / 2;
                let mouseY = window.innerHeight / 2;
                let currentX = mouseX;
                let currentY = mouseY;

                window.addEventListener('mousemove', function (e) {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });

                function animateLight() {
                    currentX += (mouseX - currentX) * 0.08;
                    currentY += (mouseY - currentY) * 0.08;
                    cursorLight.style.left = currentX + 'px';
                    cursorLight.style.top = currentY + 'px';
                    requestAnimationFrame(animateLight);
                }
                animateLight();
            }

            // 3. Top Laser Scroll Progress Bar
            const progressBar = document.getElementById('scroll-progress-bar');
            window.addEventListener('scroll', function () {
                const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (totalHeight > 0) {
                    const progress = (window.pageYOffset / totalHeight) * 100;
                    if (progressBar) {
                        progressBar.style.width = progress + '%';
                    }
                }
            }, { passive: true });

            // 4. Scroll Reveal IntersectionObserver
            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            if ('IntersectionObserver' in window && revealElements.length > 0) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    rootMargin: '0px 0px -50px 0px',
                    threshold: 0.1
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>

    @include('partials.pwa-prompts')
</body>
</html>
