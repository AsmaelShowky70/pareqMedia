@extends('layouts.app')

@section('title', 'إدارة العملاء والتعاقدات الشهرية CRM')
@section('page_title', 'سجل العملاء وإدارة التعاقدات (CRM)')
@section('page_subtitle', 'متابعة تجديدات التعاقد الشهرية، فلترة مهام كل شهر، وجدولة دفعات وأقساط العملاء')

@section('content')
<div class="space-y-6 pt-2" x-data="{ createModalOpen: false, editModalOpen: false, selectedClient: null }">

    <!-- 1. MONTHLY FILTER BAR & CONTRACT RENEWALS (فلتر المهام والشهور) -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-yellow/40 rounded-2xl p-5 shadow-xl space-y-4">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-brand-yellow animate-ping"></span>
                    <h2 class="text-base font-black text-white">فلتر تجديد التعاقد الشهري والمهام المجدولة</h2>
                </div>
                <p class="text-xs text-gray-300">
                    يعرض لك المهام المحددة لكل عميل في الشهر المختار: 
                    <strong class="text-brand-gold text-sm">{{ $selectedDate->translatedFormat('F Y') }}</strong>
                </p>
            </div>

            <!-- Quick Month Navigators -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('clients.index', ['month' => $prevMonthStr]) }}" 
                   class="px-3 py-1.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-gray-300 border border-brand-border text-xs font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    <span>الشهر السابق</span>
                </a>

                <a href="{{ route('clients.index', ['month' => $currentMonthStr]) }}" 
                   class="px-3.5 py-1.5 rounded-xl {{ $selectedDate->format('Y-m') === $currentMonthStr ? 'bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow' : 'bg-brand-purple hover:bg-brand-hover text-brand-gold border border-brand-yellow/40' }} text-xs font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-calendar-day"></i>
                    <span>الشهر الحالي</span>
                </a>

                <a href="{{ route('clients.index', ['month' => $nextMonthStr]) }}" 
                   class="px-3 py-1.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-gray-300 border border-brand-border text-xs font-bold transition flex items-center gap-1.5">
                    <span>الشهر القادم</span>
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                </a>

                <!-- Custom Month Picker -->
                <form method="GET" action="{{ route('clients.index') }}" class="flex items-center gap-1.5">
                    <input type="month" name="month" value="{{ $selectedDate->format('Y-m') }}" onchange="this.form.submit()" 
                           class="bg-brand-dark border border-brand-border rounded-xl text-xs text-white px-2.5 py-1.5 focus:outline-none focus:border-brand-gold">
                </form>
            </div>
        </div>

        <!-- Total Monthly Retainer Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3 border-t border-brand-border/60 text-xs">
            <div class="p-3 rounded-xl bg-brand-dark/40 border border-brand-border/40 flex items-center justify-between">
                <span class="text-gray-400">إجمالي قيمة التجديد الشهري:</span>
                <span class="text-base font-black text-emerald-400">{{ number_format($totalMonthlyRetainers, 2) }} ج.م</span>
            </div>
            <div class="p-3 rounded-xl bg-brand-dark/40 border border-brand-border/40 flex items-center justify-between">
                <span class="text-gray-400">الشهر المحدد حالياً:</span>
                <span class="text-sm font-black text-white">{{ $selectedDate->translatedFormat('F Y') }}</span>
            </div>
            <div class="p-3 rounded-xl bg-brand-dark/40 border border-brand-border/40 flex items-center justify-between">
                <span class="text-gray-400">إجمالي العملاء المسجلين:</span>
                <span class="text-sm font-black text-brand-gold">{{ $clients->total() }} عميل</span>
            </div>
        </div>
    </div>

    <!-- 2. APPROACHING INSTALLMENTS ALERT (الدفعات المستحقة قريباً) -->
    @if(isset($approachingInstallments) && $approachingInstallments->isNotEmpty())
    <div class="p-4 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-300 space-y-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 font-black text-sm">
                <i class="fa-solid fa-bell-ring animate-bounce text-brand-yellow"></i>
                <span>تنبيه أقساط ودفعات مستحقة قريباً (خلال 3 أيام أو متأخرة):</span>
            </div>
            <span class="text-xs bg-amber-500 text-brand-dark font-black px-2 py-0.5 rounded-full">{{ $approachingInstallments->count() }} دفعات</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5 pt-1 text-xs">
            @foreach($approachingInstallments as $appInst)
            <div class="p-2.5 rounded-xl bg-brand-card/90 border border-brand-border flex items-center justify-between text-white">
                <div>
                    <div class="font-bold truncate max-w-[150px]">{{ $appInst->client->name }}</div>
                    <div class="text-[10px] text-amber-400">{{ $appInst->title }} ({{ $appInst->due_date->format('Y-m-d') }})</div>
                </div>
                <div class="text-left font-black text-emerald-400">{{ number_format($appInst->amount) }} ج.م</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- 3. Top Action Bar -->
    <div class="flex items-center justify-between">
        <div class="text-xs text-gray-400">
            سجل عملاء وكالة بريق (CRM)
        </div>
        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow flex items-center gap-2">
            <i class="fa-solid fa-user-plus"></i>
            <span>إضافة عميل جديد للتعاقد</span>
        </button>
    </div>

    <!-- 4. Clients Grid / Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($clients as $client)
        <div class="bg-brand-card/95 border border-brand-border rounded-2xl p-5 hover:border-brand-yellow/40 transition space-y-4 flex flex-col justify-between shadow-lg">
            
            <div class="space-y-3">
                <!-- Header -->
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h3 class="text-base font-bold text-white">{{ $client->name }}</h3>
                        @if($client->brand_name)
                        <div class="text-xs text-brand-gold font-bold flex items-center gap-1 mt-0.5">
                            <i class="fa-solid fa-tag text-[10px]"></i>
                            <span>{{ $client->brand_name }}</span>
                        </div>
                        @endif
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $client->status === 'active' ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/30' : 'bg-slate-500/15 text-slate-400' }}">
                        {{ $client->status === 'active' ? 'تعاقد نشط' : 'محتمل / متوقف' }}
                    </span>
                </div>

                <!-- Monthly Retainer Highlight -->
                <div class="p-3 rounded-xl bg-brand-purple/60 border border-brand-border/60 flex items-center justify-between text-xs">
                    <span class="text-gray-300 font-bold">قيمة التعاقد الشهري:</span>
                    <span class="text-sm font-black text-emerald-400">{{ number_format($client->monthly_retainer ?? 0, 2) }} ج.م</span>
                </div>

                <!-- Contact & Country -->
                <div class="space-y-1 text-xs text-gray-400">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-earth-americas text-brand-gold w-4"></i>
                        <span>{{ $client->country }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-brand-gold w-4"></i>
                        <a href="tel:{{ $client->phone }}" class="hover:text-white">{{ $client->phone }}</a>
                    </div>
                    @if($client->service_package)
                    <div class="flex items-center gap-2 text-brand-gold font-medium">
                        <i class="fa-solid fa-box text-brand-gold w-4"></i>
                        <span class="truncate">{{ $client->service_package }}</span>
                    </div>
                    @endif
                </div>

                <!-- MONTHLY TASKS SUMMARY (مهام هذا الشهر المختار) -->
                <div class="p-3 rounded-xl bg-brand-dark/50 border border-brand-border/50 text-xs space-y-2">
                    <div class="flex items-center justify-between text-gray-300 font-bold">
                        <span>مهام شهر ({{ $selectedDate->translatedFormat('F') }}):</span>
                        <span class="px-2 py-0.5 rounded bg-brand-yellow/20 text-brand-gold font-black">
                            {{ $client->tasks->count() }} مهام
                        </span>
                    </div>

                    @if($client->tasks->isNotEmpty())
                    <div class="space-y-1.5 pt-1">
                        @foreach($client->tasks->take(3) as $mTask)
                        <div class="flex items-center justify-between text-[11px] text-gray-300 bg-brand-card/80 p-1.5 rounded-lg">
                            <span class="truncate max-w-[170px]">{{ $mTask->title }}</span>
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ $mTask->status === 'completed' ? 'text-emerald-400' : 'text-amber-400' }}">
                                {{ $mTask->status_label }}
                            </span>
                        </div>
                        @endforeach
                        @if($client->tasks->count() > 3)
                        <div class="text-[10px] text-brand-gold text-center pt-0.5">
                            + {{ $client->tasks->count() - 3 }} مهام إضافية في هذا الشهر
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="text-[11px] text-gray-500 italic py-1">
                        لا توجد مهام مجدولة لهذا العميل في {{ $selectedDate->translatedFormat('F Y') }}
                    </div>
                    @endif
                </div>

                <!-- Installments Badge -->
                @php
                    $pendingInst = $client->installments->where('status', 'pending');
                @endphp
                @if($pendingInst->isNotEmpty())
                <div class="text-[11px] text-amber-300 font-bold flex items-center gap-1.5 bg-amber-500/10 p-2 rounded-lg border border-amber-500/20">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>متبقي {{ $pendingInst->count() }} دفعات قادمة بإجمالي {{ number_format($pendingInst->sum('amount')) }} ج.م</span>
                </div>
                @endif
            </div>

            <!-- Card Bottom Actions -->
            <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between text-xs">
                <a href="{{ route('clients.show', ['client' => $client->id, 'month' => $selectedDate->format('Y-m')]) }}" 
                   class="text-brand-gold hover:underline font-black flex items-center gap-1.5">
                    <span>إدارة الدفعات والمهام</span>
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                </a>

                <div class="flex items-center gap-1.5">
                    <button @click="selectedClient = {{ json_encode($client) }}; editModalOpen = true;" 
                            class="p-2 rounded-lg bg-brand-purple hover:bg-brand-hover text-gray-300 hover:text-white" title="تعديل العميل">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 p-12 text-center text-gray-400 bg-brand-card/50 border border-brand-border rounded-2xl">
            لا يوجد عملاء مسجلين حالياً.
        </div>
        @endforelse
    </div>

    <div class="pt-2">
        {{ $clients->links() }}
    </div>

    <!-- CREATE CLIENT MODAL -->
    <div x-show="createModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="createModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">إضافة عميل جديد وتحديد التعاقد الشهري</h3>
                </div>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('clients.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل / الشركة <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: د. أحمد يوسف">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم البراند / النشاط</label>
                        <input type="text" name="brand_name" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: عيادات النخبة">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم الهاتف / واتساب <span class="text-red-400">*</span></label>
                        <input type="text" name="phone" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="+2010...">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة</label>
                        <select name="country" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="مصر">مصر</option>
                            <option value="السعودية">المملكة العربية السعودية</option>
                            <option value="الإمارات">الإمارات</option>
                            <option value="الأردن">الأردن</option>
                            <option value="عمان">سلطنة عمان</option>
                            <option value="ليبيا">ليبيا</option>
                            <option value="قطر">قطر</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">قيمة التجديد الشهري (Retainer) ج.م</label>
                        <input type="number" step="0.01" name="monthly_retainer" value="0" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: 12000">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">باقة الخدمة المتفق عليها</label>
                        <input type="text" name="service_package" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: باقة 12 فيديو ريلز + إعلانات">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">حالة التعاقد</label>
                    <select name="status" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                        <option value="active">تعاقد نشط</option>
                        <option value="lead">عميل محتمل (Lead)</option>
                        <option value="paused">متوقف مؤقتاً</option>
                        <option value="completed">منتهي التعاقد</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات التعاقد والتجديد</label>
                    <textarea name="notes" rows="2" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="تفاصيل التعاقد ومواعيد التجديد الشهرية..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="createModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ العميل</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT CLIENT MODAL -->
    <div x-show="editModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-pen text-brand-gold text-lg"></i>
                    <h3 class="text-base font-bold text-white">تعديل بيانات العميل</h3>
                </div>
                <button @click="editModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/clients/' + (selectedClient ? selectedClient.id : '')" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل</label>
                        <input type="text" name="name" required :value="selectedClient ? selectedClient.name : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم البراند</label>
                        <input type="text" name="brand_name" :value="selectedClient ? selectedClient.brand_name : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم الهاتف</label>
                        <input type="text" name="phone" required :value="selectedClient ? selectedClient.phone : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة</label>
                        <input type="text" name="country" required :value="selectedClient ? selectedClient.country : 'مصر'" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">قيمة التجديد الشهري (ج.م)</label>
                        <input type="number" step="0.01" name="monthly_retainer" :value="selectedClient ? selectedClient.monthly_retainer : 0" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">حالة التعاقد</label>
                        <select name="status" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="active">تعاقد نشط</option>
                            <option value="lead">عميل محتمل</option>
                            <option value="paused">متوقف</option>
                            <option value="completed">منتهي</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
