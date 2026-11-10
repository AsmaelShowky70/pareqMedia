<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'وكالة بريق للإعلام والتصميم') | نصنع لعلامتك التجارية بريقاً استثنائياً</title>
    
    @include('partials.pwa-meta')
    
    <meta name="description" content="@yield('meta_description', 'وكالة بريق حلول تسويق إلكتروني وتصميم جرافيك متكاملة مع تصوير ومونتاج فيديو احترافي سينمائي، تصميم هويات بصرية، وإعلانات ممولة في مصر والسعودية والخليج.')">
    <meta name="keywords" content="بريق, وكالة بريق, تصميم جرافيك, تصوير سينمائي, مونتاج ريلز, هوية بصرية, اعلانات ممولة, pariq agency, creative studio">

    <!-- Fonts: Cairo -->
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
                        purple: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#8b6cf7',
                            500: '#3E24C5',
                            600: '#3E24C5',
                            700: '#3F147E',
                            800: '#3F147E',
                            900: '#1B082B',
                            950: '#0E031A',
                        },
                        violet: {
                            400: '#8b6cf7',
                            500: '#3E24C5',
                            600: '#3E24C5',
                            700: '#3F147E',
                            800: '#3F147E',
                            900: '#1B082B',
                        },
                        amber: {
                            300: '#FFD199',
                            400: '#FFBA70',
                            500: '#FF9420',
                            600: '#BC6200',
                            700: '#944E00',
                        },
                        orange: {
                            300: '#FFD199',
                            400: '#FFBA70',
                            500: '#FF9420',
                            600: '#FF7A00',
                            700: '#BC6200',
                        },
                        brand: {
                            black: '#000000',
                            void: '#07010e',
                            night: '#1B082B',
                            dark: '#0e031a',
                            darker: '#0a0213',
                            deep: '#140626',
                            card: '#1B082B',
                            cardHover: '#260B46',
                            plum: '#1B082B',
                            violet: '#3F147E',
                            electric: '#3E24C5',
                            indigo: '#3E24C5',
                            purple: '#3F147E',
                            purpleLight: '#3E24C5',
                            hover: '#3F147E',
                            border: '#3E24C5',
                            borderLight: '#3F147E',
                            borderGlow: 'rgba(255, 148, 32, 0.45)',
                            orange: '#FF9420',
                            orangeHover: '#FF7A00',
                            peach: '#FFBA70',
                            bronze: '#BC6200',
                            amber: '#FF9420',
                            yellow: '#FFBA70',
                            gold: '#FFBA70',
                            goldLight: '#FFE3B8',
                            white: '#FFFFFF',
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
            --primary-orange: #FF9420;
            --primary-peach: #FFBA70;
            --primary-bronze: #BC6200;
            --primary-white: #FFFFFF;
            --primary-electric: #3E24C5;
            --primary-purple: #3F147E;
            --primary-night: #1B082B;
            --primary-black: #000000;
            --orange-glow: rgba(255, 148, 32, 0.6);
            --electric-glow: rgba(62, 36, 197, 0.6);
            --purple-glow: rgba(63, 20, 126, 0.6);
        }

        body { 
            font-family: 'Cairo', sans-serif; 
            background-color: #080210; 
            background-image: 
                radial-gradient(at 15% 15%, rgba(62, 36, 197, 0.25) 0px, transparent 55%),
                radial-gradient(at 85% 20%, rgba(255, 148, 32, 0.20) 0px, transparent 50%),
                radial-gradient(at 80% 75%, rgba(63, 20, 126, 0.30) 0px, transparent 60%),
                radial-gradient(at 20% 85%, rgba(188, 98, 0, 0.18) 0px, transparent 55%);
            background-attachment: fixed;
            color: #FFFFFF;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Ambient Cursor Light Following Mouse */
        #ambient-cursor-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(255, 148, 32, 0.22) 0%, rgba(62, 36, 197, 0.25) 45%, transparent 75%);
            filter: blur(45px);
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
            height: 3.5px;
            width: 0%;
            background: linear-gradient(90deg, #3E24C5 0%, #FF9420 50%, #FFBA70 100%);
            box-shadow: 0 0 18px rgba(255, 148, 32, 0.95), 0 0 28px rgba(62, 36, 197, 0.9);
            z-index: 9999;
            transition: width 0.1s ease-out;
        }

        /* Liquid Shimmer Text */
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFFFFF 0%, #FFBA70 25%, #FF9420 60%, #BC6200 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 5s linear infinite;
        }

        .purple-gradient-text {
            background: linear-gradient(135deg, #FFFFFF 0%, #C4B5FD 25%, #3E24C5 75%, #3F147E 100%);
            background-size: 200% auto;
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
            filter: blur(90px);
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
            0%, 100% { opacity: 0.75; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.08); }
        }

        @keyframes radarWave {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(2.2); opacity: 0; }
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

        /* Glassmorphism Classes */
        .glass-card-purple {
            background: linear-gradient(145deg, rgba(27, 8, 43, 0.94) 0%, rgba(63, 20, 126, 0.35) 50%, rgba(14, 3, 24, 0.98) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(62, 36, 197, 0.55);
            box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.9), 0 0 30px rgba(62, 36, 197, 0.25);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card-purple:hover {
            border-color: #FF9420;
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.95), 0 0 35px rgba(255, 148, 32, 0.4), 0 0 50px rgba(62, 36, 197, 0.35);
            transform: translateY(-4px);
        }

        /* Rotating Conic Border for Special Cards */
        .conic-glow-border {
            position: relative;
            z-index: 1;
            border-radius: 1.5rem;
            padding: 2.5px;
            background: linear-gradient(135deg, #FF9420, #3E24C5, #FFBA70, #3F147E);
            box-shadow: 0 0 45px rgba(62, 36, 197, 0.45), 0 0 70px rgba(255, 148, 32, 0.35);
            transition: all 0.4s ease;
        }
        .conic-glow-border:hover {
            box-shadow: 0 0 55px rgba(255, 148, 32, 0.55), 0 0 95px rgba(62, 36, 197, 0.55);
            transform: translateY(-4px);
        }

        /* Flowing Pipeline Laser Pulse for Process Sequence (RTL Flow: Step 1 -> 4) */
        @keyframes pipelineLaserRtl {
            0% {
                right: -15%;
                opacity: 0;
            }
            15% {
                opacity: 1;
            }
            85% {
                opacity: 1;
            }
            100% {
                right: 115%;
                opacity: 0;
            }
        }
        .pipeline-laser-beam {
            animation: pipelineLaserRtl 2.4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
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
    @stack('styles')
</head>

<body class="bg-brand-void text-gray-100 overflow-x-hidden selection:bg-brand-amber selection:text-brand-dark min-h-screen flex flex-col" 
      x-data="{ 
          mobileNav: false, 
          previewModal: false, 
          showBackToTop: false,
          activeMedia: { type: '', src: '', embedSrc: '', title: '', desc: '', aspect: 'landscape', brandItems: [] },
          openMedia(mediaType, src, title, desc, aspect = 'landscape', brandItems = []) {
              let type = mediaType;
              let embed = '';
              if (type === 'video' && src) {
                  const ytMatch = src.match(/(?:(?:youtube\.com|youtu\.be)?\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/)|youtu\.be\/|^\/?shorts\/|shorts\/)([\w-]{11})/i);
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
              this.activeMedia = { type: type, src: src, embedSrc: embed, title: title, desc: desc, aspect: aspect, brandItems: brandItems || [] };
              this.previewModal = true;
          },
          closeMedia() {
              this.previewModal = false;
              this.activeMedia = { type: '', src: '', embedSrc: '', title: '', desc: '', aspect: 'landscape', brandItems: [] };
          }
      }"
      @scroll.window="showBackToTop = (window.pageYOffset > 400)">

    <!-- Ambient Cursor Glow Spotlight Follower -->
    <div id="ambient-cursor-glow"></div>

    <!-- Top Laser Scroll Progress Indicator -->
    <div id="scroll-progress-bar"></div>

    <!-- Ambient Background Lighting Layer (Fixed viewport layer with vibrant Bariq electric purple & warm amber glow) -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="glow-orb w-[850px] h-[850px] bg-[#3E24C5]/30 top-10 right-1/4 animate-float-slow"></div>
        <div class="glow-orb w-[750px] h-[750px] bg-[#FF9420]/22 top-1/3 -left-24 animate-float-reverse"></div>
        <div class="glow-orb w-[900px] h-[900px] bg-[#3F147E]/40 top-2/3 -right-24 animate-float-slow"></div>
        <div class="glow-orb w-[750px] h-[750px] bg-[#BC6200]/22 -bottom-20 left-1/3 animate-pulse-glow"></div>
    </div>

    <!-- UNIVERSAL HEADER & GLASSMORPHIC NAVBAR (شريط تنقل احترافي مع دعم الصفحات المنفصلة) -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#1B082B]/85 backdrop-blur-2xl border-b-2 border-[#3E24C5]/40 shadow-[0_4px_30px_rgba(62,36,197,0.25)] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Identity Logo (Clean, crisp logo with PARIQ AGENCY only, zero glow or glare) -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group relative py-1">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="PARIQ AGENCY" class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="flex flex-col text-right">
                    <span class="text-xs sm:text-sm font-black text-brand-orange tracking-widest font-mono uppercase">PARIQ AGENCY</span>
                </div>
            </a>

            <!-- Desktop Nav Links (Direct Multi-Page Navigation) -->
            <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-xs font-bold text-gray-300">
                <!-- 1. Home -->
                <a href="{{ route('home') }}" 
                   class="relative py-2 transition-colors duration-200 group {{ request()->routeIs('home') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }}">
                    <span>الرئيسية</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-peach {{ request()->routeIs('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform origin-right duration-300"></span>
                </a>

                <!-- 2. Services Page -->
                <a href="{{ route('public.services') }}" 
                   class="relative py-2 transition-colors duration-200 group {{ request()->routeIs('public.services') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }}">
                    <span>خدماتنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-peach {{ request()->routeIs('public.services') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform origin-right duration-300"></span>
                </a>

                <!-- 3. Portfolio Page (Updated to اعمالنا) -->
                <a href="{{ route('public.portfolio') }}" 
                   class="relative py-2 transition-colors duration-200 group {{ request()->routeIs('public.portfolio') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }}">
                    <span>أعمالنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-peach {{ request()->routeIs('public.portfolio') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform origin-right duration-300"></span>
                </a>

                <!-- 4. About Page -->
                <a href="{{ route('public.about') }}" 
                   class="relative py-2 transition-colors duration-200 group {{ request()->routeIs('public.process') || request()->routeIs('public.about') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }}">
                    <span>من نحن</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-peach {{ request()->routeIs('public.process') || request()->routeIs('public.about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform origin-right duration-300"></span>
                </a>

                <!-- 5. Contact Page -->
                <a href="{{ route('public.contact') }}" 
                   class="relative py-2 transition-colors duration-200 group {{ request()->routeIs('public.contact') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }}">
                    <span>تواصل معنا</span>
                    <span class="absolute bottom-0 inset-x-0 h-0.5 bg-gradient-to-r from-brand-orange to-brand-peach {{ request()->routeIs('public.contact') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }} transition-transform origin-right duration-300"></span>
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('public.contact') }}" 
                   class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-xs font-black rounded-xl group bg-gradient-to-r from-[#FF9420] via-[#FFBA70] to-[#BC6200] shadow-[0_0_20px_rgba(255,148,32,0.4)] hover:shadow-[0_0_35px_rgba(255,148,32,0.7)] transition-all duration-300 active:scale-95">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-200 bg-[#1B082B] rounded-[10px] group-hover:bg-opacity-0 text-white flex items-center gap-2 font-bold">
                        <i class="fa-solid fa-bolt text-[#FF9420] group-hover:rotate-12 transition-transform"></i>
                        <span>طلب استشارة مجانية</span>
                    </span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center gap-2 lg:hidden">
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
             class="lg:hidden bg-[#110423]/95 backdrop-blur-2xl border-b border-purple-800/50 px-6 py-5 space-y-3.5 text-sm font-bold shadow-2xl max-h-[85vh] overflow-y-auto">
            
            <a href="{{ route('home') }}" @click="mobileNav = false" class="block py-1.5 {{ request()->routeIs('home') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }} transition-colors">الرئيسية</a>
            <a href="{{ route('public.services') }}" @click="mobileNav = false" class="block py-1.5 {{ request()->routeIs('public.services') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }} transition-colors">خدماتنا</a>
            <a href="{{ route('public.portfolio') }}" @click="mobileNav = false" class="block py-1.5 {{ request()->routeIs('public.portfolio') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }} transition-colors">أعمالنا</a>
            <a href="{{ route('public.about') }}" @click="mobileNav = false" class="block py-1.5 {{ request()->routeIs('public.process') || request()->routeIs('public.about') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }} transition-colors">من نحن</a>
            <a href="{{ route('public.contact') }}" @click="mobileNav = false" class="block py-1.5 {{ request()->routeIs('public.contact') ? 'text-brand-orange font-black' : 'hover:text-brand-orange' }} transition-colors">تواصل معنا</a>
            
            <div class="pt-3 border-t border-purple-800/40">
                <a href="{{ route('public.contact') }}" @click="mobileNav = false" class="block py-3 text-center rounded-xl bg-gradient-to-r from-brand-orange via-brand-amber to-brand-gold text-brand-dark font-black text-xs shadow-lg">
                    طلب استشارة تسويقية مجانية فوراً
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN PAGE CONTENT (Injects here) -->
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <!-- UNIVERSAL FOOTER -->
    <footer class="bg-gradient-to-b from-[#080210] via-[#1B082B] to-[#000000] border-t-2 border-[#3E24C5]/40 shadow-[0_-10px_40px_rgba(62,36,197,0.2)] py-16 px-4 sm:px-6 lg:px-8 relative z-10 text-xs text-gray-300 mt-auto">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-right">
                
                <!-- Brand Bio -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-10 w-auto object-contain">
                        <div>
                            <div class="text-xl font-black text-white">بريق <span class="text-[#FF9420]">للإعلام والتصميم</span></div>
                            <div class="text-[10px] text-[#FFBA70] font-bold">PARIQ CREATIVE AGENCY</div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        وكالة إبداعية متكاملة متخصصة في التصوير السينمائي، المونتاج فائق السرعة والجودة، تصميم الهويات البصرية، وإدارة الحملات الإعلانية القائمة على أعلى عائد استثماري.
                    </p>
                    <div class="flex items-center gap-2.5 text-base">
                        <a href="https://wa.me/201062330838?text=مرحباً%20بريق" target="_blank" class="w-10 h-10 rounded-xl bg-[#1B082B] hover:bg-emerald-600 hover:text-white border-2 border-[#3E24C5]/60 hover:border-emerald-400 flex items-center justify-center transition shadow-lg text-white">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 rounded-xl bg-[#1B082B] hover:bg-blue-600 hover:text-white border-2 border-[#3E24C5]/60 hover:border-blue-400 flex items-center justify-center transition shadow-lg text-white">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-10 h-10 rounded-xl bg-[#1B082B] hover:bg-pink-600 hover:text-white border-2 border-[#3E24C5]/60 hover:border-pink-400 flex items-center justify-center transition shadow-lg text-white">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://tiktok.com" target="_blank" class="w-10 h-10 rounded-xl bg-[#1B082B] hover:bg-white hover:text-black border-2 border-[#3E24C5]/60 hover:border-white flex items-center justify-center transition shadow-lg text-white">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b-2 border-[#3E24C5]/50 pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#FF9420]"></span>
                        <span>روابط المنصة الرئيسية</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-angle-left text-[10px] text-[#FF9420]"></i> الصفحة الرئيسية</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-angle-left text-[10px] text-[#FF9420]"></i> كافة الخدمات</a></li>
                        <li><a href="{{ route('public.portfolio') }}" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-angle-left text-[10px] text-[#FF9420]"></i> أعمالنا المعتمدة</a></li>
                        <li><a href="{{ route('public.process') }}" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-angle-left text-[10px] text-[#FF9420]"></i> منهجية العمل ومن نحن</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-angle-left text-[10px] text-[#FF9420]"></i> طلب استشارة وعرض سعر</a></li>
                    </ul>
                </div>

                <!-- Creative Services -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b-2 border-[#3E24C5]/50 pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#3E24C5]"></span>
                        <span>أبرز خدماتنا</span>
                    </h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('public.services') }}#shooting" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-video text-[10px] text-[#FFBA70]"></i> تصوير سينمائي 4K</a></li>
                        <li><a href="{{ route('public.services') }}#editing" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-film text-[10px] text-[#3E24C5]"></i> مونتاج ريلز وبرومو سريع</a></li>
                        <li><a href="{{ route('public.services') }}#design" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-bezier-curve text-[10px] text-[#FF9420]"></i> تصميم هويات وأغلفة CTR</a></li>
                        <li><a href="{{ route('public.services') }}#ads" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-chart-line text-[10px] text-[#FFBA70]"></i> إعلانات ممولة وميديا باينج</a></li>
                        <li><a href="{{ route('public.services') }}#social" class="hover:text-[#FF9420] transition flex items-center gap-2 text-gray-200"><i class="fa-solid fa-share-nodes text-[10px] text-[#BC6200]"></i> إدارة حسابات السوشيال ميديا</a></li>
                    </ul>
                </div>

                <!-- Contact & Regional Coverage -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b-2 border-[#3E24C5]/50 pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#FFBA70]"></span>
                        <span>التواصل والتغطية الإقليمية</span>
                    </h4>
                    <div class="space-y-2 text-xs text-gray-200">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-[#FF9420] text-xs"></i>
                            <span dir="ltr" class="font-mono font-bold text-white">+20 106 233 0838</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-[#FF9420] text-xs"></i>
                            <span class="font-mono text-white">contact@pariqagency.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-globe text-[#3E24C5] text-xs"></i>
                            <span>مصر • السعودية • الإمارات • الأردن • قطر • عمان</span>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#FF9420] to-[#FFBA70] text-black font-black hover:brightness-110 transition text-[11px] shadow-[0_0_20px_rgba(255,148,32,0.4)]">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span>حجز جلسة استشارة فورية</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 border-t border-[#3E24C5]/30 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-right">
                <div class="text-[11px] text-gray-300">
                    مفتاح نجاحك في التسويق والإبداع • جميع الحقوق محفوظة © {{ date('Y') }} <span class="text-white font-bold">وكالة بريق للإعلام والتصميم</span>.
                </div>
                <div class="flex items-center gap-4 text-[11px] text-gray-300">
                    <a href="{{ route('public.services') }}" class="hover:text-[#FF9420] transition">خدماتنا</a>
                    <span>•</span>
                    <a href="{{ route('public.portfolio') }}" class="hover:text-[#FF9420] transition">أعمالنا</a>
                    <span>•</span>
                    <a href="{{ route('public.contact') }}" class="hover:text-[#FF9420] transition">تواصل معنا</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- FLOATING WHATSAPP CONSULTATION WIDGET (زر واتساب العائم بنبضات الرادار) -->
    <div id="pariq-whatsapp-floating" class="fixed bottom-4 sm:bottom-6 right-3 sm:right-6 z-40 flex items-center group">
        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
           target="_blank" 
           class="hidden sm:flex items-center gap-2 px-4 py-2 ml-3 rounded-full bg-[#18082B]/95 border border-emerald-500/40 text-white text-xs font-bold shadow-2xl backdrop-blur-md transform transition-all group-hover:scale-105 group-hover:border-emerald-400">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>طلب استشارة فورية عبر واتساب 💬</span>
        </a>

        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
           target="_blank" 
           aria-label="تواصل مع بريق عبر واتساب"
           class="relative w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-tr from-[#128C7E] to-[#25D366] text-white flex items-center justify-center text-xl sm:text-2xl shadow-2xl shadow-emerald-500/30 hover:scale-110 active:scale-95 transition-all duration-300">
            <span class="absolute inset-0 rounded-full bg-emerald-400/30 animate-ping -z-10"></span>
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <!-- FLOATING BACK TO TOP BUTTON -->
    <button type="button" 
            x-show="showBackToTop" 
            x-transition 
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            aria-label="الرجوع للأعلى"
            class="fixed bottom-20 sm:bottom-24 right-4 sm:right-7 z-40 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#1A0833]/90 border border-purple-600/40 hover:border-brand-gold text-brand-gold hover:text-white flex items-center justify-center text-xs sm:text-sm shadow-xl backdrop-blur-md hover:scale-110 active:scale-95 transition-all" 
            style="display: none;">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- UNIVERSAL PREVIEW MODAL (LIGHTBOX FOR VIDEOS & IMAGES) -->
    <div x-show="previewModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/90 backdrop-blur-xl" 
         style="display: none;">
        
        <div @click.away="closeMedia()" 
             :class="activeMedia.aspect === 'vertical' ? 'max-w-md' : (activeMedia.type === 'branding' ? 'max-w-5xl' : 'max-w-4xl')"
             class="w-full glass-card-purple rounded-2xl sm:rounded-[2rem] p-4 sm:p-6 shadow-2xl relative space-y-3 sm:space-y-4 border border-purple-500/50 max-h-[92vh] overflow-y-auto">
            
            <button @click="closeMedia()" 
                    class="absolute top-3 left-3 sm:-top-12 sm:left-0 text-white hover:text-brand-orange text-lg sm:text-2xl transition z-30 w-8 h-8 rounded-full bg-black/60 sm:bg-transparent flex items-center justify-center"
                    aria-label="إغلاق النافذة">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Media Container (Standard Video / Reel / Image) -->
            <template x-if="activeMedia.type !== 'branding'">
                <div :class="activeMedia.aspect === 'vertical' ? 'aspect-[9/16] max-h-[70vh] mx-auto' : 'aspect-video'"
                     class="w-full bg-black rounded-2xl overflow-hidden flex items-center justify-center relative shadow-inner">
                    <template x-if="previewModal && activeMedia.type === 'video'">
                        <video :src="activeMedia.src" controls autoplay playsinline class="w-full h-full object-contain"></video>
                    </template>
                    <template x-if="previewModal && (activeMedia.type === 'youtube' || activeMedia.type === 'vimeo' || activeMedia.type === 'iframe')">
                        <iframe :src="activeMedia.embedSrc" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </template>
                    <template x-if="previewModal && activeMedia.type === 'image' && activeMedia.src">
                        <img :src="activeMedia.src" :alt="activeMedia.title" class="w-full h-full object-contain">
                    </template>
                    <template x-if="previewModal && (!activeMedia.src || activeMedia.type === 'text')">
                        <div class="p-6 sm:p-10 text-center space-y-4 max-w-lg mx-auto my-auto">
                            <div class="w-14 h-14 rounded-2xl bg-brand-orange/20 text-brand-orange flex items-center justify-center text-2xl mx-auto shadow-inner">
                                <i class="fa-solid fa-quote-right"></i>
                            </div>
                            <div class="text-amber-400 text-base flex justify-center gap-1">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                            <p class="text-sm sm:text-base text-gray-100 italic leading-relaxed" x-text="'«' + activeMedia.desc + '»'"></p>
                            <div class="pt-3 border-t border-purple-800/40">
                                <h4 class="text-sm font-black text-brand-orange" x-text="activeMedia.title"></h4>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Multi-Item Brand Identity Showcase (بنود الهوية البصرية المتعددة) -->
            <template x-if="activeMedia.type === 'branding'">
                <div class="space-y-6">
                    <div class="relative aspect-video max-h-[50vh] bg-black/60 rounded-2xl overflow-hidden flex items-center justify-center border border-purple-800/60">
                        <img :src="activeMedia.src" :alt="activeMedia.title" class="w-full h-full object-contain">
                        <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-brand-orange/90 text-brand-dark font-black text-xs shadow">
                            هوية بصرية متكاملة
                        </span>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-sm font-black text-brand-gold flex items-center gap-2">
                            <i class="fa-solid fa-layer-group text-brand-orange"></i>
                            <span>بنود وحزمة الهوية البصرية المعتمدة للبراند:</span>
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-shapes text-brand-orange text-lg"></i>
                                <div class="font-bold text-white">الشعار الرسمي (Logo)</div>
                                <div class="text-[10px] text-gray-400">ملفات فيكتور، رمزي، ونصوص</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-palette text-amber-400 text-lg"></i>
                                <div class="font-bold text-white">لوحة الألوان (Colors)</div>
                                <div class="text-[10px] text-gray-400">أكواد HEX, RGB, CMYK, Pantone</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-font text-purple-300 text-lg"></i>
                                <div class="font-bold text-white">الخطوط الرسمية (Typography)</div>
                                <div class="text-[10px] text-gray-400">عربي وإنجليزي لكافة المنصات</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-book-open text-emerald-400 text-lg"></i>
                                <div class="font-bold text-white">دليل الهوية (Brandbook)</div>
                                <div class="text-[10px] text-gray-400">قواعد الاستخدام والمساحات الآمنة</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-id-card text-blue-400 text-lg"></i>
                                <div class="font-bold text-white">كروت ومطبوعات</div>
                                <div class="text-[10px] text-gray-400">بزنس كارد، ورق رسمي، أظرف</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-box-open text-orange-400 text-lg"></i>
                                <div class="font-bold text-white">التغليف والعلب (Packaging)</div>
                                <div class="text-[10px] text-gray-400">أكياس، علب منتجات، استيكرات</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-hashtag text-cyan-400 text-lg"></i>
                                <div class="font-bold text-white">قوالب السوشيال ميديا</div>
                                <div class="text-[10px] text-gray-400">أغلفة، بوستات، وهايلايت ستوري</div>
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-700/40 text-center space-y-1">
                                <i class="fa-solid fa-laptop text-brand-gold text-lg"></i>
                                <div class="font-bold text-white">موك اب واقعي (3D Mockup)</div>
                                <div class="text-[10px] text-gray-400">محاكاة الهوية على أرض الواقع</div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <div class="space-y-1 text-right pt-2 border-t border-purple-800/40">
                <h3 class="text-lg font-black text-white" x-text="activeMedia.title"></h3>
                <p class="text-xs text-gray-300 leading-relaxed" x-text="activeMedia.desc"></p>
            </div>
        </div>
    </div>

    <!-- Scripts: Ambient Cursor Follower, Top Scroll Progress, Scroll Reveals -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Ambient Cursor Light
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

            // 2. Top Laser Scroll Progress Bar
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

            // 3. Scroll Reveal IntersectionObserver
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
    @stack('scripts')
</body>
</html>

