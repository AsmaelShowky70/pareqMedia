@extends('layouts.app')

@section('title', $project->title)
@section('page_title', $project->title)
@section('page_subtitle', 'متابعة سير المشروع، حساب الأرباح، وتوزيع المهام على فريق العمل')

@section('content')
<div class="space-y-6 pt-2" x-data="{ deliverModalOpen: false, gmDecisionModal: false, decisionType: 'approved' }">

    <!-- Top Project Card -->
    <div class="bg-gradient-to-r from-brand-card via-brand-purple to-brand-card border border-brand-border rounded-2xl p-6 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-brand-purple border border-brand-border text-brand-gold">
                        {{ $project->category_arabic }}
                    </span>

                    @if($project->status === 'delivered')
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-black bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse">
                        <i class="fa-solid fa-clock ml-1"></i>مسلم للمدير العام للاعتماد
                    </span>
                    @elseif($project->status === 'completed')
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                        <i class="fa-solid fa-check-double ml-1"></i>معتمد ومكتمل
                    </span>
                    @else
                    <span class="text-xs px-2.5 py-0.5 rounded-full font-bold bg-purple-500/20 text-purple-300 border border-purple-500/40">
                        {{ $project->status_arabic }}
                    </span>
                    @endif
                </div>

                <h2 class="text-2xl font-black text-white">{{ $project->title }}</h2>

                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-300 pt-1">
                    @if($project->client)
                    <span class="text-brand-gold font-bold">
                        <i class="fa-solid fa-building ml-1"></i>العميل: <a href="{{ route('clients.show', $project->client->id) }}" class="underline">{{ $project->client->name }}</a>
                    </span>
                    @endif

                    <span class="font-bold text-white">
                        <i class="fa-solid fa-user-tie text-brand-gold ml-1"></i>صانع المحتوى المسؤول: <strong class="text-brand-gold">{{ $project->contentCreator->name ?? 'غير محدد' }}</strong>
                    </span>
                </div>

                @if($project->description)
                <p class="text-xs text-gray-400 max-w-2xl">{{ $project->description }}</p>
                @endif
            </div>

            <!-- Workflow Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-2">
                
                <!-- Content Creator: Deliver to GM Button -->
                @if((Auth::user()->isContentCreator() && $project->content_creator_id === Auth::id()) && $project->status !== 'delivered' && $project->status !== 'completed')
                <button @click="deliverModalOpen = true" type="button" 
                        class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>تسليم المشروع للمدير العام</span>
                </button>
                @endif

                <!-- General Manager (Admin): Decision Buttons if Delivered -->
                @if(Auth::user()->isAdmin() && $project->status === 'delivered')
                <div class="flex items-center gap-2">
                    <button @click="decisionType = 'approved'; gmDecisionModal = true;" type="button" 
                            class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs shadow transition flex items-center gap-1.5">
                        <i class="fa-solid fa-check-double"></i>
                        <span>اعتماد المشروع</span>
                    </button>
                    <button @click="decisionType = 'revisions_needed'; gmDecisionModal = true;" type="button" 
                            class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs shadow transition flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>طلب تعديلات</span>
                    </button>
                </div>
                @endif
            </div>
        </div>

        @if($project->delivery_notes)
        <div class="mt-4 p-3.5 rounded-xl bg-brand-dark/60 border border-brand-border/60 text-xs space-y-1">
            <div class="font-bold text-brand-gold flex items-center gap-1.5">
                <i class="fa-solid fa-comment-dots"></i>
                <span>سجل ملاحظات التسليم والاعتماد:</span>
            </div>
            <div class="text-gray-300 whitespace-pre-line">{{ $project->delivery_notes }}</div>
        </div>
        @endif
    </div>

    <!-- Financial Breakdown for this Project -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">الميزانية المتفق عليها</div>
            <div class="text-xl font-black text-white mt-1">{{ number_format($project->total_budget, 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">المبالغ المحصلة (الإيراد)</div>
            <div class="text-xl font-black text-emerald-400 mt-1">{{ number_format($project->payments->sum('amount'), 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">المصروفات والتكاليف</div>
            <div class="text-xl font-black text-rose-400 mt-1">{{ number_format($project->expenses->sum('amount'), 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-gradient-to-br from-brand-card to-emerald-950/30 border border-emerald-500/30">
            <div class="text-xs text-emerald-300 font-bold">هامش الربح الصافي</div>
            <div class="text-xl font-black text-emerald-400 mt-1">
                {{ number_format($project->net_profit, 2) }} ج.م 
                <span class="text-xs text-brand-gold">({{ $project->profit_margin_percentage }}%)</span>
            </div>
        </div>
    </div>

    <!-- Project Tasks List (مهام المشروع وتوزيعها) -->
    <div class="bg-brand-card border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-list-check text-brand-gold"></i>
                <span>مهام وسير عمل هذا المشروع ({{ $project->tasks->count() }})</span>
            </h3>

            <a href="{{ route('tasks.index') }}" class="px-3.5 py-1.5 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black text-xs shadow flex items-center gap-1.5">
                <i class="fa-solid fa-plus"></i>
                <span>إضافة مهمة جديدة</span>
            </a>
        </div>

        <div class="space-y-3">
            @forelse($project->tasks as $t)
            <div class="p-4 rounded-xl bg-brand-purple/60 border border-brand-border text-xs space-y-2">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $t->status_badge }}">{{ $t->status_label }}</span>
                            <span class="text-gray-400">{{ $t->department_arabic }}</span>
                        </div>
                        <h4 class="font-bold text-white text-sm">{{ $t->title }}</h4>
                    </div>

                    <div class="text-left text-gray-300">
                        <div>المسؤول: <strong class="text-brand-gold">{{ $t->assignee->name ?? 'غير محدد' }}</strong></div>
                        <div class="text-amber-300 font-semibold">{{ $t->daily_delivery_deadline ?? 'تسليم حسب الجدول' }}</div>
                    </div>
                </div>

                <div class="pt-2 border-t border-brand-border/40 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-4">
                        @if($t->material_link)
                        <a href="{{ $t->material_link }}" target="_blank" class="text-blue-400 hover:underline flex items-center gap-1">
                            <i class="fa-brands fa-google-drive"></i>
                            <span>الماتريال الخام</span>
                        </a>
                        @endif

                        @if($t->delivery_link)
                        <a href="{{ $t->delivery_link }}" target="_blank" class="text-emerald-400 hover:underline font-bold flex items-center gap-1">
                            <i class="fa-solid fa-link"></i>
                            <span>رابط التسليم النهائي</span>
                        </a>
                        @endif
                    </div>

                    @if($t->notes)
                    <span class="text-gray-400 truncate max-w-xs">{{ $t->notes }}</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500 text-xs">لا توجد مهام منشأة لهذا المشروع بعد.</div>
            @endforelse
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
                    <h3 class="text-base font-bold text-white">تسليم المشروع للمدير العام للاعتماد النهائي</h3>
                </div>
                <button @click="deliverModalOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('projects.deliver-to-gm', $project->id) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات وروابط التسليم النهائي للمدير العام <span class="text-red-400">*</span></label>
                    <textarea name="delivery_notes" rows="4" required
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold"
                              placeholder="اكتب للمدير العام تفاصيل ما تم إنجازه، روابط التسليم، وأية ملاحظات للاعتماد..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="deliverModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black shadow">
                        إرسال التسليم للمدير العام
                    </button>
                </div>
            </form>
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

            <form action="{{ route('projects.gm-decision', $project->id) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <input type="hidden" name="decision" :value="decisionType">

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات المدير العام لصانع المحتوى</label>
                    <textarea name="notes" rows="3" 
                              class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white focus:outline-none focus:border-brand-gold"
                              :placeholder="decisionType === 'approved' ? 'مثال: تم الاعتماد بجودة ممتازة، شكراً لكم.' : 'مثال: مطلوب تعديل في الفيديو الثاني...'"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="gmDecisionModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" 
                            class="px-5 py-2 rounded-xl font-black shadow text-white"
                            :class="decisionType === 'approved' ? 'bg-emerald-600 hover:bg-emerald-500' : 'bg-rose-600 hover:bg-rose-500'"
                            x-text="decisionType === 'approved' ? 'تأكيد الاعتماد' : 'إرسال طلب التعديل'">
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
