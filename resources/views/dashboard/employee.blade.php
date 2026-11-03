@extends('layouts.app')

@section('title', 'مساحة العمل الشخصية للموظف')
@section('page_title')
مرحباً بك، {{ $user->name }} 👋
@endsection
@section('page_subtitle', 'جدول مهامك وتفاصيل مشاريعك الخاصة بقسم ' . $user->department_name_arabic)

@section('content')
<div class="space-y-6 pt-2" x-data="employeeDashboard()">

    <!-- 1. Daily Quota & Status Banner -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-6 relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-yellow/15 text-brand-gold text-xs font-bold mb-1">
                    <i class="fa-solid fa-bullseye"></i>
                    <span>التارجت واليومية المعتمدة لك:</span>
                </div>
                <h2 class="text-xl font-black text-white">{{ $user->daily_quota ?? 'متابعة وإنجاز المهام المسندة يومياً' }}</h2>
                <p class="text-xs text-gray-400">
                    قسم: <span class="text-gray-200 font-bold">{{ $user->department_name_arabic }}</span> | 
                    المسمى: <span class="text-gray-200 font-bold">{{ $user->job_title }}</span>
                </p>
            </div>

            <!-- Stats & Portfolio button -->
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('my-portfolio') }}" 
                   class="px-4 py-2.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-brand-gold text-xs font-bold border border-brand-yellow/40 transition shadow flex items-center gap-2">
                    <i class="fa-solid fa-briefcase text-sm"></i>
                    <span>معرض إنجازاتي وسابقة أعمالي</span>
                </a>

                <div class="flex items-center gap-2">
                    <div class="px-3.5 py-2 rounded-xl bg-amber-500/10 border border-amber-500/20 text-center">
                        <div class="text-[11px] text-amber-300 font-bold">قيد العمل</div>
                        <div class="text-lg font-black text-amber-400">{{ $inProgressCount }}</div>
                    </div>
                    <div class="px-3.5 py-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-center">
                        <div class="text-[11px] text-emerald-300 font-bold">أتممت تسليمه</div>
                        <div class="text-lg font-black text-emerald-400">{{ $completedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. PHOTOGRAPHER FIELD TASKS & GEOFENCE ATTENDANCE (إذا وجدت مهام تصوير ميدانية) -->
    @if($photographyTasks->isNotEmpty())
    <div class="bg-gradient-to-br from-indigo-950/40 via-brand-card to-purple-950/30 border-2 border-indigo-500/40 rounded-2xl p-6 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-white">مهام التصوير الميداني وبصمة الحضور بالموقع (Geofence GPS)</h2>
                    <p class="text-xs text-gray-400">تتبع خط سير جلسة التصوير من استلام المهمة للوصول للموقع وتسليم الماتريال</p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                {{ $photographyTasks->count() }} موقع تصوير
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
            @foreach($photographyTasks as $pTask)
            <div class="p-5 rounded-2xl bg-brand-purple/70 border border-brand-border space-y-4 flex flex-col justify-between">
                <div class="space-y-2.5">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $pTask->status_badge }}">
                                {{ $pTask->status_label }}
                            </span>
                            <h3 class="text-base font-bold text-white mt-1">{{ $pTask->title }}</h3>
                            @if($pTask->client)
                            <div class="text-xs text-brand-gold font-bold">العميل: {{ $pTask->client->name }}</div>
                            @endif
                        </div>

                        <!-- Current Attendance Status Badge -->
                        <span class="px-2.5 py-1 rounded-xl text-xs font-black {{ $pTask->attendance_status === 'checked_in' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : ($pTask->attendance_status === 'on_the_way' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse' : 'bg-slate-700 text-slate-300') }}">
                            <i class="fa-solid {{ $pTask->attendance_status === 'checked_in' ? 'fa-circle-check' : ($pTask->attendance_status === 'on_the_way' ? 'fa-person-walking' : 'fa-clock') }} ml-1"></i>
                            {{ $pTask->attendance_status_arabic }}
                        </span>
                    </div>

                    @if($pTask->location_address)
                    <div class="p-3 rounded-xl bg-brand-card/90 border border-brand-border/60 text-xs space-y-1.5">
                        <div class="flex items-center gap-2 text-gray-300">
                            <i class="fa-solid fa-map-location-dot text-indigo-400"></i>
                            <span class="font-bold text-white">موقع التصوير:</span>
                            <span>{{ $pTask->location_address }}</span>
                        </div>
                        @if($pTask->location_map_url)
                        <div>
                            <a href="{{ $pTask->location_map_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 font-bold underline flex items-center gap-1">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                <span>فتح الموقع على خرائط Google Maps</span>
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($pTask->photographer_arrival_distance_meters !== null)
                    <div class="text-[11px] text-emerald-400 font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>تم توثيق الحضور بنجاح على مسافة {{ $pTask->photographer_arrival_distance_meters }} متر من الموقع</span>
                    </div>
                    @endif
                </div>

                <!-- Photographer Action Buttons -->
                <div class="pt-3 border-t border-brand-border/60 flex flex-wrap items-center gap-2">
                    @if($pTask->attendance_status === 'none' || !$pTask->attendance_status)
                    <button @click="startMoving({{ $pTask->id }})" 
                            type="button" 
                            :disabled="loadingId === {{ $pTask->id }}"
                            class="flex-1 py-2 px-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow transition flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-person-walking"></i>
                        <span>استلام المهمة وبدء التحرك</span>
                    </button>
                    @elseif($pTask->attendance_status === 'on_the_way')
                    <button @click="checkinGeofence({{ $pTask->id }})" 
                            type="button" 
                            :disabled="loadingId === {{ $pTask->id }}"
                            class="flex-1 py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition flex items-center justify-center gap-1.5 animate-pulse">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <span>تسجيل بصمة الحضور بالموقع (GPS)</span>
                    </button>
                    @elseif($pTask->attendance_status === 'checked_in')
                    <button @click="openDeliverModal({{ $pTask->id }}, '{{ addslashes($pTask->title) }}', '{{ addslashes($pTask->delivery_link ?? '') }}')" 
                            type="button" 
                            class="flex-1 py-2 px-3 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow transition flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-camera-retro"></i>
                        <span>إنهاء التصوير وتسليم الماتريال</span>
                    </button>
                    @else
                    <div class="w-full text-center text-xs text-emerald-400 font-bold py-1">
                        <i class="fa-solid fa-circle-check ml-1"></i>تم إنجاز جلسة التصوير وتسليم الماتريال
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- 3. COLOR-CODED TASK CARDS (كروت المهام الملونة حسب قرب موعد التسليم) -->
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-palette text-brand-gold"></i>
                    <span>كروت المهام وتوقيتات التسليم (الاستعجال بالألوان)</span>
                </h2>
                <p class="text-xs text-gray-400">مقسمة بالألوان: الأحمر (عاجل جداً/اليوم) - الأصفر (يقترب 2-3 أيام) - الأخضر (متبقي وقت كافي)</p>
            </div>

            <!-- Color Key Guide -->
            <div class="flex items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-rose-500/20 text-rose-300 border border-rose-500/40 font-bold">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span> أحمر: عاجل جداً
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-500/20 text-amber-300 border border-amber-500/40 font-bold">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span> أصفر: يقترب
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span> أخضر: متسع
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($myTasks as $task)
            @php
                $urgency = $task->urgency_info;
            @endphp
            <div class="rounded-2xl p-5 border-2 transition duration-200 flex flex-col justify-between space-y-4 {{ $urgency['border_class'] }} {{ $urgency['bg_class'] }}">
                <div class="space-y-3">
                    
                    <!-- Card Top Header -->
                    <div class="flex items-start justify-between gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black border {{ $urgency['badge_class'] }}">
                            <span class="w-2 h-2 rounded-full {{ $urgency['dot_color'] }}"></span>
                            <span>{{ $urgency['label'] }}</span>
                        </span>

                        <span class="text-xs px-2 py-0.5 rounded-full font-bold border {{ $task->status_badge }}">
                            {{ $task->status_label }}
                        </span>
                    </div>

                    <!-- Task Title & Client -->
                    <div>
                        <h3 class="text-base font-bold text-white">{{ $task->title }}</h3>
                        <div class="flex items-center gap-2 text-xs text-brand-gold font-bold mt-1">
                            <i class="fa-solid fa-briefcase text-[10px]"></i>
                            <span>{{ $task->client->name ?? 'مهمة داخلية' }}</span>
                            @if($task->project)
                            <span class="text-gray-400">| {{ $task->project->title }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Dates Info -->
                    <div class="p-3 rounded-xl bg-brand-dark/40 border border-brand-border/40 text-xs space-y-1">
                        <div class="flex items-center justify-between text-gray-300">
                            <span>موعد التسليم النهائي:</span>
                            <span class="font-bold text-white">{{ $task->delivery_deadline ? $task->delivery_deadline->format('Y-m-d') : 'مفتوح' }}</span>
                        </div>
                        @if($task->daily_delivery_deadline)
                        <div class="flex items-center justify-between text-amber-300">
                            <span>تارجت اليوم:</span>
                            <span class="font-bold">{{ $task->daily_delivery_deadline }}</span>
                        </div>
                        @endif
                    </div>

                    @if($task->notes)
                    <div class="p-2.5 rounded-xl bg-brand-purple/40 text-xs text-gray-300">
                        <span class="font-bold text-white">ملاحظات: </span>{{ Str::limit($task->notes, 100) }}
                    </div>
                    @endif
                </div>

                <!-- Action Footer & Links -->
                <div class="pt-3 border-t border-brand-border/50 flex items-center justify-between gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        @if($task->material_link)
                        <a href="{{ $task->material_link }}" target="_blank" class="p-2 rounded-lg bg-blue-500/20 text-blue-300 hover:bg-blue-500/30 transition font-bold" title="تحميل الماتريال الخام">
                            <i class="fa-brands fa-google-drive"></i>
                        </a>
                        @endif

                        @if($task->delivery_link)
                        <a href="{{ $task->delivery_link }}" target="_blank" class="p-2 rounded-lg bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30 transition font-bold" title="معاينة تسليمك">
                            <i class="fa-solid fa-link"></i>
                        </a>
                        @endif
                    </div>

                    <button @click="openDeliverModal({{ $task->id }}, '{{ addslashes($task->title) }}', '{{ addslashes($task->delivery_link ?? '') }}')"
                            type="button" 
                            class="px-4 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs transition flex items-center gap-1.5 shadow">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>{{ $task->delivery_link ? 'تعديل التسليم' : 'تسليم العمل الآن' }}</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-3 p-12 text-center text-gray-400 bg-brand-card/50 border border-brand-border rounded-2xl">
                رائع! ليس لديك أي مهام معلقة في الوقت الحالي.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 4. Deliver Work Modal -->
    <div x-show="deliverModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="deliverModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تسليم وإنجاز المهمة</h3>
                </div>
                <button @click="deliverModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/tasks/' + (activeTask ? activeTask.id : '') + '/deliver'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">المهمة:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple/70 text-xs text-white font-bold" x-text="activeTask ? activeTask.title : ''"></div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">رابط التسليم النهائي (Google Drive / Frame.io / Dropbox / WeTransfer) <span class="text-red-400">*</span></label>
                    <input type="url" name="delivery_link" required :value="activeTask ? activeTask.delivery_link : ''"
                           class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                           placeholder="https://drive.google.com/drive/folders/...">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">ملاحظات للمراجع وصانع المحتوى (اختياري)</label>
                    <textarea name="notes" rows="3" 
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"
                              placeholder="مثال: تم إنهاء النسخة كاملة بدقة 4K وتطبيق تعديلات الألوان والخطوط..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="deliverModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-xs text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow">
                        حفظ التسليم واعتماد الاكتمال
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function employeeDashboard() {
        return {
            deliverModalOpen: false,
            activeTask: null,
            loadingId: null,

            openDeliverModal(id, title, link) {
                this.activeTask = { id: id, title: title, delivery_link: link };
                this.deliverModalOpen = true;
            },

            startMoving(taskId) {
                this.loadingId = taskId;
                if (!navigator.geolocation) {
                    alert('خاصية تحديد الموقع الجغرافي غير مفعلة في جهازك.');
                    this.loadingId = null;
                    return;
                }

                navigator.geolocation.getCurrentPosition((pos) => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;

                    fetch('/tasks/' + taskId + '/photographer/accept', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ lat: lat, lng: lng })
                    })
                    .then(r => r.json())
                    .then(data => {
                        this.loadingId = null;
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message || 'حدث خطأ');
                        }
                    })
                    .catch(err => {
                        this.loadingId = null;
                        alert('تعذر إرسال الإشعار. تم التحديث محلياً.');
                        window.location.reload();
                    });
                }, (err) => {
                    this.loadingId = null;
                    alert('يرجى السماح بالوصول للموقع الجغرافي (GPS) لتأكيد بدء التحرك.');
                }, { enableHighAccuracy: true });
            },

            checkinGeofence(taskId) {
                this.loadingId = taskId;
                if (!navigator.geolocation) {
                    alert('خاصية تحديد الموقع الجغرافي غير مفعلة.');
                    this.loadingId = null;
                    return;
                }

                navigator.geolocation.getCurrentPosition((pos) => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;

                    fetch('/tasks/' + taskId + '/photographer/checkin', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ lat: lat, lng: lng })
                    })
                    .then(r => r.json())
                    .then(data => {
                        this.loadingId = null;
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(err => {
                        this.loadingId = null;
                        alert('حدث خطأ في الاتصال بالخادم.');
                    });
                }, (err) => {
                    this.loadingId = null;
                    alert('يرجى تفعيل الـ GPS بدقة عالية لتسجيل بصمة الحضور.');
                }, { enableHighAccuracy: true });
            }
        }
    }
</script>
@endpush
@endsection
