@extends('layouts.app')

@section('title', 'إدارة المهام وسير العمل اليومي')
@section('page_title', 'محرك إدارة المهام والعمليات اليومية')
@section('page_subtitle', 'توزيع المهام، متابعة المونتاج والتصوير والتصاميم، وروابط الماتريال والتسليم')

@section('content')
<div class="space-y-6 pt-2" x-data="{ 
    createModalOpen: false, 
    editModalOpen: false, 
    deliverModalOpen: false,
    selectedTask: null,
    isPhotoShoot: false,
    viewMode: '{{ $viewMode }}'
}">

    @if(Auth::user()->isAdmin())
    <!-- Task Distribution Banner for General Manager -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-yellow/30 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-yellow/20 text-brand-gold flex items-center justify-center text-lg">
                <i class="fa-solid fa-people-arrows"></i>
            </div>
            <div>
                <h3 class="text-xs font-bold text-white">لوحة توزيع وإسناد المهام على فريق العمل</h3>
                <p class="text-[11px] text-gray-300">بصفتك المدير العام، يمكنك إسناد أي مهمة لأي موظف مع تحديد موعد التسليم اليومي وتتبع بصمة حضور المصورين ومتابعة إنجازهم مباشرة.</p>
            </div>
        </div>
        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs transition flex items-center gap-1.5 shadow whitespace-nowrap self-start sm:self-auto">
            <i class="fa-solid fa-plus-circle"></i>
            <span>توزيع مهمة جديدة لموظف</span>
        </button>
    </div>
    @elseif(Auth::user()->isContentCreator())
    <!-- Task Banner for Content Creator -->
    <div class="bg-gradient-to-r from-blue-950/40 via-brand-card to-brand-card border border-blue-500/30 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-300 flex items-center justify-center text-lg">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
                <h3 class="text-xs font-bold text-white">إدارة وتوزيع مهام فريق صانع المحتوى</h3>
                <p class="text-[11px] text-gray-300">أنت تشاهد فقط مهام مشاريعك الخاصة. يمكنك تكليف الموظفين والمصورين ومتابعة حضورهم وتسليماتهم.</p>
            </div>
        </div>
        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs transition flex items-center gap-1.5 shadow whitespace-nowrap self-start sm:self-auto">
            <i class="fa-solid fa-plus-circle"></i>
            <span>تكليف موظف بمهمة جديدة</span>
        </button>
    </div>
    @endif

    <!-- Filter & Actions Bar -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-4 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        
        <!-- Filters Form -->
        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap items-center gap-2.5 flex-1">
            <input type="hidden" name="view" :value="viewMode">

            <!-- Search box -->
            <div class="relative min-w-[200px] flex-1 sm:flex-initial">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="بحث في المهام أو الموقع..." 
                       class="w-full pl-3 pr-8 py-2 bg-brand-purple border border-brand-border rounded-xl text-xs text-white placeholder-gray-400 focus:outline-none focus:border-brand-gold">
                <i class="fa-solid fa-magnifying-glass absolute right-2.5 top-2.5 text-gray-400 text-xs"></i>
            </div>

            @if(!Auth::user()->isEmployee())
            <!-- Assignee Filter -->
            <select name="assigned_to" onchange="this.form.submit()" 
                    class="bg-brand-purple border border-brand-border rounded-xl text-xs text-gray-200 py-2 px-3 focus:outline-none focus:border-brand-gold">
                <option value="">جميع الموظفين</option>
                @foreach($employees as $emp)
                <option value="{{ $emp->id }}" {{ request('assigned_to') == $emp->id ? 'selected' : '' }}>
                    {{ $emp->name }} ({{ $emp->job_title }})
                </option>
                @endforeach
            </select>
            @endif

            <!-- Status Filter -->
            <select name="status" onchange="this.form.submit()" 
                    class="bg-brand-purple border border-brand-border rounded-xl text-xs text-gray-200 py-2 px-3 focus:outline-none focus:border-brand-gold">
                <option value="">جميع الحالات</option>
                @foreach($statuses as $key => $st)
                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $st['name'] }}</option>
                @endforeach
            </select>

            <!-- Department Filter -->
            <select name="department" onchange="this.form.submit()" 
                    class="bg-brand-purple border border-brand-border rounded-xl text-xs text-gray-200 py-2 px-3 focus:outline-none focus:border-brand-gold">
                <option value="">جميع الأقسام</option>
                <option value="editing" {{ request('department') == 'editing' ? 'selected' : '' }}>المونتاج والبوست برودكشن</option>
                <option value="video" {{ request('department') == 'video' ? 'selected' : '' }}>التصوير الميداني والإنتاج</option>
                <option value="design" {{ request('department') == 'design' ? 'selected' : '' }}>تصميم الجرافيك</option>
                <option value="media_buyer" {{ request('department') == 'media_buyer' ? 'selected' : '' }}>الميديا باينج والإعلانات</option>
            </select>

            @if(request()->anyFilled(['search', 'assigned_to', 'status', 'department']))
            <a href="{{ route('tasks.index', ['view' => $viewMode]) }}" class="text-xs text-gray-400 hover:text-white px-2 py-1">
                <i class="fa-solid fa-rotate-left ml-1"></i>إعادة ضبط
            </a>
            @endif
        </form>

        <!-- View switcher & New Task Button -->
        <div class="flex items-center gap-2.5 self-end lg:self-auto">
            <!-- View toggles -->
            <div class="p-1 rounded-xl bg-brand-purple border border-brand-border flex items-center gap-1">
                <button type="button" 
                        @click="viewMode = 'kanban'; window.location.href='{{ route('tasks.index', array_merge(request()->query(), ['view' => 'kanban'])) }}'"
                        :class="viewMode === 'kanban' ? 'bg-brand-yellow text-brand-dark font-bold' : 'text-gray-400 hover:text-white'"
                        class="px-2.5 py-1 rounded-lg text-xs transition flex items-center gap-1.5">
                    <i class="fa-solid fa-table-columns"></i>
                    <span>كانبان</span>
                </button>

                <button type="button" 
                        @click="viewMode = 'list'; window.location.href='{{ route('tasks.index', array_merge(request()->query(), ['view' => 'list'])) }}'"
                        :class="viewMode === 'list' ? 'bg-brand-yellow text-brand-dark font-bold' : 'text-gray-400 hover:text-white'"
                        class="px-2.5 py-1 rounded-lg text-xs transition flex items-center gap-1.5">
                    <i class="fa-solid fa-list"></i>
                    <span>جدول</span>
                </button>
            </div>

            @if(!Auth::user()->isEmployee())
            <!-- Add Task Button -->
            <button @click="createModalOpen = true" 
                    type="button" 
                    class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 transition flex items-center gap-2 shadow-md">
                <i class="fa-solid fa-plus"></i>
                <span>مهمة جديدة</span>
            </button>
            @endif
        </div>

    </div>

    <!-- 1. KANBAN BOARD VIEW -->
    <div x-show="viewMode === 'kanban'" class="overflow-x-auto pb-6">
        <div class="flex gap-4 min-w-[1250px]">
            @foreach($statuses as $statusKey => $statusData)
            @php
                $columnTasks = $tasks->where('status', $statusKey);
            @endphp
            <div class="flex-1 bg-brand-card/70 border border-brand-border rounded-2xl flex flex-col max-h-[800px] overflow-hidden">
                
                <!-- Column Header -->
                <div class="p-3.5 border-b border-brand-border/80 flex items-center justify-between bg-brand-purple/50">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $statusData['color'] }}"></span>
                        <h3 class="text-xs font-black text-white">{{ $statusData['name'] }}</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-brand-dark/80 text-gray-300">
                        {{ $columnTasks->count() }}
                    </span>
                </div>

                <!-- Column Task Cards -->
                <div class="flex-1 p-3 space-y-3 overflow-y-auto">
                    @forelse($columnTasks as $task)
                    @php $urg = $task->urgency_info; @endphp
                    <div class="p-3.5 rounded-xl bg-brand-purple/70 border-2 {{ $urg['border_class'] }} transition shadow space-y-2.5 group">
                        
                        <!-- Header / Urgency Dot / Dept -->
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-gray-400 font-medium">
                                <i class="fa-solid fa-layer-group text-[9px] ml-1"></i>
                                {{ $task->department_arabic }}
                            </span>
                            
                            <!-- Urgency badge -->
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-black border {{ $urg['badge_class'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $urg['dot_color'] }}"></span>
                                <span>{{ $urg['color_name'] }}</span>
                            </span>
                        </div>

                        <!-- Title -->
                        <h4 class="text-xs font-bold text-white leading-relaxed group-hover:text-brand-gold transition-colors">
                            {{ $task->title }}
                        </h4>

                        <!-- Client / Project -->
                        @if($task->client)
                        <div class="text-[11px] text-brand-gold font-bold flex items-center gap-1">
                            <i class="fa-solid fa-building text-[10px]"></i>
                            <span>{{ $task->client->name }}</span>
                            @if($task->project)
                            <span class="text-gray-400 font-normal">({{ $task->project->title }})</span>
                            @endif
                        </div>
                        @endif

                        <!-- Photographer Location & Attendance status badge (if applicable) -->
                        @if($task->location_address)
                        <div class="p-2 rounded-lg bg-indigo-950/40 border border-indigo-500/30 text-[10px] space-y-1">
                            <div class="flex items-center gap-1 text-indigo-300 font-bold">
                                <i class="fa-solid fa-map-pin"></i>
                                <span class="truncate">{{ $task->location_address }}</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-300">
                                <span>حالة الحضور:</span>
                                <span class="font-bold {{ $task->attendance_status === 'checked_in' ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $task->attendance_status_arabic }}
                                </span>
                            </div>
                        </div>
                        @endif

                        <!-- Daily Delivery Deadline -->
                        @if($task->daily_delivery_deadline)
                        <div class="p-1.5 rounded-lg bg-amber-500/10 border border-amber-500/20 text-[10px] text-amber-300 flex items-center gap-1.5">
                            <i class="fa-regular fa-clock"></i>
                            <span class="font-bold truncate">اليومية: {{ $task->daily_delivery_deadline }}</span>
                        </div>
                        @endif

                        <!-- Materials & Delivery Links -->
                        <div class="pt-2 border-t border-brand-border/40 flex items-center justify-between text-[11px]">
                            <div class="flex items-center gap-2">
                                @if($task->material_link)
                                <a href="{{ $task->material_link }}" target="_blank" title="لينك الماتريال الخام" class="text-blue-400 hover:text-blue-300">
                                    <i class="fa-brands fa-google-drive"></i>
                                </a>
                                @endif

                                @if($task->delivery_link)
                                <a href="{{ $task->delivery_link }}" target="_blank" title="لينك التسليم المعتمد" class="text-emerald-400 hover:text-emerald-300">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                                @endif
                            </div>

                            <!-- Assignee -->
                            <div class="flex items-center gap-1.5">
                                <span class="text-[10px] text-gray-300 font-semibold">{{ $task->assignee->name ?? 'غير مسند' }}</span>
                                <div class="w-5 h-5 rounded-full bg-brand-yellow/20 text-brand-gold font-bold flex items-center justify-center text-[9px]">
                                    {{ mb_substr($task->assignee->name ?? 'U', 0, 1) }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Dropdown -->
                        <div class="pt-2 border-t border-brand-border/30 flex items-center justify-between">
                            <form method="POST" action="{{ route('tasks.status', $task->id) }}">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="bg-brand-dark border border-brand-border rounded text-[10px] text-gray-300 py-0.5 px-1.5 focus:outline-none">
                                    @foreach($statuses as $k => $st)
                                    <option value="{{ $k }}" {{ $task->status === $k ? 'selected' : '' }}>نقل إلى: {{ $st['name'] }}</option>
                                    @endforeach
                                </select>
                            </form>

                            <div class="flex items-center gap-1">
                                <button @click="selectedTask = {{ json_encode($task) }}; editModalOpen = true;" 
                                        type="button" class="text-gray-400 hover:text-brand-gold p-1 text-xs" title="تعديل">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                
                                @if(!Auth::user()->isEmployee())
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-rose-400 p-1 text-xs" title="حذف">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>

                    </div>
                    @empty
                    <div class="py-8 text-center text-gray-500 text-xs">
                        لا توجد مهام في هذا القسم
                    </div>
                    @endforelse
                </div>

            </div>
            @endforeach
        </div>
    </div>

    <!-- 2. TABLE / LIST VIEW -->
    <div x-show="viewMode === 'list'" class="bg-brand-card/90 border border-brand-border rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border text-gray-400 bg-brand-purple/40">
                        <th class="py-3 px-3">الاستعجال</th>
                        <th class="py-3 px-3">المهمة</th>
                        <th class="py-3 px-3">القسم</th>
                        <th class="py-3 px-3">المسؤول</th>
                        <th class="py-3 px-3">العميل / المشروع</th>
                        <th class="py-3 px-3">الحالة</th>
                        <th class="py-3 px-3">موعد التسليم</th>
                        <th class="py-3 px-3">موقع التصوير</th>
                        <th class="py-3 px-3">التسليم</th>
                        <th class="py-3 px-3 text-left">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($tasks as $t)
                    @php $urg = $t->urgency_info; @endphp
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-black border {{ $urg['badge_class'] }}">
                                <span class="w-2 h-2 rounded-full {{ $urg['dot_color'] }}"></span>
                                <span>{{ $urg['color_name'] }}</span>
                            </span>
                        </td>
                        <td class="py-3 px-3 font-bold text-white">{{ $t->title }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $t->department_arabic }}</td>
                        <td class="py-3 px-3 font-bold text-brand-gold">{{ $t->assignee->name ?? '-' }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $t->client->name ?? ($t->project->title ?? '-') }}</td>
                        <td class="py-3 px-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $t->status_badge }}">{{ $t->status_label }}</span>
                        </td>
                        <td class="py-3 px-3 text-gray-300">{{ $t->delivery_deadline ? $t->delivery_deadline->format('Y-m-d') : '-' }}</td>
                        <td class="py-3 px-3">
                            @if($t->location_address)
                            <span class="text-indigo-400 font-bold" title="{{ $t->location_address }}">
                                <i class="fa-solid fa-map-pin ml-1"></i>{{ Str::limit($t->location_address, 20) }}
                            </span>
                            @else
                            <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-3">
                            @if($t->delivery_link)
                            <a href="{{ $t->delivery_link }}" target="_blank" class="text-emerald-400 font-bold hover:underline">
                                <i class="fa-solid fa-link ml-1"></i>معاينة
                            </a>
                            @else
                            <span class="text-gray-500">لم يسلم</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 text-left">
                            <button @click="selectedTask = {{ json_encode($t) }}; editModalOpen = true;" class="p-1 rounded text-gray-400 hover:text-white">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="py-8 text-center text-gray-500">لا توجد مهام مطابقة للبحث.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- CREATE TASK MODAL (مع دعم إحداثيات وموقع بصمة حضور المصور) -->
    <div x-show="createModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="createModalOpen = false" 
             class="w-full max-w-2xl bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">إضافة وتكليف مهمة جديدة لموظف</h3>
                </div>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block font-bold text-gray-300 mb-1">عنوان المهمة <span class="text-red-400">*</span></label>
                        <input type="text" name="title" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: مونتاج 2 فيديو ريلز للمنتجات الجديدة">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الموظف المكلف <span class="text-red-400">*</span></label>
                        <select name="assigned_to" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->job_title }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">القسم التشغيلي <span class="text-red-400">*</span></label>
                        <select name="department" required x-on:change="isPhotoShoot = ($event.target.value === 'video')" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="editing">مونتاج وبوست برودكشن</option>
                            <option value="video">تصوير سينمائي وميداني (جلسة تصوير)</option>
                            <option value="design">تصميم جرافيك وهويات</option>
                            <option value="media_buyer">إعلانات ممولة وميديا باينج</option>
                            <option value="management">إدارة ومتابعة</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">حالة المهمة المبدئية</label>
                        <select name="status" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="not_started">لم تبدأ</option>
                            <option value="in_progress" selected>جاري العمل</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الأولوية</label>
                        <select name="priority" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="low">منخفضة</option>
                            <option value="medium" selected>متوسطة</option>
                            <option value="high">عالية</option>
                            <option value="urgent">عاجل جداً</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">موعد التسليم النهائي (Deadline)</label>
                        <input type="date" name="delivery_deadline" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div>
                        <label class="block font-bold text-amber-300 mb-1">موعد التسليم اليومي (تارجت اليوم)</label>
                        <input type="text" name="daily_delivery_deadline" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: اليوم الساعة 6:00 مساءً">
                    </div>

                    <!-- Client & Project -->
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">العميل</label>
                        <select name="client_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="">بدون عميل (مهمة داخلية)</option>
                            @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المشروع التابع له</label>
                        <select name="project_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="">بدون مشروع محدد</option>
                            @foreach($projects as $p)
                            <option value="{{ $p->id }}">{{ $p->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Photographer Location Fields Checkbox / Section -->
                    <div class="md:col-span-2 p-3.5 rounded-xl bg-indigo-950/40 border border-indigo-500/30 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-camera text-indigo-400"></i>
                                <span class="font-bold text-white">بيانات جلسة التصوير الميدانية وبصمة الحضور (GPS):</span>
                            </div>
                            <span class="text-[11px] text-indigo-300">خاصة بالمصور فقط</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-gray-300 mb-1">عنوان موقع التصوير</label>
                                <input type="text" name="location_address" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: مصر الجديدة - شارع الثورة - برج الأطباء">
                            </div>

                            <div>
                                <label class="block font-bold text-gray-300 mb-1">رابط Google Maps للموقع</label>
                                <input type="url" name="location_map_url" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="https://maps.google.com/?q=...">
                            </div>

                            <div>
                                <label class="block font-bold text-gray-300 mb-1">نصف قطر البصمة المسموح (متر)</label>
                                <input type="number" name="geofence_radius_meters" value="100" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="100">
                            </div>

                            <div>
                                <label class="block font-bold text-gray-300 mb-1">إحداثيات خط العرض (Latitude)</label>
                                <input type="number" step="any" name="location_lat" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: 30.0886">
                            </div>

                            <div>
                                <label class="block font-bold text-gray-300 mb-1">إحداثيات خط الطول (Longitude)</label>
                                <input type="number" step="any" name="location_lng" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="مثال: 31.3325">
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-blue-400 mb-1">رابط الماتريال الخام (Google Drive / Dropbox)</label>
                        <input type="url" name="material_link" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="https://drive.google.com/...">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-gray-300 mb-1">ملاحظات العمل والتوجيهات</label>
                        <textarea name="notes" rows="3" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold" placeholder="اكتب البريف أو تعليمات التصوير أو المونتاج..."></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="createModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-6 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow-md">
                        إنشاء المهمة وإشعار الموظف
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT TASK MODAL -->
    <div x-show="editModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editModalOpen = false" 
             class="w-full max-w-2xl bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تعديل بيانات ومواعيد المهمة</h3>
                </div>
                <button @click="editModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/tasks/' + (selectedTask ? selectedTask.id : '')" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block font-bold text-gray-300 mb-1">عنوان المهمة</label>
                        <input type="text" name="title" required :value="selectedTask ? selectedTask.title : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الموظف المكلف</label>
                        <select name="assigned_to" required 
                                class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" :selected="selectedTask && selectedTask.assigned_to == {{ $emp->id }}">
                                {{ $emp->name }} — {{ $emp->job_title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الحالة</label>
                        <select name="status" required 
                                class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="not_started" :selected="selectedTask && selectedTask.status == 'not_started'">لم تبدأ</option>
                            <option value="in_progress" :selected="selectedTask && selectedTask.status == 'in_progress'">جاري العمل</option>
                            <option value="completed" :selected="selectedTask && selectedTask.status == 'completed'">مكتمل</option>
                            <option value="cancelled" :selected="selectedTask && selectedTask.status == 'cancelled'">إلغاء المشروع</option>
                            <option value="on_leave" :selected="selectedTask && selectedTask.status == 'on_leave'">اجازه</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-amber-300 mb-1">موعد التسليم اليومي</label>
                        <input type="text" name="daily_delivery_deadline" :value="selectedTask ? selectedTask.daily_delivery_deadline : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-300 mb-1">موعد التسليم النهائي</label>
                        <input type="date" name="delivery_deadline" :value="selectedTask ? (selectedTask.delivery_deadline ? selectedTask.delivery_deadline.substring(0,10) : '') : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-indigo-400 mb-1">عنوان موقع التصوير (للمصورين)</label>
                        <input type="text" name="location_address" :value="selectedTask ? selectedTask.location_address : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-blue-400 mb-1">لينك الماتريال الخام</label>
                        <input type="url" name="material_link" :value="selectedTask ? selectedTask.material_link : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-emerald-400 mb-1">لينك التسليم النهائي</label>
                        <input type="url" name="delivery_link" :value="selectedTask ? selectedTask.delivery_link : ''"
                               class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-bold text-gray-300 mb-1">الملاحظات والتوجيهات</label>
                        <textarea name="notes" rows="3" :value="selectedTask ? selectedTask.notes : ''"
                                  class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-6 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow-md">
                        تحديث المهمة
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
