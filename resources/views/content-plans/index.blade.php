@extends('layouts.app')

@section('title', 'جدول وخطة نشر المحتوى للعملاء | وكالة بريق')

@section('content')
<div class="space-y-6" x-data="contentCalendarApp()">

    <!-- Header & Action Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-brand-card p-6 rounded-2xl border border-brand-border shadow-xl">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-amber to-brand-yellow text-brand-dark flex items-center justify-center text-2xl shadow-lg">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-white flex items-center gap-2">
                        جدول وخطة نشر المحتوى للعملاء
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ Auth::user()->isAdmin() ? 'الإدارة العامة' : 'لوحة صانع المحتوى' }}
                        </span>
                    </h1>
                    <p class="text-sm text-gray-400 mt-0.5">تخطيط وجدولة منشورات وريلز السوشيال ميديا ومتابعة مواعيد التسليم والنشر للعملاء</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <!-- View Switcher -->
            <div class="inline-flex rounded-xl bg-brand-dark p-1 border border-brand-border">
                <a href="{{ request()->fullUrlWithQuery(['view' => 'table']) }}" 
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 {{ $view === 'table' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow' : 'text-gray-400 hover:text-white' }}">
                    <i class="fa-solid fa-table-list"></i>
                    <span>جدول النشر</span>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['view' => 'calendar']) }}" 
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 {{ $view === 'calendar' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow' : 'text-gray-400 hover:text-white' }}">
                    <i class="fa-solid fa-calendar-alt"></i>
                    <span>التقويم الشهري</span>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['view' => 'pipeline']) }}" 
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 {{ $view === 'pipeline' ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark shadow' : 'text-gray-400 hover:text-white' }}">
                    <i class="fa-solid fa-bars-staggered"></i>
                    <span>مراحل النشر</span>
                </a>
            </div>

            <!-- Add Post Button -->
            <button @click="openCreateModal()" 
                    class="px-4 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-bold text-sm shadow hover:opacity-90 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-base"></i>
                <span>إضافة منشور للخطة +</span>
            </button>
        </div>
    </div>

    <!-- Month Navigation Bar -->
    <div class="bg-brand-card/90 p-4 rounded-2xl border border-brand-border flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ request()->fullUrlWithQuery(['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}" 
               class="px-3 py-2 rounded-xl bg-brand-dark hover:bg-brand-hover border border-brand-border text-gray-300 hover:text-white text-xs font-bold flex items-center gap-1.5 transition">
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span>{{ $prevMonth->translatedFormat('F Y') }}</span>
            </a>

            <div class="px-5 py-1.5 rounded-xl bg-gradient-to-r from-brand-amber/15 via-brand-yellow/10 to-brand-amber/15 border border-brand-yellow/30 text-center">
                <div class="text-xs text-brand-gold/80 font-medium">خطة شهر</div>
                <div class="text-lg font-black text-white tracking-wide">
                    {{ $selectedDate->translatedFormat('F Y') }}
                </div>
            </div>

            <a href="{{ request()->fullUrlWithQuery(['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}" 
               class="px-3 py-2 rounded-xl bg-brand-dark hover:bg-brand-hover border border-brand-border text-gray-300 hover:text-white text-xs font-bold flex items-center gap-1.5 transition">
                <span>{{ $nextMonth->translatedFormat('F Y') }}</span>
                <i class="fa-solid fa-chevron-left text-[10px]"></i>
            </a>

            @if($year != now()->year || $month != now()->month)
            <a href="{{ request()->fullUrlWithQuery(['year' => now()->year, 'month' => now()->month]) }}" 
               class="px-3 py-1.5 rounded-lg bg-brand-yellow/10 hover:bg-brand-yellow/20 text-brand-gold text-xs font-bold border border-brand-yellow/30 transition">
                العودة للشهر الحالي
            </a>
            @endif
        </div>

        <!-- Filter Controls -->
        <form method="GET" action="{{ route('content-plans.index') }}" class="flex flex-wrap items-center gap-2">
            <input type="hidden" name="year" value="{{ $year }}">
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="view" value="{{ $view }}">

            <!-- Client Filter -->
            <select name="client_id" onchange="this.form.submit()" 
                    class="bg-brand-dark border border-brand-border rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-brand-yellow">
                <option value="">جميع العملاء</option>
                @foreach($clients as $c)
                    <option value="{{ $c->id }}" {{ $clientId == $c->id ? 'selected' : '' }}>
                        {{ $c->brand_name ? $c->brand_name . ' (' . $c->name . ')' : $c->name }}
                    </option>
                @endforeach
            </select>

            <!-- Content Creator Filter (for GM) -->
            @if(Auth::user()->isAdmin())
            <select name="creator_id" onchange="this.form.submit()" 
                    class="bg-brand-dark border border-brand-border rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-brand-yellow">
                <option value="">جميع صناع المحتوى</option>
                @foreach($creators as $cr)
                    <option value="{{ $cr->id }}" {{ $creatorId == $cr->id ? 'selected' : '' }}>
                        {{ $cr->name }}
                    </option>
                @endforeach
            </select>
            @endif

            <!-- Content Type Filter -->
            <select name="type" onchange="this.form.submit()" 
                    class="bg-brand-dark border border-brand-border rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-brand-yellow">
                <option value="">جميع أنواع المحتوى</option>
                <option value="reel" {{ $type === 'reel' ? 'selected' : '' }}>🎬 ريل (Reel)</option>
                <option value="carousel" {{ $type === 'carousel' ? 'selected' : '' }}>📑 كاروسيل (Carousel)</option>
                <option value="post" {{ $type === 'post' ? 'selected' : '' }}>🖼️ بوست تصميم (Post)</option>
                <option value="story" {{ $type === 'story' ? 'selected' : '' }}>⭕ ستوري (Story)</option>
                <option value="video" {{ $type === 'video' ? 'selected' : '' }}>📹 فيديو (Video)</option>
                <option value="tiktok" {{ $type === 'tiktok' ? 'selected' : '' }}>🎵 تيك توك (TikTok)</option>
            </select>

            <!-- Status Filter -->
            <select name="status" onchange="this.form.submit()" 
                    class="bg-brand-dark border border-brand-border rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-brand-yellow">
                <option value="">جميع الحالات</option>
                <option value="today" {{ $status === 'today' ? 'selected' : '' }}>📣 مقرر نشره اليوم</option>
                <option value="scheduled" {{ $status === 'scheduled' ? 'selected' : '' }}>⏳ مجدول للنشر</option>
                <option value="published" {{ $status === 'published' ? 'selected' : '' }}>✅ تم النشر</option>
                <option value="overdue" {{ $status === 'overdue' ? 'selected' : '' }}>🚨 متأخر عن النشر</option>
                <option value="postponed" {{ $status === 'postponed' ? 'selected' : '' }}>⏸️ مؤجل</option>
                <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>❌ ملغي</option>
            </select>

            <!-- Reset Filter -->
            @if($clientId || $creatorId || $type || $status || $search)
            <a href="{{ route('content-plans.index', ['year' => $year, 'month' => $month, 'view' => $view]) }}" 
               class="p-2 text-gray-400 hover:text-rose-400 transition" title="إعادة تعيين الفلاتر">
                <i class="fa-solid fa-rotate-left text-sm"></i>
            </a>
            @endif
        </form>
    </div>

    <!-- Monthly KPI Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3.5">
        <!-- 1. Total Target -->
        <div class="bg-brand-card p-4 rounded-xl border border-brand-border">
            <div class="flex items-center justify-between text-gray-400 text-xs mb-1">
                <span>مستهدف الشهر</span>
                <i class="fa-solid fa-bullseye text-brand-gold"></i>
            </div>
            <div class="text-2xl font-black text-white">{{ $totalCount }}</div>
            <div class="text-[11px] text-gray-400 mt-1">منشور وريل مخطط</div>
        </div>

        <!-- 2. Published -->
        <div class="bg-brand-card p-4 rounded-xl border border-emerald-500/30 bg-emerald-500/5">
            <div class="flex items-center justify-between text-emerald-400 text-xs mb-1">
                <span>تم النشر بنجاح</span>
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="text-2xl font-black text-emerald-300">{{ $publishedCount }}</div>
            <div class="text-[11px] text-emerald-400/80 mt-1">إنجاز {{ $completionRate }}%</div>
        </div>

        <!-- 3. Ready to Publish -->
        <div class="bg-brand-card p-4 rounded-xl border border-sky-500/30 bg-sky-500/5">
            <div class="flex items-center justify-between text-sky-400 text-xs mb-1">
                <span>جاهز بانتظار الموعد</span>
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="text-2xl font-black text-sky-300">{{ $readyCount }}</div>
            <div class="text-[11px] text-sky-400/80 mt-1">اكتمل مونتاجه وتصميمه</div>
        </div>

        <!-- 4. In Production -->
        <div class="bg-brand-card p-4 rounded-xl border border-brand-border">
            <div class="flex items-center justify-between text-yellow-400 text-xs mb-1">
                <span>قيد التنفيذ والمونتاج</span>
                <i class="fa-solid fa-palette"></i>
            </div>
            <div class="text-2xl font-black text-yellow-300">{{ $inProductionCount }}</div>
            <div class="text-[11px] text-gray-400 mt-1">لدى فريق الإبداع</div>
        </div>

        <!-- 5. Today's Posts -->
        <div class="bg-brand-card p-4 rounded-xl border border-amber-500/30 bg-amber-500/5">
            <div class="flex items-center justify-between text-amber-400 text-xs mb-1">
                <span>مقرر نشره اليوم</span>
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="text-2xl font-black text-amber-300">{{ $todayCount }}</div>
            <div class="text-[11px] text-amber-400/80 mt-1">يوم {{ now()->translatedFormat('l') }}</div>
        </div>

        <!-- 6. Overdue -->
        <div class="bg-brand-card p-4 rounded-xl border {{ $overdueCount > 0 ? 'border-rose-500/40 bg-rose-500/5' : 'border-brand-border' }}">
            <div class="flex items-center justify-between {{ $overdueCount > 0 ? 'text-rose-400 font-bold' : 'text-gray-400' }} text-xs mb-1">
                <span>متأخر عن النشر</span>
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="text-2xl font-black {{ $overdueCount > 0 ? 'text-rose-400' : 'text-white' }}">{{ $overdueCount }}</div>
            <div class="text-[11px] text-gray-400 mt-1">تجاوز التاريخ المقرر</div>
        </div>
    </div>

    <!-- Monthly Progress Bar -->
    <div class="bg-brand-card p-4 rounded-xl border border-brand-border">
        <div class="flex items-center justify-between text-xs text-gray-300 mb-2">
            <span class="font-bold flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-brand-gold"></i>
                نسبة إنجاز خطة نشر شهر {{ $selectedDate->translatedFormat('F Y') }}
            </span>
            <span class="font-black text-brand-gold">{{ $publishedCount }} من أصل {{ $totalCount }} منشور تم نشرها ({{ $completionRate }}%)</span>
        </div>
        <div class="w-full bg-brand-dark rounded-full h-3 p-0.5 overflow-hidden border border-brand-border">
            <div class="bg-gradient-to-r from-brand-amber via-brand-yellow to-emerald-400 h-full rounded-full transition-all duration-500 shadow" 
                 style="width: {{ $completionRate }}%"></div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- VIEW 1: ADVANCED TABLE / SPREADSHEET VIEW                                -->
    <!-- ========================================================================= -->
    @if($view === 'table')
    <div class="bg-brand-card rounded-2xl border border-brand-border overflow-hidden shadow-xl">
        <div class="p-4 border-b border-brand-border flex items-center justify-between bg-brand-dark/40">
            <div class="flex items-center gap-2 text-sm font-bold text-white">
                <i class="fa-solid fa-table text-brand-gold"></i>
                <span>جدول النشر الشهري التفصيلي</span>
                <span class="text-xs text-gray-400">({{ $contentPlans->count() }} عنصر)</span>
            </div>
            <div class="text-xs text-gray-400">
                <i class="fa-solid fa-circle-info text-brand-gold ml-1"></i>
                اضغط على علامة الصح لنقل المنشور فوراً إلى "تم النشر"
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="bg-brand-dark/80 text-gray-400 border-b border-brand-border uppercase font-semibold text-[11px]">
                        <th class="py-3 px-3 text-center w-12">النشر</th>
                        <th class="py-3 px-4">اسم المحتوى / الفكرة</th>
                        <th class="py-3 px-3">النوع والمنصة</th>
                        <th class="py-3 px-4">العميل والمشروع</th>
                        <th class="py-3 px-3 text-center">أقصى موعد لتسليم العميل</th>
                        <th class="py-3 px-3 text-center">ميعاد النشر وتوقيته</th>
                        <th class="py-3 px-3 text-center">حالة التنفيذ</th>
                        <th class="py-3 px-3 text-center">حالة النشر</th>
                        <th class="py-3 px-3 text-center">رابط المحتوى</th>
                        <th class="py-3 px-3 text-center">الكابشن</th>
                        <th class="py-3 px-3 text-center">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/60">
                    @forelse($contentPlans as $plan)
                    @php
                        $typeBadge = $plan->type_badge;
                        $pubBadge = $plan->publishing_status_badge;
                        $prodBadge = $plan->production_status_badge;
                    @endphp
                    <tr class="hover:bg-brand-hover/50 transition-colors {{ $plan->is_published ? 'bg-emerald-500/5' : ($plan->is_overdue ? 'bg-rose-500/5' : '') }}">
                        
                        <!-- 1. Quick Publish Checkmark Toggle -->
                        <td class="py-3 px-3 text-center">
                            <form method="POST" action="{{ route('content-plans.toggle-publish', $plan) }}">
                                @csrf
                                <button type="submit" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all shadow-sm {{ $plan->is_published ? 'bg-emerald-500 text-brand-dark hover:bg-emerald-400 font-black' : 'bg-brand-dark border border-brand-border hover:border-emerald-500/80 text-gray-500 hover:text-emerald-400' }}"
                                        title="{{ $plan->is_published ? 'انقر للإلغاء والعودة لمجدول' : 'انقر للتأكيد: تم النشر بنجاح' }}">
                                    <i class="fa-solid fa-check text-sm"></i>
                                </button>
                            </form>
                        </td>

                        <!-- 2. Content Title -->
                        <td class="py-3 px-4">
                            <div class="font-bold text-white text-sm flex items-center gap-2">
                                <span>{{ $plan->title }}</span>
                                @if($plan->publish_date && $plan->publish_date->isToday())
                                    <span class="px-1.5 py-0.5 rounded text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30 font-bold">اليوم</span>
                                @endif
                            </div>
                            @if($plan->notes)
                                <div class="text-[11px] text-gray-400 mt-0.5 flex items-center gap-1">
                                    <i class="fa-solid fa-comment-dots text-brand-gold/60 text-[10px]"></i>
                                    <span>{{ Str::limit($plan->notes, 40) }}</span>
                                </div>
                            @endif
                        </td>

                        <!-- 3. Type & Platforms -->
                        <td class="py-3 px-3 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold inline-flex items-center gap-1.5 {{ $typeBadge['badge'] }}">
                                <i class="fa-solid {{ $typeBadge['icon'] }}"></i>
                                <span>{{ $typeBadge['label'] }}</span>
                            </span>
                            @if(!empty($plan->platforms))
                                <div class="flex items-center gap-1.5 mt-1 text-gray-400 text-xs">
                                    @foreach($plan->platforms as $plat)
                                        @if($plat === 'instagram') <i class="fa-brands fa-instagram text-pink-400" title="انستغرام"></i>
                                        @elseif($plat === 'facebook') <i class="fa-brands fa-facebook text-blue-400" title="فيسبوك"></i>
                                        @elseif($plat === 'tiktok') <i class="fa-brands fa-tiktok text-cyan-300" title="تيك توك"></i>
                                        @elseif($plat === 'youtube') <i class="fa-brands fa-youtube text-red-400" title="يوتيوب"></i>
                                        @elseif($plat === 'linkedin') <i class="fa-brands fa-linkedin text-blue-300" title="لينكد إن"></i>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <!-- 4. Client & Project -->
                        <td class="py-3 px-4 whitespace-nowrap">
                            <div class="font-bold text-brand-gold">
                                <a href="{{ route('clients.show', $plan->client_id) }}" class="hover:underline">
                                    {{ $plan->client->brand_name ?? $plan->client->name }}
                                </a>
                            </div>
                            @if($plan->project)
                                <div class="text-[11px] text-gray-400">{{ Str::limit($plan->project->title, 25) }}</div>
                            @endif
                            @if(Auth::user()->isAdmin() && $plan->contentCreator)
                                <div class="text-[10px] text-blue-300 flex items-center gap-1 mt-0.5">
                                    <i class="fa-solid fa-user-pen"></i>
                                    <span>{{ $plan->contentCreator->name }}</span>
                                </div>
                            @endif
                        </td>

                        <!-- 5. Client Approval Deadline -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            @if($plan->client_delivery_deadline)
                                <div class="font-semibold text-gray-200">
                                    {{ $plan->client_delivery_deadline->format('Y/m/d') }}
                                </div>
                                <div class="text-[10px] text-gray-400">
                                    {{ $plan->client_delivery_deadline->translatedFormat('l') }}
                                </div>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>

                        <!-- 6. Publishing Date & Time -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            <div class="font-bold {{ $plan->is_overdue ? 'text-rose-400' : 'text-white' }}">
                                {{ $plan->publish_date->format('Y/m/d') }}
                            </div>
                            <div class="text-[10px] flex items-center justify-center gap-1 {{ $plan->is_overdue ? 'text-rose-400' : 'text-brand-gold' }}">
                                <i class="fa-regular fa-clock"></i>
                                <span>{{ $plan->publish_time ?? '18:00' }}</span>
                            </div>
                        </td>

                        <!-- 7. Production Status -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-medium inline-block {{ $prodBadge['class'] }}">
                                {{ $prodBadge['label'] }}
                            </span>
                        </td>

                        <!-- 8. Publishing Status -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold inline-flex items-center gap-1.5 {{ $pubBadge['class'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $pubBadge['dot'] }}"></span>
                                <span>{{ $pubBadge['label'] }}</span>
                            </span>
                        </td>

                        <!-- 9. Content URL (Drive / File) -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            @if($plan->content_url)
                                <a href="{{ $plan->content_url }}" target="_blank" 
                                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-[11px] font-bold transition">
                                    <i class="fa-brands fa-google-drive text-amber-400"></i>
                                    <span>معاينة الرابط</span>
                                </a>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>

                        <!-- 10. Caption / Copy -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            @if($plan->caption)
                                <button type="button" 
                                        @click="copyCaption('{{ addslashes($plan->caption) }}')" 
                                        class="px-2.5 py-1 rounded-lg bg-brand-dark hover:bg-brand-hover text-gray-300 hover:text-white border border-brand-border text-[11px] font-medium transition inline-flex items-center gap-1.5">
                                    <i class="fa-regular fa-copy text-brand-gold"></i>
                                    <span>نسخ الكابشن</span>
                                </button>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>

                        <!-- 11. Actions -->
                        <td class="py-3 px-3 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" 
                                        @click="openEditModal({{ json_encode($plan) }})" 
                                        class="p-1.5 rounded-lg bg-brand-dark hover:bg-brand-hover text-gray-300 hover:text-brand-gold border border-brand-border transition" 
                                        title="تعديل">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                
                                <form method="POST" action="{{ route('content-plans.destroy', $plan) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور من الخطة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-1.5 rounded-lg bg-brand-dark hover:bg-rose-500/20 text-gray-400 hover:text-rose-400 border border-brand-border transition" 
                                            title="حذف">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="py-12 text-center">
                            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-brand-dark flex items-center justify-center text-gray-500 text-2xl border border-brand-border">
                                <i class="fa-solid fa-calendar-xmark"></i>
                            </div>
                            <div class="text-white font-bold text-base">لا توجد منشورات مجدولة في هذا الشهر تطابق الفلاتر المحددة</div>
                            <p class="text-gray-400 text-xs mt-1">اضغط على زر "إضافة منشور للخطة +" للبدء بجدولة المحتوى أو اختر شهراً آخر</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- ========================================================================= -->
    <!-- VIEW 2: INTERACTIVE MONTHLY CALENDAR VIEW                                 -->
    <!-- ========================================================================= -->
    @if($view === 'calendar')
    @php
        $daysInMonth = $selectedDate->daysInMonth;
        $firstDayOfWeek = $selectedDate->copy()->startOfMonth()->dayOfWeek; // 0 = Sunday, 6 = Saturday
        // In Arabic week starts on Saturday (6), so convert offset: Sat=0, Sun=1, Mon=2, Tue=3, Wed=4, Thu=5, Fri=6
        $offset = ($firstDayOfWeek + 1) % 7;
    @endphp

    <div class="bg-brand-card rounded-2xl border border-brand-border overflow-hidden shadow-xl p-5">
        <!-- Calendar Days Header -->
        <div class="grid grid-cols-7 gap-2 mb-3 text-center text-xs font-black text-brand-gold uppercase tracking-wider">
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">السبت</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الأحد</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الاثنين</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الثلاثاء</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الأربعاء</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الخميس</div>
            <div class="py-2 rounded-lg bg-brand-dark border border-brand-border">الجمعة</div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-2">
            <!-- Empty offset boxes -->
            @for($i = 0; $i < $offset; $i++)
                <div class="min-h-[120px] rounded-xl bg-brand-dark/20 border border-brand-border/30 opacity-40"></div>
            @endfor

            <!-- Days of the month -->
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $currentDayDate = \Carbon\Carbon::createFromDate($year, $month, $day);
                    $dateStr = $currentDayDate->format('Y-m-d');
                    $dayPlans = $plansByDate[$dateStr] ?? collect();
                    $isToday = $currentDayDate->isToday();
                @endphp
                <div class="min-h-[130px] rounded-xl p-2.5 flex flex-col justify-between border transition-all duration-200 {{ $isToday ? 'bg-gradient-to-b from-brand-amber/10 to-brand-card border-brand-yellow shadow-lg' : 'bg-brand-card border-brand-border hover:border-brand-border/80' }}">
                    <!-- Day Header -->
                    <div class="flex items-center justify-between mb-2 pb-1.5 border-b border-brand-border/50">
                        <span class="text-sm font-black {{ $isToday ? 'w-6 h-6 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center font-black' : 'text-white' }}">
                            {{ $day }}
                        </span>
                        
                        <div class="flex items-center gap-1">
                            @if($dayPlans->count() > 0)
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-brand-yellow/20 text-brand-gold">
                                    {{ $dayPlans->count() }}
                                </span>
                            @endif
                            <button @click="openCreateModalForDate('{{ $dateStr }}')" 
                                    class="w-5 h-5 rounded hover:bg-brand-hover text-gray-500 hover:text-brand-gold text-[10px] flex items-center justify-center transition" 
                                    title="إضافة منشور في هذا اليوم">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Scheduled Items for this day -->
                    <div class="space-y-1.5 flex-1 overflow-y-auto max-h-[140px]">
                        @foreach($dayPlans as $item)
                        @php $typeB = $item->type_badge; @endphp
                        <div @click="openEditModal({{ json_encode($item) }})" 
                             class="p-1.5 rounded-lg text-[10px] font-bold cursor-pointer transition-all border {{ $item->is_published ? 'bg-emerald-500/15 border-emerald-500/30 text-emerald-300' : ($item->is_overdue ? 'bg-rose-500/15 border-rose-500/30 text-rose-300' : 'bg-brand-dark/90 border-brand-border text-gray-200 hover:border-brand-yellow') }}">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-extrabold text-brand-gold truncate max-w-[80px]">
                                    {{ $item->client->brand_name ?? $item->client->name }}
                                </span>
                                <span class="text-[9px] text-gray-400">{{ $item->publish_time ?? '18:00' }}</span>
                            </div>
                            <div class="flex items-center gap-1 mt-0.5 truncate text-white">
                                <i class="fa-solid {{ $typeB['icon'] }} text-[9px] text-brand-yellow"></i>
                                <span class="truncate">{{ $item->title }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endfor
        </div>
    </div>
    @endif

    <!-- ========================================================================= -->
    <!-- VIEW 3: PIPELINE / KANBAN VIEW                                            -->
    <!-- ========================================================================= -->
    @if($view === 'pipeline')
    @php
        $columns = [
            'idea' => [
                'title' => 'أفكار ومسودات',
                'color' => 'border-gray-500 text-gray-300',
                'items' => $contentPlans->where('production_status', 'idea'),
            ],
            'in_production' => [
                'title' => 'قيد التنفيذ والمونتاج',
                'color' => 'border-blue-500 text-blue-300',
                'items' => $contentPlans->where('production_status', 'in_production'),
            ],
            'client_review' => [
                'title' => 'بانتظار موافقة العميل',
                'color' => 'border-yellow-500 text-yellow-300',
                'items' => $contentPlans->where('production_status', 'client_review'),
            ],
            'ready_to_publish' => [
                'title' => 'جاهز بانتظار موعد النشر',
                'color' => 'border-sky-500 text-sky-300',
                'items' => $contentPlans->where('production_status', 'ready_to_publish')->where('is_published', false),
            ],
            'published' => [
                'title' => 'تم النشر بنجاح',
                'color' => 'border-emerald-500 text-emerald-300',
                'items' => $contentPlans->where('is_published', true),
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
        @foreach($columns as $colKey => $col)
        <div class="bg-brand-card/90 rounded-2xl border border-brand-border p-4 flex flex-col min-h-[500px]">
            <!-- Column Header -->
            <div class="flex items-center justify-between pb-3 mb-3 border-b border-brand-border">
                <span class="font-black text-sm {{ $col['color'] }} flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full border-2 {{ $col['color'] }}"></span>
                    {{ $col['title'] }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-brand-dark text-gray-300 border border-brand-border">
                    {{ $col['items']->count() }}
                </span>
            </div>

            <!-- Cards -->
            <div class="space-y-3 flex-1 overflow-y-auto">
                @forelse($col['items'] as $item)
                @php $typeB = $item->type_badge; @endphp
                <div class="p-3.5 rounded-xl bg-brand-dark border border-brand-border hover:border-brand-yellow transition-all shadow-md group relative">
                    <div class="flex items-center justify-between text-xs mb-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $typeB['badge'] }}">
                            <i class="fa-solid {{ $typeB['icon'] }} ml-1"></i>
                            {{ $typeB['label'] }}
                        </span>
                        <span class="text-[10px] text-gray-400">
                            {{ $item->publish_date->format('m/d') }}
                        </span>
                    </div>

                    <h4 class="font-bold text-white text-sm mb-1.5">{{ $item->title }}</h4>

                    <div class="text-xs text-brand-gold font-semibold mb-2">
                        {{ $item->client->brand_name ?? $item->client->name }}
                    </div>

                    <div class="pt-2 border-t border-brand-border/50 flex items-center justify-between text-[11px] text-gray-400">
                        <div class="flex items-center gap-1.5">
                            @if($item->content_url)
                                <a href="{{ $item->content_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300" title="رابط المحتوى">
                                    <i class="fa-brands fa-google-drive"></i>
                                </a>
                            @endif
                            @if($item->caption)
                                <button type="button" @click="copyCaption('{{ addslashes($item->caption) }}')" class="hover:text-white" title="نسخ الكابشن">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            @endif
                        </div>

                        <button @click="openEditModal({{ json_encode($item) }})" class="text-brand-gold hover:underline text-[11px] font-bold">
                            تعديل / تفاصيل
                        </button>
                    </div>
                </div>
                @empty
                <div class="py-8 text-center text-xs text-gray-500">
                    لا توجد منشورات في هذه المرحلة
                </div>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- ========================================================================= -->
    <!-- MODAL: ADD / EDIT CONTENT PLAN                                            -->
    <!-- ========================================================================= -->
    <div x-show="modalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-sm flex items-center justify-center p-4" 
         style="display: none;">
        
        <div @click.away="modalOpen = false" 
             class="bg-brand-card w-full max-w-2xl rounded-2xl border border-brand-border shadow-2xl overflow-hidden my-8">
            
            <div class="p-5 border-b border-brand-border flex items-center justify-between bg-brand-dark/50">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-brand-yellow/20 text-brand-gold flex items-center justify-center text-base">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>
                    <h3 class="font-black text-white text-base" x-text="isEditMode ? 'تعديل منشور في خطة النشر' : 'إضافة منشور جديد إلى خطة النشر'"></h3>
                </div>
                <button @click="modalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="isEditMode ? '{{ url('/content-plans') }}/' + form.id : '{{ route('content-plans.store') }}'" 
                  method="POST" 
                  class="p-6 space-y-4">
                @csrf
                <template x-if="isEditMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Row 1: Client & Project -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">العميل <span class="text-rose-400">*</span></label>
                        <select name="client_id" x-model="form.client_id" required 
                                class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-brand-yellow">
                            <option value="">اختر العميل...</option>
                            @foreach($clients as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->brand_name ? $c->brand_name . ' (' . $c->name . ')' : $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">المشروع المرتبط (اختياري)</label>
                        <select name="project_id" x-model="form.project_id" 
                                class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-brand-yellow">
                            <option value="">لا يوجد مشروع محدد</option>
                            @foreach($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->client->brand_name ?? $p->client->name }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 2: Title -->
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1.5">اسم المحتوى / فكرة المنشور <span class="text-rose-400">*</span></label>
                    <input type="text" name="title" x-model="form.title" required 
                           placeholder="مثال: ريل الفرق بين التصميم والواقع، أو بوست كاروسيل جودة الألوان"
                           class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-brand-yellow">
                </div>

                <!-- Row 3: Content Type & Platforms -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">نوع المحتوى <span class="text-rose-400">*</span></label>
                        <select name="content_type" x-model="form.content_type" required 
                                class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-brand-yellow">
                            <option value="reel">🎬 ريل (Reel)</option>
                            <option value="carousel">📑 كاروسيل (Carousel)</option>
                            <option value="post">🖼️ بوست تصميم (Single Post)</option>
                            <option value="story">⭕ ستوري (Story)</option>
                            <option value="video">📹 فيديو طويل (Video)</option>
                            <option value="tiktok">🎵 تيك توك (TikTok)</option>
                            <option value="other">📄 محتوى متنوع</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">المنصات المستهدفة للنشر</label>
                        <div class="flex flex-wrap gap-2 pt-1">
                            <label class="inline-flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer">
                                <input type="checkbox" name="platforms[]" value="instagram" :checked="form.platforms && form.platforms.includes('instagram')" class="rounded bg-brand-dark border-brand-border text-brand-yellow focus:ring-0">
                                <span>انستغرام</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer">
                                <input type="checkbox" name="platforms[]" value="facebook" :checked="form.platforms && form.platforms.includes('facebook')" class="rounded bg-brand-dark border-brand-border text-brand-yellow focus:ring-0">
                                <span>فيسبوك</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer">
                                <input type="checkbox" name="platforms[]" value="tiktok" :checked="form.platforms && form.platforms.includes('tiktok')" class="rounded bg-brand-dark border-brand-border text-brand-yellow focus:ring-0">
                                <span>تيك توك</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer">
                                <input type="checkbox" name="platforms[]" value="linkedin" :checked="form.platforms && form.platforms.includes('linkedin')" class="rounded bg-brand-dark border-brand-border text-brand-yellow focus:ring-0">
                                <span>لينكد إن</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Row 4: Dates (Publish Date & Time vs Client Delivery Deadline) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">ميعاد النشر <span class="text-rose-400">*</span></label>
                        <input type="date" name="publish_date" x-model="form.publish_date" required 
                               class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2 text-xs text-white focus:outline-none focus:border-brand-yellow">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">توقيت النشر المفضل</label>
                        <input type="time" name="publish_time" x-model="form.publish_time" 
                               class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2 text-xs text-white focus:outline-none focus:border-brand-yellow">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">أقصى موعد لتسليم العميل</label>
                        <input type="date" name="client_delivery_deadline" x-model="form.client_delivery_deadline" 
                               class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2 text-xs text-white focus:outline-none focus:border-brand-yellow">
                    </div>
                </div>

                <!-- Row 5: Link to Content (Google Drive / etc) -->
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1.5">رابط المحتوى (جوجل درايف / فيجما / فيديو)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                            <i class="fa-brands fa-google-drive text-amber-400"></i>
                        </span>
                        <input type="url" name="content_url" x-model="form.content_url" 
                               placeholder="https://drive.google.com/..." 
                               class="w-full bg-brand-dark border border-brand-border rounded-xl pr-9 pl-3.5 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-brand-yellow">
                    </div>
                </div>

                <!-- Row 6: Caption / Copy -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold text-gray-300">نص المنشور / الكابشن والهاشتاجات</label>
                        <span class="text-[10px] text-gray-400" x-text="(form.caption || '').length + ' حرف'"></span>
                    </div>
                    <textarea name="caption" x-model="form.caption" rows="3" 
                              placeholder="اكتب كابشن البوست هنا ليسهل على صانع المحتوى نسخه وقت النشر بنقرة زر..."
                              class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-brand-yellow"></textarea>
                </div>

                <!-- Row 7: Production Status vs Publishing Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">حالة التنفيذ والمونتاج <span class="text-rose-400">*</span></label>
                        <select name="production_status" x-model="form.production_status" required 
                                class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-brand-yellow">
                            <option value="idea">💡 فكرة / مسودة</option>
                            <option value="in_production">🎨 قيد التنفيذ والمونتاج</option>
                            <option value="client_review">⏳ بانتظار موافقة العميل</option>
                            <option value="ready_to_publish">✅ جاهز للنشر (اكتمل التنفيذ)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1.5">حالة النشر المجدولة <span class="text-rose-400">*</span></label>
                        <select name="publishing_status" x-model="form.publishing_status" required 
                                class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-brand-yellow">
                            <option value="scheduled">⏳ مجدول للنشر</option>
                            <option value="published">✅ تم النشر على المنصات</option>
                            <option value="postponed">⏸️ مؤجل</option>
                            <option value="cancelled">❌ ملغي</option>
                        </select>
                    </div>
                </div>

                <!-- Row 8: Notes -->
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1.5">ملاحظات إضافية</label>
                    <input type="text" name="notes" x-model="form.notes" 
                           placeholder="مثال: لم يتم إرسال الفيديو بعد، مطلوب تعديل الفونت، إلخ..."
                           class="w-full bg-brand-dark border border-brand-border rounded-xl px-3.5 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-brand-yellow">
                </div>

                <!-- Submit / Cancel -->
                <div class="pt-4 border-t border-brand-border flex items-center justify-end gap-3">
                    <button type="button" @click="modalOpen = false" 
                            class="px-4 py-2.5 rounded-xl bg-brand-dark hover:bg-brand-hover border border-brand-border text-gray-300 text-xs font-bold transition">
                        إلغاء
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs shadow hover:opacity-90 transition">
                        <span x-text="isEditMode ? 'حفظ التعديلات' : 'إضافة المنشور للخطة'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
function contentCalendarApp() {
    return {
        modalOpen: false,
        isEditMode: false,
        form: {
            id: null,
            client_id: '{{ $clientId ?? '' }}',
            project_id: '',
            title: '',
            content_type: 'reel',
            platforms: ['instagram', 'facebook'],
            publish_date: '{{ now()->format('Y-m-d') }}',
            publish_time: '18:00',
            client_delivery_deadline: '',
            content_url: '',
            caption: '',
            production_status: 'ready_to_publish',
            publishing_status: 'scheduled',
            notes: '',
        },

        openCreateModal() {
            this.isEditMode = false;
            this.form = {
                id: null,
                client_id: '{{ $clientId ?? '' }}',
                project_id: '',
                title: '',
                content_type: 'reel',
                platforms: ['instagram', 'facebook'],
                publish_date: '{{ now()->format('Y-m-d') }}',
                publish_time: '18:00',
                client_delivery_deadline: '',
                content_url: '',
                caption: '',
                production_status: 'ready_to_publish',
                publishing_status: 'scheduled',
                notes: '',
            };
            this.modalOpen = true;
        },

        openCreateModalForDate(dateStr) {
            this.openCreateModal();
            this.form.publish_date = dateStr;
        },

        openEditModal(plan) {
            this.isEditMode = true;
            this.form = {
                id: plan.id,
                client_id: plan.client_id,
                project_id: plan.project_id || '',
                title: plan.title,
                content_type: plan.content_type,
                platforms: Array.isArray(plan.platforms) ? plan.platforms : [],
                publish_date: plan.publish_date ? plan.publish_date.substring(0, 10) : '',
                publish_time: plan.publish_time || '18:00',
                client_delivery_deadline: plan.client_delivery_deadline ? plan.client_delivery_deadline.substring(0, 10) : '',
                content_url: plan.content_url || '',
                caption: plan.caption || '',
                production_status: plan.production_status || 'ready_to_publish',
                publishing_status: plan.publishing_status || 'scheduled',
                notes: plan.notes || '',
            };
            this.modalOpen = true;
        },

        copyCaption(text) {
            if (!text) return;
            navigator.clipboard.writeText(text).then(() => {
                alert('تم نسخ الكابشن بنجاح إلى الحافظة! يمكنك الآن لصقه مباشرة في منصة النشر.');
            }).catch(() => {
                const ta = document.createElement('textarea');
                ta.value = text;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                alert('تم نسخ الكابشن بنجاح!');
            });
        }
    };
}
</script>
@endpush
@endsection
