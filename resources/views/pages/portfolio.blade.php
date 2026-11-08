@extends('layouts.public')

@section('title', 'معرض أعمال بريق الحقيقي والموثق')
@section('meta_description', 'تصفح أعمال وكالة بريق الحقيقية: أغلفة يوتيوب عالية النقر CTR، فيديوهات ريلز وسينما 4K، تصاميم هويات تجارية، ونتائج حملات إعلانية موثقة.')

@section('content')
<!-- Hero Header for Portfolio -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-gold transition">الرئيسية</a>
        <span class="text-brand-amber">/</span>
        <span class="text-brand-gold font-bold">معرض الأعمال الحقيقي الموثق</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        أعمال إبداعية تتحدث عن 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">نتائجها الاستثنائية</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        لا نعرض مجرد صور وتصاميم، بل نماذج حقيقية مدعومة بالأرقام: نسب نقر عالية لأغلفة اليوتيوب، فيديوهات ريلز وسينما حصدت ملايين المشاهدات، ونتائج حملات إعلانية ضاعفت مبيعات شركائنا.
    </p>

    <!-- Key Metrics Pills -->
    <div class="flex flex-wrap items-center justify-center gap-4 pt-8 text-xs font-bold">
        <div class="px-4 py-2 rounded-xl bg-amber-500/15 border border-amber-500/30 text-brand-gold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>+480 مشروع منجز بنجاح</span>
        </div>
        <div class="px-4 py-2 rounded-xl bg-purple-500/15 border border-purple-500/30 text-purple-300 flex items-center gap-2">
            <i class="fa-solid fa-globe"></i>
            <span>شركاء نجاح في 6 دول عربية</span>
        </div>
        <div class="px-4 py-2 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center gap-2">
            <i class="fa-solid fa-chart-line"></i>
            <span>عائد إعلاني موثق يتجاوز ROAS 6.8x</span>
        </div>
    </div>
</section>

<!-- MAIN PORTFOLIO SECTION WITH FILTER -->
<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10" x-data="{ activeFilter: 'all' }">
    
    <!-- Filter Pills -->
    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14">
        <button type="button" @click="activeFilter = 'all'" 
                :class="activeFilter === 'all' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            جميع الأعمال
        </button>
        <button type="button" @click="activeFilter = 'youtube_thumbnail'" 
                :class="activeFilter === 'youtube_thumbnail' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            أغلفة يوتيوب مصغرة (High CTR)
        </button>
        <button type="button" @click="activeFilter = 'ad_results'" 
                :class="activeFilter === 'ad_results' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            نتائج الحملات الإعلانية (ROAS)
        </button>
        <button type="button" @click="activeFilter = 'social_design'" 
                :class="activeFilter === 'social_design' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            تصميمات سوشيال ميديا
        </button>
        <button type="button" @click="activeFilter = 'branding'" 
                :class="activeFilter === 'branding' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            تصميم لوجو وهوية بصرية
        </button>
        <button type="button" @click="activeFilter = 'video_reels'" 
                :class="activeFilter === 'video_reels' ? 'bg-gradient-to-l from-brand-orange to-brand-amber text-brand-dark font-black shadow-lg shadow-amber-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            فيديوهات ريلز وإنتاج سينمائي
        </button>
    </div>

    <!-- Portfolio Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($portfolioItems as $item)
        <div x-show="activeFilter === 'all' || activeFilter === '{{ $item->category }}'"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="glass-card-purple rounded-[2rem] overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-2xl flex flex-col justify-between">
            
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
        <!-- Fallback if empty -->
        <div class="col-span-full py-16 text-center text-gray-400">
            <i class="fa-solid fa-sparkles text-4xl text-brand-gold mb-3"></i>
            <p class="text-sm">يتم تحديث قائمة الأعمال الإبداعية بصورة دورية...</p>
        </div>
        @endforelse
    </div>

</section>

<!-- IN-DEPTH CASE STUDIES HIGHLIGHT (دراسات حالة حقيقية) -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10 border-t border-purple-900/40">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-black text-brand-gold uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-yellow/10 border border-brand-yellow/30">
            قصص نجاح بالأرقام والنتائج
        </span>
        <h2 class="text-3xl sm:text-5xl font-black text-white">كيف حققنا لعملائنا طفرات مبيعات حقيقية؟</h2>
        <p class="text-xs sm:text-sm text-gray-300">أمثلة موثقة على تحول الأفكار إلى حملات حققت ملايين المشاهدات وعوائد مالية قياسية.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Case Study 1 -->
        <div class="glass-card-purple rounded-[2rem] p-8 space-y-5 border border-purple-800/60 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-brand-amber">مطاعم • الأردن</span>
                <span class="text-xs font-black px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">+240% مبيعات</span>
            </div>
            <h3 class="text-xl font-black text-white">مطاعم شاورماكر (Shawrmaker Jordan)</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                <strong>التحدي:</strong> إطلاق فرع جديد وزيادة الإقبال في فترة ركود موسمي.
                <br><br>
                <strong>الحل:</strong> إنتاج 20 فيديو ريلز بمونتاج سريع يركز على بخار وجاذبية الطعام مع أصوات تريند مخصصة لتيك توك وإنستجرام، وإطلاق إعلانات جغرافية مستهدفة بدقة 2 كم حول الفرع.
                <br><br>
                <strong>النتيجة:</strong> أكثر من 3.8 مليون مشاهدة وطوابير زبائن قياسية في الأسبوع الأول من الافتتاح.
            </p>
        </div>

        <!-- Case Study 2 -->
        <div class="glass-card-purple rounded-[2rem] p-8 space-y-5 border border-purple-800/60 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-brand-amber">قطاع طبي • الرياض</span>
                <span class="text-xs font-black px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">ROAS 5.8x</span>
            </div>
            <h3 class="text-xl font-black text-white">مجمع ماجستي الطبي (الرياض، السعودية)</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                <strong>التحدي:</strong> ارتفاع تكلفة حجز الكشف الطبي وصعوبة الوصول للشريحة المهتمة بعمليات التجميل والأسنان.
                <br><br>
                <strong>الحل:</strong> تصوير فيديوهات شرح احترافية مع أطباء المجمع، وضبط حملات ليدز ذكية على سناب شات وميتا آدز مع فلترة الجمهور الشرائي.
                <br><br>
                <strong>النتيجة:</strong> مضاعفة حجوزات العيادات بنسبة 180% وتقليل تكلفة العميل المكتسب بنسبة 45%.
            </p>
        </div>

        <!-- Case Study 3 -->
        <div class="glass-card-purple rounded-[2rem] p-8 space-y-5 border border-purple-800/60 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-brand-amber">صناعات غذائية • مصر</span>
                <span class="text-xs font-black px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">هوية متكاملة</span>
            </div>
            <h3 class="text-xl font-black text-white">منتجات ألبان ويلفير (Welfare Dairy)</h3>
            <p class="text-xs text-gray-300 leading-relaxed font-normal">
                <strong>التحدي:</strong> شركة عريقة تأسست عام 1970 ترغب في تجديد هويتها البصرية لتبدو عصرية وتنافس الشركات الحديثة.
                <br><br>
                <strong>الحل:</strong> إعادة رسم وتحديث اللوجو، تصميم عبوات المنتجات والأجبان، وجلسة تصوير منتجات كاملة عالية التباين للكتالوج الإلكتروني.
                <br><br>
                <strong>النتيجة:</strong> اعتماد الهوية الجديدة في أكثر من 40 هايبر ماركت وزيادة انتشار العلامة التجارية.
            </p>
        </div>

    </div>
</section>

<!-- BOTTOM CTA -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-purple-500/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">جاهز لنصنع لعلامتك التجارية عملاً إبداعياً مماثلاً؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            دعنا نتولى إنتاجك المرئي وحملاتك التسويقية لتصل إلى نفس المستوى من الاحترافية والنتائج الموثقة.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-brand-gold text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                طلب استشارة مجانية وعرض سعر
            </a>
            <a href="https://wa.me/201062330838?text=مرحباً%20بريق،%20شاهدت%20معرض%20أعمالكم%20وأرغب%20في%20تنفيذ%20مشروع%20مماثل" 
               target="_blank"
               class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-emerald-600 border border-purple-600/40 hover:border-emerald-500 text-white font-bold text-xs transition flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-400 group-hover:text-white"></i>
                <span>نقاش فوري عبر واتساب</span>
            </a>
        </div>
    </div>
</section>
@endsection
