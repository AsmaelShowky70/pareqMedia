@extends('layouts.app')

@section('title', 'لوحة التحكم الشاملة')
@section('page_title', 'لوحة المتابعة والأداء العام للشركة')
@section('page_subtitle', 'نظرة شاملة للمدير العام على مؤشرات الأداء، المشروعات، مهام صناع المحتوى، والمالية لحظياً')

@section('content')
<div class="space-y-6 pt-2" x-data="{ gmDecisionModal: false, activeProject: null, decisionType: 'approved' }">

    <!-- 1. ALERT: PROJECTS DELIVERED BY CONTENT CREATORS WAITING FOR GM APPROVAL (تسليمات صناع المحتوى للمدير العام) -->
    @if(isset($projectsPendingGMApproval) && $projectsPendingGMApproval->isNotEmpty())
    <div class="bg-gradient-to-r from-amber-950/50 via-brand-card to-amber-950/40 border-2 border-amber-500/60 rounded-2xl p-6 shadow-2xl space-y-4 animate-pulse">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-brand-dark flex items-center justify-center text-lg font-black shadow">
                    <i class="fa-solid fa-flag-checkered"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-white">مشاريع مسلمة من صناع المحتوى بانتظار اعتمادك النهائي</h2>
                    <p class="text-xs text-amber-300 font-bold">قام صناع المحتوى بإنهاء المشروعات التالية ومراجعة مهام الموظفين وإرسالها لاعتماد المدير العام</p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-brand-dark">
                {{ $projectsPendingGMApproval->count() }} مشاريع جاهزة
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
            @foreach($projectsPendingGMApproval as $pPending)
            <div class="p-4 rounded-xl bg-brand-purple/90 border border-brand-border space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <span class="text-xs text-brand-gold font-bold">صانع المحتوى المسؤول: {{ $pPending->contentCreator->name ?? 'غير محدد' }}</span>
                        <h4 class="text-base font-bold text-white mt-0.5">{{ $pPending->title }}</h4>
                        <div class="text-xs text-gray-400">العميل: {{ $pPending->client->name ?? 'غير محدد' }} | المهام المكتملة: {{ $pPending->tasks->where('status', 'completed')->count() }}/{{ $pPending->tasks->count() }}</div>
                    </div>
                    <span class="text-[11px] text-gray-400 font-medium">
                        {{ $pPending->submitted_to_gm_at ? $pPending->submitted_to_gm_at->diffForHumans() : 'الآن' }}
                    </span>
                </div>

                @if($pPending->delivery_notes)
                <div class="p-3 rounded-lg bg-brand-card/90 border border-brand-border/60 text-xs text-gray-300">
                    <span class="font-bold text-white">ملاحظات صانع المحتوى: </span>{{ $pPending->delivery_notes }}
                </div>
                @endif

                <div class="pt-2 border-t border-brand-border/40 flex items-center justify-between gap-2">
                    <a href="{{ route('projects.show', $pPending->id) }}" class="text-xs text-brand-gold font-bold hover:underline">
                        فحص المشروع والمهام ←
                    </a>

                    <div class="flex items-center gap-2">
                        <button @click="activeProject = { id: {{ $pPending->id }}, title: '{{ addslashes($pPending->title) }}' }; decisionType = 'approved'; gmDecisionModal = true;"
                                type="button" 
                                class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition flex items-center gap-1">
                            <i class="fa-solid fa-check"></i>
                            <span>اعتماد الاكتمال</span>
                        </button>
                        <button @click="activeProject = { id: {{ $pPending->id }}, title: '{{ addslashes($pPending->title) }}' }; decisionType = 'revisions_needed'; gmDecisionModal = true;"
                                type="button" 
                                class="px-3 py-1.5 rounded-xl bg-rose-600/80 hover:bg-rose-600 text-white font-bold text-xs shadow transition flex items-center gap-1">
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

    <!-- 2. Top KPI Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Revenue -->
        <div class="bg-brand-card/80 border border-brand-border/70 rounded-2xl p-5 relative overflow-hidden group hover:border-brand-yellow/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">إجمالي التحصيلات (الإيرادات)</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-brand-gold flex items-center justify-center text-lg">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ number_format($totalRevenue, 0) }} <span class="text-sm font-bold text-brand-gold">ج.م</span>
            </div>
            <div class="mt-2 flex items-center gap-2 text-[11px] text-emerald-400">
                <i class="fa-solid fa-scale-balanced"></i>
                <span>رصيد الخزائن الحالي: <strong class="text-white">{{ number_format($treasuryBalance ?? 0, 0) }} ج.م</strong></span>
            </div>
        </div>

        <!-- Net Profit -->
        <div class="bg-brand-card/80 border border-brand-border/70 rounded-2xl p-5 relative overflow-hidden group hover:border-emerald-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">صافي الأرباح التشغيلية</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ number_format($netProfit, 0) }} <span class="text-sm font-bold text-emerald-400">ج.م</span>
            </div>
            <div class="mt-2 text-[11px] text-gray-400">
                المصروفات: <span class="text-rose-400 font-bold">{{ number_format($totalExpenses, 0) }} ج.م</span>
            </div>
        </div>

        <!-- Active Tasks -->
        <div class="bg-brand-card/80 border border-brand-border/70 rounded-2xl p-5 relative overflow-hidden group hover:border-brand-border transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">مهام قيد العمل النشط</span>
                <div class="w-10 h-10 rounded-xl bg-purple-500/15 text-purple-300 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ $taskCounts['in_progress'] }} <span class="text-sm font-normal text-gray-400">من أصل {{ $taskCounts['total'] }} مهمة</span>
            </div>
            <div class="mt-2 flex items-center gap-1.5 text-[11px] text-amber-400">
                <i class="fa-solid fa-clock"></i>
                <span>{{ $taskCounts['not_started'] }} مهام في قائمة الانتظار</span>
            </div>
        </div>

        <!-- Clients & Retainers -->
        <div class="bg-brand-card/80 border border-brand-border/70 rounded-2xl p-5 relative overflow-hidden group hover:border-brand-border transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400">العملاء والتعاقدات الشهرية</span>
                <div class="w-10 h-10 rounded-xl bg-blue-500/15 text-blue-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-handshake"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white tracking-tight">
                {{ $totalClientsCount }} <span class="text-sm font-bold text-blue-400">عميل نشط</span>
            </div>
            <div class="mt-2 text-[11px] text-gray-400 flex items-center justify-between">
                <span>المشاريع الجارية: <strong class="text-white">{{ $activeProjectsCount }}</strong></span>
                <a href="{{ route('clients.index') }}" class="text-brand-gold hover:underline">إدارة CRM ←</a>
            </div>
        </div>

    </div>

    <!-- 3. APPROACHING CLIENT INSTALLMENTS & PHOTOGRAPHER LIVE TRACKING -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Approaching Client Installments -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-brand-gold flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">تنبيهات استحقاق دفعات وأقساط العملاء</h3>
                        <p class="text-[11px] text-gray-400">مواعيد الدفعات القادمة خلال 3 أيام أو المتأخرة لمتابعة التحصيل</p>
                    </div>
                </div>
                <a href="{{ route('clients.index') }}" class="text-xs text-brand-gold font-bold hover:underline">عرض الكل</a>
            </div>

            <div class="space-y-2.5">
                @forelse($approachingInstallments as $inst)
                @php $urg = $inst->urgency_info; @endphp
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs">
                    <div>
                        <div class="font-bold text-white">{{ $inst->title }}</div>
                        <div class="text-[11px] text-brand-gold font-bold mt-0.5">العميل: {{ $inst->client->name }}</div>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $urg['badge'] }}">
                            {{ $urg['label'] }}
                        </span>
                    </div>
                    <div class="text-left space-y-1">
                        <div class="font-black text-sm text-emerald-400">{{ number_format($inst->amount, 2) }} ج.م</div>
                        <a href="{{ route('clients.show', $inst->client_id) }}" class="inline-flex items-center gap-1 text-[11px] text-brand-gold hover:underline">
                            <span>تحصيل الآن</span>
                            <i class="fa-solid fa-arrow-left text-[9px]"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500 text-xs">لا توجد أقساط مستحقة خلال الأيام الثلاثة القادمة.</div>
                @endforelse
            </div>
        </div>

        <!-- Field Photographers Live Status -->
        <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">نشاط المصورين الميدانيين وبصمة الحضور</h3>
                        <p class="text-[11px] text-gray-400">متابعة تحركات المصورين من استلام المهمة للوصول للموقع</p>
                    </div>
                </div>
                <a href="{{ route('tasks.index') }}" class="text-xs text-indigo-300 font-bold hover:underline">المهام</a>
            </div>

            <div class="space-y-2.5">
                @forelse($activePhotographerTasks as $pTask)
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs">
                    <div class="space-y-1">
                        <div class="font-bold text-white">{{ $pTask->title }}</div>
                        <div class="text-[11px] text-gray-300">
                            المصور: <strong class="text-brand-gold">{{ $pTask->assignee->name }}</strong> • {{ $pTask->location_address ?? 'الموقع' }}
                        </div>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold {{ $pTask->attendance_status === 'checked_in' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-amber-500/20 text-amber-300 animate-pulse' }}">
                            <i class="fa-solid {{ $pTask->attendance_status === 'checked_in' ? 'fa-circle-check' : 'fa-person-walking' }}"></i>
                            {{ $pTask->attendance_status_arabic }}
                        </span>
                    </div>

                    @if($pTask->location_map_url)
                    <a href="{{ $pTask->location_map_url }}" target="_blank" class="p-2 rounded-lg bg-indigo-600/20 text-indigo-300 hover:bg-indigo-600/30 transition font-bold text-xs" title="خريطة الموقع">
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

    <!-- 3.5 Content Publishing Calendar Quick Widget -->
    <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-calendar-days text-brand-gold"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <span>خطة وجدول نشر المحتوى للعملاء</span>
                        @if(isset($todayContentPlans) && $todayContentPlans->count() > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-brand-dark animate-pulse">
                                {{ $todayContentPlans->count() }} مقرر نشره اليوم
                            </span>
                        @endif
                    </h3>
                    <p class="text-[11px] text-gray-400">متابعة مواعيد نشر الريلز والبوستات وروابط المحتوى عبر منصات التواصل</p>
                </div>
            </div>
            <a href="{{ route('content-plans.index') }}" class="text-xs text-brand-gold font-bold hover:underline flex items-center gap-1">
                <span>فتح جدول النشر والتقويم الشهري</span>
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
            </a>
        </div>

        @if(isset($todayContentPlans) && $todayContentPlans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($todayContentPlans as $tp)
            @php $tBadge = $tp->type_badge; $pBadge = $tp->publishing_status_badge; @endphp
            <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border flex items-center justify-between text-xs">
                <div>
                    <div class="font-bold text-white">{{ $tp->title }}</div>
                    <div class="text-[11px] text-brand-gold font-semibold mt-0.5">
                        {{ $tp->client->brand_name ?? $tp->client->name }}
                        @if($tp->contentCreator)
                            <span class="text-gray-400"> • {{ $tp->contentCreator->name }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $tBadge['badge'] }}">
                            <i class="fa-solid {{ $tBadge['icon'] }} ml-1"></i>{{ $tBadge['label'] }}
                        </span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $pBadge['class'] }}">{{ $pBadge['label'] }}</span>
                    </div>
                </div>
                <div class="text-left space-y-1">
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
        <div class="p-4 rounded-xl bg-brand-dark/50 border border-brand-border text-center text-xs text-gray-400 flex items-center justify-between">
            <span>لا توجد منشورات مقررة للنشر في هذا اليوم بالتحديد.</span>
            <a href="{{ route('content-plans.index') }}" class="text-brand-gold font-bold hover:underline">عرض الخطة الشهرية الكاملة ←</a>
        </div>
        @endif
    </div>

    <!-- 4. Five Strict Statuses Tracker Banner -->
    <div class="bg-brand-purple/70 border border-brand-border rounded-2xl p-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
            <div class="text-xs font-bold text-gray-300 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-brand-gold"></i>
                <span>توزيع المهام التشغيلية اليومية حسب الحالات الخمس المعتمدة:</span>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-xs text-brand-gold hover:underline font-bold flex items-center gap-1">
                <span>فتح لوحة كانبان والمهام</span>
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5">
            <div class="p-3 rounded-xl bg-slate-800/40 border border-slate-700/50 flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-slate-400 font-bold">لم تبدأ</div>
                    <div class="text-lg font-black text-white">{{ $taskCounts['not_started'] }}</div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
            </div>

            <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-amber-300 font-bold">جاري العمل</div>
                    <div class="text-lg font-black text-amber-400">{{ $taskCounts['in_progress'] }}</div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
            </div>

            <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-emerald-300 font-bold">مكتمل</div>
                    <div class="text-lg font-black text-emerald-400">{{ $taskCounts['completed'] }}</div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
            </div>

            <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-rose-300 font-bold">إلغاء المشروع</div>
                    <div class="text-lg font-black text-rose-400">{{ $taskCounts['cancelled'] }}</div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
            </div>

            <div class="p-3 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-between">
                <div>
                    <div class="text-[11px] text-purple-300 font-bold">اجازه</div>
                    <div class="text-lg font-black text-purple-300">{{ $taskCounts['on_leave'] }}</div>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-purple-400"></span>
            </div>
        </div>
    </div>

    <!-- 5. Main Grid: Active Tasks & Cashier Panel -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Active & Urgent Daily Tasks (2 Columns) -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-yellow/15 text-brand-gold flex items-center justify-center text-sm">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-white">المهام اليومية ومواعيد التسليم العاجلة</h2>
                            <p class="text-xs text-gray-400">متابعة تسليمات المونتيرين والمصممين والميديا بايرز</p>
                        </div>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="px-3 py-1.5 rounded-lg bg-brand-hover hover:bg-brand-border text-xs text-brand-gold font-bold transition flex items-center gap-1.5">
                        <span>عرض كل المهام</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($urgentTasks as $task)
                    <div class="p-4 rounded-xl bg-brand-purple/50 border border-brand-border/60 hover:border-brand-border transition group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-xs px-2.5 py-0.5 rounded-full font-bold border {{ $task->status_badge }}">
                                        {{ $task->status_label }}
                                    </span>
                                    <span class="text-xs text-gray-400 font-medium">
                                        <i class="fa-solid fa-layer-group text-[10px] ml-1"></i>
                                        {{ $task->department_arabic }}
                                    </span>
                                    @if($task->client)
                                    <span class="text-xs text-brand-gold font-bold">
                                        • {{ $task->client->name }}
                                    </span>
                                    @endif
                                </div>
                                <h3 class="text-sm font-bold text-white group-hover:text-brand-gold transition-colors">
                                    {{ $task->title }}
                                </h3>
                            </div>

                            <div class="text-left flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-1 pt-2 sm:pt-0 border-t sm:border-t-0 border-brand-border/30">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-white">{{ $task->assignee->name ?? 'غير محدد' }}</span>
                                    <div class="w-6 h-6 rounded-full bg-brand-yellow/20 text-brand-gold font-bold flex items-center justify-center text-[10px]">
                                        {{ mb_substr($task->assignee->name ?? 'U', 0, 1) }}
                                    </div>
                                </div>
                                <div class="text-[11px] text-amber-300 font-semibold flex items-center gap-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>اليومية: {{ $task->daily_delivery_deadline ?? 'تسليم في الموعد' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Links & Notes bar -->
                        <div class="mt-3 pt-3 border-t border-brand-border/40 flex flex-wrap items-center justify-between gap-2 text-xs">
                            <div class="flex items-center gap-3">
                                @if($task->material_link)
                                <a href="{{ $task->material_link }}" target="_blank" class="text-blue-400 hover:text-blue-300 flex items-center gap-1">
                                    <i class="fa-brands fa-google-drive"></i>
                                    <span>الماتريال</span>
                                </a>
                                @endif

                                @if($task->delivery_link)
                                <a href="{{ $task->delivery_link }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 flex items-center gap-1 font-bold">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                    <span>التسليم</span>
                                </a>
                                @else
                                <span class="text-gray-500 italic">في انتظار التسليم</span>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('tasks.status', $task->id) }}" class="flex items-center gap-1.5">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="bg-brand-dark/70 border border-brand-border rounded-lg text-[11px] text-gray-300 py-1 px-2 focus:outline-none focus:border-brand-gold">
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
        <div class="space-y-6">
            
            <!-- Cashier Quick Launch Box -->
            <div class="bg-gradient-to-br from-brand-card via-brand-purple to-brand-card border border-brand-yellow/40 rounded-2xl p-5 shadow-lg relative overflow-hidden">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-cash-register text-brand-gold text-xl"></i>
                        <h2 class="text-base font-bold text-white">كاشير الوكالة والحسابات</h2>
                    </div>
                    <span class="text-[10px] bg-brand-yellow text-brand-dark font-black px-2 py-0.5 rounded-full">POS</span>
                </div>
                <p class="text-xs text-gray-300 mb-4">تسجيل الدفعات السريعة، إيصالات القبض، ومشاركتها مع العميل على واتساب بنقرة واحدة.</p>

                <div class="space-y-2.5">
                    <a href="{{ route('cashier.index') }}" 
                       class="w-full py-2.5 px-4 rounded-xl font-black text-xs bg-brand-yellow text-brand-dark hover:bg-brand-gold transition flex items-center justify-center gap-2 shadow">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>فتح واجهة الكاشير وإصدار إيصال</span>
                    </a>
                    <a href="{{ route('accounting.index') }}" 
                       class="w-full py-2 px-4 rounded-xl font-bold text-xs bg-brand-card hover:bg-brand-hover text-gray-300 border border-brand-border transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-scale-balanced text-brand-gold"></i>
                        <span>النظام المحاسبي وقيود اليومية</span>
                    </a>
                </div>

                <!-- Recent Cashier Payments -->
                <div class="mt-5 pt-4 border-t border-brand-border/60">
                    <div class="text-[11px] font-bold text-gray-400 mb-2.5">آخر إيصالات تم تحصيلها:</div>
                    <div class="space-y-2">
                        @forelse($recentPayments as $payment)
                        <div class="p-2.5 rounded-lg bg-brand-dark/40 border border-brand-border/50 flex items-center justify-between text-xs">
                            <div>
                                <div class="font-bold text-white truncate max-w-[130px]">{{ $payment->client->name ?? 'عميل' }}</div>
                                <div class="text-[10px] text-brand-gold">{{ $payment->payment_method_arabic }}</div>
                            </div>
                            <div class="text-left">
                                <div class="font-black text-emerald-400">{{ number_format($payment->amount) }} ج.م</div>
                                <a href="{{ route('cashier.receipt', $payment->id) }}" class="text-[10px] text-gray-400 hover:text-white underline">
                                    الإيصال #{{ $payment->receipt_number }}
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
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-bullhorn text-brand-gold"></i>
                        <h2 class="text-sm font-bold text-white">طلبات واستشارات الموقع</h2>
                    </div>
                    <a href="{{ route('cms.index') }}" class="text-xs text-brand-gold hover:underline">عرض الكل</a>
                </div>

                <div class="space-y-3">
                    @forelse($recentInquiries as $inq)
                    <div class="p-3 rounded-xl bg-brand-purple/40 border border-brand-border/40 text-xs space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-white">{{ $inq->name }}</span>
                            <span class="text-[10px] text-gray-400">{{ $inq->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-[11px] text-brand-gold">{{ $inq->brand_name ?? 'بدون براند' }} • {{ $inq->service_interested ?? 'استشارة' }}</div>
                        <div class="text-gray-300 text-[11px] line-clamp-1">{{ $inq->message }}</div>
                    </div>
                    @empty
                    <div class="text-xs text-gray-500 text-center py-4">لا توجد استشارات جديدة بعد</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <!-- GM DECISION MODAL -->
    <div x-show="gmDecisionModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="gmDecisionModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-stamp text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white" x-text="decisionType === 'approved' ? 'اعتماد اكتمال المشروع النهائي' : 'طلب تعديلات من صانع المحتوى'"></h3>
                </div>
                <button @click="gmDecisionModal = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/projects/' + (activeProject ? activeProject.id : '') + '/gm-decision'" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="decision" :value="decisionType">

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">المشروع:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple/70 text-xs text-white font-bold" x-text="activeProject ? activeProject.title : ''"></div>
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
