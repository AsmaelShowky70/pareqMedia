<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بريق للتسويق الإلكتروني | مفتاح نجاحك في التسويق - تصوير، مونتاج، تصاميم، وإعلانات ممولة</title>
    
    @include('partials.pwa-meta')
    
    <meta name="description" content="وكالة بريق حلول تسويق إلكتروني متكاملة مع تصوير ومونتاج فيديو احترافي، تصميم جرافيك، وإعلانات ممولة في مصر والسعودية والأردن والخليج.">
    <meta name="keywords" content="بريق, بريق للتسويق الالكتروني, مونتاج, تصوير فيديو, ريلز, اعلانات ممولة, تصميم جرافيك, pariq agency">

    <!-- Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { cairo: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: {
                            dark: '#08020F',
                            darker: '#05010A',
                            purple: '#150626',
                            card: '#1F0B38',
                            hover: '#2C104F',
                            border: '#3E176F',
                            yellow: '#F59E0B',
                            amber: '#FF9F0A',
                            gold: '#FBBF24',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #08020F; color: #F3F4F6; }
        html { scroll-behavior: smooth; }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FDE68A 0%, #FBBF24 35%, #F59E0B 70%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .purple-gradient-card {
            background: linear-gradient(135deg, rgba(31, 11, 56, 0.9) 0%, rgba(21, 6, 38, 0.98) 100%);
        }
        .glow-sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(140px);
            pointer-events: none;
            z-index: 0;
            animation: floatSlow 14s ease-in-out infinite alternate;
        }
        @keyframes floatSlow {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -20px) scale(1.08); }
            100% { transform: translate(-25px, 25px) scale(0.95); }
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(50%); }
        }
        .marquee-track {
            display: flex;
            width: 200%;
            animation: marquee 30s linear infinite;
        }
        .marquee-track:hover {
            animation-play-state: paused;
        }
        @keyframes subtlePulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.02); opacity: 0.92; }
        }
        .subtle-pulse {
            animation: subtlePulse 4s infinite ease-in-out;
        }
        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-track { background: #08020F; }
        ::-webkit-scrollbar-thumb { background: #3E176F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #F59E0B; }
    </style>
</head>
<body class="bg-brand-dark text-gray-100 overflow-x-hidden selection:bg-brand-yellow selection:text-brand-dark" 
      x-data="{ 
          mobileNav: false, 
          activeFilter: 'all', 
          activeServiceCategory: 'all',
          activeFaq: 0,
          previewModal: false, 
          showBackToTop: false,
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

    <!-- Ambient Glowing Backdrops -->
    <div class="glow-sphere w-[600px] h-[600px] bg-purple-900/25 -top-40 -right-40"></div>
    <div class="glow-sphere w-[500px] h-[500px] bg-amber-500/10 top-96 -left-40"></div>
    <div class="glow-sphere w-[700px] h-[700px] bg-purple-950/40 bottom-40 right-1/4"></div>

    <!-- 1. HEADER & NAVIGATION -->
    <header class="fixed top-0 inset-x-0 z-50 bg-brand-dark/85 backdrop-blur-xl border-b border-brand-border/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-12 w-auto object-contain filter drop-shadow group-hover:scale-105 transition-transform duration-300">
                <div class="flex flex-col">
                    <span class="text-2xl font-black gold-gradient-text tracking-wide leading-none">بريق</span>
                    <span class="text-[10px] text-brand-gold font-bold tracking-wider mt-0.5">PARIQ AGENCY</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center gap-6 xl:gap-7 text-xs font-bold text-gray-300">
                <a href="#hero" class="hover:text-brand-gold transition-colors">الرئيسية</a>
                <a href="#services" class="hover:text-brand-gold transition-colors">خدماتنا</a>
                <a href="#process" class="hover:text-brand-gold transition-colors">مراحل عملنا</a>
                <a href="#portfolio" class="hover:text-brand-gold transition-colors">معرض الأعمال</a>
                <a href="#clients" class="hover:text-brand-gold transition-colors">عملاؤنا</a>
                <a href="#testimonials" class="hover:text-brand-gold transition-colors">آراء العملاء</a>
                <a href="#faq" class="hover:text-brand-gold transition-colors">الأسئلة الشائعة</a>
                <a href="#contact" class="hover:text-brand-gold transition-colors">تواصل معنا</a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-2.5">
                @auth
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 active:scale-95 transition shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>لوحة التحكم</span>
                </a>
                @else
                <a href="{{ route('login') }}" 
                   class="px-3.5 py-2.5 rounded-xl bg-[#240c42] border border-brand-yellow/40 text-brand-gold hover:bg-brand-yellow hover:text-brand-dark font-black text-xs transition flex items-center gap-2 shadow">
                    <i class="fa-solid fa-user-lock"></i>
                    <span>دخول الإدارة والفريق</span>
                </a>
                @endauth

                <a href="#contact" 
                   class="px-4 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 active:scale-95 transition shadow-lg flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt"></i>
                    <span>طلب استشارة مجانية</span>
                </a>
            </div>

            <!-- Mobile Actions & Hamburger -->
            <div class="flex items-center gap-2 lg:hidden">
                @auth
                <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-xl bg-brand-yellow text-brand-dark font-black text-xs flex items-center gap-1.5 shadow">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>اللوحة</span>
                </a>
                @else
                <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-xl bg-amber-500/20 border border-brand-yellow/40 text-brand-gold font-bold text-xs flex items-center gap-1.5 shadow">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span>دخول النظام</span>
                </a>
                @endauth
                <button @click="mobileNav = !mobileNav" class="text-gray-300 hover:text-white p-2">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileNav" 
             @click.away="mobileNav = false" 
             x-transition 
             class="lg:hidden bg-brand-purple border-b border-brand-border px-5 py-4 space-y-3 text-sm font-bold">
            
            <!-- Quick Auth Action for Mobile -->
            @auth
            <a href="{{ route('dashboard') }}" @click="mobileNav = false" class="w-full py-2.5 px-3 rounded-xl bg-brand-yellow text-brand-dark font-black text-center flex items-center justify-center gap-2 shadow">
                <i class="fa-solid fa-gauge-high"></i>
                <span>الانتقال إلى لوحة التحكم والمهام</span>
            </a>
            @else
            <a href="{{ route('login') }}" @click="mobileNav = false" class="w-full py-2.5 px-3 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-center flex items-center justify-center gap-2 shadow">
                <i class="fa-solid fa-user-shield"></i>
                <span>تسجيل دخول الإدارة وفريق العمل</span>
            </a>
            @endauth

            <a href="#hero" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">الرئيسية</a>
            <a href="#services" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">خدماتنا</a>
            <a href="#process" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">مراحل عملنا</a>
            <a href="#portfolio" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">معرض الأعمال</a>
            <a href="#clients" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">عملاؤنا</a>
            <a href="#testimonials" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">آراء العملاء</a>
            <a href="#faq" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">الأسئلة الشائعة</a>
            <a href="#contact" @click="mobileNav = false" class="block py-1 hover:text-brand-gold">تواصل معنا</a>
            <div class="pt-3 border-t border-brand-border space-y-2">
                <button type="button" onclick="mobileNav = false; executePwaInstall()" class="w-full py-2.5 text-center rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-300 font-bold text-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <span>تثبيت تطبيق بريق على الهاتف</span>
                </button>
                <a href="#contact" @click="mobileNav = false" class="block py-2.5 text-center rounded-xl bg-brand-yellow text-brand-dark font-black text-xs">طلب استشارة مجانية</a>
            </div>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section id="hero" class="relative pt-36 pb-20 lg:pt-48 lg:pb-28 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10">
        
        @if(session('success_inquiry'))
        <div class="p-4 mb-8 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm flex items-center justify-between shadow-xl">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-400 text-xl"></i>
                <span class="font-bold">{{ session('success_inquiry') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <div class="text-center max-w-4xl mx-auto space-y-6">
            
            <!-- Slogan Badge -->
            <div class="inline-flex items-center gap-2.5 px-6 py-2 rounded-full bg-brand-card/90 border border-brand-yellow/40 text-brand-gold text-xs font-bold shadow-lg subtle-pulse">
                <i class="fa-solid fa-sparkles text-sm text-brand-yellow"></i>
                <span>( بريق ، مفتاح نجاحك في التسويق )</span>
            </div>

            <!-- Main Punchline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight">
                نصنع لعلامتك التجارية 
                <span class="gold-gradient-text block mt-2">بريقاً لا ينطفئ</span> 
                في الفضاء الرقمي
            </h1>

            <p class="text-base sm:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed font-normal">
                حلول تسويقية متكاملة تجمع بين التصوير السينمائي، المونتاج فائق الجودة، تصميمات الهوية الجذابة، وإدارة الحملات الإعلانية المدفوعة القائمة على مضاعفة العائد على الاستثمار.
            </p>

            <!-- Hero CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a href="#portfolio" 
                   class="px-8 py-4 rounded-2xl bg-gradient-to-l from-brand-amber via-brand-yellow to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 active:scale-95 transition shadow-2xl flex items-center gap-2.5">
                    <i class="fa-solid fa-play text-xs"></i>
                    <span>شاهد معرض أعمالنا الحقيقي</span>
                </a>

                <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" target="_blank" 
                   class="px-8 py-4 rounded-2xl bg-brand-card hover:bg-brand-hover border border-brand-border text-white font-bold text-sm transition shadow flex items-center gap-2.5">
                    <i class="fa-brands fa-whatsapp text-emerald-400 text-lg"></i>
                    <span>استشارة مجانية عبر واتساب</span>
                </a>
            </div>

            <!-- LIVE ANIMATED STATS COUNTER BAR (أرقام وإحصائيات تزيد بالتزامن) -->
            <div x-data="pariqStatsCounter()" 
                 x-init="initObserver($el)"
                 class="pt-14 space-y-3">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>إحصائيات موثقة تتحدث بالتزامن مع إنجازات الوكالة</span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- 1. Projects Completed -->
                    <div class="p-5 rounded-2xl bg-brand-card/80 border border-brand-border/80 hover:border-brand-yellow/60 transition-all duration-300 shadow-xl group">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-brand-gold flex items-center justify-center mx-auto mb-2 text-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center">
                            <span>+</span><span x-text="projects">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1 font-bold">مشروع مكتمل بنجاح</div>
                    </div>

                    <!-- 2. Happy Clients -->
                    <div class="p-5 rounded-2xl bg-brand-card/80 border border-brand-border/80 hover:border-brand-yellow/60 transition-all duration-300 shadow-xl group">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/15 text-blue-400 flex items-center justify-center mx-auto mb-2 text-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-white flex items-center justify-center">
                            <span>+</span><span x-text="clients">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1 font-bold">عميل سعيد في 6 دول</div>
                    </div>

                    <!-- 3. Years of Experience -->
                    <div class="p-5 rounded-2xl bg-brand-card/80 border border-brand-border/80 hover:border-brand-yellow/60 transition-all duration-300 shadow-xl group">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center mx-auto mb-2 text-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-brand-gold flex items-center justify-center">
                            <span>+</span><span x-text="years">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1 font-bold">سنوات خبرة متواصلة</div>
                    </div>

                    <!-- 4. Team Members -->
                    <div class="p-5 rounded-2xl bg-brand-card/80 border border-brand-border/80 hover:border-brand-yellow/60 transition-all duration-300 shadow-xl group">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center mx-auto mb-2 text-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        <div class="text-3xl lg:text-4xl font-black text-white flex items-center justify-center">
                            <span>+</span><span x-text="team">0</span>
                        </div>
                        <div class="text-xs text-gray-300 mt-1 font-bold">عضو فريق ومبدع محترف</div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 3. AMBIENT MOVING MARQUEE TICKER (شريط سينمائي متحرك) -->
    <div class="py-3.5 bg-[#120522]/95 border-y border-brand-border/50 overflow-hidden relative z-10 select-none">
        <div class="marquee-track flex items-center gap-8 whitespace-nowrap text-xs font-bold text-gray-300">
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-camera-retro text-brand-gold"></i> تصوير سينمائي 4K</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i> مونتاج ريلز وبرومو سريع</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-bezier-curve text-blue-400"></i> هويات بصرية وتصميمات سوشيال ميديا</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-chart-line text-emerald-400"></i> إعلانات ممولة ومضاعفة المبيعات (ROAS)</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-crown text-brand-gold"></i> بريق ، مفتاح نجاحك في التسويق</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-globe text-cyan-400"></i> عملاؤنا في مصر والسعودية والإمارات</span>
            <span class="text-brand-yellow/40">•</span>
            <!-- Repeat for seamless scroll -->
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-camera-retro text-brand-gold"></i> تصوير سينمائي 4K</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i> مونتاج ريلز وبرومو سريع</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-bezier-curve text-blue-400"></i> هويات بصرية وتصميمات سوشيال ميديا</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-chart-line text-emerald-400"></i> إعلانات ممولة ومضاعفة المبيعات (ROAS)</span>
            <span class="text-brand-yellow/40">•</span>
            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-crown text-brand-gold"></i> بريق ، مفتاح نجاحك في التسويق</span>
        </div>
    </div>

    <!-- 4. SERVICES SECTION (أيقونات جذابة استاتيكية + تنقل سلس وتفاعلي) -->
    <section id="services" class="py-20 bg-brand-purple/40 border-b border-brand-border/40 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-10 space-y-3">
                <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">ماذا نقدم لعلامتك التجارية؟</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white">خدماتنا التسويقية والإبداعية المتكاملة</h2>
                <p class="text-xs sm:text-sm text-gray-400">نغطي كافة مراحل الإنتاج الرقمي تحت سقف واحد بأعلى معايير الإتقان الفني والتجاري.</p>
            </div>

            <!-- Services Category Tabs (تنقل تفاعلي سلس بين الأقسام) -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12">
                <button type="button" @click="activeServiceCategory = 'all'" 
                        :class="activeServiceCategory === 'all' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all flex items-center gap-2">
                    <i class="fa-solid fa-grid-2"></i>
                    <span>جميع الخدمات (6)</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'video'" 
                        :class="activeServiceCategory === 'video' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all flex items-center gap-2">
                    <i class="fa-solid fa-video text-amber-400"></i>
                    <span>التصوير والمونتاج السينمائي</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'design'" 
                        :class="activeServiceCategory === 'design' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all flex items-center gap-2">
                    <i class="fa-solid fa-bezier-curve text-cyan-400"></i>
                    <span>التصميم وبناء الهويات</span>
                </button>
                <button type="button" @click="activeServiceCategory = 'marketing'" 
                        :class="activeServiceCategory === 'marketing' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-5 py-2.5 rounded-2xl text-xs transition-all flex items-center gap-2">
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
                        'icon_color' => 'text-purple-400',
                        'icon_bg' => 'bg-purple-500/15 border-purple-500/30',
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
                        'icon_color' => 'text-cyan-400',
                        'icon_bg' => 'bg-cyan-500/15 border-cyan-500/30',
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
                        'icon_color' => 'text-pink-400',
                        'icon_bg' => 'bg-pink-500/15 border-pink-500/30',
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
                     class="purple-gradient-card border border-brand-border rounded-3xl p-7 hover:border-brand-yellow/60 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl flex flex-col justify-between">
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl {{ $srv['icon_bg'] }} border {{ $srv['icon_color'] }} flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300 shadow">
                                <i class="{{ $srv['icon'] }}"></i>
                            </div>
                            <span class="text-[11px] font-bold text-brand-gold bg-brand-yellow/10 px-3 py-1 rounded-full border border-brand-yellow/20">
                                {{ $srv['category_name'] }}
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-white group-hover:text-brand-gold transition-colors">
                            {{ $srv['title'] }}
                        </h3>

                        <p class="text-xs text-gray-300 leading-relaxed">
                            {{ $srv['desc'] }}
                        </p>

                        <!-- Features bullets -->
                        <div class="space-y-1.5 pt-2 border-t border-brand-border/40 text-[11px] text-gray-300">
                            @foreach($srv['features'] as $feat)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-emerald-400 text-[10px]"></i>
                                <span>{{ $feat }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-5 mt-5 border-t border-brand-border/40 flex items-center justify-between text-xs">
                        <div>
                            <span class="text-[10px] text-gray-400 block">تبدأ الأسعار من:</span>
                            <span class="text-brand-gold font-black text-sm">
                                {{ $srv['price'] }} ج.م
                            </span>
                        </div>
                        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20طلب%20خدمة:%20{{ urlencode($srv['title']) }}" 
                           target="_blank"
                           class="px-4 py-2 rounded-xl bg-brand-yellow/15 hover:bg-brand-yellow text-brand-gold hover:text-brand-dark border border-brand-yellow/30 font-bold transition flex items-center gap-1.5 shadow">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>طلب الخدمة</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 5. OUR 8-STEP WORK PROCESS -->
    <section id="process" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">منهجية العمل المعتمدة</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white">مراحل عملنا نحو نجاح علامتك التجارية</h2>
            <p class="text-xs sm:text-sm text-gray-400">خطة واضحة ومدروسة تضمن تحقيق نتائج حقيقية وقابلة للقياس.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $stages = [
                    ['num' => '01', 'title' => 'مرحلة الاكتشاف والتحليل', 'desc' => 'فهم طبيعة نشاطك، تحليل المنافسين وسلوك الجمهور المستهدف بدقة.'],
                    ['num' => '02', 'title' => 'بناء الاستراتيجية والخطة', 'desc' => 'رسم خطة محتوى شهرية وتحديد الرسائل التسويقية الفعالة.'],
                    ['num' => '03', 'title' => 'التحضير قبل الإنتاج', 'desc' => 'كتابة السكريبتات، تجهيز الـ Moodboard، ولوكيشنات التصوير.'],
                    ['num' => '04', 'title' => 'التصوير والإنتاج السينمائي', 'desc' => 'تصوير 4K بأحدث الكاميرات والمعدات والإضاءة الاحترافية.'],
                    ['num' => '05', 'title' => 'المونتاج وما بعد الإنتاج', 'desc' => 'مونتاج سريع، هندسة صوتية، تصحيح ألوان ومؤثرات بصرية مبهرة.'],
                    ['num' => '06', 'title' => 'الإطلاق والتوزيع', 'desc' => 'نشر المحتوى في الأوقات الذهبية على منصات التواصل الاجتماعي.'],
                    ['num' => '07', 'title' => 'الإعلانات الممولة والحملات', 'desc' => 'إطلاق حملات استهداف دقيقة على Meta, TikTok, Google بحساب الـ ROAS.'],
                    ['num' => '08', 'title' => 'التحليل والتحسين المستمر', 'desc' => 'تقارير أداء دورية وتطوير الحملات لمضاعفة المبيعات.'],
                ];
            @endphp

            @foreach($stages as $st)
            <div class="p-6 rounded-2xl bg-brand-card/70 border border-brand-border hover:border-brand-yellow/50 transition-all hover:-translate-y-1 relative group shadow-lg">
                <div class="text-3xl font-black text-brand-yellow/30 group-hover:text-brand-gold transition-colors mb-2 font-mono">
                    {{ $st['num'] }}
                </div>
                <h3 class="text-sm font-bold text-white mb-2">{{ $st['title'] }}</h3>
                <p class="text-xs text-gray-400 leading-relaxed">{{ $st['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 6. REAL PORTFOLIO & WORK SHOWCASE (أنيميشن سلس في الفلترة والتنقل) -->
    <section id="portfolio" class="py-20 bg-brand-purple/40 border-y border-brand-border/40 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-10 space-y-3">
                <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">سجل إنجازاتنا الفعلي</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white">معرض أعمال بريق الحقيقي والموثق</h2>
                <p class="text-xs sm:text-sm text-gray-400">نماذج حقيقية من تصميماتنا، أغلفة اليوتيوب، نتائج الحملات الإعلانية، وفيديوهات الإنتاج.</p>
            </div>

            <!-- Category Filter Pills with smooth transition -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
                <button type="button" @click="activeFilter = 'all'" 
                        :class="activeFilter === 'all' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    جميع الأعمال
                </button>
                <button type="button" @click="activeFilter = 'youtube_thumbnail'" 
                        :class="activeFilter === 'youtube_thumbnail' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    أغلفة يوتيوب مصغرة (CTR)
                </button>
                <button type="button" @click="activeFilter = 'ad_results'" 
                        :class="activeFilter === 'ad_results' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    نتائج الحملات الإعلانية الموثقة
                </button>
                <button type="button" @click="activeFilter = 'social_design'" 
                        :class="activeFilter === 'social_design' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    تصميمات سوشيال ميديا
                </button>
                <button type="button" @click="activeFilter = 'branding'" 
                        :class="activeFilter === 'branding' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    تصميم لوجو وهويات بصرية
                </button>
                <button type="button" @click="activeFilter = 'video_reels'" 
                        :class="activeFilter === 'video_reels' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-lg shadow-amber-500/20' : 'bg-brand-card text-gray-300 hover:text-white border border-brand-border'"
                        class="px-4 py-2 rounded-xl text-xs transition-all">
                    فيديوهات ريلز وسينما
                </button>
            </div>

            <!-- Portfolio Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolioItems as $item)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $item->category }}'"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="bg-brand-card border border-brand-border rounded-3xl overflow-hidden group hover:border-brand-yellow/60 transition-all duration-300 shadow-xl flex flex-col justify-between">
                    
                    <div>
                        <!-- Real Thumbnail / Media Box -->
                        <div class="relative aspect-video bg-black/40 flex items-center justify-center overflow-hidden cursor-pointer"
                             @click="openMedia('{{ $item->video_url ? 'video' : 'image' }}', '{{ $item->video_url ?: asset($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}')">
                            
                            @if($item->thumbnail)
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card via-black/20 to-transparent z-10"></div>
                            
                            @if($item->video_url)
                            <!-- Video Play Icon -->
                            <div class="w-14 h-14 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center text-lg z-20 shadow-2xl group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play mr-1"></i>
                            </div>
                            @else
                            <div class="absolute bottom-3 left-3 z-20 w-8 h-8 rounded-lg bg-black/60 backdrop-blur text-white flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                            @endif

                            <!-- Category Badge -->
                            <span class="absolute top-3 right-3 z-20 text-[10px] font-bold px-2.5 py-1 rounded-full bg-brand-dark/90 backdrop-blur-md text-brand-gold border border-brand-border">
                                {{ $item->category_arabic }}
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 space-y-2.5">
                            <h3 class="text-base font-bold text-white group-hover:text-brand-gold transition-colors leading-snug">
                                {{ $item->title }}
                            </h3>

                            <div class="text-xs text-brand-gold font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-building text-[10px]"></i>
                                <span>{{ $item->client_name }}</span>
                                @if($item->client_country)
                                <span>• {{ $item->client_country }}</span>
                                @endif
                            </div>

                            @if($item->metrics)
                            <div class="p-2 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-300 font-bold flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-brand-gold"></i>
                                <span>{{ $item->metrics }}</span>
                            </div>
                            @endif

                            <p class="text-xs text-gray-300 leading-relaxed pt-1">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <button type="button"
                                @click="openMedia('{{ $item->video_url ? 'video' : 'image' }}', '{{ $item->video_url ?: asset($item->thumbnail) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}')"
                                class="w-full py-2.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-brand-gold font-bold text-xs border border-brand-border transition flex items-center justify-center gap-2">
                            <i class="fa-solid {{ $item->video_url ? 'fa-play' : 'fa-magnifying-glass-plus' }}"></i>
                            <span>{{ $item->video_url ? 'تشغيل ومعاينة الفيديو' : 'معاينة العمل بالحجم الكامل' }}</span>
                        </button>
                    </div>

                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 7. REAL CLIENTS & PARTNERS WALL (With Actual Client Logos) -->
    <section id="clients" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
            <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">شركاء النجاح المعتمدون</span>
            <h2 class="text-3xl font-black text-white">علامات تجارية وضعت ثقتها في بريق</h2>
            <p class="text-xs text-gray-400">من كبرى الشركات والمؤسسات الطبية والتعليمية والمطاعم في الوطن العربي</p>
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
            <div class="p-5 rounded-2xl bg-brand-card/70 border border-brand-border/60 hover:border-brand-yellow/50 transition-all flex flex-col items-center justify-center text-center group shadow-md hover:-translate-y-1">
                <div class="w-16 h-16 rounded-xl bg-brand-purple/60 border border-brand-border/40 flex items-center justify-center p-2 mb-3 group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/clients/' . $cl['img']) }}" alt="{{ $cl['name'] }}" class="max-w-full max-h-full object-contain filter brightness-95 group-hover:brightness-110">
                </div>
                <span class="text-xs font-black text-white group-hover:text-brand-gold transition leading-snug">{{ $cl['name'] }}</span>
                <span class="text-[10px] text-gray-400 mt-1">{{ $cl['desc'] }}</span>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 8. CLIENT TESTIMONIALS & REVIEWS (آراء وتقييمات شركاء النجاح) -->
    <section id="testimonials" class="py-20 bg-brand-purple/30 border-y border-brand-border/40 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
                <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">قصص نجاح نعتز بها</span>
                <h2 class="text-3xl font-black text-white">ماذا يقول عملاؤنا عن العمل مع بريق؟</h2>
                <p class="text-xs text-gray-400">آراء موثقة من أصحاب الشركات والمؤسسات التي ساهمنا في نمو علاماتهم التجارية</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Review 1 -->
                <div class="p-7 rounded-3xl bg-brand-card/80 border border-brand-border hover:border-brand-yellow/50 transition-all shadow-xl space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center gap-1 text-brand-gold text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed italic">
                            "فريق بريق تولى إدارة الحملات الإعلانية وتصوير الفيديوهات الطبية للمجمع بالرياض. النتيجة كانت تضاعف حجوزات العيادات بنسبة تجاوزت 180% في أول شهرين."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-brand-border/50">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-yellow-500 text-brand-dark font-black flex items-center justify-center text-sm shadow">
                            ع
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white">د. عبد الرحمن المجيدي</div>
                            <div class="text-[10px] text-brand-gold">مجمع ماجستي الطبي (الرياض، السعودية)</div>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="p-7 rounded-3xl bg-brand-card/80 border border-brand-border hover:border-brand-yellow/50 transition-all shadow-xl space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center gap-1 text-brand-gold text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed italic">
                            "جودة تصوير الريلز والمونتاج السينمائي أحدثت ضجة كبيرة على تيك توك وانستجرام. الفيديوهات حققت ملايين المشاهدات وجلبت لنا طوابير زبائن في فرعنا الجديد."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-brand-border/50">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-indigo-500 text-white font-black flex items-center justify-center text-sm shadow">
                            ح
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white">أ. حسام الدين غانم</div>
                            <div class="text-[10px] text-brand-gold">مؤسس Shawrmaker (عَمّان، الأردن)</div>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="p-7 rounded-3xl bg-brand-card/80 border border-brand-border hover:border-brand-yellow/50 transition-all shadow-xl space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center gap-1 text-brand-gold text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed italic">
                            "الاحترافية في التزام مواعيد التسليم وتصميم الهوية الإعلانية جعلت بريق شريكنا الدائم لكافة علاماتنا التجارية. أنصح بهم بشدة لكل صاحب مشروع يريد نمواً حقيقياً."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-brand-border/50">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-brand-dark font-black flex items-center justify-center text-sm shadow">
                            س
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white">م. سيف النمر</div>
                            <div class="text-[10px] text-brand-gold">مدير تسويق شركة ألبان (القاهرة، مصر)</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 9. FAQ ACCORDION SECTION (الأسئلة الأكثر شيوعاً) -->
    <section id="faq" class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
            <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">إجابات واضحة وسريعة</span>
            <h2 class="text-3xl font-black text-white">الأسئلة الشائعة حول خدماتنا</h2>
            <p class="text-xs text-gray-400">كل ما تحتاج لمعرفته حول طريقة العمل والأسعار وخطوات البدء</p>
        </div>

        <div class="space-y-3">
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
            <div class="rounded-2xl bg-brand-card/70 border border-brand-border/60 overflow-hidden transition-colors">
                <button type="button" 
                        @click="activeFaq = (activeFaq === {{ $idx }} ? null : {{ $idx }})"
                        class="w-full p-5 text-right font-bold text-sm text-white flex items-center justify-between gap-4 hover:text-brand-gold transition">
                    <span>{{ $faq['q'] }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-brand-gold transition-transform duration-300"
                       :class="activeFaq === {{ $idx }} ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="activeFaq === {{ $idx }}" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 max-h-0"
                     x-transition:enter-end="opacity-100 max-h-96"
                     class="px-5 pb-5 text-xs text-gray-300 leading-relaxed border-t border-brand-border/30 pt-3">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 10. CONSULTATION & CONTACT FORM -->
    <section id="contact" class="py-20 bg-brand-purple/50 border-t border-brand-border relative z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-brand-card/90 border border-brand-border rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden">
                <div class="text-center max-w-xl mx-auto mb-8 space-y-2">
                    <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">ابدأ قصة نجاح علامتك اليوم</span>
                    <h2 class="text-3xl font-black text-white">احصل على استشارة تسويقية وعرض سعر فوري</h2>
                    <p class="text-xs text-gray-300">أخبرنا بما تحتاجه وسيتواصل معك مستشار بريق لمناقشة خطة العمل المخصصة لمشروعك.</p>
                </div>

                <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4 text-xs">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">اسمك الكريم <span class="text-red-400">*</span></label>
                            <input type="text" name="name" required placeholder="محمد أحمد" 
                                   class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1">اسم البراند أو الشركة</label>
                            <input type="text" name="brand_name" placeholder="اسم علامتك التجارية" 
                                   class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">رقم الهاتف أو الواتساب <span class="text-red-400">*</span></label>
                            <input type="text" name="phone" required placeholder="+2010... أو +966..." 
                                   class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1">البريد الإلكتروني</label>
                            <input type="email" name="email" placeholder="example@brand.com" 
                                   class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">الخدمة التي تهمك أكثر</label>
                            <select name="service_interested" 
                                    class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="تصوير ومونتاج فيديو ريلز">تصوير ومونتاج فيديو ريلز وسينما</option>
                                <option value="إعلانات ممولة وميديا باينج">إعلانات ممولة وميديا باينج (Meta, TikTok)</option>
                                <option value="تصميمات جرافيك وهوية بصرية">تصميمات جرافيك وبناء هوية بصرية</option>
                                <option value="إدارة كاملة لحسابات السوشيال ميديا">إدارة كاملة لحسابات السوشيال ميديا</option>
                                <option value="استشارة وبناء خطة تسويقية كاملة">استشارة وبناء خطة تسويقية كاملة</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-300 mb-1">الميزانية المتوقعة للمشروع</label>
                            <select name="budget_range" 
                                    class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                                <option value="أقل من 10,000 ج.م">أقل من 10,000 ج.م</option>
                                <option value="10,000 - 25,000 ج.م">10,000 - 25,000 ج.م</option>
                                <option value="25,000 - 50,000 ج.م">25,000 - 50,000 ج.م</option>
                                <option value="أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)">أكثر من 50,000 ج.م (عقد سنوي أو باقة كبرى)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">أخبرنا بنبذة عن أهدافك ورؤيتك</label>
                        <textarea name="message" rows="3" placeholder="اكتب لنا ملخصاً سريعاً عما تود تحقيقه لعلامتك التجارية..." 
                                  class="w-full px-4 py-3 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 rounded-xl bg-gradient-to-l from-brand-amber via-brand-yellow to-brand-gold text-brand-dark font-black text-sm hover:brightness-110 shadow-xl transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>إرسال طلب الاستشارة التسويقية</span>
                    </button>
                </form>

            </div>

        </div>
    </section>

    <!-- 11. FOOTER -->
    <footer class="bg-brand-darker border-t border-brand-border/60 py-12 px-4 sm:px-6 lg:px-8 relative z-10 text-xs text-gray-400">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-right">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="بريق" class="h-10 w-auto object-contain">
                <div>
                    <div class="text-lg font-black gold-gradient-text">بريق للتسويق الإلكتروني</div>
                    <div class="text-[11px] text-gray-400">مفتاح نجاحك في التسويق • جميع الحقوق محفوظة © {{ date('Y') }}</div>
                </div>
            </div>

            <!-- Social Media Icons -->
            <div class="flex items-center gap-3 text-lg">
                <a href="https://wa.me/201062330838?text=مرحباً%20بريق" target="_blank" class="w-9 h-9 rounded-lg bg-brand-card hover:bg-emerald-600 hover:text-white flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://facebook.com" target="_blank" class="w-9 h-9 rounded-lg bg-brand-card hover:bg-blue-600 hover:text-white flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-lg bg-brand-card hover:bg-pink-600 hover:text-white flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://tiktok.com" target="_blank" class="w-9 h-9 rounded-lg bg-brand-card hover:bg-white hover:text-black flex items-center justify-center transition text-gray-300">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            </div>

        </div>
    </footer>

    <!-- 12. FLOATING WHATSAPP CONSULTATION WIDGET (زر واتساب العائم للاستشارة المجانية) -->
    <div id="pariq-whatsapp-floating" class="fixed bottom-6 right-4 sm:right-6 z-40 flex items-center group">
        <!-- Interactive Tooltip Pill -->
        <a href="https://wa.me/201062330838?text=مرحباً%20وكالة%20بريق،%20أرغب%20في%20الحصول%20على%20استشارة%20تسويقية%20مجانية%20وعرض%20سعر" 
           target="_blank" 
           class="hidden sm:flex items-center gap-2 px-3.5 py-2 ml-2.5 rounded-full bg-[#18082B]/95 border border-emerald-500/40 text-white text-xs font-bold shadow-2xl backdrop-blur-md transform transition-all group-hover:scale-105 group-hover:border-emerald-400">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>طلب استشارة مجانية فوراً 💬</span>
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
            class="fixed bottom-24 right-5 sm:right-7 z-40 w-11 h-11 rounded-full bg-brand-purple/90 border border-brand-border hover:border-brand-gold text-brand-gold hover:text-white flex items-center justify-center text-sm shadow-xl backdrop-blur-md hover:scale-110 active:scale-95 transition-all" 
            style="display: none;">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- 14. Universal Preview Modal (Images & Videos) -->
    <div x-show="previewModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md" 
         style="display: none;">
        <div @click.away="closeMedia()" 
             class="w-full max-w-4xl bg-brand-card border border-brand-border rounded-3xl p-6 shadow-2xl relative space-y-4">
            
            <button @click="closeMedia()" 
                    class="absolute -top-12 left-0 text-white hover:text-brand-gold text-2xl">
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
                <h3 class="text-lg font-bold text-white" x-text="activeMedia.title"></h3>
                <p class="text-xs text-gray-300" x-text="activeMedia.desc"></p>
            </div>
        </div>
    </div>

    <!-- Script for Live Count-Up Animation -->
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
                        // Smooth ease-out cubic
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

    @include('partials.pwa-prompts')
</body>
</html>
