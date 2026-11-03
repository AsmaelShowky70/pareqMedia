@extends('layouts.app')

@section('title', 'فريق العمل والصلاحيات')
@section('page_title', 'إدارة فريق العمل والصلاحيات (RBAC)')
@section('page_subtitle', 'إضافة الموظفين، تحديد أقسامهم وأدوارهم، وتعيين كوتة اليومية لكل موظف')

@section('content')
<div class="space-y-6 pt-2" x-data="{ createModalOpen: false, editModalOpen: false, selectedUser: null }">

    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <div class="text-xs text-gray-400">إجمالي أعضاء الفريق: <span class="font-bold text-white">{{ $users->total() }}</span></div>
        <button @click="createModalOpen = true" type="button" 
                class="px-4 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow flex items-center gap-2">
            <i class="fa-solid fa-user-plus"></i>
            <span>إضافة موظف جديد وتحديد صلاحياته</span>
        </button>
    </div>

    <!-- Team Members Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($users as $u)
        <div class="bg-brand-card/90 border border-brand-border rounded-2xl p-5 hover:border-brand-yellow/40 transition space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-amber to-brand-yellow text-brand-dark font-black flex items-center justify-center text-lg shadow">
                            {{ mb_substr($u->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white">{{ $u->name }}</h3>
                            <div class="text-xs text-brand-gold font-medium">{{ $u->job_title }}</div>
                        </div>
                    </div>
                    
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $u->isAdmin() ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40' : ($u->isManager() ? 'bg-blue-500/20 text-blue-300' : 'bg-purple-500/20 text-purple-300') }}">
                        {{ $u->isAdmin() ? 'مدير عام' : ($u->isManager() ? 'مدير قسم' : 'موظف تشغيلي') }}
                    </span>
                </div>

                <div class="space-y-1.5 text-xs text-gray-300 pt-2 border-t border-brand-border/40">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">القسم:</span>
                        <span class="font-bold text-white">{{ $u->department_name_arabic }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">البريد:</span>
                        <span class="text-gray-200">{{ $u->email }}</span>
                    </div>
                    @if($u->phone)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">الهاتف:</span>
                        <span class="text-gray-200">{{ $u->phone }}</span>
                    </div>
                    @endif
                </div>

                <!-- Daily Quota / Target -->
                <div class="p-2.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs">
                    <span class="text-[11px] text-brand-gold font-bold block mb-0.5">كوتة الإنتاج واليومية المعتمدة:</span>
                    <span class="text-gray-200 font-semibold">{{ $u->daily_quota ?? 'متابعة وإنجاز المهام المسندة' }}</span>
                </div>
            </div>

            <!-- Card Bottom Bar -->
            <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between text-xs">
                <span class="text-gray-400">المهام المسندة حالياً: <strong class="text-brand-gold">{{ $u->assigned_tasks_count }}</strong></span>

                <div class="flex items-center gap-2">
                    <button @click="selectedUser = {{ json_encode($u) }}; editModalOpen = true;" 
                            class="px-3 py-1.5 rounded-xl bg-brand-purple hover:bg-brand-hover text-brand-gold hover:text-white border border-brand-border text-xs font-bold transition flex items-center gap-1.5" title="تعديل الصلاحيات واليومية">
                        <i class="fa-solid fa-user-pen text-xs"></i>
                        <span>تعديل الصلاحيات</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CREATE USER MODAL -->
    <div x-show="createModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="createModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-brand-gold"></i>
                    <span>إضافة موظف جديد للنظام</span>
                </h3>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('users.store') }}" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">الاسم الكامل <span class="text-red-400">*</span></label>
                    <input type="text" name="name" required placeholder="مثال: أحمد عبد الله" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">البريد الإلكتروني <span class="text-red-400">*</span></label>
                        <input type="email" name="email" required placeholder="ahmed@pariqagency.com" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">كلمة المرور الأولية <span class="text-red-400">*</span></label>
                        <input type="password" name="password" required value="password" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم الهاتف / واتساب</label>
                        <input type="text" name="phone" placeholder="+2010..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المسمى الوظيفي <span class="text-red-400">*</span></label>
                        <input type="text" name="job_title" required placeholder="مثال: مونتير ريلز وسينما" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">مستوى الصلاحية (Role) <span class="text-red-400">*</span></label>
                        <select name="role" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="employee">موظف تشغيلي (يرى مهامه الشخصية فقط - Privacy)</option>
                            <option value="content_creator">صانع محتوى (Content Creator - إدارة وتوزيع مشاريع وفريق معزول)</option>
                            <option value="manager">مدير قسم (إشراف ومتابعة القسم)</option>
                            <option value="admin">مدير عام / صاحب الشركة (صلاحيات كاملة 360)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">القسم المعين به <span class="text-red-400">*</span></label>
                        <select name="department" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="editing">قسم المونتاج والبوست برودكشن</option>
                            <option value="video">قسم التصوير والإنتاج</option>
                            <option value="design">قسم تصميم الجرافيك والهويات</option>
                            <option value="media_buyer">قسم الميديا باينج والإعلانات</option>
                            <option value="accounting">قسم الحسابات والكاشير</option>
                            <option value="management">الإدارة العامة</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-amber-300 mb-1">كوتة اليومية المطلوبة (Daily Quota Target)</label>
                    <input type="text" name="daily_quota" placeholder="مثال: إنتاج 2 ريلز يومياً + تطبيق التعديلات" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="createModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">إضافة الموظف</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT USER MODAL -->
    <div x-show="editModalOpen" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editModalOpen = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-user-gear text-brand-gold"></i>
                    <span>تعديل بيانات وصلاحيات الموظف</span>
                </h3>
                <button @click="editModalOpen = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('users') }}/' + (selectedUser ? selectedUser.id : '')" class="space-y-3 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الاسم الكامل <span class="text-red-400">*</span></label>
                    <input type="text" name="name" x-bind:value="selectedUser ? selectedUser.name : ''" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">البريد الإلكتروني <span class="text-red-400">*</span></label>
                        <input type="email" name="email" x-bind:value="selectedUser ? selectedUser.email : ''" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">تغيير كلمة المرور (اتركه فارغاً للإبقاء عليها)</label>
                        <input type="password" name="password" placeholder="كلمة مرور جديدة..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم الهاتف / واتساب</label>
                        <input type="text" name="phone" x-bind:value="selectedUser ? selectedUser.phone : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المسمى الوظيفي <span class="text-red-400">*</span></label>
                        <input type="text" name="job_title" x-bind:value="selectedUser ? selectedUser.job_title : ''" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">مستوى الصلاحية (Role) <span class="text-red-400">*</span></label>
                        <select name="role" x-bind:value="selectedUser ? selectedUser.role : 'employee'" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="employee">موظف تشغيلي (يرى مهامه الشخصية فقط - Privacy)</option>
                            <option value="content_creator">صانع محتوى (Content Creator - إدارة وتوزيع مشاريع وفريق معزول)</option>
                            <option value="manager">مدير قسم (إشراف ومتابعة القسم)</option>
                            <option value="admin">مدير عام / صاحب الشركة (صلاحيات كاملة 360)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">القسم المعين به <span class="text-red-400">*</span></label>
                        <select name="department" x-bind:value="selectedUser ? selectedUser.department : 'editing'" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="editing">قسم المونتاج والبوست برودكشن</option>
                            <option value="video">قسم التصوير والإنتاج</option>
                            <option value="design">قسم تصميم الجرافيك والهويات</option>
                            <option value="media_buyer">قسم الميديا باينج والإعلانات</option>
                            <option value="accounting">قسم الحسابات والكاشير</option>
                            <option value="management">الإدارة العامة</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-amber-300 mb-1">كوتة اليومية والإنتاج المطلوبة</label>
                    <input type="text" name="daily_quota" x-bind:value="selectedUser ? selectedUser.daily_quota : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="edit_is_active" name="is_active" value="1" :checked="selectedUser && selectedUser.is_active" class="rounded text-brand-gold focus:ring-0">
                    <label for="edit_is_active" class="text-xs text-gray-300 font-semibold cursor-pointer">الحساب نشط ويستقبل تكليفات المهام</label>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-brand-border">
                    <div>
                        <template x-if="selectedUser && selectedUser.role !== 'admin'">
                            <button type="button" @click="if(confirm('هل أنت متأكد من حذف هذا الموظف نهائياً؟')) { document.getElementById('delete-user-form-' + selectedUser.id).submit(); }" class="text-xs text-red-400 hover:text-red-300 font-bold flex items-center gap-1">
                                <i class="fa-solid fa-trash-can"></i>
                                <span>حذف الموظف</span>
                            </button>
                        </template>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="editModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($users as $u)
    @if(!$u->isAdmin())
    <form id="delete-user-form-{{ $u->id }}" action="{{ route('users.destroy', $u) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endif
    @endforeach

</div>
@endsection
