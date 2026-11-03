@extends('layouts.app')

@section('title', 'المصروفات والحسابات')
@section('page_title', 'إدارة المصروفات والتكاليف التشغيلية')
@section('page_subtitle', 'تسجيل مصاريف الإعلانات، أجور المصورين، اشتراكات البرامج، وحساب الأرباح')

@section('content')
<div class="space-y-6 pt-2" x-data="{ createModalOpen: false }">

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">إجمالي المصروفات الكلية</div>
            <div class="text-2xl font-black text-rose-400 mt-1">{{ number_format($totalExpenses, 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">ميزانيات الإعلانات الممولة (Ad Spend)</div>
            <div class="text-2xl font-black text-white mt-1">{{ number_format($byCategory['ad_spend'], 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">اشتراكات الأدوات والبرامج (Adobe / AI)</div>
            <div class="text-2xl font-black text-white mt-1">{{ number_format($byCategory['software_tools'], 2) }} ج.م</div>
        </div>
        <div class="p-4 rounded-xl bg-brand-card border border-brand-border">
            <div class="text-xs text-gray-400 font-bold">أجور العمل الحر وتصوير خارجي</div>
            <div class="text-2xl font-black text-white mt-1">{{ number_format($byCategory['freelancers'], 2) }} ج.م</div>
        </div>
    </div>

    <!-- Actions & Add Expense button -->
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-white flex items-center gap-2">
            <i class="fa-solid fa-receipt text-brand-gold"></i>
            <span>سجل بنود الصرف والمصروفات</span>
        </h3>
        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>تسجيل مصروف جديد</span>
        </button>
    </div>

    <!-- Expenses Table -->
    <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-brand-border text-gray-400 font-bold">
                        <th class="py-3 px-3">بند المصروف</th>
                        <th class="py-3 px-3">التصنيف</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">طريقة الدفع</th>
                        <th class="py-3 px-3">المشروع التابع</th>
                        <th class="py-3 px-3">التاريخ</th>
                        <th class="py-3 px-3">المسؤول</th>
                        <th class="py-3 px-3 text-left">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/40">
                    @forelse($expenses as $exp)
                    <tr class="hover:bg-brand-hover/40 transition">
                        <td class="py-3.5 px-3">
                            <div class="font-bold text-white text-sm">{{ $exp->title }}</div>
                            @if($exp->notes)
                            <div class="text-[11px] text-gray-400">{{ $exp->notes }}</div>
                            @endif
                        </td>
                        <td class="py-3.5 px-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-purple border border-brand-border text-gray-300">
                                {{ $exp->category_arabic }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3 font-black text-rose-400 text-sm">
                            {{ number_format($exp->amount, 2) }} ج.م
                        </td>
                        <td class="py-3.5 px-3 text-gray-300">
                            {{ $exp->payment_method }}
                        </td>
                        <td class="py-3.5 px-3 text-gray-400">
                            {{ $exp->project->title ?? 'مصروف عام للشركة' }}
                        </td>
                        <td class="py-3.5 px-3 text-gray-400">
                            {{ $exp->spent_at ? $exp->spent_at->format('Y-m-d') : '-' }}
                        </td>
                        <td class="py-3.5 px-3 text-gray-400">
                            {{ $exp->creator->name ?? '-' }}
                        </td>
                        <td class="py-3.5 px-3 text-left">
                            <form method="POST" action="{{ route('expenses.destroy', $exp->id) }}" onsubmit="return confirm('حذف بند المصروف؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 rounded text-gray-500 hover:text-rose-400 text-xs">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-gray-400">لا توجد مصروفات مسجلة بعد.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $expenses->links() }}
        </div>
    </div>

    <!-- CREATE EXPENSE MODAL -->
    <div x-show="createModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="createModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-receipt text-brand-gold"></i>
                    <span>تسجيل مصروف تشغيلي جديد</span>
                </h3>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">بيان المصروف <span class="text-red-400">*</span></label>
                    <input type="text" name="title" required placeholder="مثال: شحن ميزانية إعلانات Meta لحملة مطعم شاورماكر" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">التصنيف <span class="text-red-400">*</span></label>
                        <select name="category" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="ad_spend">ميزانيات إعلانات ممولة (Ad Spend)</option>
                            <option value="freelancers">أجور عمل حر ومصورين خارجيين</option>
                            <option value="software_tools">اشتراكات برامج وأدوات (Adobe, AI)</option>
                            <option value="equipment">معدات تصوير وصيانة</option>
                            <option value="office_rent">إيجار ومصاريف مقر</option>
                            <option value="other">مصروفات عامة</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-rose-300 mb-1">المبلغ (ج.م) <span class="text-red-400">*</span></label>
                        <input type="number" step="0.01" name="amount" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">طريقة الدفع المنصرف بها</label>
                        <select name="payment_method" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="instapay">إنستاباي</option>
                            <option value="vodafone_cash">فودافون كاش</option>
                            <option value="cash">نقداً من الخزينة</option>
                            <option value="bank_transfer">تحويل بنكي</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تاريخ الصرف</label>
                        <input type="date" name="spent_at" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ربط بمشروع معين (اختياري - لحساب صافي ربح المشروع)</label>
                    <select name="project_id" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        <option value="">بدون مشروع (مصروف عام للشركة)</option>
                        @foreach($projects as $p)
                        <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->client->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">ملاحظات إضافية</label>
                    <textarea name="notes" rows="2" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="createModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ المصروف</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
