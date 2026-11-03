@extends('layouts.app')

@section('title', 'المشروعات الكبرى')
@section('page_title', 'إدارة المشروعات والحملات التسويقية')
@section('page_subtitle', 'توزيع المشروعات على صناع المحتوى ومتابعة مراحل الإنتاج والتسليم للمدير العام')

@section('content')
<div class="space-y-6 pt-2" x-data="{ createModalOpen: false, deliverModalOpen: false, selectedProject: null }">

    <!-- Top Action & Filter Bar -->
    <div class="bg-brand-card/80 border border-brand-border rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 text-xs">
            <span class="text-gray-400">إجمالي المشروعات: <strong class="text-white">{{ $projects->total() }}</strong></span>

            @if(Auth::user()->isContentCreator())
            <span class="px-2.5 py-1 rounded-full bg-blue-500/20 text-blue-300 font-bold border border-blue-500/30">
                <i class="fa-solid fa-lock ml-1"></i>نظام العزل: تعرض مشروعاتك فقط
            </span>
            @endif

            <!-- Admin filter by Content Creator -->
            @if(Auth::user()->isAdmin() && isset($contentCreators))
            <form method="GET" action="{{ route('projects.index') }}" class="flex items-center gap-2">
                <span class="text-gray-400">تصفية حسب صانع المحتوى:</span>
                <select name="content_creator_id" onchange="this.form.submit()" 
                        class="bg-brand-purple border border-brand-border rounded-xl text-xs text-white px-2.5 py-1.5 focus:outline-none focus:border-brand-gold">
                    <option value="">كافة صناع المحتوى (الكل)</option>
                    @foreach($contentCreators as $cc)
                    <option value="{{ $cc->id }}" {{ request('content_creator_id') == $cc->id ? 'selected' : '' }}>
                        {{ $cc->name }}
                    </option>
                    @endforeach
                </select>
            </form>
            @endif
        </div>

        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow flex items-center justify-center gap-2">
            <i class="fa-solid fa-folder-plus"></i>
            <span>إضافة مشروع جديد</span>
        </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($projects as $project)
        <div class="bg-brand-card/95 border border-brand-border rounded-2xl p-5 hover:border-brand-yellow/40 transition space-y-4 flex flex-col justify-between shadow-lg">
            
            <div class="space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold bg-brand-purple border border-brand-border text-brand-gold">
                        {{ $project->category_arabic }}
                    </span>

                    @if($project->status === 'delivered')
                    <span class="text-[10px] px-2.5 py-0.5 rounded-full font-black bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse">
                        <i class="fa-solid fa-clock ml-1"></i>مسلم للمدير العام
                    </span>
                    @elseif($project->status === 'completed')
                    <span class="text-[10px] px-2.5 py-0.5 rounded-full font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                        <i class="fa-solid fa-check-double ml-1"></i>معتمد ومكتمل
                    </span>
                    @else
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold bg-purple-500/15 text-purple-300 border border-purple-500/30">
                        {{ $project->status_arabic }}
                    </span>
                    @endif
                </div>

                <h3 class="text-base font-bold text-white leading-snug">
                    <a href="{{ route('projects.show', $project->id) }}" class="hover:text-brand-gold transition-colors">
                        {{ $project->title }}
                    </a>
                </h3>

                @if($project->client)
                <div class="text-xs text-brand-gold font-bold flex items-center gap-1.5">
                    <i class="fa-solid fa-building text-[10px]"></i>
                    <span>العميل: {{ $project->client->name }}</span>
                </div>
                @endif

                <!-- Assigned Content Creator -->
                <div class="p-2.5 rounded-xl bg-brand-purple/60 border border-brand-border/50 text-xs flex items-center justify-between">
                    <span class="text-gray-400">صانع المحتوى المسؤول:</span>
                    <span class="font-bold text-white flex items-center gap-1">
                        <i class="fa-solid fa-user-tie text-brand-gold text-[10px]"></i>
                        {{ $project->contentCreator->name ?? 'غير محدد بعد' }}
                    </span>
                </div>

                @if($project->description)
                <p class="text-xs text-gray-400 line-clamp-2">
                    {{ $project->description }}
                </p>
                @endif
            </div>

            <!-- Budget & Tasks Count Bar -->
            <div class="pt-3 border-t border-brand-border/60 space-y-3 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400">الميزانية الكلية:</span>
                    <span class="font-black text-white text-sm">{{ number_format($project->total_budget) }} ج.م</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-400">المهام المسندة للموظفين:</span>
                    <span class="font-bold text-brand-gold">{{ $project->tasks_count }} مهام</span>
                </div>

                <div class="flex items-center justify-between text-[11px] text-gray-400">
                    <span>تاريخ التسليم:</span>
                    <span class="font-bold text-gray-200">{{ $project->deadline ? $project->deadline->format('Y-m-d') : 'مفتوح' }}</span>
                </div>

                <div class="pt-2 border-t border-brand-border/40 flex items-center justify-between">
                    <a href="{{ route('projects.show', $project->id) }}" class="text-brand-gold hover:underline font-bold flex items-center gap-1">
                        <span>تفاصيل وتوزيع المهام</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </a>

                    <!-- If creator and not delivered, show quick deliver to GM button -->
                    @if(Auth::user()->isContentCreator() && $project->content_creator_id === Auth::id() && $project->status !== 'delivered' && $project->status !== 'completed')
                    <button @click="selectedProject = { id: {{ $project->id }}, title: '{{ addslashes($project->title) }}' }; deliverModalOpen = true;"
                            type="button" 
                            class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow transition">
                        تسليم للمدير
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 p-12 text-center text-gray-400 bg-brand-card/50 border border-brand-border rounded-2xl">
            لا توجد مشاريع مضافة بعد.
        </div>
        @endforelse
    </div>

    <div class="pt-2">
        {{ $projects->links() }}
    </div>

    <!-- CREATE PROJECT MODAL -->
    <div x-show="createModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="createModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-folder-plus text-brand-gold"></i>
                    <span>إضافة مشروع جديد وتعيين صانع المحتوى</span>
                </h3>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('projects.store') }}" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم المشروع <span class="text-red-400">*</span></label>
                    <input type="text" name="title" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: حملة إطلاق براند عطور فاخرة">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">العميل <span class="text-red-400">*</span></label>
                        <select name="client_id" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Assign Content Creator -->
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">صانع المحتوى المسؤول</label>
                        @if(Auth::user()->isAdmin())
                        <select name="content_creator_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="">بدون تعيين حالياً</option>
                            @foreach($contentCreators as $cc)
                            <option value="{{ $cc->id }}">{{ $cc->name }} ({{ $cc->job_title }})</option>
                            @endforeach
                        </select>
                        @else
                        <div class="p-2.5 rounded-xl bg-brand-purple text-brand-gold font-bold">
                            {{ Auth::user()->name }} (أنت)
                        </div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تصنيف المشروع</label>
                        <select name="category" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                            <option value="video_production">إنتاج وتصوير فيديو</option>
                            <option value="social_media">إدارة حسابات سوشيال ميديا</option>
                            <option value="media_buying">إعلانات ممولة وميديا باينج</option>
                            <option value="branding">هوية بصرية وبراندينج</option>
                            <option value="full_campaign">حملة تسويقية متكاملة</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الميزانية الكلية (ج.م) <span class="text-red-400">*</span></label>
                        <input type="number" step="0.01" name="total_budget" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="مثال: 25000">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تاريخ البدء</label>
                        <input type="date" name="start_date" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">موعد التسليم النهائي</label>
                        <input type="date" name="deadline" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">حالة المشروع</label>
                    <select name="status" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold">
                        <option value="planning">تخطيط وتحضير</option>
                        <option value="in_progress" selected>جاري العمل</option>
                        <option value="review">مراجعة واعتماد</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">وصف المشروع ومخرجاته</label>
                    <textarea name="description" rows="2" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold" placeholder="تفاصيل المخرجات، عدد الفيديوهات، التصميمات..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="createModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ المشروع</button>
                </div>
            </form>
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

            <form :action="'/projects/' + (selectedProject ? selectedProject.id : '') + '/deliver-to-gm'" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">المشروع المسلم:</label>
                    <div class="p-2.5 rounded-xl bg-brand-purple text-white font-bold" x-text="selectedProject ? selectedProject.title : ''"></div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات وروابط التسليم النهائي للمدير العام <span class="text-red-400">*</span></label>
                    <textarea name="delivery_notes" rows="4" required
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold"
                              placeholder="مثال: تم إنهاء كافة فيديوهات الريلز ومراجعة الألوان ومطابقة المحتوى، الروابط جاهزة للاعتماد النهائي..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="deliverModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black shadow">
                        إرسال التسليم للمدير العام الآن
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
