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
                        brand: {
                            void: '#06010D',
                            dark: '#08020F',
                            darker: '#0C0317',
                            deep: '#120522',
                            night: '#1B082B',
                            purple: '#1B0733',
                            purpleLight: '#260B46',
                            card: '#1F0B38',
                            hover: '#2D1050',
                            border: '#3F166F',
                            borderGlow: 'rgba(255, 148, 32, 0.35)',
                            orange: '#FF9420',
                            orangeHover: '#FF7A00',
                            peach: '#FFBA70',
                            bronze: '#BC6200',
                            amber: '#FF9420',
                            yellow: '#FFBA70',
                            gold: '#FFBA70',
                            goldLight: '#FFE3B8',
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
            --primary-dark: #08020F;
            --primary-night: #1B082B;
            --primary-purple: #3F147E;
            --orange-glow: rgba(255, 148, 32, 0.45);
            --purple-glow: rgba(63, 20, 126, 0.4);
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

        /* Rotating Conic Border for Special Cards */
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

    <!-- Ambient Background Lighting Layer (Fixed viewport layer away from top navbar logo to avoid glare) -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="glow-orb w-[600px] h-[600px] bg-purple-900/20 top-40 right-1/3 animate-float-slow"></div>
        <div class="glow-orb w-[550px] h-[550px] bg-amber-500/10 top-1/4 -left-40 animate-float-reverse"></div>
        <div class="glow-orb w-[700px] h-[700px] bg-purple-950/30 top-1/2 -right-32 animate-float-slow"></div>
        <div class="glow-orb w-[550px] h-[550px] bg-orange-600/10 -bottom-20 left-1/4 animate-pulse-glow"></div>
    </div>

    <!-- UNIVERSAL HEADER & GLASSMORPHIC NAVBAR (شريط تنقل احترافي مع دعم الصفحات المنفصلة) -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#08020F]/90 backdrop-blur-2xl border-b border-purple-900/30 transition-all duration-300">
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
                   class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-xs font-black rounded-xl group bg-gradient-to-br from-brand-orange via-brand-amber to-brand-gold shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40 transition-all duration-300">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-200 bg-brand-dark/30 rounded-[10px] group-hover:bg-opacity-0 text-white flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-brand-gold group-hover:rotate-12 transition-transform"></i>
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
    <footer class="bg-brand-void border-t border-purple-900/50 py-16 px-4 sm:px-6 lg:px-8 relative z-10 text-xs text-gray-400 mt-auto">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-right">
                
                <!-- Brand Bio -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-10 w-auto object-contain">
                        <div>
                            <div class="text-xl font-black gold-gradient-text">بريق للإعلام والتصميم</div>
                            <div class="text-[10px] text-brand-amber font-bold">PARIQ CREATIVE AGENCY</div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        وكالة إبداعية متكاملة متخصصة في التصوير السينمائي، المونتاج فائق السرعة والجودة، تصميم الهويات البصرية، وإدارة الحملات الإعلانية القائمة على أعلى عائد استثماري.
                    </p>
                    <div class="flex items-center gap-2.5 text-base">
                        <a href="https://wa.me/201062330838?text=مرحباً%20بريق" target="_blank" class="w-9 h-9 rounded-xl bg-purple-950/60 hover:bg-emerald-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="w-9 h-9 rounded-xl bg-purple-950/60 hover:bg-blue-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-xl bg-purple-950/60 hover:bg-pink-600 hover:text-white border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://tiktok.com" target="_blank" class="w-9 h-9 rounded-xl bg-purple-950/60 hover:bg-white hover:text-black border border-purple-800/40 flex items-center justify-center transition text-gray-300">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b border-purple-800/40 pb-2">روابط المنصة الرئيسية</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-angle-left text-[10px] text-brand-amber"></i> الصفحة الرئيسية</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-angle-left text-[10px] text-brand-amber"></i> كافة الخدمات</a></li>
                        <li><a href="{{ route('public.portfolio') }}" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-angle-left text-[10px] text-brand-amber"></i> أعمالنا المعتمدة</a></li>
                        <li><a href="{{ route('public.process') }}" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-angle-left text-[10px] text-brand-amber"></i> منهجية العمل ومن نحن</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-angle-left text-[10px] text-brand-amber"></i> طلب استشارة وعرض سعر</a></li>
                    </ul>
                </div>

                <!-- Creative Services -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b border-purple-800/40 pb-2">أبرز خدماتنا</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('public.services') }}#shooting" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-video text-[10px] text-amber-400"></i> تصوير سينمائي 4K</a></li>
                        <li><a href="{{ route('public.services') }}#editing" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-film text-[10px] text-purple-400"></i> مونتاج ريلز وبرومو سريع</a></li>
                        <li><a href="{{ route('public.services') }}#design" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-bezier-curve text-[10px] text-yellow-400"></i> تصميم هويات وأغلفة CTR</a></li>
                        <li><a href="{{ route('public.services') }}#ads" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-chart-line text-[10px] text-emerald-400"></i> إعلانات ممولة وميديا باينج</a></li>
                        <li><a href="{{ route('public.services') }}#social" class="hover:text-brand-gold transition flex items-center gap-2"><i class="fa-solid fa-share-nodes text-[10px] text-orange-400"></i> إدارة حسابات السوشيال ميديا</a></li>
                    </ul>
                </div>

                <!-- Contact & Regional Coverage -->
                <div class="space-y-3">
                    <h4 class="text-sm font-black text-white border-b border-purple-800/40 pb-2">التواصل والتغطية الإقليمية</h4>
                    <div class="space-y-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-brand-amber text-xs"></i>
                            <span dir="ltr" class="font-mono font-bold">+20 106 233 0838</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-brand-amber text-xs"></i>
                            <span class="font-mono">contact@pariqagency.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-globe text-brand-amber text-xs"></i>
                            <span>مصر • السعودية • الإمارات • الأردن • قطر • عمان</span>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-brand-yellow/15 text-brand-gold hover:bg-brand-yellow hover:text-brand-dark transition font-bold border border-brand-yellow/30 text-[11px]">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span>حجز جلسة استشارة فورية</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 border-t border-purple-900/40 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-right">
                <div class="text-[11px] text-gray-400">
                    مفتاح نجاحك في التسويق والإبداع • جميع الحقوق محفوظة © {{ date('Y') }} وكالة بريق للإعلام والتصميم.
                </div>
                <div class="flex items-center gap-4 text-[11px] text-gray-400">
                    <a href="{{ route('public.services') }}" class="hover:text-brand-gold">خدماتنا</a>
                    <span>•</span>
                    <a href="{{ route('public.portfolio') }}" class="hover:text-brand-gold">أعمالنا</a>
                    <span>•</span>
                    <a href="{{ route('public.contact') }}" class="hover:text-brand-gold">تواصل معنا</a>
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

