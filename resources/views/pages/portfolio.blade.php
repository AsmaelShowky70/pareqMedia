@extends('layouts.public')

@section('title', 'معرض أعمال بريق الحقيقي والموثق')
@section('meta_description', 'تصفح أعمال وكالة بريق الحقيقية: فيديوهات برومو، ريلز سينمائية، تصاميم جرافيك وأغلفة، نتائج حملات إعلانية ROAS، وهويات بصرية متكاملة.')

@section('content')
<!-- Hero Header for Portfolio -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-orange transition">الرئيسية</a>
        <span class="text-brand-orange">/</span>
        <span class="text-brand-orange font-bold">معرض الأعمال الحقيقي الموثق</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        أعمال إبداعية تتحدث عن 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">نتائجها الاستثنائية</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        نماذج حقيقية مدعومة بالأرقام: فيديوهات برومو سينمائية، ريلز سريعة حصدت ملايين المشاهدات، تصاميم وأغلفة عالية النقر، نتائج حملات إعلانية ضاعفت المبيعات، وهويات بصرية كاملة.
    </p>

    <!-- Key Metrics Pills -->
    <div class="flex flex-wrap items-center justify-center gap-4 pt-8 text-xs font-bold">
        <div class="px-4 py-2 rounded-xl bg-orange-500/15 border border-brand-orange/30 text-brand-orange flex items-center gap-2">
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

<!-- =========================================================================
     3D WIDESCREEN CINEMATIC PORTFOLIO SHOWCASE (معرض أعمال ثلاثي الأبعاد بشكل سينمائي عريض مع حركة تلقائية من الشمال لليمين)
     ========================================================================= -->
@php
    $showcasePortfolio = [];
    if (isset($portfolioItems) && $portfolioItems->isNotEmpty()) {
        foreach ($portfolioItems->take(12) as $pItem) {
            $tUrl = $pItem->thumbnail ?: $pItem->thumbnail_url;
            $fThumb = $tUrl ? (str_starts_with($tUrl, 'http') ? $tUrl : asset(ltrim($tUrl, '/'))) : asset('images/portfolio/social_1.webp');
            $fMedia = $pItem->video_url ? (str_starts_with($pItem->video_url, 'http') ? $pItem->video_url : asset(ltrim($pItem->video_url, '/'))) : ($pItem->media_url ?: $fThumb);
            $mType = ($pItem->video_url || $pItem->media_type === 'video') ? 'video' : 'image';
            $asp = in_array($pItem->category, ['reels', 'video_reels']) ? 'vertical' : 'landscape';
            $showcasePortfolio[] = [
                'id' => $pItem->id,
                'title' => $pItem->title,
                'client' => ($pItem->client_name ?? 'شريك نجاح') . ($pItem->client_country ? ' • ' . $pItem->client_country : ''),
                'category' => $pItem->category_arabic ?? 'إنتاج إبداعي',
                'mediaType' => $mType,
                'finalMedia' => $fMedia,
                'thumb' => $fThumb,
                'metrics' => $pItem->metrics ?: 'عمل موثق',
                'desc' => $pItem->description ?: 'إنتاج إبداعي سينمائي بأعلى معايير الجودة والإتقان من وكالة بريق.',
                'aspect' => $asp,
            ];
        }
    }
@endphp

@if(!empty($showcasePortfolio))
<section class="py-12 bg-gradient-to-b from-[#08020F] via-[#140626] to-transparent relative z-10 overflow-hidden"
         x-data="{ 
             activeIdx: 0, 
             autoplayTimer: null,
             progress: 0,
             progressTimer: null,
             works: {{ Js::from($showcasePortfolio) }},
             next() { 
                 if (this.works.length <= 1) return;
                 this.activeIdx = (this.activeIdx + 1) % this.works.length; 
                 this.resetTimer();
             },
             prev() { 
                 if (this.works.length <= 1) return;
                 this.activeIdx = (this.activeIdx - 1 + this.works.length) % this.works.length; 
                 this.resetTimer();
             },
             startAutoplay() {
                 this.stopAutoplay();
                 this.progress = 0;
                 if (this.works.length > 1) {
                     this.progressTimer = setInterval(() => {
                         if (this.progress < 100) {
                             this.progress += 1;
                         }
                     }, 100);
                     this.autoplayTimer = setInterval(() => { 
                         this.next(); 
                     }, 10000);
                 }
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
                 const total = this.works.length;
                 if (total <= 1) {
                     return 'transform: translateX(0px) scale(1) perspective(1000px); z-index: 30; opacity: 1;';
                 }
                 let diff = idx - this.activeIdx;
                 if (diff > total / 2) diff -= total;
                 if (diff < -total / 2) diff += total;
                 const absDiff = Math.abs(diff);
                 if (absDiff > 2) return 'display: none;';
                 const translateX = diff * (window.innerWidth < 640 ? 250 : (window.innerWidth < 1024 ? 340 : 430));
                 const scale = 1 - (absDiff * 0.12);
                 const rotateY = diff * -16;
                 const zIndex = 30 - (absDiff * 10);
                 const opacity = 1 - (absDiff * 0.35);
                 return `transform: translateX(${translateX}px) scale(${scale}) perspective(1000px) rotateY(${rotateY}deg); z-index: ${zIndex}; opacity: ${opacity};`;
             }
         }"
         x-init="startAutoplay()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-2xl mx-auto mb-8 space-y-2">
            <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
                صالة عرض سينمائية عريضة 3D
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-white">استعراض تفاعلي لأبرز أعمال بريق</h2>
            <p class="text-xs sm:text-sm text-gray-300">تصميم عريض سينمائي يتحرك تلقائياً كل 10 ثوانٍ • انقر على أي عمل لفتحه بجودة فائقة</p>
        </div>

        <!-- 3D Widescreen Track -->
        <div class="relative py-4">
            <div class="relative h-[270px] sm:h-[330px] md:h-[370px] lg:h-[400px] w-full flex items-center justify-center overflow-hidden"
                 :class="works.length === 1 ? '!h-[280px] sm:!h-[360px] md:!h-[420px] lg:!h-[460px]' : ''">
                <template x-for="(item, idx) in works" :key="item.id + '-' + idx">
                    <div @click="activeIdx === idx ? openMedia(item.mediaType, item.finalMedia, item.title, item.desc, item.aspect) : (activeIdx = idx)"
                         :style="getCardStyle(idx)"
                         :class="[
                             activeIdx === idx ? 'border-2 border-brand-orange shadow-[0_0_55px_rgba(255,148,32,0.45)] ring-2 ring-brand-orange/50' : 'border border-purple-800/60 hover:border-brand-orange/60',
                             works.length === 1 ? '!w-[320px] sm:!w-[520px] md:!w-[680px] lg:!w-[800px] !h-[260px] sm:!h-[340px] md:!h-[400px] lg:!h-[440px]' : 'w-[310px] sm:w-[440px] md:w-[530px] lg:w-[610px] h-[230px] sm:h-[290px] md:h-[330px] lg:h-[360px]'
                         ]"
                         class="absolute rounded-2xl sm:rounded-3xl overflow-hidden cursor-pointer transition-all duration-500 ease-out shadow-2xl group flex flex-col justify-between select-none bg-[#0D031A]">
                         
                         <!-- Full Background Artwork -->
                         <img :src="item.thumb" :alt="item.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-108">
                         <div class="absolute inset-0 bg-gradient-to-t from-black via-black/35 to-black/60"></div>
                         
                         <!-- Top Category & Client Info -->
                         <div class="relative z-10 p-4 sm:p-5 flex items-center justify-between gap-2">
                             <span class="px-3 py-1 rounded-full bg-black/85 backdrop-blur-md border border-brand-orange/50 text-[10px] sm:text-xs font-black text-brand-orange flex items-center gap-1.5 shadow-md">
                                 <i class="fa-solid" :class="item.mediaType === 'video' ? 'fa-clapperboard' : 'fa-image'"></i>
                                 <span x-text="item.category"></span>
                             </span>
                             <span class="px-3 py-1 rounded-full bg-black/80 backdrop-blur-md border border-white/20 text-[10px] sm:text-xs font-bold text-gray-200 truncate max-w-[200px]"
                                   x-text="item.client"></span>
                         </div>
                         
                         <!-- Centered Play/Inspect Glowing Button -->
                         <div class="relative z-10 flex items-center justify-center my-auto pointer-events-none">
                             <div class="w-13 h-13 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-brand-orange to-amber-400 text-brand-dark flex items-center justify-center text-lg sm:text-2xl shadow-[0_0_30px_#FF9420] group-hover:scale-115 transition-transform duration-300">
                                 <i class="fa-solid" :class="item.mediaType === 'video' ? 'fa-play mr-0.5' : 'fa-expand'"></i>
                             </div>
                         </div>

                         <!-- Bottom Frosted Info Bar -->
                         <div class="relative z-10 p-3 sm:p-4 bg-[#0A0214]/90 backdrop-blur-md border-t border-brand-orange/30 flex items-center justify-between gap-3 text-right">
                             <div class="min-w-0 flex-1">
                                 <h3 class="text-xs sm:text-sm md:text-base font-black text-white truncate group-hover:text-brand-orange transition-colors" x-text="item.title"></h3>
                                 <div class="text-[10px] sm:text-xs text-amber-300 font-bold truncate mt-0.5" x-text="item.metrics"></div>
                             </div>
                             
                             <button type="button"
                                     @click.stop="openMedia(item.mediaType, item.finalMedia, item.title, item.desc, item.aspect)"
                                     class="shrink-0 px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-xl bg-brand-orange hover:bg-brand-orangeHover text-brand-dark font-black text-[10px] sm:text-xs transition shadow-lg flex items-center gap-1.5 active:scale-95">
                                 <i class="fa-solid" :class="item.mediaType === 'video' ? 'fa-play' : 'fa-eye'"></i>
                                 <span class="hidden sm:inline">مشاهدة العمل</span>
                             </button>
                         </div>
                    </div>
                </template>
            </div>

            <!-- Controls (show with smooth 10s progress indicator) -->
            <div class="flex items-center justify-center gap-5 sm:gap-7 mt-8" x-show="works.length > 1">
                <button type="button" @click="prev()" 
                        aria-label="السابق"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#150626] border border-purple-800/60 hover:border-brand-orange hover:bg-brand-orange hover:text-brand-dark text-white flex items-center justify-center transition shadow-lg active:scale-95">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

                <!-- Dual Visual Track: Current Item Number + Live 10s Countdown Bar -->
                <div class="flex flex-col items-center gap-2 w-56 sm:w-80">
                    <div class="flex items-center justify-between w-full text-[11px] font-mono">
                        <span class="font-black text-brand-orange" x-text="(activeIdx + 1 < 10 ? '0' : '') + (activeIdx + 1)">01</span>
                        <span class="text-[10px] text-brand-peach/80 flex items-center gap-1 font-sans">
                            <i class="fa-solid fa-clock-rotate-left text-[9px] animate-spin-slow"></i>
                            <span>تبديل تلقائي كل 10ث</span>
                        </span>
                        <span class="font-bold text-gray-400" x-text="works.length < 10 ? '0' + works.length : works.length">05</span>
                    </div>
                    <!-- Dynamic 10-Second Countdown Track -->
                    <div class="w-full h-2 bg-purple-950/80 rounded-full overflow-hidden relative border border-purple-800/50 p-0.5">
                        <div class="h-full bg-gradient-to-r from-brand-orange via-amber-400 to-brand-peach rounded-full transition-all duration-100 ease-linear shadow-[0_0_10px_#FF9420]"
                             :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>

                <button type="button" @click="next()" 
                        aria-label="التالي"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#150626] border border-purple-800/60 hover:border-brand-orange hover:bg-brand-orange hover:text-brand-dark text-white flex items-center justify-center transition shadow-lg active:scale-95">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endif

<!-- MAIN PORTFOLIO SECTION WITH FILTER (جميع الأعمال . برومو . ريلز . تصميم . حملات إعلانية . هوية بصرية) -->
<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10" x-data="{ activeFilter: 'all' }">
    
    <!-- Filter Pills as Requested by Client -->
    <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14">
        <!-- 1. جميع الأعمال -->
        <button type="button" @click="activeFilter = 'all'" 
                :class="activeFilter === 'all' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200">
            جميع الأعمال
        </button>

        <!-- 2. برومو -->
        <button type="button" @click="activeFilter = 'promo'" 
                :class="activeFilter === 'promo' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-clapperboard text-brand-orange"></i>
            <span>برومو</span>
        </button>

        <!-- 3. ريلز (مقاس طولي) -->
        <button type="button" @click="activeFilter = 'reels'" 
                :class="activeFilter === 'reels' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-mobile-screen text-amber-400"></i>
            <span>ريلز</span>
        </button>

        <!-- 4. تصميم (مربع أو مستطيل) -->
        <button type="button" @click="activeFilter = 'design'" 
                :class="activeFilter === 'design' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-bezier-curve text-purple-300"></i>
            <span>تصميم</span>
        </button>

        <!-- 5. حملات إعلانية (عرضي) -->
        <button type="button" @click="activeFilter = 'campaigns'" 
                :class="activeFilter === 'campaigns' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-emerald-400"></i>
            <span>حملات إعلانية</span>
        </button>

        <!-- 6. هوية بصرية (ملخص وبنود متعددة) -->
        <button type="button" @click="activeFilter = 'branding'" 
                :class="activeFilter === 'branding' ? 'bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black shadow-lg shadow-orange-500/30 scale-105' : 'bg-[#150626] text-gray-300 hover:text-white border border-purple-800/60'"
                class="px-5 py-2.5 rounded-2xl text-xs transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-palette text-cyan-400"></i>
            <span>هوية بصرية</span>
        </button>
    </div>

    <!-- Portfolio Cards Grid (Styled per format: Reels=Vertical, Design=Square/Ratio, Promo=Horizontal with perfectly centered play button, Branding=Summary & Multiple items) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
        @forelse($portfolioItems as $item)
        @php
            $thumbUrl = $item->thumbnail;
            $finalThumb = $thumbUrl ? (str_starts_with($thumbUrl, 'http') ? $thumbUrl : asset(ltrim($thumbUrl, '/'))) : asset('images/portfolio/social_1.webp');
            $finalMedia = $item->video_url ?: $finalThumb;
            
            // Determine type and aspect ratio based on category
            $cat = $item->category;
            $isReel = in_array($cat, ['reels', 'video_reels']);
            $isPromo = in_array($cat, ['promo', 'promo_video']);
            $isDesign = in_array($cat, ['design', 'social_design', 'youtube_thumbnail']);
            $isCampaign = in_array($cat, ['campaigns', 'ad_results']);
            $isBranding = ($cat === 'branding');

            $mediaType = $item->video_url ? 'video' : ($isBranding ? 'branding' : 'image');
            $aspectRatio = $isReel ? 'aspect-[9/14]' : ($isDesign ? 'aspect-square' : 'aspect-video');
            $aspectType = $isReel ? 'vertical' : 'landscape';
        @endphp

        <div x-show="activeFilter === 'all' || 
                     (activeFilter === 'promo' && ('{{ $cat }}' === 'promo' || '{{ $cat }}' === 'promo_video')) || 
                     (activeFilter === 'reels' && ('{{ $cat }}' === 'reels' || '{{ $cat }}' === 'video_reels')) || 
                     (activeFilter === 'design' && ('{{ $cat }}' === 'design' || '{{ $cat }}' === 'social_design' || '{{ $cat }}' === 'youtube_thumbnail')) || 
                     (activeFilter === 'campaigns' && ('{{ $cat }}' === 'campaigns' || '{{ $cat }}' === 'ad_results')) || 
                     (activeFilter === 'branding' && ('{{ $cat }}' === 'branding'))"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="glass-card-purple rounded-[2rem] overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-2xl flex flex-col justify-between border border-purple-800/60 hover:border-brand-orange">
            
            <div>
                <!-- Thumbnail Box with Adjusted Aspect Ratio per Client Request -->
                <div class="relative {{ $aspectRatio }} bg-black/70 flex items-center justify-center overflow-hidden cursor-pointer"
                     @click="openMedia('{{ $mediaType }}', '{{ $finalMedia }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ $aspectType }}')">
                    
                    <img src="{{ $finalThumb }}" alt="{{ $item->title }}" 
                         class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#140626] via-black/20 to-transparent z-10"></div>
                    
                    <!-- Centered Video Play Button for Promo & Reels (Properly Centered and Aligned) -->
                    @if($item->video_url)
                    <div class="absolute inset-0 z-20 flex items-center justify-center pointer-events-none">
                        <div class="relative flex items-center justify-center">
                            <span class="absolute w-16 h-16 rounded-full bg-brand-orange/30 animate-radar"></span>
                            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-brand-orange to-[#FF7A00] text-brand-dark flex items-center justify-center text-lg shadow-2xl group-hover:scale-115 transition-transform duration-300">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                    </div>
                    @elseif($isBranding)
                    <div class="absolute inset-0 z-20 flex items-center justify-center">
                        <span class="px-4 py-2 rounded-xl bg-brand-orange/90 text-brand-dark font-black text-xs shadow-xl backdrop-blur flex items-center gap-2 group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-layer-group"></i>
                            <span>تصفح بنود الهوية (8 بنود)</span>
                        </span>
                    </div>
                    @else
                    <div class="absolute bottom-3 left-3 z-20 w-9 h-9 rounded-xl bg-black/75 backdrop-blur text-white flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition duration-200">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </div>
                    @endif

                    <!-- Category Badge -->
                    <span class="absolute top-3 right-3 z-20 text-[10px] font-bold px-3 py-1 rounded-full bg-black/80 backdrop-blur-md text-brand-peach border border-purple-500/30">
                        {{ $item->category_arabic }}
                    </span>

                    @if($isReel)
                    <span class="absolute top-3 left-3 z-20 text-[10px] font-bold px-2.5 py-0.5 rounded-md bg-amber-500/80 text-black">
                        9:16 Reel
                    </span>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="p-6 space-y-3">
                    <h3 class="text-base font-black text-white group-hover:text-brand-orange transition-colors leading-snug">
                        {{ $item->title }}
                    </h3>

                    <div class="text-xs text-brand-peach font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-building text-[10px]"></i>
                        <span>{{ $item->client_name }}</span>
                        @if($item->client_country)
                        <span>• {{ $item->client_country }}</span>
                        @endif
                    </div>

                    @if($item->metrics)
                    <div class="p-2.5 rounded-xl bg-orange-500/10 border border-brand-orange/20 text-xs text-brand-orange font-bold flex items-center gap-2">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>{{ $item->metrics }}</span>
                    </div>
                    @endif

                    <p class="text-xs text-gray-300 leading-relaxed pt-1 font-normal line-clamp-3">
                        {{ $item->description }}
                    </p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="p-6 pt-0">
                <button type="button"
                        @click="openMedia('{{ $mediaType }}', '{{ $finalMedia }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ $aspectType }}')"
                        class="w-full py-2.5 rounded-xl bg-purple-900/40 hover:bg-gradient-to-l hover:from-brand-orange hover:to-[#FF7A00] hover:text-brand-dark text-brand-peach font-bold text-xs border border-purple-600/40 hover:border-transparent transition flex items-center justify-center gap-2 shadow">
                    @if($item->video_url)
                    <i class="fa-solid fa-play"></i>
                    <span>تشغيل ومعاينة الفيديو</span>
                    @elseif($isBranding)
                    <i class="fa-solid fa-layer-group"></i>
                    <span>عرض حزمة وبنود الهوية</span>
                    @else
                    <i class="fa-solid fa-expand"></i>
                    <span>معاينة العمل بالحجم الكامل</span>
                    @endif
                </button>
            </div>

        </div>
        @empty
        <div class="col-span-full py-16 text-center text-gray-400">
            <i class="fa-solid fa-sparkles text-4xl text-brand-orange mb-3"></i>
            <p class="text-sm">يتم تحديث قائمة الأعمال الإبداعية بصورة دورية...</p>
        </div>
        @endforelse
    </div>

</section>

<!-- BOTTOM CTA -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-brand-orange/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">هل أنت مستعد لنصنع لعلامتك عملاً استثنائياً؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            تواصل معنا لمناقشة أهدافك ونوع المحتوى الملائم لنشاطك، وسنبدأ فوراً في إعداد الخطة والإنتاج.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                طلب مشروع جديد الآن
            </a>
            <a href="https://wa.me/201062330838" target="_blank" class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-purple-900/60 border border-brand-orange/50 text-white font-bold text-xs transition flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                <span>محادثة واتساب مباشرة</span>
            </a>
        </div>
    </div>
</section>
@endsection
