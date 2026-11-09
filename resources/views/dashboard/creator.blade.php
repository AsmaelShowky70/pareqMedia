@extends('layouts.app')

@section('title', 'لوحة تحكم صانع المحتوى')
@section('page_title')
مرحباً صانع المحتوى، {{ $user->name }} 🎬
@endsection
@section('page_subtitle', 'إدارة مشاريعك وتوزيع المهام على فريق العمل ومتابعة التنفيذ والتسليم للمدير العام')

@section('content')
<div class="space-y-6 pt-2" x-data="{ deliverModalOpen: false, selectedProject: null, taskModalOpen: false }">

    <!-- Top Stats Banner -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-6 shadow-xl relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-bold mb-1">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>مساحة العمل الخاصة بك (فريقك ومشروعاتك المعزولة)</span>
                </div>
                <h2 class="text-xl font-black text-white">إدارة المشروعات والمهام التشغيلية</h2>
                <p class="text-xs text-gray-400">تستلم المشروعات من المدير العام، توزع المهام على الموظفين، وتعتمد التسليمات قبل تسليمها النهائي للإدارة العامة.</p>
            </div>

            <!-- Stats pills -->
            <div class="grid grid-cols-3 gap-2 sm:gap-3 w-full md:w-auto">
                <div class="px-2.5 sm:px-4 py-2 sm:py-3 rounded-xl bg-blue-500/10 border border-blue-500/20 text-center">
                    <div class="text-[10px] sm:text-[11px] text-blue-300 font-bold">مشاريع جارية</div>
                    <div class="text-xl sm:text-2xl font-black text-blue-400">{{ $activeProjectsCount }}</div>
                </div>
                <div class="px-2.5 sm:px-4 py-2 sm:py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-center">
                    <div class="text-[10px] sm:text-[11px] text-amber-300 font-bold">سلمت للمدير</div>
                    <div class="text-xl sm:text-2xl font-black text-amber-400">{{ $deliveredProjectsCount }}</div>
                </div>
                <div class="px-2.5 sm:px-4 py-2 sm:py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-center">
                    <div class="text-[10px] sm:text-[11px] text-emerald-300 font-bold">معتمدة</div>
                    <div class="text-xl sm:text-2xl font-black text-emerald-400">{{ $completedProjectsCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/70 border border-brand-border p-3.5 sm:p-4 rounded-2xl">
        <div class="text-xs text-gray-300 font-bold flex items-center gap-2">
            <i class="fa-solid fa-bolt text-brand-yellow"></i>
            <span>إجراءات سريعة لفريق عملك:</span>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <a href="{{ route('content-plans.index') }}" 
               class="px-4 py-2 rounded-xl bg-indigo-500/15 hover:bg-indigo-500/25 text-indigo-300 font-bold text-xs border border-indigo-500/30 transition flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-brand-gold"></i>
                <span>خطة وجدول النشر الشهري</span>
                @if(isset($todayContentPlans) && $todayContentPlans->count() > 0)
                    <span class="px-1.5 py-0.5 rounded-full bg-amber-500 text-brand-dark text-[10px] font-black">{{ $todayContentPlans->count() }} اليوم</span>
                @endif
            </a>
            <a href="{{ route('tasks.index') }}" 
               class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>تكليف موظف بمهمة جديدة</span>
            </a>
            <a href="{{ route('projects.index') }}" 
               class="px-4 py-2 rounded-xl bg-brand-purple hover:bg-brand-hover text-white font-bold text-xs border border-brand-border transition flex items-center gap-2">
                <i class="fa-solid fa-folder-tree"></i>
                <span>عرض قائمة مشاريعك</span>
            </a>
        </div>
    </div>

    <!-- 1. My Assigned Projects (المشاريع المسندة لصانع المحتوى) -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-folder-tree text-brand-gold"></i>
                <span>المشاريع المكلف بها من المدير العام ({{ $myProjects->count() }})</span>
            </h3>
            <span class="text-xs text-gray-400">مشاريعك محمية ومعزولة تماماً عن باقي صناع المحتوى</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($myProjects as $project)
            <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 hover:border-brand-yellow/40 transition flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/15 text-blue-300 border border-blue-500/30">
                            {{ $project->category_arabic }}
                        </span>

                        @if($project->status === 'delivered')
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse">
                            <i class="fa-solid fa-clock ml-1"></i>بانتظار اعتماد المدير العام
                        </span>
                        @elseif($project->status === 'completed')
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                            <i class="fa-solid fa-check-double ml-1"></i>معتمد ومكتمل
                        </span>
                        @else
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/40">
                            {{ $project->status_arabic }}
                        </span>
                        @endif
                    </div>

                    <div>
                        <h4 class="text-base font-bold text-white">{{ $project->title }}</h4>
                        <div class="text-xs text-brand-gold font-bold mt-1">العميل: {{ $project->client->name ?? 'غير محدد' }}</div>
                    </div>

                    <div class="p-3 rounded-xl bg-brand-purple/50 border border-brand-border/40 text-xs space-y-2">
                        <div class="flex items-center justify-between text-gray-300">
                            <span>مهام المشروع:</span>
                            <span class="font-bold text-white">{{ $project->tasks->count() }} مهام</span>
                        </div>
                        <div class="flex items-center justify-between text-gray-300">
                            <span>المهام المنجزة:</span>
                            <span class="font-bold text-emerald-400">{{ $project->tasks->where('status', 'completed')->count() }} مكتمل</span>
                        </div>
                        <div class="flex items-center justify-between text-gray-300">
                            <span>الموعد النهائي:</span>
                            <span class="font-bold text-white">{{ $project->deadline ? $project->deadline->format('Y-m-d') : 'مفتوح' }}</span>
                        </div>
                    </div>

                    @if($project->gm_approval_status === 'revisions_needed')
                    <div class="p-3 rounded-xl bg-rose-500/15 border border-rose-500/30 text-xs text-rose-300">
                        <span class="font-bold">ملاحظات المدير العام: </span>{{ $project->delivery_notes }}
                    </div>
                    @endif
                </div>

                <!-- Footer Action: Deliver to GM -->
                <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between gap-2">
                    <a href="{{ route('projects.show', $project->id) }}" class="text-xs text-brand-gold font-bold hover:underline">
                        عرض وتوزيع المهام ←
                    </a>

                    @if($project->status !== 'delivered' && $project->status !== 'completed')
                    <button @click="selectedProject = { id: {{ $project->id }}, title: '{{ addslashes($project->title) }}' }; deliverModalOpen = true;" 
                            type="button" 
                            class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition flex items-center gap-1.5">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>تسليم للمدير العام</span>
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-3 p-12 text-center text-gray-400 bg-brand-card/50 border border-brand-border rounded-2xl">
                لا توجد مشاريع مسندة إليك حالياً من المدير العام.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 2. Photographer Field Monitoring (تحركات ومتابعة المصور) -->
    @if($photographerTasks->isNotEmpty())
    <div class="bg-gradient-to-br from-indigo-950/30 via-brand-card to-brand-card border border-indigo-500/30 rounded-2xl p-5 space-y-4 shadow-lg">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-camera text-indigo-400"></i>
                <span>متابعة المصور الميداني لمشاريعك (بصمة الحضور والتحركات)</span>
            </h3>
            <span class="text-xs text-indigo-300 font-bold">{{ $photographerTasks->count() }} مهمة تصوير</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($photographerTasks as $pt)
            <div class="p-4 rounded-xl bg-brand-purple/60 border border-brand-border space-y-2.5 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-white text-sm">{{ $pt->title }}</span>
                    <span class="px-2.5 py-1 rounded-lg font-black {{ $pt->attendance_status === 'checked_in' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : ($pt->attendance_status === 'on_the_way' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse' : 'bg-slate-700 text-slate-300') }}">
                        {{ $pt->attendance_status_arabic }}
                    </span>
                </div>
                <div class="text-gray-300 flex items-center justify-between">
                    <span>المصور: <strong class="text-white">{{ $pt->assignee->name ?? 'غير محدد' }}</strong></span>
                    <span>الموقع: {{ $pt->location_address ?? 'غير محدد' }}</span>
                </div>
                @if($pt->photographer_arrival_distance_meters !== null)
                <div class="text-emerald-400 font-bold">
                    ✓ سجل بصمة الحضور في الموقع بنجاح (المسافة: {{ $pt->photographer_arrival_distance_meters }} متر)
                </div>
                @endif
                @if($pt->delivery_link)
                <div class="pt-2 border-t border-brand-border/40">
                    <a href="{{ $pt->delivery_link }}" target="_blank" class="text-emerald-400 hover:underline font-bold flex items-center gap-1">
                        <i class="fa-solid fa-link"></i>
                        <span>معاينة ماتريال التصوير المسلم</span>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- 3. Team Tasks Table (مهام فريقك ومتابعة إنجازها) -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-list-check text-brand-gold"></i>
                <span>مهام الموظفين التابعة لمشاريعك ({{ $creatorTasks->count() }})</span>
            </h3>
            <a href="{{ route('tasks.index') }}" class="text-xs text-brand-gold hover:underline font-bold">عرض كانبان كامل</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border/60 text-gray-400">
                        <th class="py-3 px-3">المهمة</th>
                        <th class="py-3 px-3">الموظف المسؤول</th>
                        <th class="py-3 px-3">المشروع / العميل</th>
                        <th class="py-3 px-3">حالة التنفيذ</th>
                        <th class="py-3 px-3">موعد التسليم</th>
                        <th class="py-3 px-3">رابط التسليم</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($creatorTasks as $task)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3 px-3 font-bold text-white">{{ $task->title }}</td>
                        <td class="py-3 px-3 font-bold text-brand-gold">{{ $task->assignee->name ?? '-' }}</td>
                        <td class="py-3 px-3 text-gray-300">{{ $task->client->name ?? ($task->project->title ?? '-') }}</td>
                        <td class="py-3 px-3">
                            <span class="px-2 py-0.5 rounded-full font-bold border text-[11px] {{ $task->status_badge }}">
                                {{ $task->status_label }}
                            </span>
                        </td>
                        <td class="py-3 px-3 text-gray-300">{{ $task->delivery_deadline ? $task->delivery_deadline->format('Y-m-d') : '-' }}</td>
                        <td class="py-3 px-3">
                            @if($task->delivery_link)
                            <a href="{{ $task->delivery_link }}" target="_blank" class="text-emerald-400 font-bold hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>معاينة الرابط</span>
                            </a>
                            @else
                            <span class="text-gray-500">قيد العمل</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">لم تقم بتكليف مهام لموظفين بعد. اضغط على "تكليف موظف بمهمة جديدة" للبدء.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- DELIVER TO GM MODAL -->
    <div x-show="deliverModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="deliverModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تسليم المشروع للمدير العام للاعتماد</h3>
                </div>
                <button @click="deliverModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/projects/' + (selectedProject ? selectedProject.id : '') + '/deliver-to-gm'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">المشروع المسلم:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple/70 text-xs text-white font-bold" x-text="selectedProject ? selectedProject.title : ''"></div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">ملاحظات وروابط التسليم النهائي للمدير العام <span class="text-red-400">*</span></label>
                    <textarea name="delivery_notes" rows="4" required
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                              placeholder="مثال: تم إنهاء كافة فيديوهات الريلز ومراجعة الألوان ومطابقة المحتوى، روابط التسليم جاهزة للاعتماد النهائي..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="deliverModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-xs text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow">
                        إرسال التسليم للمدير العام الآن
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

