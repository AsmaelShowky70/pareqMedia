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
    selectedPortfolio: null,
    addPartnerModal: false,
    editPartnerModal: false,
    selectedPartner: null,
    addTestimonialModal: false,
    editTestimonialModal: false,
    selectedTestimonial: null,
    addTeamModal: false,
    editTeamModal: false,
    selectedTeamMember: null
}">

    <!-- Tab navigation -->
    <div class="flex items-center gap-2 border-b border-brand-border pb-2 overflow-x-auto">
        <button type="button" @click="tab = 'services'" 
                :class="tab === 'services' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-briefcase"></i>
            <span>خدمات الوكالة وتصنيفاتها ({{ $services->count() }})</span>
        </button>

        <button type="button" @click="tab = 'team'" 
                :class="tab === 'team' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-users-gear text-brand-gold"></i>
            <span>فريق العمل (من نحن) ({{ isset($teamMembers) ? $teamMembers->count() : 0 }})</span>
        </button>

        <button type="button" @click="tab = 'portfolio'" 
                :class="tab === 'portfolio' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-photo-film"></i>
            <span>معرض الفيديوهات والأعمال ({{ $portfolioItems->count() }})</span>
        </button>

        <button type="button" @click="tab = 'partners'" 
                :class="tab === 'partners' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-handshake"></i>
            <span>شركاء النجاح والعلامات التجارية ({{ isset($partners) ? $partners->count() : 0 }})</span>
        </button>

        <button type="button" @click="tab = 'testimonials'" 
                :class="tab === 'testimonials' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-comments"></i>
            <span>آراء العملاء وفيديوهات الفيدباك ({{ isset($testimonials) ? $testimonials->count() : 0 }})</span>
        </button>

        <button type="button" @click="tab = 'stats'" 
                :class="tab === 'stats' ? 'bg-brand-yellow text-brand-dark font-black' : 'text-gray-400 hover:text-white bg-brand-card'"
                class="px-4 py-2 rounded-xl text-xs transition flex items-center gap-2 whitespace-nowrap">
            <i class="fa-solid fa-chart-simple text-brand-gold"></i>
            <span>إحصائيات ومؤشرات المنصة (Stats Counter)</span>
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
                        @if($item->display_thumbnail)
                        <img src="{{ $item->display_thumbnail }}" alt="{{ $item->title }}" referrerpolicy="no-referrer" loading="lazy" class="w-full h-full object-cover">
                        @elseif($item->thumbnail)
                        <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" referrerpolicy="no-referrer" loading="lazy" class="w-full h-full object-cover">
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
             x-data="{
                 category: 'video_reels',
                 videoInput: '',
                 thumbInput: '',
                 previewSrc: '',
                 previewBadge: '',
                 isImageCat() {
                     return ['social_design', 'branding', 'youtube_thumbnail', 'ad_results'].includes(this.category);
                 },
                 checkPreview() {
                     // Smart cross-input detection: If user pasted a Google Drive link in videoInput, transfer it to thumbInput!
                     if (this.videoInput) {
                         const vVal = this.videoInput.trim();
                         const driveMatch = vVal.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.thumbInput = this.videoInput;
                             this.videoInput = '';
                         }
                     }

                     if (this.thumbInput) {
                         const val = this.thumbInput.trim();
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.previewSrc = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.previewBadge = 'Google Drive Cloud CDN (مباشر وسريع - 0 MB مساحة مستهلكة)';
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.previewSrc = val;
                             this.previewBadge = 'رابط صورة خارجي';
                             return;
                         }
                         if (val) {
                             this.previewSrc = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             this.previewBadge = 'مسار محلي';
                             return;
                         }
                     }
                     if (this.videoInput) {
                         const val = this.videoInput.trim();
                         const ytMatch = val.match(/(?:youtube\.com\/(?:watch\?.*v=|shorts\/|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
                         if (ytMatch) {
                             this.previewSrc = 'https://img.youtube.com/vi/' + ytMatch[1] + '/hqdefault.jpg';
                             this.previewBadge = 'غلاف YouTube التلقائي (دقة عالية)';
                             return;
                         }
                     }
                     this.previewSrc = '';
                     this.previewBadge = '';
                 },
                 onFileChosen(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.previewSrc = URL.createObjectURL(file);
                         this.previewBadge = 'صورة مرفوعة من جهازك (' + file.name + ')';
                     }
                 }
             }"
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-photo-film text-brand-gold"></i>
                    <span>إضافة فيديو أو عمل جديد لمعرض الموقع</span>
                </h3>
                <button @click="addPortfolioModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.portfolio.store') }}" enctype="multipart/form-data" class="space-y-3 text-xs">
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
                        <select name="category" x-model="category" @change="checkPreview()" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
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

                <!-- Image / Design Box (Emphasized when Image category) -->
                <div class="p-3 rounded-xl bg-purple-950/40 border space-y-2 transition-all duration-300"
                     :class="isImageCat() ? 'border-amber-400/60 bg-amber-950/20 ring-1 ring-amber-400/30' : 'border-purple-800/40'">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-amber-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-image text-brand-gold"></i>
                            <span x-text="isImageCat() ? 'صورة العمل / التصميم الأساسي *' : 'صورة الغلاف / Thumbnail المصغر'"></span>
                        </label>
                        <span class="text-[10px] text-emerald-400 font-bold flex items-center gap-1">
                            <i class="fa-solid fa-cloud-bolt"></i>
                            <span>يدعم Google Drive مباشرة (0 MB مساحة)</span>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">رفع صورة من جهازك (مباشر):</label>
                            <input type="file" name="thumbnail_file" accept="image/*" @change="onFileChosen($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو كتابة رابط صورة (Google Drive مباشرة):</label>
                            <input type="text" name="thumbnail" x-model="thumbInput" @input="checkPreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-brand-gold font-medium mt-1">
                                <i class="fa-solid fa-bolt ml-1"></i> يتم الربط تلقائياً بسيرفرات Google Cloud فائقة السرعة وبدون أي استهلاك لمساحة الاستضافة.
                            </p>
                        </div>
                    </div>

                    <!-- Live Thumbnail Preview -->
                    <div x-show="previewSrc" x-transition class="pt-2 border-t border-purple-800/40 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-brand-gold flex items-center gap-1.5">
                                <i class="fa-solid fa-eye text-emerald-400"></i>
                                <span>معاينة الصورة / الغلاف:</span>
                            </span>
                            <span class="px-2 py-0.5 rounded bg-brand-purple text-[10px] text-amber-300 font-medium" x-text="previewBadge"></span>
                        </div>
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/70 border border-purple-800/60 flex items-center justify-center max-h-40 mx-auto">
                            <img :src="previewSrc" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Video Options -->
                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-brand-gold">
                        <i class="fa-solid fa-play ml-1"></i>
                        <span x-text="isImageCat() ? 'فيديو العمل (اختياري تماماً للتصميمات)' : 'الفيديو الأساسي (YouTube أو MP4)'"></span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">رابط YouTube أو فيديو خارجي:</label>
                            <input type="text" name="video_url" x-model="videoInput" @input="checkPreview()" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-emerald-400 font-medium mt-1">
                                <i class="fa-solid fa-circle-check ml-1"></i> يتم جلب غلاف الفيديو من YouTube تلقائياً وبأعلى جودة!
                            </p>
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو رفع ملف فيديو MP4 مباشر:</label>
                            <input type="file" name="video_file" accept="video/mp4,video/webm,video/mov" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-purple file:text-brand-gold">
                        </div>
                    </div>
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
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ العمل ونشره</button>
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
             x-data="{
                 editCategory: 'video_reels',
                 editVideo: '',
                 editThumb: '',
                 editPreview: '',
                 editBadge: '',
                 init() {
                     this.$watch('editPortfolioModal', (val) => {
                         if (val && this.selectedPortfolio) {
                             this.editCategory = this.selectedPortfolio.category || 'video_reels';
                             this.editVideo = this.selectedPortfolio.video_url || '';
                             this.editThumb = this.selectedPortfolio.thumbnail || '';
                             this.updatePreview();
                         }
                     });
                 },
                 isImageCat() {
                     return ['social_design', 'branding', 'youtube_thumbnail', 'ad_results'].includes(this.editCategory);
                 },
                 updatePreview() {
                     // Smart cross-input check: If user pasted Google Drive link in editVideo, move it to editThumb!
                     if (this.editVideo) {
                         const vVal = this.editVideo.trim();
                         const driveMatch = vVal.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.editThumb = this.editVideo;
                             this.editVideo = '';
                         }
                     }

                     if (this.editThumb) {
                         const val = this.editThumb.trim();
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.editPreview = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.editBadge = 'Google Drive Cloud CDN (0 MB مساحة مستهلكة)';
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.editPreview = val;
                             this.editBadge = 'رابط خارجي';
                             return;
                         }
                         if (val) {
                             this.editPreview = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             this.editBadge = 'صورة حالية';
                             return;
                         }
                     }
                     if (this.editVideo) {
                         const val = this.editVideo.trim();
                         const ytMatch = val.match(/(?:youtube\.com\/(?:watch\?.*v=|shorts\/|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
                         if (ytMatch) {
                             this.editPreview = 'https://img.youtube.com/vi/' + ytMatch[1] + '/hqdefault.jpg';
                             this.editBadge = 'غلاف YouTube التلقائي';
                             return;
                         }
                     }
                     this.editPreview = '';
                     this.editBadge = '';
                 },
                 useYoutubeThumb() {
                     this.editThumb = '';
                     this.updatePreview();
                 },
                 onFileChosen(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.editPreview = URL.createObjectURL(file);
                         this.editBadge = 'صورة جديدة مرفوعة (' + file.name + ')';
                     }
                 }
             }"
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold"></i>
                    <span>تعديل بيانات العمل في معرض الموقع</span>
                </h3>
                <button @click="editPortfolioModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('cms/portfolio') }}/' + (selectedPortfolio ? selectedPortfolio.id : '')" enctype="multipart/form-data" class="space-y-3 text-xs">
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
                        <select name="category" x-model="editCategory" @change="updatePreview()" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
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

                <!-- Image / Design Options (Emphasized when Image category) -->
                <div class="p-3 rounded-xl bg-purple-950/40 border space-y-2 transition-all duration-300"
                     :class="isImageCat() ? 'border-amber-400/60 bg-amber-950/20 ring-1 ring-amber-400/30' : 'border-purple-800/40'">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-amber-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-image text-brand-gold"></i>
                            <span x-text="isImageCat() ? 'صورة العمل / التصميم الأساسي *' : 'صورة الغلاف / التصميم'"></span>
                        </label>
                        <button type="button" @click="useYoutubeThumb()" x-show="editVideo && (editVideo.includes('youtu.be') || editVideo.includes('youtube.com'))" class="text-[10px] text-amber-300 hover:text-white underline font-bold">
                            <i class="fa-brands fa-youtube ml-1"></i> جلب غلاف اليوتيوب تلقائياً
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">رفع صورة جديدة من جهازك:</label>
                            <input type="file" name="thumbnail_file" accept="image/*" @change="onFileChosen($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو كتابة رابط صورة (Google Drive أو مباشر):</label>
                            <input type="text" name="thumbnail" x-model="editThumb" @input="updatePreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-brand-gold font-medium mt-1">
                                <i class="fa-solid fa-cloud ml-1"></i> روابط Google Drive تُعرض مباشرة من Google Cloud (0 MB من السيرفر).
                            </p>
                        </div>
                    </div>

                    <!-- Live Thumbnail Preview in Edit Modal -->
                    <div x-show="editPreview" x-transition class="pt-2 border-t border-purple-800/40 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-brand-gold flex items-center gap-1.5">
                                <i class="fa-solid fa-eye text-emerald-400"></i>
                                <span>معاينة الغلاف الحالي / الجديد:</span>
                            </span>
                            <span class="px-2 py-0.5 rounded bg-brand-purple text-[10px] text-amber-300 font-medium" x-text="editBadge"></span>
                        </div>
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/70 border border-purple-800/60 flex items-center justify-center max-h-40 mx-auto">
                            <img :src="editPreview" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Video Options -->
                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-brand-gold">
                        <i class="fa-solid fa-play ml-1"></i>
                        <span x-text="isImageCat() ? 'فيديو العمل (اختياري تماماً للتصميمات)' : 'الفيديو الأساسي (اختياري)'"></span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">رابط YouTube أو فيديو خارجي:</label>
                            <input type="text" name="video_url" x-model="editVideo" @input="updatePreview()" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-emerald-400 font-medium mt-1">
                                <i class="fa-solid fa-circle-check ml-1"></i> يدعم روابط فيديوهات YouTube ويتم جلب غلافها تلقائياً.
                            </p>
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو تغيير ملف الفيديو (MP4):</label>
                            <input type="file" name="video_file" accept="video/mp4,video/webm,video/mov" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-purple file:text-brand-gold">
                        </div>
                    </div>
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

    <!-- 4. PARTNERS TAB (إدارة وتعديل شركاء النجاح والعلامات التجارية) -->
    <div x-show="tab === 'partners'" class="space-y-4" style="display: none;">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/60 border border-brand-border/60 p-4 rounded-2xl">
            <div>
                <h3 class="text-xs font-bold text-white">إدارة شركاء النجاح والعلامات التجارية في الصفحة الرئيسية</h3>
                <p class="text-[11px] text-gray-400">يمكنك هنا إضافة أو تعديل شعارات كبرى الشركات والمؤسسات التي تثق في وكالة بريق وتنعكس في الشريط المتحرك تلقائياً.</p>
            </div>
            <button @click="addPartnerModal = true" type="button" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow-lg flex items-center gap-2 self-start sm:self-auto whitespace-nowrap">
                <i class="fa-solid fa-plus-circle"></i>
                <span>إضافة شريك / علامة تجارية جديدة</span>
            </button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse($partners as $partner)
            <div class="bg-brand-card border border-brand-border rounded-2xl p-3 flex flex-col justify-between hover:border-brand-yellow/50 transition shadow group">
                <!-- Large Logo Box with Clean White Background for Maximum Clarity (مثل لوجو جوكار والشركات الكبرى) -->
                <div class="w-full h-24 sm:h-28 rounded-xl bg-white p-3 flex items-center justify-center overflow-hidden shadow-inner border border-gray-100 group-hover:scale-[1.02] transition-transform"
                     title="{{ $partner->name }}">
                    @if($partner->display_logo)
                    <img src="{{ $partner->display_logo }}" alt="{{ $partner->name }}" referrerpolicy="no-referrer" class="max-w-full max-h-full object-contain filter group-hover:scale-105 transition-transform" onerror="this.onerror=null; this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='block';">
                    <span style="display: none;" class="font-black text-gray-900 text-xs font-sans text-center">{{ $partner->name }}</span>
                    @else
                    <span class="font-black text-gray-900 text-xs font-sans text-center">{{ $partner->name }}</span>
                    @endif
                </div>

                <div class="pt-2.5 mt-2 border-t border-brand-border/40 flex items-center justify-between text-xs">
                    <span class="text-[10px] font-bold {{ $partner->is_active ? 'text-emerald-400' : 'text-rose-400' }}">
                        {{ $partner->is_active ? 'نشط' : 'معطل' }}
                    </span>

                    <div class="flex items-center gap-1.5">
                        <button type="button" 
                                @click="selectedPartner = {{ json_encode($partner) }}; editPartnerModal = true" 
                                class="p-1.5 text-brand-gold hover:text-white transition" title="تعديل الشريك ({{ $partner->name }})">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <form method="POST" action="{{ route('cms.partners.destroy', $partner->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا الشريك؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-400 transition" title="حذف">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-400">
                لا توجد علامات تجارية مسجلة. انقر على "إضافة شريك / علامة تجارية جديدة" للبدء.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 5. TESTIMONIALS TAB (إدارة آراء العملاء وفيديوهات الفيدباك) -->
    <div x-show="tab === 'testimonials'" class="space-y-4" style="display: none;">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/60 border border-brand-border/60 p-4 rounded-2xl">
            <div>
                <h3 class="text-xs font-bold text-white">إدارة آراء العملاء وفيديوهات الفيدباك (شكل جو ميديا الدائري ثلاثي الأبعاد)</h3>
                <p class="text-[11px] text-gray-400">يمكنك هنا إضافة وتعديل فيديوهات الريلز الطولية وشهادات وتقييمات العملاء الموثقة التي تظهر في قسم الفيدباك بالصفحة الرئيسية.</p>
            </div>
            <button @click="addTestimonialModal = true" type="button" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow-lg flex items-center gap-2 self-start sm:self-auto whitespace-nowrap">
                <i class="fa-solid fa-plus-circle"></i>
                <span>إضافة فيدباك / رأي عميل جديد</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($testimonials as $test)
            <div class="bg-brand-card border border-brand-border rounded-2xl overflow-hidden flex flex-col justify-between hover:border-brand-yellow/50 transition shadow group">
                <div>
                    <!-- Header Info -->
                    <div class="p-4 border-b border-brand-border/50 flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $test->type === 'video_reel' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : ($test->type === 'image_review' ? 'bg-purple-500/20 text-purple-300 border border-purple-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30') }}">
                            @if($test->type === 'video_reel')
                                <i class="fa-solid fa-mobile-screen ml-1"></i> فيديو ريلز طولي
                            @elseif($test->type === 'image_review')
                                <i class="fa-solid fa-image ml-1"></i> صورة فيدباك
                            @else
                                <i class="fa-solid fa-comment-dots ml-1"></i> تقييم كتابي موثق
                            @endif
                        </span>
                        <div class="text-brand-gold text-xs flex gap-0.5">
                            @for($i = 0; $i < ($test->rating ?? 5); $i++)
                            <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                    </div>

                    <!-- Visual / Media Preview if any -->
                    @php
                        $tCardThumb = $test->display_thumbnail ?: ($test->thumbnail ? \App\Support\MediaHelper::formatDisplayUrl($test->thumbnail) : null);
                        if (!$tCardThumb && !empty($test->media_url)) {
                            $ytId = \App\Support\MediaHelper::extractYouTubeId($test->media_url);
                            if ($ytId) {
                                $tCardThumb = 'https://img.youtube.com/vi/' . $ytId . '/hqdefault.jpg';
                            }
                        }
                    @endphp
                    @if($tCardThumb || $test->media_url)
                    <div class="relative aspect-video bg-black/60 overflow-hidden">
                        @if($tCardThumb)
                        <img src="{{ $tCardThumb }}" alt="{{ $test->client_name }}" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                        @endif
                        @if($test->type === 'video_reel')
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center pointer-events-none">
                            <div class="w-10 h-10 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center text-sm shadow">
                                <i class="fa-solid fa-play mr-0.5"></i>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Content & Client Info -->
                    <div class="p-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-white text-sm">{{ $test->client_name }}</h4>
                            <span class="text-[11px] text-gray-400">{{ $test->client_country }}</span>
                        </div>
                        @if($test->client_title)
                        <div class="text-xs text-brand-gold font-semibold">{{ $test->client_title }}</div>
                        @endif
                        <p class="text-xs text-gray-300 leading-relaxed line-clamp-3 italic">"{{ $test->content }}"</p>
                    </div>
                </div>

                <!-- Footer & Actions -->
                <div class="p-4 pt-2 border-t border-brand-border/40 flex items-center justify-between text-xs">
                    <span class="text-[11px] font-bold {{ $test->is_active ? 'text-emerald-400' : 'text-rose-400' }}">
                        {{ $test->is_active ? 'ظاهر بالموقع' : 'معطل' }}
                    </span>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                @click="selectedTestimonial = {{ json_encode($test) }}; editTestimonialModal = true" 
                                class="px-3 py-1.5 rounded-lg bg-brand-purple hover:bg-brand-hover text-brand-gold hover:text-white border border-brand-border text-xs font-bold transition flex items-center gap-1.5">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>تعديل</span>
                        </button>
                        <form method="POST" action="{{ route('cms.testimonials.destroy', $test->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا الفيدباك؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-400 transition" title="حذف">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-400">
                لا توجد تقييمات أو فيدباك مضاف حتى الآن. انقر على "إضافة فيدباك / رأي عميل جديد" للبدء.
            </div>
            @endforelse
        </div>
    </div>

    <!-- 6. PLATFORM STATS TAB (إدارة إحصائيات المنصة ومؤشرات النجاح) -->
    <div x-show="tab === 'stats'" class="space-y-6" style="display: none;" 
         x-data="{
             syncMode: '{{ $stats['sync_mode'] ?? 'custom' }}',
             projectsCount: '{{ $stats['projects_count'] ?? 480 }}',
             projectsLabel: '{{ $stats['projects_label'] ?? 'مشروع مكتمل بنجاح' }}',
             clientsCount: '{{ $stats['clients_count'] ?? 125 }}',
             clientsLabel: '{{ $stats['clients_label'] ?? 'عميل سعيد في 6 دول' }}',
             yearsCount: '{{ $stats['years_count'] ?? 6 }}',
             yearsLabel: '{{ $stats['years_label'] ?? 'سنوات خبرة متواصلة' }}',
             teamCount: '{{ $stats['team_count'] ?? 18 }}',
             teamLabel: '{{ $stats['team_label'] ?? 'مبدع وخبير متخصص' }}',
             copyRealMetrics() {
                 this.projectsCount = '{{ $stats['real_projects'] ?? 20 }}';
                 this.clientsCount = '{{ $stats['real_clients'] ?? 44 }}';
                 this.teamCount = '{{ $stats['real_team'] ?? 8 }}';
                 this.syncMode = 'custom';
             }
         }">
        
        <!-- Header Banner -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-brand-card/90 border border-brand-border p-5 rounded-2xl shadow-lg relative overflow-hidden">
            <div class="space-y-1 relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-orange/15 border border-brand-orange/40 text-brand-orange text-xs font-bold">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>إدارة شريط الإحصائيات الرئيسي (Live Platform Counters)</span>
                </div>
                <h3 class="text-base font-bold text-white">إحصائيات وأرقام نجاح وكالة بريق بالموقع</h3>
                <p class="text-xs text-gray-400 max-w-2xl leading-relaxed">
                    تحكم بالكامل في الأرقام التي تظهر لزوار موقع بريق. يمكنك تفعيل السحب اللحظي التلقائي من قاعدة البيانات، أو كتابة أرقام وعناوين تسويقية مخصصة تناسب استراتيجيتك.
                </p>
            </div>

            <!-- Quick Copy Button -->
            <button type="button" @click="copyRealMetrics()" 
                    class="px-4 py-2.5 rounded-xl bg-purple-900/60 hover:bg-brand-orange hover:text-brand-dark text-white border border-purple-700/60 font-bold text-xs transition flex items-center gap-2 shadow-md self-start md:self-auto whitespace-nowrap active:scale-95">
                <i class="fa-solid fa-copy text-brand-peach"></i>
                <span>نسخ أرقام المنصة الحالية إلى الحقول</span>
            </button>
        </div>

        <!-- LIVE PREVIEW CARDS (معاينة حية لشكل الكروت في الموقع الخارجي) -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-eye text-brand-orange"></i>
                    <span>معاينة حية لشكل الكروت في واجهة الموقع (مطابقة لباليتة بريق الجديدة)</span>
                </span>
                <span class="text-[11px] text-gray-400">تتحدث المعاينة مباشرة مع كتابتك أدناه</span>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-5 rounded-2xl bg-[#0e031a] border border-purple-900/40">
                <!-- Card 1: Projects -->
                <div class="p-5 rounded-2xl bg-[#1B082B] border border-brand-orange/60 shadow-[0_0_25px_rgba(255,148,32,0.2)] text-center transition-all">
                    <div class="w-11 h-11 rounded-2xl bg-[#FF9420]/15 border border-[#FF9420]/40 text-[#FF9420] flex items-center justify-center mx-auto mb-2 text-lg">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-[#FF9420] font-mono">
                        <span>+</span><span x-text="syncMode === 'live' ? '{{ $stats['real_projects'] > 0 ? $stats['real_projects'] : $stats['projects_count'] }}' : projectsCount">480</span>
                    </div>
                    <div class="text-xs text-gray-200 mt-1.5 font-bold" x-text="projectsLabel">مشروع مكتمل بنجاح</div>
                </div>

                <!-- Card 2: Clients -->
                <div class="p-5 rounded-2xl bg-[#1B082B] border border-[#3E24C5]/40 text-center transition-all">
                    <div class="w-11 h-11 rounded-2xl bg-[#3E24C5]/20 border border-[#3E24C5]/50 text-[#FFBA70] flex items-center justify-center mx-auto mb-2 text-lg">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-white font-mono">
                        <span>+</span><span x-text="syncMode === 'live' ? '{{ $stats['real_clients'] > 0 ? $stats['real_clients'] : $stats['clients_count'] }}' : clientsCount">125</span>
                    </div>
                    <div class="text-xs text-gray-200 mt-1.5 font-bold" x-text="clientsLabel">عميل سعيد في 6 دول</div>
                </div>

                <!-- Card 3: Years -->
                <div class="p-5 rounded-2xl bg-[#1B082B] border border-[#3E24C5]/40 text-center transition-all">
                    <div class="w-11 h-11 rounded-2xl bg-[#BC6200]/20 border border-[#FFBA70]/40 text-[#FFBA70] flex items-center justify-center mx-auto mb-2 text-lg">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-[#FFBA70] font-mono">
                        <span>+</span><span x-text="yearsCount">6</span>
                    </div>
                    <div class="text-xs text-gray-200 mt-1.5 font-bold" x-text="yearsLabel">سنوات خبرة متواصلة</div>
                </div>

                <!-- Card 4: Team -->
                <div class="p-5 rounded-2xl bg-[#1B082B] border border-[#3E24C5]/40 text-center transition-all">
                    <div class="w-11 h-11 rounded-2xl bg-[#FF9420]/15 border border-[#FF9420]/40 text-[#FF9420] flex items-center justify-center mx-auto mb-2 text-lg">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-white font-mono">
                        <span>+</span><span x-text="syncMode === 'live' ? '{{ $stats['real_team'] > 0 ? $stats['real_team'] : $stats['team_count'] }}' : teamCount">18</span>
                    </div>
                    <div class="text-xs text-gray-200 mt-1.5 font-bold" x-text="teamLabel">مبدع وخبير متخصص</div>
                </div>
            </div>
        </div>

        <!-- FORM: EDIT SETTINGS -->
        <form method="POST" action="{{ route('cms.stats.update') }}" class="space-y-6">
            @csrf

            <!-- Sync Mode Selector -->
            <div class="bg-brand-card border border-brand-border rounded-2xl p-5 shadow-sm space-y-4">
                <h4 class="text-xs font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-brand-orange"></i>
                    <span>وضع تشغيل الإحصائيات في الموقع</span>
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Option 1: Custom Override -->
                    <label class="relative flex items-start gap-3 p-4 rounded-xl border cursor-pointer transition"
                           :class="syncMode === 'custom' ? 'bg-brand-purple/80 border-brand-orange shadow-[0_0_20px_rgba(255,148,32,0.15)]' : 'bg-brand-dark/50 border-brand-border/60 hover:border-brand-border'">
                        <input type="radio" name="stat_sync_mode" value="custom" x-model="syncMode" class="mt-1 text-brand-orange focus:ring-brand-orange">
                        <div class="space-y-1 text-right">
                            <span class="block text-xs font-bold text-white">أرقام وعناوين مخصصة (Custom Override)</span>
                            <span class="block text-[11px] text-gray-400">إدخال الأرقام التسويقية والعناوين يدوياً كما تحددها في الحقول بالأسفل (المفضل لأغراض الدعاية).</span>
                        </div>
                    </label>

                    <!-- Option 2: Live Platform Sync -->
                    <label class="relative flex items-start gap-3 p-4 rounded-xl border cursor-pointer transition"
                           :class="syncMode === 'live' ? 'bg-brand-purple/80 border-brand-orange shadow-[0_0_20px_rgba(255,148,32,0.15)]' : 'bg-brand-dark/50 border-brand-border/60 hover:border-brand-border'">
                        <input type="radio" name="stat_sync_mode" value="live" x-model="syncMode" class="mt-1 text-brand-orange focus:ring-brand-orange">
                        <div class="space-y-1 text-right">
                            <span class="block text-xs font-bold text-white">سحب تلقائي لحظي من قاعدة بيانات المنصة (Live Sync)</span>
                            <span class="block text-[11px] text-gray-400">حساب عدد المشاريع المنجزة، العملاء المسجلين، وأعضاء الفريق تلقائياً من المنصة مع إمكانية تعديل العناوين.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Detailed Stat Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Stat 1: Projects -->
                <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-orange-500/20 text-brand-orange flex items-center justify-center text-xs">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                            <span class="text-xs font-bold text-white">إحصائية المشاريع المكتملة</span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-mono">في المنصة: {{ $stats['real_projects'] }} مشروع</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">الرقم المستهدف</label>
                            <input type="number" name="stat_projects_count" x-model="projectsCount" required min="0" 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white font-mono text-sm focus:outline-none focus:border-brand-orange">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">النص التوضيحي للبطاقة</label>
                            <input type="text" name="stat_projects_label" x-model="projectsLabel" required 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-orange">
                        </div>
                    </div>
                </div>

                <!-- Stat 2: Clients -->
                <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-purple-500/20 text-purple-300 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <span class="text-xs font-bold text-white">إحصائية العملاء وسعادتهم</span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-mono">في المنصة: {{ $stats['real_clients'] }} عميل</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">الرقم المستهدف</label>
                            <input type="number" name="stat_clients_count" x-model="clientsCount" required min="0" 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white font-mono text-sm focus:outline-none focus:border-brand-orange">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">النص التوضيحي للبطاقة</label>
                            <input type="text" name="stat_clients_label" x-model="clientsLabel" required 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-orange">
                        </div>
                    </div>
                </div>

                <!-- Stat 3: Years of Experience -->
                <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-amber-500/20 text-brand-peach flex items-center justify-center text-xs">
                                <i class="fa-solid fa-award"></i>
                            </span>
                            <span class="text-xs font-bold text-white">إحصائية سنوات الخبرة</span>
                        </div>
                        <span class="text-[10px] text-brand-peach font-bold">تراكم الخبرات</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">عدد السنوات</label>
                            <input type="number" name="stat_years_count" x-model="yearsCount" required min="0" 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white font-mono text-sm focus:outline-none focus:border-brand-orange">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">النص التوضيحي للبطاقة</label>
                            <input type="text" name="stat_years_label" x-model="yearsLabel" required 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-orange">
                        </div>
                    </div>
                </div>

                <!-- Stat 4: Team -->
                <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-orange-500/20 text-orange-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-user-group"></i>
                            </span>
                            <span class="text-xs font-bold text-white">إحصائية المبدعين والخبراء</span>
                        </div>
                        <span class="text-[10px] text-gray-400 font-mono">في المنصة: {{ $stats['real_team'] }} عضو</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">عدد الخبراء والمبدعين</label>
                            <input type="number" name="stat_team_count" x-model="teamCount" required min="0" 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white font-mono text-sm focus:outline-none focus:border-brand-orange">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-300 mb-1">النص التوضيحي للبطاقة</label>
                            <input type="text" name="stat_team_label" x-model="teamLabel" required 
                                   class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-orange">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="submit" 
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-brand-orange via-brand-peach to-brand-bronze text-brand-dark font-black text-xs hover:brightness-110 shadow-lg shadow-orange-500/20 flex items-center gap-2 transition active:scale-95">
                    <i class="fa-solid fa-check-circle"></i>
                    <span>حفظ وتحديث إحصائيات الموقع فوراً</span>
                </button>
            </div>
        </form>
    </div>

    <!-- 7. TEAM MEMBERS TAB (إدارة وتعديل أعضاء فريق العمل - من نحن) -->
    <div x-show="tab === 'team'" class="space-y-4" style="display: none;">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-brand-card/60 border border-brand-border/60 p-4 rounded-2xl">
            <div>
                <h3 class="text-xs font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-users text-brand-orange"></i>
                    <span>إدارة وتعديل أعضاء فريق العمل (صفحة من نحن)</span>
                </h3>
                <p class="text-[11px] text-gray-400">يمكنك هنا إضافة أو تعديل أو حذف أي عضو في الفريق، وتغيير المسمى الوظيفي، واقتباس العضو، وتعيين صورة حقيقية (عبر الرفع المباشر أو رابط Google Drive).</p>
            </div>
            <button @click="addTeamModal = true" type="button" 
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-l from-brand-amber to-brand-yellow text-brand-dark font-black text-xs hover:brightness-110 shadow-lg flex items-center gap-2 self-start sm:self-auto whitespace-nowrap">
                <i class="fa-solid fa-user-plus"></i>
                <span>إضافة عضو فريق جديد</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($teamMembers as $tm)
            <div class="bg-brand-card border border-brand-border rounded-2xl p-5 space-y-4 flex flex-col justify-between hover:border-brand-yellow/50 transition shadow group">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <!-- Profile Photo -->
                        <div class="relative">
                            @if($tm->display_image)
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-brand-orange shadow-md p-0.5 bg-[#1B082B]">
                                <img src="{{ $tm->display_image }}" alt="{{ $tm->name }}" referrerpolicy="no-referrer" class="w-full h-full object-cover object-top rounded-full">
                            </div>
                            @else
                            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-brand-orange to-[#FF7A00] text-brand-dark font-black text-2xl flex items-center justify-center shadow-lg">
                                {{ $tm->letter ?? mb_substr($tm->name, 0, 1, 'UTF-8') }}
                            </div>
                            @endif
                            <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full {{ $tm->is_active ? 'bg-emerald-500' : 'bg-gray-500' }} border-2 border-brand-card shadow"></span>
                        </div>

                        <div class="text-left flex flex-col items-end">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $tm->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-400 border border-rose-500/30' }}">
                                {{ $tm->is_active ? 'ظاهر بالموقع' : 'معطل' }}
                            </span>
                            <span class="text-[10px] text-gray-400 font-mono mt-1">#{{ $tm->sort_order }}</span>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-white text-base leading-snug">{{ $tm->name }}</h4>
                        <div class="text-xs text-brand-gold font-bold mt-0.5">{{ $tm->role }}</div>
                        @if($tm->dept)
                        <div class="text-[11px] text-gray-400 mt-0.5">{{ $tm->dept }}</div>
                        @endif
                    </div>

                    @if($tm->quote)
                    <p class="text-xs text-gray-300 leading-relaxed italic border-t border-brand-border/40 pt-2 line-clamp-3">
                        "{{ $tm->quote }}"
                    </p>
                    @endif
                </div>

                <div class="pt-3 border-t border-brand-border/60 flex items-center justify-between text-xs">
                    <span class="text-[10px] text-gray-400 flex items-center gap-1">
                        <i class="{{ $tm->icon ?? 'fa-solid fa-user' }} text-brand-orange"></i>
                        <span>عضو بريق</span>
                    </span>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                                @click="selectedTeamMember = {{ json_encode($tm) }}; editTeamModal = true" 
                                class="px-3 py-1.5 rounded-lg bg-brand-purple hover:bg-brand-hover text-brand-gold hover:text-white border border-brand-border text-xs font-bold transition flex items-center gap-1.5">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>تعديل</span>
                        </button>

                        <form method="POST" action="{{ route('cms.team-members.destroy', $tm->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف عضو الفريق {{ $tm->name }} نهائياً من الموقع؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-400 transition" title="حذف العضو">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12 text-gray-400">
                لا يوجد أعضاء فريق مضافين حتى الآن. انقر على زر "إضافة عضو فريق جديد" للبدء.
            </div>
            @endforelse
        </div>
    </div>

    <!-- MODAL: ADD PARTNER -->
    <div x-show="addPartnerModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addPartnerModal = false" 
             x-data="{
                 logoInput: '',
                 logoPreview: '',
                 checkPreview() {
                     if (this.logoInput) {
                         const val = this.logoInput.trim();
                         const driveMatch = val.match(/(?:file\/d\/|id=|open\?id=|\/d\/)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.logoPreview = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.logoPreview = val;
                             return;
                         }
                         if (val) {
                             this.logoPreview = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             return;
                         }
                     }
                     this.logoPreview = '';
                 },
                 onFile(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.logoPreview = URL.createObjectURL(file);
                     }
                 }
             }"
             class="w-full max-w-md bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-handshake text-brand-gold"></i>
                    <span>إضافة شريك نجاح أو علامة تجارية</span>
                </h3>
                <button @click="addPartnerModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.partners.store') }}" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم الشريك / العلامة التجارية <span class="text-red-400">*</span></label>
                    <input type="text" name="name" required placeholder="مثال: Mercedes-Benz أو مطاعم شاورماكر" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">المجال / التصنيف</label>
                    <input type="text" name="category" placeholder="مثال: سيارات فاخرة / أغذية ومطاعم / رعاية صحية" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-amber-300">
                        <i class="fa-solid fa-image ml-1"></i>
                        شعار الشريك (اللوجو)
                    </label>
                    <div>
                        <label class="block text-[11px] text-brand-gold font-bold mb-1">رفع لوجو من جهازك (PNG/WebP/SVG شفاف):</label>
                        <input type="file" name="logo_file" accept="image/*" @change="onFile($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                    </div>
                    <div>
                        <label class="block text-[11px] text-gray-400 mb-1">أو رابط الشعار (يدعم روابط Google Drive المباشرة):</label>
                        <input type="text" name="logo_url" x-model="logoInput" @input="checkPreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        <p class="text-[10px] text-brand-gold font-medium mt-1">
                            <i class="fa-solid fa-cloud-arrow-down ml-1"></i> روابط Google Drive يتم تنزيلها وتخزينها محلياً بالسيرفر فوراً لضمان سرعة التحميل وعدم الحظر.
                        </p>
                    </div>

                    <!-- Live Logo Preview in White Box -->
                    <div x-show="logoPreview" x-transition class="pt-2 border-t border-purple-800/40 text-center space-y-1.5">
                        <span class="text-[10px] text-brand-gold font-bold block">معاينة ظهور اللوجو داخل كرت الشريك الأبيض:</span>
                        <div class="w-44 h-24 rounded-2xl bg-white p-3 mx-auto flex items-center justify-center shadow-lg border border-gray-200">
                            <img :src="logoPreview" referrerpolicy="no-referrer" class="max-w-full max-h-full object-contain">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="partner_active" checked class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="partner_active" class="text-xs text-gray-300 cursor-pointer">تفعيل وظهور الشريك فوراً في الشريط المتحرك بالصفحة الرئيسية</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addPartnerModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">إضافة الشريك</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT PARTNER -->
    <div x-show="editPartnerModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editPartnerModal = false" 
             x-data="{
                 editLogoInput: '',
                 editLogoPreview: '',
                 init() {
                     this.$watch('editPartnerModal', (val) => {
                         if (val && this.selectedPartner) {
                             this.editLogoInput = this.selectedPartner.logo_url || '';
                             this.updatePreview();
                         }
                     });
                 },
                 updatePreview() {
                     if (this.editLogoInput) {
                         const val = this.editLogoInput.trim();
                         const driveMatch = val.match(/(?:file\/d\/|id=|open\?id=|\/d\/)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.editLogoPreview = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.editLogoPreview = val;
                             return;
                         }
                         if (val) {
                             this.editLogoPreview = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             return;
                         }
                     }
                     this.editLogoPreview = '';
                 },
                 onFile(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.editLogoPreview = URL.createObjectURL(file);
                     }
                 }
             }"
             class="w-full max-w-md bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold"></i>
                    <span>تعديل بيانات الشريك والعلامة التجارية</span>
                </h3>
                <button @click="editPartnerModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('cms/partners') }}/' + (selectedPartner ? selectedPartner.id : '')" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-bold text-gray-300 mb-1">اسم الشريك / العلامة التجارية <span class="text-red-400">*</span></label>
                    <input type="text" name="name" required x-bind:value="selectedPartner ? selectedPartner.name : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">المجال / التصنيف</label>
                    <input type="text" name="category" x-bind:value="selectedPartner ? selectedPartner.category : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                </div>

                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-amber-300">
                        <i class="fa-solid fa-image ml-1"></i>
                        شعار الشريك (اللوجو)
                    </label>
                    <div>
                        <label class="block text-[11px] text-brand-gold font-bold mb-1">تغيير اللوجو من جهازك:</label>
                        <input type="file" name="logo_file" accept="image/*" @change="onFile($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                    </div>
                    <div>
                        <label class="block text-[11px] text-gray-400 mb-1">أو رابط الشعار (يدعم Google Drive مباشرة):</label>
                        <input type="text" name="logo_url" x-model="editLogoInput" @input="updatePreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        <p class="text-[10px] text-brand-gold font-medium mt-1">
                            <i class="fa-solid fa-cloud-arrow-down ml-1"></i> روابط Google Drive يتم حفظها محلياً بالسيرفر تلقائياً.
                        </p>
                    </div>

                    <!-- Live Logo Preview in White Box -->
                    <div x-show="editLogoPreview" x-transition class="pt-2 border-t border-purple-800/40 text-center space-y-1.5">
                        <span class="text-[10px] text-brand-gold font-bold block">معاينة ظهور اللوجو داخل كرت الشريك الأبيض:</span>
                        <div class="w-44 h-24 rounded-2xl bg-white p-3 mx-auto flex items-center justify-center shadow-lg border border-gray-200">
                            <img :src="editLogoPreview" referrerpolicy="no-referrer" class="max-w-full max-h-full object-contain">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="edit_partner_active" :checked="selectedPartner && selectedPartner.is_active" class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="edit_partner_active" class="text-xs text-gray-300 cursor-pointer">الشريك مفعل ونشط في الموقع</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editPartnerModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD TESTIMONIAL (إضافة فيدباك جديد) -->
    <div x-show="addTestimonialModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addTestimonialModal = false" 
             x-data="{
                 type: 'video_reel',
                 mediaUrl: '',
                 thumbUrl: '',
                 previewSrc: '',
                 previewBadge: '',
                 updatePreview() {
                     // 1. If custom thumbnail provided (Google Drive or direct URL)
                     if (this.thumbUrl) {
                         const val = this.thumbUrl.trim();
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.previewSrc = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.previewBadge = 'Google Drive Cloud CDN (0 MB مساحة)';
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.previewSrc = val;
                             this.previewBadge = 'رابط صورة خارجي';
                             return;
                         }
                         if (val) {
                             this.previewSrc = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             this.previewBadge = 'مسار محلي';
                             return;
                         }
                     }

                     // 2. If video URL provided (YouTube Shorts, YouTube video, Google Drive)
                     if (this.mediaUrl) {
                         const val = this.mediaUrl.trim();
                         const ytMatch = val.match(/(?:(?:youtube\.com|youtu\.be)?\/(?:watch\?.*v=|shorts\/|embed\/|v\/)|youtu\.be\/|^\/?shorts\/|shorts\/)([a-zA-Z0-9_-]{11})/i);
                         if (ytMatch) {
                             this.previewSrc = 'https://img.youtube.com/vi/' + ytMatch[1] + '/hqdefault.jpg';
                             this.previewBadge = 'غلاف YouTube التلقائي (دقة عالية)';
                             return;
                         }
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.previewSrc = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.previewBadge = 'Google Drive';
                             return;
                         }
                     }

                     this.previewSrc = '';
                     this.previewBadge = '';
                 },
                 onFileChosen(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.previewSrc = URL.createObjectURL(file);
                         this.previewBadge = 'صورة مرفوعة من جهازك (' + file.name + ')';
                     }
                 }
             }"
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-comments text-brand-gold"></i>
                    <span>إضافة رأي عميل أو فيديو فيدباك جديد</span>
                </h3>
                <button @click="addTestimonialModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.testimonials.store') }}" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل <span class="text-red-400">*</span></label>
                        <input type="text" name="client_name" required placeholder="مثال: د. عبد الرحمن المجيدي" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الشركة أو المنصب</label>
                        <input type="text" name="client_title" placeholder="مثال: مجمع ماجستي الطبي" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة / المدينة</label>
                        <input type="text" name="client_country" placeholder="الرياض، السعودية" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-amber-300 mb-1">نوع الفيدباك <span class="text-red-400">*</span></label>
                        <select name="type" x-model="type" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video_reel">فيديو ريلز طولي (Reel 9:16)</option>
                            <option value="image_review">صورة تقييم معتمدة</option>
                            <option value="text_review">تقييم كتابي موثق</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">التقييم بالنجوم</label>
                        <select name="rating" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="5">⭐⭐⭐⭐⭐ (5 نجوم)</option>
                            <option value="4">⭐⭐⭐⭐ (4 نجوم)</option>
                            <option value="3">⭐⭐⭐ (3 نجوم)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">نص الشهادة / تجربة العميل <span class="text-red-400">*</span></label>
                    <textarea name="content" rows="3" required placeholder="اكتب تفاصيل تجربة العميل مع وكالة بريق وما حققته له الحملات أو الفيديوهات..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <!-- Video / Reel File or URL -->
                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-brand-gold">
                        <i class="fa-solid fa-play ml-1"></i>
                        فيديو الفيدباك (لفيديوهات الريلز)
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">رفع فيديو من جهازك (MP4):</label>
                            <input type="file" name="video_file" accept="video/mp4,video/webm,video/mov" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-purple file:text-brand-gold">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو رابط فيديو (يدعم Shorts و YouTube):</label>
                            <input type="text" name="media_url" x-model="mediaUrl" @input="updatePreview()" placeholder="/shorts/... أو رابط YouTube" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-emerald-400 font-medium mt-1">
                                <i class="fa-solid fa-circle-check ml-1"></i> يتم جلب صورة الغلاف تلقائياً من YouTube وبأعلى جودة.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-amber-300">
                            <i class="fa-solid fa-image ml-1"></i>
                            صورة الغلاف / صورة التقييم
                        </label>
                        <span class="text-[10px] text-gray-400">(اختياري في حال وجود فيديو يوتيوب)</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">رفع صورة من جهازك:</label>
                            <input type="file" name="thumbnail_file" accept="image/*" @change="onFileChosen($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-400 mb-1">أو رابط صورة (يدعم Google Drive مباشرة):</label>
                            <input type="text" name="thumbnail" x-model="thumbUrl" @input="updatePreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>

                    <!-- Live Thumbnail Preview -->
                    <div x-show="previewSrc" x-transition class="pt-2 border-t border-purple-800/40 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-brand-gold flex items-center gap-1.5">
                                <i class="fa-solid fa-eye text-emerald-400"></i>
                                <span>معاينة غلاف الفيدباك المعروض للزوار:</span>
                            </span>
                            <span class="px-2 py-0.5 rounded bg-brand-purple text-[10px] text-amber-300 font-medium" x-text="previewBadge"></span>
                        </div>
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/70 border border-purple-800/60 flex items-center justify-center max-h-40 mx-auto">
                            <img :src="previewSrc" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                            <div x-show="type === 'video_reel'" class="absolute inset-0 bg-black/30 flex items-center justify-center pointer-events-none">
                                <div class="w-10 h-10 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center text-sm shadow">
                                    <i class="fa-solid fa-play mr-0.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="test_active" checked class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="test_active" class="text-xs text-gray-300 cursor-pointer">تفعيل وظهور الفيدباك فوراً في الشكل الدائري ثلاثي الأبعاد بالصفحة الرئيسية</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addTestimonialModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">إضافة الفيدباك</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT TESTIMONIAL (تعديل الفيدباك الحالي) -->
    <div x-show="editTestimonialModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editTestimonialModal = false" 
             x-data="{
                 type: 'video_reel',
                 mediaUrl: '',
                 thumbUrl: '',
                 previewSrc: '',
                 previewBadge: '',
                 init() {
                     this.$watch('editTestimonialModal', (val) => {
                         if (val && this.selectedTestimonial) {
                             this.type = this.selectedTestimonial.type || 'video_reel';
                             this.mediaUrl = this.selectedTestimonial.media_url || '';
                             this.thumbUrl = this.selectedTestimonial.thumbnail || '';
                             this.updatePreview();
                         }
                     });
                 },
                 updatePreview() {
                     // 1. If custom thumbnail provided (Google Drive or direct URL)
                     if (this.thumbUrl) {
                         const val = this.thumbUrl.trim();
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.previewSrc = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.previewBadge = 'Google Drive Cloud CDN (0 MB مساحة)';
                             return;
                         }
                         if (val.startsWith('http://') || val.startsWith('https://')) {
                             this.previewSrc = val;
                             this.previewBadge = 'رابط صورة خارجي';
                             return;
                         }
                         if (val) {
                             this.previewSrc = '{{ asset('') }}' + val.replace(/^\/+/, '');
                             this.previewBadge = 'صورة حالية';
                             return;
                         }
                     }

                     // 2. If video URL provided (YouTube Shorts, YouTube video, Google Drive)
                     if (this.mediaUrl) {
                         const val = this.mediaUrl.trim();
                         const ytMatch = val.match(/(?:(?:youtube\.com|youtu\.be)?\/(?:watch\?.*v=|shorts\/|embed\/|v\/)|youtu\.be\/|^\/?shorts\/|shorts\/)([a-zA-Z0-9_-]{11})/i);
                         if (ytMatch) {
                             this.previewSrc = 'https://img.youtube.com/vi/' + ytMatch[1] + '/hqdefault.jpg';
                             this.previewBadge = 'غلاف YouTube التلقائي (دقة عالية)';
                             return;
                         }
                         const driveMatch = val.match(/(?:file(?:\/u\/\d+)?\/d\/|\/d\/|id=|open\?id=|\/folders\/|uc\?.*id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i);
                         if (driveMatch) {
                             this.previewSrc = 'https://lh3.googleusercontent.com/d/' + driveMatch[1];
                             this.previewBadge = 'Google Drive';
                             return;
                         }
                     }

                     this.previewSrc = '';
                     this.previewBadge = '';
                 },
                 onFileChosen(e) {
                     const file = e.target.files[0];
                     if (file) {
                         this.previewSrc = URL.createObjectURL(file);
                         this.previewBadge = 'صورة مرفوعة من جهازك (' + file.name + ')';
                     }
                 }
             }"
             class="w-full max-w-lg bg-brand-card border border-brand-border rounded-2xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-brand-gold"></i>
                    <span>تعديل رأي العميل / فيديو الفيدباك</span>
                </h3>
                <button @click="editTestimonialModal = false" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" :action="'{{ url('cms/testimonials') }}/' + (selectedTestimonial ? selectedTestimonial.id : '')" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العميل <span class="text-red-400">*</span></label>
                        <input type="text" name="client_name" required x-bind:value="selectedTestimonial ? selectedTestimonial.client_name : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الشركة أو المنصب</label>
                        <input type="text" name="client_title" x-bind:value="selectedTestimonial ? selectedTestimonial.client_title : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الدولة / المدينة</label>
                        <input type="text" name="client_country" x-bind:value="selectedTestimonial ? selectedTestimonial.client_country : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-amber-300 mb-1">نوع الفيدباك <span class="text-red-400">*</span></label>
                        <select name="type" x-model="type" required class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="video_reel">فيديو ريلز طولي (Reel 9:16)</option>
                            <option value="image_review">صورة تقييم معتمدة</option>
                            <option value="text_review">تقييم كتابي موثق</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">التقييم بالنجوم</label>
                        <select name="rating" x-bind:value="selectedTestimonial ? selectedTestimonial.rating : 5" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <option value="5">⭐⭐⭐⭐⭐ (5 نجوم)</option>
                            <option value="4">⭐⭐⭐⭐ (4 نجوم)</option>
                            <option value="3">⭐⭐⭐ (3 نجوم)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">نص الشهادة / تجربة العميل <span class="text-red-400">*</span></label>
                    <textarea name="content" rows="3" required x-bind:value="selectedTestimonial ? selectedTestimonial.content : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-brand-gold">
                        <i class="fa-solid fa-play ml-1"></i>
                        فيديو الفيدباك (لفيديوهات الريلز)
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">تغيير ملف الفيديو (MP4):</label>
                            <input type="file" name="video_file" accept="video/mp4,video/webm,video/mov" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-purple file:text-brand-gold">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو رابط فيديو (يدعم Shorts و YouTube):</label>
                            <input type="text" name="media_url" x-model="mediaUrl" @input="updatePreview()" placeholder="/shorts/... أو رابط YouTube" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                            <p class="text-[10px] text-emerald-400 font-medium mt-1">
                                <i class="fa-solid fa-circle-check ml-1"></i> يدعم روابط Shorts ويتم جلب غلافها تلقائياً.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-amber-300">
                            <i class="fa-solid fa-image ml-1"></i>
                            صورة الغلاف / صورة التقييم
                        </label>
                        <span class="text-[10px] text-gray-400">(اختياري في حال وجود فيديو يوتيوب)</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">تغيير صورة الغلاف من جهازك:</label>
                            <input type="file" name="thumbnail_file" accept="image/*" @change="onFileChosen($event)" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-400 mb-1">أو رابط صورة (يدعم Google Drive مباشرة):</label>
                            <input type="text" name="thumbnail" x-model="thumbUrl" @input="updatePreview()" placeholder="https://drive.google.com/file/d/.../view" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>

                    <!-- Live Thumbnail Preview in Edit Modal -->
                    <div x-show="previewSrc" x-transition class="pt-2 border-t border-purple-800/40 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="font-bold text-brand-gold flex items-center gap-1.5">
                                <i class="fa-solid fa-eye text-emerald-400"></i>
                                <span>معاينة غلاف الفيدباك المعروض للزوار:</span>
                            </span>
                            <span class="px-2 py-0.5 rounded bg-brand-purple text-[10px] text-amber-300 font-medium" x-text="previewBadge"></span>
                        </div>
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/70 border border-purple-800/60 flex items-center justify-center max-h-40 mx-auto">
                            <img :src="previewSrc" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                            <div x-show="type === 'video_reel'" class="absolute inset-0 bg-black/30 flex items-center justify-center pointer-events-none">
                                <div class="w-10 h-10 rounded-full bg-brand-yellow text-brand-dark flex items-center justify-center text-sm shadow">
                                    <i class="fa-solid fa-play mr-0.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="edit_test_active" :checked="selectedTestimonial && selectedTestimonial.is_active" class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="edit_test_active" class="text-xs text-gray-300 cursor-pointer">الفيدباك مفعل ونشط في الموقع</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editTestimonialModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: ADD TEAM MEMBER -->
    <div x-show="addTeamModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="addTeamModal = false" class="w-full max-w-xl bg-brand-card border border-brand-border rounded-3xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-brand-gold"></i>
                    <span>إضافة عضو جديد لفريق العمل (من نحن)</span>
                </h3>
                <button @click="addTeamModal = false" type="button" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" action="{{ route('cms.team-members.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العضو <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required placeholder="مثال: سيف عادل" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المسمى الوظيفي <span class="text-red-400">*</span></label>
                        <input type="text" name="role" required placeholder="مثال: المؤسس والمدير الإبداعي التنفيذي" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">القسم</label>
                        <input type="text" name="dept" placeholder="مثال: الإدارة العامة والإبداع" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الترتيب في الصفحة</label>
                        <input type="number" name="sort_order" value="{{ (isset($teamMembers) ? $teamMembers->count() : 0) + 1 }}" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">مقولة أو نبذة العضو</label>
                    <textarea name="quote" rows="2" placeholder="نص المقولة التي تظهر على بطاقة العضو..." class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <!-- Photo Options (Direct file or Google Drive / URL) -->
                <div class="p-3.5 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-amber-300 text-xs">
                        <i class="fa-solid fa-camera ml-1"></i>
                        صورة البروفايل الحقيقية للعضو
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">رفع صورة من جهازك (مباشر):</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو رابط صورة / Google Drive:</label>
                            <input type="text" name="image_url" placeholder="https://drive.google.com/file/d/... أو رابط صورة" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400">💡 يدعم روابط Google Drive تلقائياً (تأكد أن إذن الملف في درايف: "أي شخص لديه الرابط").</p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="team_active_add" checked class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="team_active_add" class="text-xs text-gray-300 cursor-pointer">تفعيل وظهور العضو في صفحة من نحن بالموقع</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="addTeamModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">إضافة العضو ونشره</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: EDIT TEAM MEMBER -->
    <div x-show="editTeamModal" 
         x-transition 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" 
         style="display: none;">
        <div @click.away="editTeamModal = false" class="w-full max-w-xl bg-brand-card border border-brand-border rounded-3xl p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-user-pen text-brand-gold"></i>
                    <span>تعديل بيانات عضو الفريق</span>
                </h3>
                <button @click="editTeamModal = false" type="button" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form method="POST" 
                  :action="'/cms/team-members/' + (selectedTeamMember ? selectedTeamMember.id : '')" 
                  enctype="multipart/form-data" 
                  class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">اسم العضو <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required x-bind:value="selectedTeamMember ? selectedTeamMember.name : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">المسمى الوظيفي <span class="text-red-400">*</span></label>
                        <input type="text" name="role" required x-bind:value="selectedTeamMember ? selectedTeamMember.role : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">القسم</label>
                        <input type="text" name="dept" x-bind:value="selectedTeamMember ? selectedTeamMember.dept : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-300 mb-1">الترتيب في الصفحة</label>
                        <input type="number" name="sort_order" x-bind:value="selectedTeamMember ? selectedTeamMember.sort_order : 0" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-300 mb-1">مقولة أو نبذة العضو</label>
                    <textarea name="quote" rows="2" x-bind:value="selectedTeamMember ? selectedTeamMember.quote : ''" class="w-full px-3 py-2 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold"></textarea>
                </div>

                <!-- Photo Options (Direct file or Google Drive / URL) -->
                <div class="p-3.5 rounded-xl bg-purple-950/40 border border-purple-800/40 space-y-2">
                    <label class="block font-bold text-amber-300 text-xs">
                        <i class="fa-solid fa-camera ml-1"></i>
                        تغيير صورة البروفايل الحقيقية للعضو
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] text-brand-gold font-bold mb-1">تغيير الصورة من جهازك:</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-gray-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-yellow file:text-brand-dark">
                        </div>
                        <div>
                            <label class="block text-[11px] text-gray-300 mb-1">أو رابط صورة / Google Drive:</label>
                            <input type="text" name="image_url" x-bind:value="selectedTeamMember ? (selectedTeamMember.image_url || '') : ''" placeholder="https://drive.google.com/file/d/... أو رابط صورة" class="w-full px-3 py-1.5 bg-brand-purple border border-brand-border rounded-xl text-white text-xs focus:outline-none focus:border-brand-gold">
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400">💡 يدعم روابط Google Drive تلقائياً (تأكد أن إذن الملف في درايف: "أي شخص لديه الرابط").</p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="edit_team_active" :checked="selectedTeamMember && selectedTeamMember.is_active" class="rounded bg-brand-purple border-brand-border text-brand-gold">
                    <label for="edit_team_active" class="text-xs text-gray-300 cursor-pointer">تفعيل وظهور العضو في صفحة من نحن بالموقع</label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-brand-border">
                    <button @click="editTeamModal = false" type="button" class="px-4 py-2 rounded-xl text-gray-300 hover:bg-brand-hover">إلغاء</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-brand-yellow hover:bg-brand-gold text-brand-dark font-black shadow">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
