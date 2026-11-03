@extends('layouts.app')

@section('title', 'إدارة الموقع ومعرض الأعمال والخدمات')
@section('page_title', 'نظام إدارة محتوى الموقع (CMS)')
@section('page_subtitle', 'إضافة وتعديل خدمات الوكالة وتحديد أنواعها، وإدارة معرض الفيديوهات والتصاميم')

@section('content')
<div class="space-y-6 pt-2" x-data="{ 
    tab: 'services', 
    addServiceModal: false, 
    editServiceModal: false, 
    selectedService: null,
    addPortfolioModal: false, 
    editPortfolioModal: false, 
    selectedPortfolio: null 
}">

    <!-- Tab navigation -->
    <div class="flex items-center gap-2 border-b border-brand-border pb-2 overflow-x-auto">
        <button type="button" @click="tab = 'services'" 
                :class="tab === 'services' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-briefcase"></i>
            <span>خدمات الوكالة وتصنيفاتها ({{ $services->count() }})</span>
        </button>

        <button type="button" @click="tab = 'portfolio'" 
                :class="tab === 'portfolio' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-photo-film"></i>
            <span>معرض الفيديوهات والأعمال ({{ $portfolioItems->count() }})</span>
        </button>

        <button type="button" @click="tab = 'inquiries'" 
                :class="tab === 'inquiries' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-envelope-open-text"></i>
            <span>طلبات واستشارات الموقع ({{ $inquiries->total() }})</span>
        </button>
    </div>

    <!-- 1. SERVICES TAB (إدارة وتحديد أنواع الخدمات) -->
    <div x-show="tab === 'services'" class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/60 border border-brand-border/60 p-4 rounded-2xl">
            <div>
                <h3 class="text-xs font-bold text-white">إدارة خدمات وكالة بريق وتحديد أنواعها</h3>
                <p class="text-[11px] text-gray-400">يمكنك هنا إضافة خدمة جديدة وتحديد نوعها (تصوير، مونتاج، إعلانات ممولة، تصميم، إلخ) وتعديل أو حذف أي خدمة لتنعكس فوراً على الموقع الرئيسي.</p>
            </div>
            <button @click="addServiceModal = true" type="button" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow-lg flex items-center gap-2 self-start sm:self-auto whitespace-nowrap">
                <i class="fa-solid fa-plus-circle"></i>
                <span>إضافة خدمة جديدة وتحديد نوعها</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($services as $srv)
            <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-4 flex flex-col justify-between hover:border-brand-yellow/50 transition shadow">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div class="w-12 h-12 rounded-xl bg-brand-yellow/15 border border-brand-yellow/30 text-brand-gold flex items-center justify-center text-xl shadow">
                            <i class="fa-solid fa-{{ $srv->icon }}"></i>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                {{ $srv->category_arabic }}
                            </span>
                            <div class="text-xs text-emerald-400 font-bold mt-1">
                                يبدأ من: {{ number_format($srv->starting_price) }} ج.م
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-white text-base leading-snug">{{ $srv->title_ar }}</h4>
                        @if($srv->title_en)
                        <div class="text-[11px] text-brand-gold/80 font-medium">{{ $srv->title_en }}</div>
                        @endif
                    </div>

                    <p class="text-xs text-gray-300 leading-relaxed line-clamp-3">{{ $srv->short_description }}</p>
                </div>

                <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between text-xs">
                    <span class="text-[11px] font-semibold {{ $srv->is_active ? 'text-emerald-400' : 'text-rose-400' }}">
                        <i class="fa-solid fa-circle text-[8px] ml-1"></i>
                        {{ $srv->is_active ? 'نشطة بالموقع' : 'معطلة' }}
                    </span>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                @click="selectedService = {{ json_encode($srv) }}; editServiceModal = true" 
                                class="px-3 py-1.5 rounded-lg bg-brand-purple hover:bg-brand-hover text-brand-gold hover:text-white border border-brand-border text-xs font-bold transition flex items-center gap-1.5">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>تعديل</span>
                        </button>

                        <form method="POST" action="{{ route('cms.services.destroy', $srv->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة نهائياً من الموقع؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-400 transition" title="حذف الخدمة">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-400">
                لا توجد خدمات مضافة حتى الآن. انقر على زر "إضافة خدمة جديدة" للبدء.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 2. PORTFOLIO TAB (معرض الفيديوهات والأعمال) -->
    <div x-show="tab === 'portfolio'" class="space-y-4" style="display: none;">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/60 border border-brand-border/60 p-4 rounded-2xl">
            <div>
                <h3 class="text-xs font-bold text-white">فيديوهات وأعمال معرض موقع بريق</h3>
                <p class="text-[11px] text-gray-400">تدعم فيديوهات يوتيوب، فيميو، ملفات MP4 المباشرة والمقاطع السريعة وتصميمات السوشيال والأغلفة.</p>
            </div>
            <button @click="addPortfolioModal = true" type="button" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow-lg flex items-center gap-2 self-start sm:self-auto whitespace-nowrap">
                <i class="fa-solid fa-plus-circle"></i>
                <span>إضافة فيديو أو عمل جديد للمعرض</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($portfolioItems as $item)
            <div class="bg-brand-card border border-brand-border rounded-2xl p-4 space-y-3 relative group hover:border-brand-yellow/50 transition shadow flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-purple border border-brand-border text-brand-gold">
                            {{ $item->category_arabic }}
                        </span>
                        @if($item->is_featured)
                        <span class="text-[10px] text-amber-400 font-bold flex items-center gap-1">
                            <i class="fa-solid fa-star"></i>
                            <span>مميز بالرئيسية</span>
                        </span>
                        @endif
                    </div>

                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/50 border border-brand-border/60">
                        @if($item->thumbnail)
                        <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @endif
                        @if($item->video_url)
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center text-sm shadow-lg">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        @endif
                    </div>

                    <h4 class="font-bold text-white text-sm leading-snug">{{ $item->title }}</h4>
                    <div class="text-xs text-brand-gold font-medium">{{ $item->client_name }} ({{ $item->client_country }})</div>

                    @if($item->metrics)
                    <div class="p-2 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-300 font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>{{ $item->metrics }}</span>
                    </div>
                    @endif

                    <p class="text-xs text-gray-300 line-clamp-2">{{ $item->description }}</p>
                </div>

                <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between text-xs">
                    @if($item->video_url)
                    <a href="{{ $item->video_url }}" target="_blank" class="text-blue-400 hover:underline flex items-center gap-1 font-bold">
                        <i class="fa-solid fa-play text-[10px]"></i>
                        <span>معاينة الرابط</span>
                    </a>
                    @else
                    <span class="text-gray-400">تصميم ثابت</span>
                    @endif

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                @click="selectedPortfolio = {{ json_encode($item) }}; editPortfolioModal = true" 
                                class="px-3 py-1.5 rounded-lg bg-brand-purple hover:bg-brand-hover text-brand-gold hover:text-white border border-brand-border text-xs font-bold transition flex items-center gap-1.5"
                                title="تعديل بيانات العمل">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>تعديل</span>
                        </button>

                        <form method="POST" action="{{ route('cms.portfolio.destroy', $item->id) }}" onsubmit="return confirm('حذف هذا العمل نهائياً من المعرض؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-400 transition" title="حذف العمل">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 3. INQUIRIES TAB (طلبات واستشارات الموقع) -->
    <div x-show="tab === 'inquiries'" class="space-y-4" style="display: none;">
        <div class="bg-brand-card border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-white">الاستشارات والطلبات الواردة من عملاء الموقع الخارجي</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead>
                        <tr class="border-b border-brand-border text-gray-400 font-bold">
                            <th class="py-3 px-3">العميل / الاسم</th>
                            <th class="py-3 px-3">البراند</th>
                            <th class="py-3 px-3">الهاتف / واتساب</th>
                            <th class="py-3 px-3">الخدمة المطلوبة</th>
                            <th class="py-3 px-3">الميزانية المتوقعة</th>
                            <th class="py-3 px-3">الرسالة</th>
                            <th class="py-3 px-3">التاريخ</th>
                            <th class="py-3 px-3">الحالة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/40">
                        @forelse($inquiries as $inq)
                        <tr class="hover:bg-brand-hover/40 transition">
                            <td class="py-3 px-3 font-bold text-white">{{ $inq->name }}</td>
                            <td class="py-3 px-3 text-brand-gold font-semibold">{{ $inq->brand_name ?? '-' }}</td>
                            <td class="py-3 px-3">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}" target="_blank" class="text-emerald-400 hover:underline flex items-center gap-1 font-bold">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>{{ $inq->phone }}</span>
                                </a>
                            </td>
                            <td class="py-3 px-3 text-gray-300">{{ $inq->service_interested ?? 'عام' }}</td>
                            <td class="py-3 px-3 text-amber-300 font-bold">{{ $inq->budget_range ?? 'غير محدد' }}</td>
                            <td class="py-3 px-3 text-gray-400 max-w-xs truncate" title="{{ $inq->message }}">{{ $inq->message }}</td>
                            <td class="py-3 px-3 text-gray-500">{{ $inq->created_at->format('Y-m-d') }}</td>
                            <td class="py-3 px-3">
                                <form method="POST" action="{{ route('cms.inquiries.status', $inq->id) }}">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="bg-brand-dark border border-brand-border rounded text-[11px] text-gray-200 py-1 px-1.5 focus:outline-none">
                                        <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>جديد</option>
                                        <option value="contacted" {{ $inq->status === 'contacted' ? 'selected' : '' }}>تم التواصل</option>
                                        <option value="converted" {{ $inq->status === 'converted' ? 'selected' : '' }}>تم التعاقد</option>
                                        <option value="closed" {{ $inq->status === 'closed' ? 'selected' : '' }}>مغلق</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-gray-400">لا توجد طلبات واردة بعد.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="pt-2">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>

    <!-- MODAL: ADD SERVICE (إضافة خدمة جديدة وتحديد نوعها) -->
    <div x-show="addServiceModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addServiceModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-briefcase text-brand-gold"></i>
                    <span>إضافة خدمة جديدة للموقع وتحديد نوعها</span>
                </h3>
                <button @click="addServiceModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.services.store') }}" class="space-y-3 text-xs">
                @csrf

                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم الخدمة باللغة العربية <span class="text-red-400">*</span></label>
                    <input type="text" name="title_ar" required placeholder="مثال: تصوير إعلانات ومونتاج ريلز سينمائي" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الاسم بالإنجليزية (اختياري)</label>
                        <input type="text" name="title_en" placeholder="Cinematic Video Production" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-amber-300 mb-1">نوع وتصنيف الخدمة <span class="text-red-400">*</span></label>
                        <select name="category" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            @foreach($serviceCategories as $catKey => $catLabel)
                            <option value="{{ $catKey }}">{{ $catLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">أيقونة الخدمة <span class="text-red-400">*</span></label>
                        <select name="icon" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video">كاميرا تصوير فيديو (video)</option>
                            <option value="film">شريط مونتاج وسينما (film)</option>
                            <option value="pen-nib">قلم تصميم وجرافيك (pen-nib)</option>
                            <option value="chart-line">مخطط إعلانات ومبيعات (chart-line)</option>
                            <option value="bullhorn">مكبر صوت إعلانات (bullhorn)</option>
                            <option value="share-nodes">شبكات سوشيال ميديا (share-nodes)</option>
                            <option value="lightbulb">مصباح فكرة واستراتيجية (lightbulb)</option>
                            <option value="crown">تاج وهوية براند (crown)</option>
                            <option value="bolt">طاقة وسرعة (bolt)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">السعر المبدئي (يبدأ من ج.م)</label>
                        <input type="number" name="starting_price" min="0" step="100" placeholder="3500" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الوصف المختصر للخدمة (يظهر في كارت الخدمة بالصفحة الرئيسية) <span class="text-red-400">*</span></label>
                    <textarea name="short_description" rows="2" required placeholder="اكتب نبذة جذابة من سطرين أو ثلاثة تلخص ميزة هذه الخدمة لعملاء الوكالة..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الوصف التفصيلي (اختياري)</label>
                    <textarea name="full_description" rows="2" placeholder="تفاصيل الباقات، المعدات المستخدمة، مخرجات الخدمة..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="add_is_active" checked class="rounded text-brand-gold focus:ring-0">
                    <label for="add_is_active" class="text-xs text-gray-300 font-semibold cursor-pointer">تفعيل الخدمة وإظهارها فوراً في الموقع الخارجي</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addServiceModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black shadow">إضافة وحفظ الخدمة</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT SERVICE (تعديل بيانات الخدمة وتصنيفها) -->
    <div x-show="editServiceModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editServiceModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold"></i>
                    <span>تعديل بيانات الخدمة وتصنيفها</span>
                </h3>
                <button @click="editServiceModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('cms/services') }}/' + (selectedService ? selectedService.id : '')" class="space-y-3 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم الخدمة باللغة العربية <span class="text-red-400">*</span></label>
                    <input type="text" name="title_ar" x-bind:value="selectedService ? selectedService.title_ar : ''" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الاسم بالإنجليزية (اختياري)</label>
                        <input type="text" name="title_en" x-bind:value="selectedService ? selectedService.title_en : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-amber-300 mb-1">نوع وتصنيف الخدمة <span class="text-red-400">*</span></label>
                        <select name="category" x-bind:value="selectedService ? selectedService.category : 'video_shooting'" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            @foreach($serviceCategories as $catKey => $catLabel)
                            <option value="{{ $catKey }}">{{ $catLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">أيقونة الخدمة <span class="text-red-400">*</span></label>
                        <select name="icon" x-bind:value="selectedService ? selectedService.icon : 'video'" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video">كاميرا تصوير فيديو (video)</option>
                            <option value="film">شريط مونتاج وسينما (film)</option>
                            <option value="pen-nib">قلم تصميم وجرافيك (pen-nib)</option>
                            <option value="chart-line">مخطط إعلانات ومبيعات (chart-line)</option>
                            <option value="bullhorn">مكبر صوت إعلانات (bullhorn)</option>
                            <option value="share-nodes">شبكات سوشيال ميديا (share-nodes)</option>
                            <option value="lightbulb">مصباح فكرة واستراتيجية (lightbulb)</option>
                            <option value="crown">تاج وهوية براند (crown)</option>
                            <option value="bolt">طاقة وسرعة (bolt)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">السعر المبدئي (يبدأ من ج.م)</label>
                        <input type="number" name="starting_price" min="0" step="100" x-bind:value="selectedService ? selectedService.starting_price : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الوصف المختصر للخدمة <span class="text-red-400">*</span></label>
                    <textarea name="short_description" rows="2" required x-bind:value="selectedService ? selectedService.short_description : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">الوصف التفصيلي (اختياري)</label>
                    <textarea name="full_description" rows="2" x-bind:value="selectedService ? selectedService.full_description : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="edit_is_active" :checked="selectedService && selectedService.is_active" class="rounded text-brand-gold focus:ring-0">
                    <label for="edit_is_active" class="text-xs text-gray-300 font-semibold cursor-pointer">الخدمة نشطة وظاهرة على الموقع</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editServiceModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD PORTFOLIO ITEM -->
    <div x-show="addPortfolioModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addPortfolioModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-photo-film text-brand-gold"></i>
                    <span>إضافة فيديو أو عمل جديد لمعرض الموقع</span>
                </h3>
                <button @click="addPortfolioModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.portfolio.store') }}" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">عنوان العمل <span class="text-red-400">*</span></label>
                    <input type="text" name="title" required placeholder="مثال: ريلز سريع لمطعم برجر مع مؤثرات بصرية" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل</label>
                        <input type="text" name="client_name" placeholder="مثال: Shawrmaker" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة</label>
                        <input type="text" name="client_country" placeholder="الأردن / السعودية / مصر..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">التصنيف <span class="text-red-400">*</span></label>
                        <select name="category" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video_reels">فيديوهات ريلز وقصيرة</option>
                            <option value="promo_video">برومو وفيديوهات إعلانية</option>
                            <option value="social_design">تصميمات سوشيال ميديا</option>
                            <option value="youtube_thumbnail">أغلفة يوتيوب مصغرة</option>
                            <option value="branding">لوجو وهويات بصرية</option>
                            <option value="ad_results">نتائج حملات إعلانية</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم/نسبة نجاح (Metrics)</label>
                        <input type="text" name="metrics" placeholder="مثال: +1.5M مشاهدة | ROAS 5x" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-brand-gold mb-1">
                        <i class="fa-solid fa-play ml-1"></i>
                        رابط الفيديو (يوتيوب YouTube أو ملف MP4 مباشر أو فيديو محلي)
                    </label>
                    <input type="text" name="video_url" placeholder="https://www.youtube.com/watch?v=... أو /videos/promo_reels_1.mp4" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    <p class="text-[10px] text-gray-400 mt-1">يدعم روابط يوتيوب العادية، روابط Shorts، فيميو، أو ملفات الفيديو المباشرة بصيغة mp4.</p>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">مسار صورة الغلاف (Thumbnail)</label>
                    <input type="text" name="thumbnail" placeholder="/images/portfolio/social_1.webp" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">وصف العمل</label>
                    <textarea name="description" rows="2" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" value="1" id="featured" checked class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="featured" class="text-xs text-gray-300 cursor-pointer">تمييز في قسم الأعمال البارزة بالصفحة الرئيسية</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addPortfolioModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ العمل</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT PORTFOLIO ITEM (تعديل العمل الموجود) -->
    <div x-show="editPortfolioModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editPortfolioModal = false" 
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold"></i>
                    <span>تعديل بيانات العمل في معرض الموقع</span>
                </h3>
                <button @click="editPortfolioModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('cms/portfolio') }}/' + (selectedPortfolio ? selectedPortfolio.id : '')" class="space-y-3 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-gray-300 mb-1">عنوان العمل <span class="text-red-400">*</span></label>
                    <input type="text" name="title" x-bind:value="selectedPortfolio ? selectedPortfolio.title : ''" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل</label>
                        <input type="text" name="client_name" x-bind:value="selectedPortfolio ? selectedPortfolio.client_name : ''" placeholder="Shawrmaker" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة</label>
                        <input type="text" name="client_country" x-bind:value="selectedPortfolio ? selectedPortfolio.client_country : ''" placeholder="الأردن / السعودية / مصر..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">التصنيف <span class="text-red-400">*</span></label>
                        <select name="category" x-bind:value="selectedPortfolio ? selectedPortfolio.category : 'video_reels'" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video_reels">فيديوهات ريلز وقصيرة</option>
                            <option value="promo_video">برومو وفيديوهات إعلانية</option>
                            <option value="social_design">تصميمات سوشيال ميديا</option>
                            <option value="youtube_thumbnail">أغلفة يوتيوب مصغرة</option>
                            <option value="branding">لوجو وهويات بصرية</option>
                            <option value="ad_results">نتائج حملات إعلانية</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">رقم/نسبة نجاح (Metrics)</label>
                        <input type="text" name="metrics" x-bind:value="selectedPortfolio ? selectedPortfolio.metrics : ''" placeholder="+1.5M مشاهدة | ROAS 5x" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-brand-gold mb-1">
                        <i class="fa-solid fa-play ml-1"></i>
                        رابط الفيديو (YouTube أو ملف MP4 مباشر أو فيديو محلي)
                    </label>
                    <input type="text" name="video_url" x-bind:value="selectedPortfolio ? (selectedPortfolio.video_url || '') : ''" placeholder="https://www.youtube.com/watch?v=... أو /videos/promo_reels_1.mp4" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    <p class="text-[10px] text-gray-400 mt-1">اتركه فارغاً إذا كان العمل عبارة عن تصميم ثابت أو غلاف.</p>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">مسار صورة الغلاف (Thumbnail)</label>
                    <input type="text" name="thumbnail" x-bind:value="selectedPortfolio ? selectedPortfolio.thumbnail : ''" placeholder="/images/portfolio/social_1.webp" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">وصف العمل</label>
                    <textarea name="description" rows="2" x-bind:value="selectedPortfolio ? selectedPortfolio.description : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" value="1" id="edit_featured" :checked="selectedPortfolio && selectedPortfolio.is_featured" class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="edit_featured" class="text-xs text-gray-300 cursor-pointer">تمييز في قسم الأعمال البارزة بالصفحة الرئيسية</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editPortfolioModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
