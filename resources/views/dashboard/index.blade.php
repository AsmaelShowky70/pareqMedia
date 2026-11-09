@extends('layouts.app')

@section('title', 'لوحة التحكم الشاملة')
@section('page_title', 'لوحة المتابعة والأداء العام للشركة')
@section('page_subtitle', 'نظرة شاملة للمدير العام على مؤشرات الأداء، المشروعات، مهام صناع المحتوى، والمالية لحظياً')

@section('content')
<div class="space-y-4 sm:space-y-6 pt-1 sm:pt-2" x-data="{ gmDecisionModal: false, activeProject: null, decisionType: 'approved' }">

    <!-- 0. SHORTCUTS ACTION BAR (شريط الاختصارات السريعة - متجاوب بالكامل للموبايل) -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-3 sm:p-3.5 shadow-xl flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-brand-gold animate-pulse"></span>
            <span class="text-xs font-bold text-gray-300">إجراءات سريعة:</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-wrap items-center gap-2">
            <a href="{{ route('projects.create') }}" class="px-3 py-2 sm:py-1.5 rounded-xl bg-gradient-to-r from-brand-gold to-amber-500 hover:from-amber-500 hover:to-brand-gold text-brand-dark font-black text-xs shadow-md transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-plus-circle"></i>
                <span>مشروع جديد</span>
            </a>
            <a href="{{ route('clients.create') }}" class="px-3 py-2 sm:py-1.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-white font-bold text-xs border border-brand-border hover:border-brand-gold transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-user-plus text-brand-gold"></i>
                <span>إضافة عميل</span>
            </a>
            <a href="{{ route('tasks.index') }}" class="px-3 py-2 sm:py-1.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-white font-bold text-xs border border-brand-border hover:border-brand-gold transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-list-check text-sky-400"></i>
                <span>إدارة المهام</span>
            </a>
            <a href="{{ route('cashier.index') }}" class="px-3 py-2 sm:py-1.5 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-300 font-bold text-xs border border-emerald-500/30 transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-cash-register"></i>
                <span>كاشير POS</span>
            </a>
            <a href="{{ route('content-plans.index') }}" class="px-3 py-2 sm:py-1.5 rounded-xl bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 font-bold text-xs border border-indigo-500/30 transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-calendar-days"></i>
                <span>جدول النشر</span>
            </a>
            <a href="{{ route('accounting.index') }}" class="col-span-2 sm:col-span-1 px-3 py-2 sm:py-1.5 rounded-xl bg-purple-500/10 hover:bg-purple-500/20 text-purple-300 font-bold text-xs border border-purple-500/30 transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-chart-line"></i>
                <span>التقارير</span>
            </a>
        </div>
    </div>

    <!-- 1. ALERT: PROJECTS DELIVERED BY CONTENT CREATORS WAITING FOR GM APPROVAL -->
    @if(isset($projectsPendingGMApproval) && $projectsPendingGMApproval->isNotEmpty())
    <div class="bg-gradient-to-r from-amber-950/50 via-brand-card to-amber-950/40 border-2 border-amber-500/60 rounded-2xl p-4 sm:p-6 shadow-2xl space-y-4 animate-pulse">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-amber-500 text-brand-dark flex items-center justify-center text-base sm:text-lg font-black shadow shrink-0">
                    <i class="fa-solid fa-flag-checkered"></i>
                </div>
                <div>
                    <h2 class="text-sm sm:text-base font-black text-white">مشاريع مسلمة من صناع المحتوى بانتظار اعتمادك</h2>
                    <p class="text-[11px] sm:text-xs text-amber-300 font-bold">بانتظار مراجعة واعتماد المدير العام</p>
                </div>
            </div>
            <span class="self-start sm:self-auto px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-brand-dark">
                {{ $projectsPendingGMApproval->count() }} مشاريع جاهزة
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 pt-1">
            @foreach($projectsPendingGMApproval as $pPending)
            <div class="p-3.5 sm:p-4 rounded-xl bg-brand-purple/90 border border-brand-border space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <div class="min-w-0">
                        <span class="text-xs text-brand-gold font-bold block truncate">صانع المحتوى: {{ $pPending->contentCreator->name ?? 'غير محدد' }}</span>
                        <h4 class="text-sm sm:text-base font-bold text-white mt-0.5 break-words">{{ $pPending->title }}</h4>
                        <div class="text-[11px] sm:text-xs text-gray-400">العميل: {{ $pPending->client->name ?? 'غير محدد' }} • مكتمل: {{ $pPending->tasks->where('status', 'completed')->count() }}/{{ $pPending->tasks->count() }}</div>
                    </div>
                    <span class="text-[10px] sm:text-[11px] text-gray-400 font-medium whitespace-nowrap">
                        {{ $pPending->submitted_to_gm_at ? $pPending->submitted_to_gm_at->diffForHumans() : 'الآن' }}
                    </span>
                </div>

                @if($pPending->delivery_notes)
                <div class="p-2.5 sm:p-3 rounded-lg bg-brand-card/90 border border-brand-border/60 text-xs text-gray-300">
                    <span class="font-bold text-white">ملاحظات: </span>{{ $pPending->delivery_notes }}
                </div>
                @endif

                <div class="pt-2 border-t border-brand-border/40 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2">
                    <a href="{{ route('projects.show', $pPending->id) }}" class="text-xs text-brand-gold font-bold hover:underline py-1">
                        فحص المشروع والمهام ←
                    </a>

                    <div class="flex items-center gap-2">
                        <button @click="activeProject = { id: {{ $pPending->id }}, title: '{{ addslashes($pPending->title) }}' }; decisionType = 'approved'; gmDecisionModal = true;"
                                type="button" 
                                class="flex-1 sm:flex-none px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition flex items-center justify-center gap-1 active:scale-95">
                            <i class="fa-solid fa-check"></i>
                            <span>اعتماد الاكتمال</span>
                        </button>
                        <button @click="activeProject = { id: {{ $pPending->id }}, title: '{{ addslashes($pPending->title) }}' }; decisionType = 'revisions_needed'; gmDecisionModal = true;"
                                type="button" 
                                class="flex-1 sm:flex-none px-3 py-1.5 rounded-xl bg-rose-600/80 hover:bg-rose-600 text-white font-bold text-xs shadow transition flex items-center justify-center gap-1 active:scale-95">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>طلب تعديلات</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- 2. UPGRADED TOP KPI GRID WITH SPARKLINES (متجاوب: 2x2 على الموبايل و 4x1 على الكمبيوتر) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4">
        
        <!-- Total Revenue -->
        <div class="bg-brand-card/90 border border-brand-border/70 rounded-2xl p-3.5 sm:p-5 relative overflow-hidden group hover:border-brand-gold/60 transition shadow-lg flex flex-col justify-between">
            <div>
                <div class="flex items-start sm:items-center justify-between gap-1 mb-1.5">
                    <span class="text-[11px] sm:text-xs font-bold text-gray-400 line-clamp-1">إجمالي التحصيلات</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] sm:text-[11px] font-black bg-emerald-500/15 text-emerald-400 flex items-center gap-0.5 border border-emerald-500/30 whitespace-nowrap">
                        <i class="fa-solid fa-arrow-trend-up text-[8px] sm:text-[10px]"></i>
                        <span>+27% ↑</span>
                    </span>
                </div>
                <div class="text-lg sm:text-2xl font-black text-white tracking-tight">
                    {{ number_format($totalRevenue, 0) }} <span class="text-xs sm:text-sm font-bold text-brand-gold">ج.م</span>
                </div>
                <div class="mt-1.5 text-[10px] sm:text-[11px] text-emerald-400 truncate">
                    <span>الخزينة: <strong class="text-white">{{ number_format($treasuryBalance ?? 0, 0) }} ج.م</strong></span>
                </div>
            </div>
            <!-- SVG Sparkline Wave -->
            <div class="mt-2 -mx-3.5 -mb-3.5 sm:-mx-5 sm:-mb-5 opacity-40 group-hover:opacity-75 transition">
                <svg viewBox="0 0 100 28" preserveAspectRatio="none" class="w-full h-6 sm:h-8 stroke-emerald-400 fill-emerald-500/10">
                    <path d="M0,25 Q15,22 30,12 T60,18 T90,6 L100,10 L100,28 L0,28 Z" stroke-width="1.8" />
                </svg>
            </div>
        </div>

        <!-- Net Profit -->
        <div class="bg-brand-card/90 border border-brand-border/70 rounded-2xl p-3.5 sm:p-5 relative overflow-hidden group hover:border-emerald-500/60 transition shadow-lg flex flex-col justify-between">
            <div>
                <div class="flex items-start sm:items-center justify-between gap-1 mb-1.5">
                    <span class="text-[11px] sm:text-xs font-bold text-gray-400 line-clamp-1">صافي الأرباح</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] sm:text-[11px] font-black bg-emerald-500/15 text-emerald-400 flex items-center gap-0.5 border border-emerald-500/30 whitespace-nowrap">
                        <i class="fa-solid fa-arrow-trend-up text-[8px] sm:text-[10px]"></i>
                        <span>+32% ↑</span>
                    </span>
                </div>
                <div class="text-lg sm:text-2xl font-black text-white tracking-tight">
                    {{ number_format($netProfit, 0) }} <span class="text-xs sm:text-sm font-bold text-emerald-400">ج.م</span>
                </div>
                <div class="mt-1.5 text-[10px] sm:text-[11px] text-gray-400 truncate">
                    <span>المصروف: <strong class="text-rose-400">{{ number_format($totalExpenses, 0) }}</strong></span>
                </div>
            </div>
            <!-- SVG Sparkline Wave -->
            <div class="mt-2 -mx-3.5 -mb-3.5 sm:-mx-5 sm:-mb-5 opacity-40 group-hover:opacity-75 transition">
                <svg viewBox="0 0 100 28" preserveAspectRatio="none" class="w-full h-6 sm:h-8 stroke-brand-gold fill-amber-500/10">
                    <path d="M0,22 Q20,26 40,14 T70,16 T100,4 L100,28 L0,28 Z" stroke-width="1.8" />
                </svg>
            </div>
        </div>

        <!-- Active Tasks -->
        <div class="bg-brand-card/90 border border-brand-border/70 rounded-2xl p-3.5 sm:p-5 relative overflow-hidden group hover:border-indigo-500/60 transition shadow-lg flex flex-col justify-between">
            <div>
                <div class="flex items-start sm:items-center justify-between gap-1 mb-1.5">
                    <span class="text-[11px] sm:text-xs font-bold text-gray-400 line-clamp-1">مهام قيد العمل</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] sm:text-[11px] font-black bg-indigo-500/15 text-indigo-300 flex items-center gap-0.5 border border-indigo-500/30 whitespace-nowrap">
                        <i class="fa-solid fa-arrow-trend-up text-[8px] sm:text-[10px]"></i>
                        <span>+18% ↑</span>
                    </span>
                </div>
                <div class="text-lg sm:text-2xl font-black text-white tracking-tight">
                    {{ $taskCounts['in_progress'] }} <span class="text-xs sm:text-sm font-normal text-gray-400">من {{ $taskCounts['total'] }}</span>
                </div>
                <div class="mt-1.5 text-[10px] sm:text-[11px] text-amber-300 truncate">
                    <span>بالانتظار: <strong>{{ $taskCounts['not_started'] }}</strong> • مكتمل: <strong class="text-emerald-400">{{ $taskCounts['completed'] }}</strong></span>
                </div>
            </div>
            <!-- SVG Sparkline Wave -->
            <div class="mt-2 -mx-3.5 -mb-3.5 sm:-mx-5 sm:-mb-5 opacity-40 group-hover:opacity-75 transition">
                <svg viewBox="0 0 100 28" preserveAspectRatio="none" class="w-full h-6 sm:h-8 stroke-indigo-400 fill-indigo-500/10">
                    <path d="M0,20 Q25,8 50,18 T75,10 T100,8 L100,28 L0,28 Z" stroke-width="1.8" />
                </svg>
            </div>
        </div>

        <!-- Clients & Retainers -->
        <div class="bg-brand-card/90 border border-brand-border/70 rounded-2xl p-3.5 sm:p-5 relative overflow-hidden group hover:border-sky-500/60 transition shadow-lg flex flex-col justify-between">
            <div>
                <div class="flex items-start sm:items-center justify-between gap-1 mb-1.5">
                    <span class="text-[11px] sm:text-xs font-bold text-gray-400 line-clamp-1">العملاء النشطون</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] sm:text-[11px] font-black bg-sky-500/15 text-sky-400 flex items-center gap-0.5 border border-sky-500/30 whitespace-nowrap">
                        <i class="fa-solid fa-arrow-trend-up text-[8px] sm:text-[10px]"></i>
                        <span>+14% ↑</span>
                    </span>
                </div>
                <div class="text-lg sm:text-2xl font-black text-white tracking-tight">
                    {{ $totalClientsCount }} <span class="text-xs sm:text-sm font-bold text-sky-400">عميل</span>
                </div>
                <div class="mt-1.5 text-[10px] sm:text-[11px] text-gray-400 flex items-center justify-between truncate">
                    <span>المشاريع: <strong class="text-white">{{ $activeProjectsCount }}</strong></span>
                    <a href="{{ route('clients.index') }}" class="text-brand-gold hover:underline font-bold">CRM ←</a>
                </div>
            </div>
            <!-- SVG Sparkline Wave -->
            <div class="mt-2 -mx-3.5 -mb-3.5 sm:-mx-5 sm:-mb-5 opacity-40 group-hover:opacity-75 transition">
                <svg viewBox="0 0 100 28" preserveAspectRatio="none" class="w-full h-6 sm:h-8 stroke-sky-400 fill-sky-500/10">
                    <path d="M0,24 Q30,20 50,12 T80,14 T100,6 L100,28 L0,28 Z" stroke-width="1.8" />
                </svg>
            </div>
        </div>

    </div>

    <!-- 3. DAILY COMPLETION RATE & MOTIVATIONAL BANNER (باند معدل الإنجاز اليومي والتحفيز) -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-brand-card via-brand-purple to-[#230b38] border border-brand-gold/40 p-4 sm:p-6 shadow-2xl">
        <div class="absolute -top-12 -left-12 w-48 h-48 rounded-full bg-brand-gold/10 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-center">
            
            <!-- Left/Main: Circular Progress + Progress Bar -->
            <div class="lg:col-span-7 flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                <!-- SVG Circular Meter -->
                <div class="relative w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 flex items-center justify-center">
                    <svg class="w-20 h-20 sm:w-24 sm:h-24 transform -rotate-90" viewBox="0 0 36 36">
                        <path class="text-white/10" stroke-width="3.5" stroke="currentColor" fill="none"
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="text-brand-gold transition-all duration-1000 ease-out" stroke-dasharray="{{ $dailyCompletionRate }}, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none"
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    </svg>
                    <div class="absolute flex flex-col items-center justify-center">
                        <span class="text-lg sm:text-xl font-black text-white">{{ $dailyCompletionRate }}%</span>
                        <span class="text-[8px] sm:text-[9px] text-brand-gold font-bold">مكتمل</span>
                    </div>
                </div>

                <!-- Info and Horizontal Bar -->
                <div class="space-y-2 w-full text-center sm:text-right">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <i class="fa-solid fa-bullseye text-brand-gold text-sm sm:text-base"></i>
                            <h3 class="text-xs sm:text-base font-black text-white">معدل الإنجاز اليومي للوكالة</h3>
                        </div>
                        <span class="text-[11px] sm:text-xs font-black text-amber-300">الهدف: 75% فأكثر</span>
                    </div>
                    
                    <!-- Progress Bar with Glow -->
                    <div class="w-full bg-white/10 rounded-full h-3 sm:h-3.5 p-0.5 overflow-hidden">
                        <div class="bg-gradient-to-r from-brand-gold via-amber-400 to-amber-200 h-full rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(255,148,32,0.6)]"
                             style="width: {{ min(100, max(12, $dailyCompletionRate)) }}%;"></div>
                    </div>
                    
                    <div class="flex items-center justify-between text-[11px] sm:text-xs text-gray-300">
                        <span>إنجاز مهام اليوم: <strong>{{ $dailyCompletionRate }}%</strong></span>
                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-check ml-1"></i>الأداء العام ممتاز</span>
                    </div>
                </div>
            </div>

            <!-- Right: Motivational Quote Box (الاقتباس التحفيزي المعتمد) -->
            <div class="lg:col-span-5 p-3.5 sm:p-4 rounded-xl bg-brand-dark/50 border border-brand-border/60 relative">
                <i class="fa-solid fa-quote-right text-brand-gold/20 text-2xl sm:text-3xl absolute top-3 left-3"></i>
                <div class="relative z-10 space-y-1">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-brand-gold font-bold flex items-center gap-1">
                        <i class="fa-solid fa-sparkles"></i>
                        <span>كلمة اليوم التحفيزية لفريق بريق</span>
                    </span>
                    <p class="text-[11px] sm:text-xs font-bold text-gray-100 leading-relaxed italic">
                        "النجاح ليس وجهة .. بل رحلة من الإنجازات الصغيرة. استمر، فخطوتك اليوم تصنع فرقاً غداً"
                    </p>
                    <div class="text-[10px] sm:text-[11px] text-gray-400 pt-1 border-t border-brand-border/40 flex items-center justify-between">
                        <span>فريق بريق الإبداعي • شغف بلا حدود</span>
                        <span class="text-amber-400">✨ Bariq</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 4. TASK SUMMARY 4-COLOR STATUS CARDS (2x2 على الموبايل و 4x1 على الكمبيوتر) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4">
        
        <!-- 1. Completed Tasks -->
        <div class="p-3 sm:p-4 rounded-2xl bg-emerald-950/20 border-2 border-emerald-500/40 hover:border-emerald-500 transition shadow-lg group">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[11px] sm:text-xs font-bold text-emerald-300">مهام مكتملة</span>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs sm:text-sm font-bold shadow">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-white group-hover:text-emerald-400 transition-colors">
                {{ $taskCounts['completed'] }}
            </div>
            <div class="mt-1.5 text-[10px] sm:text-[11px] text-emerald-400/90 font-medium flex items-center justify-between">
                <span>تم إنجازها بنجاح</span>
                <i class="fa-solid fa-check-double text-[10px]"></i>
            </div>
        </div>

        <!-- 2. In Progress Tasks -->
        <div class="p-3 sm:p-4 rounded-2xl bg-sky-950/20 border-2 border-sky-500/40 hover:border-sky-500 transition shadow-lg group">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[11px] sm:text-xs font-bold text-sky-300">قيد التنفيذ</span>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center text-xs sm:text-sm font-bold shadow">
                    <i class="fa-solid fa-arrows-rotate fa-spin"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-white group-hover:text-sky-400 transition-colors">
                {{ $taskCounts['in_progress'] }}
            </div>
            <div class="mt-1.5 text-[10px] sm:text-[11px] text-sky-300 font-medium flex items-center justify-between">
                <span>جاري العمل عليها</span>
                <i class="fa-solid fa-person-digging text-[10px]"></i>
            </div>
        </div>

        <!-- 3. Remaining Tasks -->
        <div class="p-3 sm:p-4 rounded-2xl bg-amber-950/20 border-2 border-amber-500/40 hover:border-amber-500 transition shadow-lg group">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[11px] sm:text-xs font-bold text-amber-300">مهام متبقية</span>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs sm:text-sm font-bold shadow">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-white group-hover:text-amber-400 transition-colors">
                {{ $taskCounts['remaining'] }}
            </div>
            <div class="mt-1.5 text-[10px] sm:text-[11px] text-amber-300 font-medium flex items-center justify-between">
                <span>في قائمة الانتظار</span>
                <i class="fa-solid fa-list-ol text-[10px]"></i>
            </div>
        </div>

        <!-- 4. Overdue Tasks -->
        <div class="p-3 sm:p-4 rounded-2xl bg-rose-950/20 border-2 border-rose-500/40 hover:border-rose-500 transition shadow-lg group">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[11px] sm:text-xs font-bold text-rose-300">متأخرة</span>
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-xs sm:text-sm font-bold shadow">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-rose-400 group-hover:text-rose-300 transition-colors">
                {{ $taskCounts['overdue'] }}
            </div>
            <div class="mt-1.5 text-[10px] sm:text-[11px] text-rose-300 font-medium flex items-center justify-between">
                <span>تتطلب متابعة سريعة</span>
                <i class="fa-solid fa-bell text-[10px]"></i>
            </div>
        </div>

    </div>

    <!-- 5. DEPARTMENT & EMPLOYEE DISTRIBUTION (توزيع المهام حسب القسم والموظف) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        
        <!-- A. Department Task Distribution with Visual Donut -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-5 space-y-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-brand-gold/20 text-brand-gold flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-white">توزيع المهام حسب القسم</h3>
                        <p class="text-[10px] sm:text-[11px] text-gray-400">حجم العمل الموزع على أقسام الوكالة</p>
                    </div>
                </div>
                <span class="text-[11px] sm:text-xs font-black text-brand-gold bg-brand-purple px-2 py-0.5 rounded-lg border border-brand-border">
                    إجمالي: {{ $totalDeptTasks }}
                </span>
            </div>

            <!-- Visual Donut Chart and Legend -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 sm:gap-5 items-center pt-1">
                
                <!-- Mini Donut SVG Graphic -->
                <div class="sm:col-span-5 flex justify-center py-2 sm:py-0">
                    <div class="relative w-28 h-28 sm:w-36 sm:h-36">
                        <svg viewBox="0 0 42 42" class="w-full h-full transform -rotate-90">
                            @php
                                $cumPct = 0;
                                $deptColors = [
                                    'video' => '#FF9420',
                                    'design' => '#FFBA70',
                                    'marketing' => '#BC6200',
                                    'content' => '#A855F7',
                                    'dev' => '#38BDF8',
                                    'other' => '#64748B',
                                ];
                            @endphp
                            @foreach($departmentDistribution as $dKey => $dCount)
                                @php
                                    $pct = $totalDeptTasks > 0 ? ($dCount / $totalDeptTasks) * 100 : 0;
                                    $dash = round($pct, 1);
                                    $gap = 100 - $dash;
                                    $offset = 100 - $cumPct;
                                    $cumPct += $pct;
                                @endphp
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                        stroke="{{ $deptColors[$dKey] ?? '#64748B' }}"
                                        stroke-width="5"
                                        stroke-dasharray="{{ $dash }} {{ $gap }}"
                                        stroke-dashoffset="{{ $offset }}"></circle>
                            @endforeach
                            <circle cx="21" cy="21" r="11" fill="#1b082b"></circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-xs sm:text-sm font-black text-white">{{ count($departmentDistribution) }}</span>
                            <span class="text-[9px] text-gray-400 font-bold">أقسام</span>
                        </div>
                    </div>
                </div>

                <!-- Department Legend Breakdown -->
                <div class="sm:col-span-7 space-y-2">
                    @php
                        $deptLabels = [
                            'video' => ['فيديو ومونتاج', '#FF9420', 'bg-amber-500'],
                            'design' => ['جرافيك وتصميم', '#FFBA70', 'bg-amber-300'],
                            'marketing' => ['ميديا باينج وحملات', '#BC6200', 'bg-amber-700'],
                            'content' => ['كتابة المحتوى والسيناريو', '#A855F7', 'bg-purple-500'],
                            'dev' => ['تطوير وإدارة المشروعات', '#38BDF8', 'bg-sky-400'],
                            'other' => ['مهام إدارية وخدمات', '#64748B', 'bg-slate-500'],
                        ];
                    @endphp
                    @foreach($departmentDistribution as $deptKey => $deptCount)
                        @php
                            $dInfo = $deptLabels[$deptKey] ?? ['قسم آخر', '#64748B', 'bg-slate-500'];
                            $dPct = $totalDeptTasks > 0 ? round(($deptCount / $totalDeptTasks) * 100) : 0;
                        @endphp
                        <div class="flex items-center justify-between text-[11px] sm:text-xs">
                            <div class="flex items-center gap-1.5 truncate">
                                <span class="w-2 h-2 rounded-full {{ $dInfo[2] }} shrink-0"></span>
                                <span class="text-gray-300 font-bold truncate">{{ $dInfo[0] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <span class="text-white font-black">{{ $deptCount }}</span>
                                <span class="text-[9px] sm:text-[10px] text-gray-400 w-7 text-left">({{ $dPct }}%)</span>
                            </div>
                        </div>
                        <div class="w-full bg-brand-dark rounded-full h-1 overflow-hidden">
                            <div class="{{ $dInfo[2] }} h-full rounded-full" style="width: {{ $dPct }}%;"></div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- B. Employee Task Distribution & Workload -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-5 space-y-3 sm:space-y-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-white">توزيع المهام حسب الموظف</h3>
                        <p class="text-[10px] sm:text-[11px] text-gray-400">حجم المهام المنجزة والجارية للفريق</p>
                    </div>
                </div>
                <a href="{{ route('tasks.index') }}" class="text-xs text-brand-gold font-bold hover:underline">المهام ←</a>
            </div>

            <div class="space-y-2.5 pt-1">
                @forelse($employeesWorkload as $emp)
                    @php
                        $empTotal = $emp->tasks_count ?: 1;
                        $empRate = round(($emp->completed_count / $empTotal) * 100);
                    @endphp
                    <div class="p-2.5 sm:p-3 rounded-xl bg-brand-purple/50 border border-brand-border/60 hover:border-brand-border transition space-y-1.5">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-brand-yellow/20 text-brand-gold font-black flex items-center justify-center text-[10px] sm:text-[11px] shrink-0">
                                    {{ mb_substr($emp->name, 0, 1) }}
                                </div>
                                <div class="truncate">
                                    <div class="font-bold text-white text-xs truncate">{{ $emp->name }}</div>
                                    <div class="text-[9px] sm:text-[10px] text-gray-400 truncate">{{ $emp->role_arabic ?? $emp->department ?? 'عضو الفريق' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <span class="px-1.5 py-0.5 rounded text-[9px] sm:text-[10px] font-bold bg-amber-500/15 text-amber-300">
                                    {{ $emp->active_count }} نشط
                                </span>
                                <span class="px-1.5 py-0.5 rounded text-[9px] sm:text-[10px] font-bold bg-emerald-500/15 text-emerald-400">
                                    {{ $emp->completed_count }} مكتمل
                                </span>
                            </div>
                        </div>

                        <div class="w-full bg-brand-dark rounded-full h-1 overflow-hidden">
                            <div class="bg-gradient-to-r from-brand-gold to-emerald-400 h-full rounded-full transition-all" style="width: {{ $empRate }}%;"></div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-xs text-gray-400">لا يوجد موظفون مسجلون حالياً.</div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- 6. APPROACHING CLIENT INSTALLMENTS & PHOTOGRAPHER LIVE TRACKING -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        
        <!-- Approaching Client Installments -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-5 space-y-3 sm:space-y-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-amber-500/20 text-brand-gold flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-white">استحقاق دفعات وأقساط العملاء</h3>
                        <p class="text-[10px] sm:text-[11px] text-gray-400">الدفعات القادمة خلال 3 أيام لمتابعة التحصيل</p>
                    </div>
                </div>
                <a href="{{ route('clients.index') }}" class="text-xs text-brand-gold font-bold hover:underline">الكل</a>
            </div>

            <div class="space-y-2">
                @forelse($approachingInstallments as $inst)
                @php $urg = $inst->urgency_info; @endphp
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs gap-2">
                    <div class="min-w-0">
                        <div class="font-bold text-white truncate">{{ $inst->title }}</div>
                        <div class="text-[10px] sm:text-[11px] text-brand-gold font-bold truncate mt-0.5">العميل: {{ $inst->client->name }}</div>
                        <span class="inline-block mt-1 px-1.5 py-0.5 rounded-full text-[9px] font-bold border {{ $urg['badge'] }}">
                            {{ $urg['label'] }}
                        </span>
                    </div>
                    <div class="text-left shrink-0 space-y-1">
                        <div class="font-black text-xs sm:text-sm text-emerald-400">{{ number_format($inst->amount, 0) }} ج.م</div>
                        <a href="{{ route('clients.show', $inst->client_id) }}" class="inline-flex items-center gap-1 text-[10px] text-brand-gold hover:underline">
                            <span>تحصيل</span>
                            <i class="fa-solid fa-arrow-left text-[8px]"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500 text-xs">لا توجد أقساط مستحقة حالياً.</div>
                @endforelse
            </div>
        </div>

        <!-- Field Photographers Live Status -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-5 space-y-3 sm:space-y-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-white">نشاط المصورين وبصمة الحضور</h3>
                        <p class="text-[10px] sm:text-[11px] text-gray-400">متابعة المصورين بالميدان لحظياً</p>
                    </div>
                </div>
                <a href="{{ route('tasks.index') }}" class="text-xs text-indigo-300 font-bold hover:underline">المهام</a>
            </div>

            <div class="space-y-2">
                @forelse($activePhotographerTasks as $pTask)
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs gap-2">
                    <div class="space-y-1 min-w-0">
                        <div class="font-bold text-white truncate">{{ $pTask->title }}</div>
                        <div class="text-[10px] sm:text-[11px] text-gray-300 truncate">
                            المصور: <strong class="text-brand-gold">{{ $pTask->assignee->name }}</strong>
                        </div>
                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-bold {{ $pTask->attendance_status === 'checked_in' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-amber-500/20 text-amber-300 animate-pulse' }}">
                            <i class="fa-solid {{ $pTask->attendance_status === 'checked_in' ? 'fa-circle-check' : 'fa-person-walking' }}"></i>
                            {{ $pTask->attendance_status_arabic }}
                        </span>
                    </div>

                    @if($pTask->location_map_url)
                    <a href="{{ $pTask->location_map_url }}" target="_blank" class="p-2 rounded-lg bg-indigo-600/20 text-indigo-300 hover:bg-indigo-600/30 transition font-bold text-xs shrink-0" title="خريطة الموقع">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </a>
                    @endif
                </div>
                @empty
                <div class="p-6 text-center text-gray-500 text-xs">لا توجد جلسات تصوير جارية في الميدان حالياً.</div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- 7. Content Publishing Calendar Quick Widget -->
    <div class="bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-5 space-y-3 sm:space-y-4 shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-3">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs sm:text-sm font-bold">
                    <i class="fa-solid fa-calendar-days text-brand-gold"></i>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-bold text-white flex items-center gap-2">
                        <span>جدول نشر المحتوى للعملاء</span>
                        @if(isset($todayContentPlans) && $todayContentPlans->count() > 0)
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-500 text-brand-dark animate-pulse">
                                {{ $todayContentPlans->count() }} مقرر اليوم
                            </span>
                        @endif
                    </h3>
                    <p class="text-[10px] sm:text-[11px] text-gray-400">متابعة مواعيد نشر الريلز والبوستات</p>
                </div>
            </div>
            <a href="{{ route('content-plans.index') }}" class="text-xs text-brand-gold font-bold hover:underline flex items-center gap-1 self-start sm:self-auto">
                <span>فتح التقويم الشهري</span>
                <i class="fa-solid fa-arrow-left text-[9px]"></i>
            </a>
        </div>

        @if(isset($todayContentPlans) && $todayContentPlans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-3">
            @foreach($todayContentPlans as $tp)
            @php $tBadge = $tp->type_badge; $pBadge = $tp->publishing_status_badge; @endphp
            <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs gap-2">
                <div class="min-w-0">
                    <div class="font-bold text-white truncate">{{ $tp->title }}</div>
                    <div class="text-[10px] sm:text-[11px] text-brand-gold font-semibold mt-0.5 truncate">
                        {{ $tp->client->brand_name ?? $tp->client->name }}
                    </div>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ $tBadge['badge'] }}">
                            <i class="fa-solid {{ $tBadge['icon'] }} ml-0.5"></i>{{ $tBadge['label'] }}
                        </span>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ $pBadge['class'] }}">{{ $pBadge['label'] }}</span>
                    </div>
                </div>
                <div class="text-left space-y-1 shrink-0">
                    <span class="text-xs font-black text-amber-300 block">{{ $tp->publish_time ?? '18:00' }}</span>
                    @if($tp->content_url)
                        <a href="{{ $tp->content_url }}" target="_blank" class="text-indigo-400 hover:underline font-bold text-[10px] inline-flex items-center gap-1">
                            <i class="fa-brands fa-google-drive"></i>
                            <span>معاينة</span>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="p-3.5 sm:p-4 rounded-xl bg-brand-dark/50 border border-brand-border text-center text-xs text-gray-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>لا توجد منشورات مقررة للنشر في هذا اليوم بالتحديد.</span>
            <a href="{{ route('content-plans.index') }}" class="text-brand-gold font-bold hover:underline">عرض الخطة الكاملة ←</a>
        </div>
        @endif
    </div>

    <!-- 8. Main Grid: Active Tasks & Cashier Panel -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        
        <!-- Active & Urgent Daily Tasks (2 Columns) -->
        <div class="lg:col-span-2 space-y-3 sm:space-y-4">
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 sm:p-5 shadow-lg">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-brand-yellow/15 text-brand-gold flex items-center justify-center text-xs sm:text-sm">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-bold text-white">المهام اليومية ومواعيد التسليم</h2>
                            <p class="text-[10px] sm:text-xs text-gray-400">متابعة تسليمات المونتيرين والمصممين</p>
                        </div>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="px-2.5 sm:px-3 py-1.5 rounded-lg bg-brand-hover hover:bg-brand-border text-xs text-brand-gold font-bold transition flex items-center gap-1">
                        <span>الكل</span>
                        <i class="fa-solid fa-arrow-left text-[9px]"></i>
                    </a>
                </div>

                <div class="space-y-2.5 sm:space-y-3">
                    @forelse($urgentTasks as $task)
                    <div class="p-3 sm:p-4 rounded-xl bg-brand-purple/50 border border-brand-border/60 hover:border-brand-border transition group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div class="space-y-1 min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-[10px] sm:text-xs px-2 py-0.5 rounded-full font-bold border {{ $task->status_badge }}">
                                        {{ $task->status_label }}
                                    </span>
                                    <span class="text-[10px] sm:text-xs text-gray-400 font-medium">
                                        <i class="fa-solid fa-layer-group text-[9px] ml-0.5"></i>
                                        {{ $task->department_arabic }}
                                    </span>
                                    @if($task->client)
                                    <span class="text-[10px] sm:text-xs text-brand-gold font-bold truncate max-w-[150px]">
                                        • {{ $task->client->name }}
                                    </span>
                                    @endif
                                </div>
                                <h3 class="text-xs sm:text-sm font-bold text-white group-hover:text-brand-gold transition-colors break-words">
                                    {{ $task->title }}
                                </h3>
                            </div>

                            <div class="text-left flex items-center sm:items-end justify-between sm:justify-center gap-1 pt-2 sm:pt-0 border-t sm:border-t-0 border-brand-border/30">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-xs font-bold text-white">{{ $task->assignee->name ?? 'غير محدد' }}</span>
                                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-brand-yellow/20 text-brand-gold font-bold flex items-center justify-center text-[9px] sm:text-[10px]">
                                        {{ mb_substr($task->assignee->name ?? 'U', 0, 1) }}
                                    </div>
                                </div>
                                <div class="text-[10px] sm:text-[11px] text-amber-300 font-semibold flex items-center gap-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ $task->daily_delivery_deadline ?? 'تسليم في الموعد' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Links & Notes bar -->
                        <div class="mt-2.5 pt-2.5 border-t border-brand-border/40 flex flex-wrap items-center justify-between gap-2 text-xs">
                            <div class="flex items-center gap-3">
                                @if($task->material_link)
                                <a href="{{ $task->material_link }}" target="_blank" class="text-blue-400 hover:text-blue-300 flex items-center gap-1 text-[11px]">
                                    <i class="fa-brands fa-google-drive"></i>
                                    <span>الماتريال</span>
                                </a>
                                @endif

                                @if($task->delivery_link)
                                <a href="{{ $task->delivery_link }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 flex items-center gap-1 font-bold text-[11px]">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                    <span>التسليم</span>
                                </a>
                                @else
                                <span class="text-gray-500 italic text-[11px]">في انتظار التسليم</span>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('tasks.status', $task->id) }}" class="flex items-center gap-1.5">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="bg-brand-dark/70 border border-brand-border rounded-lg text-[10px] sm:text-[11px] text-gray-300 py-1 px-2 focus:outline-none focus:border-brand-gold">
                                    @foreach(\App\Models\Task::getStatuses() as $key => $st)
                                    <option value="{{ $key }}" {{ $task->status === $key ? 'selected' : '' }}>{{ $st['name'] }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400 text-sm">
                        لا توجد مهام نشطة حالياً.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Column: Cashier & Quick POS + Recent Leads (1 Column) -->
        <div class="space-y-4 sm:space-y-6">
            
            <!-- Cashier Quick Launch Box -->
            <div class="bg-gradient-to-br from-brand-card via-brand-purple to-brand-card border border-brand-yellow/40 rounded-2xl p-4 sm:p-5 shadow-lg relative overflow-hidden">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-cash-register text-brand-gold text-lg sm:text-xl"></i>
                        <h2 class="text-sm sm:text-base font-bold text-white">كاشير الوكالة والحسابات</h2>
                    </div>
                    <span class="text-[10px] bg-brand-yellow text-brand-dark font-black px-2 py-0.5 rounded-full">POS</span>
                </div>
                <p class="text-xs text-gray-300 mb-3 sm:mb-4">تسجيل الدفعات السريعة ومشاركتها على واتساب بنقرة واحدة.</p>

                <div class="space-y-2">
                    <a href="{{ route('cashier.index') }}" 
                       class="w-full py-2.5 px-3 rounded-xl font-black text-xs bg-brand-yellow text-brand-dark hover:bg-brand-gold transition flex items-center justify-center gap-2 shadow active:scale-95">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>فتح الكاشير وإصدار إيصال</span>
                    </a>
                    <a href="{{ route('accounting.index') }}" 
                       class="w-full py-2 px-3 rounded-xl font-bold text-xs bg-brand-card hover:bg-brand-hover text-gray-300 border border-brand-border transition flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-scale-balanced text-brand-gold"></i>
                        <span>النظام المحاسبي وقيود اليومية</span>
                    </a>
                </div>

                <!-- Recent Cashier Payments -->
                <div class="mt-4 pt-3 border-t border-brand-border/60">
                    <div class="text-[10px] sm:text-[11px] font-bold text-gray-400 mb-2">آخر إيصالات تم تحصيلها:</div>
                    <div class="space-y-1.5">
                        @forelse($recentPayments as $payment)
                        <div class="p-2 sm:p-2.5 rounded-lg bg-brand-dark/40 border border-brand-border/50 flex items-center justify-between text-xs gap-2">
                            <div class="min-w-0">
                                <div class="font-bold text-white truncate max-w-[130px] sm:max-w-[160px]">{{ $payment->client->name ?? 'عميل' }}</div>
                                <div class="text-[9px] sm:text-[10px] text-brand-gold">{{ $payment->payment_method_arabic }}</div>
                            </div>
                            <div class="text-left shrink-0">
                                <div class="font-black text-xs sm:text-sm text-emerald-400">{{ number_format($payment->amount) }} ج.م</div>
                                <a href="{{ route('cashier.receipt', $payment->id) }}" class="text-[9px] sm:text-[10px] text-gray-400 hover:text-white underline">
                                    #{{ $payment->receipt_number }}
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="text-xs text-gray-500 text-center py-2">لا توجد مدفوعات حديثة</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Inquiries from Website -->
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 sm:p-5 shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-bullhorn text-brand-gold text-sm sm:text-base"></i>
                        <h2 class="text-xs sm:text-sm font-bold text-white">طلبات واستشارات الموقع</h2>
                    </div>
                    <a href="{{ route('cms.index') }}" class="text-xs text-brand-gold hover:underline">عرض الكل</a>
                </div>

                <div class="space-y-2">
                    @forelse($recentInquiries as $inq)
                    <div class="p-2.5 sm:p-3 rounded-xl bg-brand-purple/40 border border-brand-border/40 text-xs space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-white truncate max-w-[150px]">{{ $inq->name }}</span>
                            <span class="text-[9px] text-gray-400 shrink-0">{{ $inq->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-[10px] sm:text-[11px] text-brand-gold truncate">{{ $inq->brand_name ?? 'بدون براند' }} • {{ $inq->service_interested ?? 'استشارة' }}</div>
                        <div class="text-gray-300 text-[10px] sm:text-[11px] line-clamp-1">{{ $inq->message }}</div>
                    </div>
                    @empty
                    <div class="text-xs text-gray-500 text-center py-3">لا توجد استشارات جديدة بعد</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <!-- GM DECISION MODAL (متجاوب للموبايل بنوافذ منبثقة ملائمة للمس) -->
    <div x-show="gmDecisionModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="gmDecisionModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-4 sm:p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-stamp text-brand-gold text-base sm:text-lg"></i>
                    <h3 class="text-sm sm:text-base font-bold text-white" x-text="decisionType === 'approved' ? 'اعتماد اكتمال المشروع النهائي' : 'طلب تعديلات من صانع المحتوى'"></h3>
                </div>
                <button @click="gmDecisionModal = false" class="text-gray-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/projects/' + (activeProject ? activeProject.id : '') + '/gm-decision'" method="POST" class="space-y-3 sm:space-y-4">
                @csrf
                <input type="hidden" name="decision" :value="decisionType">

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">المشروع:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple/70 text-xs text-white font-bold break-words" x-text="activeProject ? activeProject.title : ''"></div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">ملاحظات المدير العام لصانع المحتوى</label>
                    <textarea name="notes" rows="3" 
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                              :placeholder="decisionType === 'approved' ? 'مثال: تم الاعتماد بجودة ممتازة، شكراً لفريق العمل.' : 'مثال: مطلوب تعديل سرعة المونتاج في الفيديو الثاني...'" required></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="gmDecisionModal = false" type="button" class="px-4 py-2 rounded-xl text-xs text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" 
                            class="px-5 py-2 rounded-xl font-black text-xs shadow text-white"
                            :class="decisionType === 'approved' ? 'bg-emerald-600 hover:bg-emerald-500' : 'bg-rose-600 hover:bg-rose-500'"
                            x-text="decisionType === 'approved' ? 'تأكيد الاعتماد والاكتمال' : 'إرسال طلب التعديل'">
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
