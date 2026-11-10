@extends('layouts.public')

@section('title', 'من نحن | فريق عمل وكالة بريق للإعلام والتصميم')
@section('meta_description', 'تعرف على فريق عمل وكالة بريق: عقول مبدعة تتعاون بعقلية واحدة وشغف موحد لصناعة نجاح استثنائي لعلامتك التجارية في الوطن العربي.')

@section('content')
<!-- Hero Header for About -->
<section class="relative pt-36 pb-16 lg:pt-44 lg:pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10 text-center">
    
    <!-- Breadcrumb -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#1A0833]/80 border border-purple-700/40 text-xs text-gray-300 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-orange transition">الرئيسية</a>
        <span class="text-brand-orange">/</span>
        <span class="text-brand-orange font-bold">من نحن</span>
    </div>

    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight">
        شغف الإبداع وفريق متكامل 
        <span class="gold-gradient-text block mt-2 text-5xl sm:text-7xl">يتعاون بعقلية واحدة</span>
    </h1>

    <p class="text-sm sm:text-base text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed font-normal">
        في وكالة بريق، نؤمن بأن النجاح في التسويق وصناعة المحتوى ليس نتاج فرد واحد، بل ثمرة تكاتف فريق متكامل يجمع بين الرؤية الفنية السينمائية والاستراتيجية الرقمية القائمة على الأرقام والمبيعات.
    </p>

    <!-- Key Principles Badges -->
    <div class="flex flex-wrap items-center justify-center gap-3 pt-8 text-xs font-bold text-gray-300">
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ عقلية تعاون واحدة وشغف موحد</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ التزام صارم بمواعيد التسليم</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ جودة سينمائية 4K قياسية</span>
        <span class="px-4 py-2 rounded-xl bg-purple-900/40 border border-purple-700/40">✦ تركيز على الـ ROAS والمبيعات</span>
    </div>
</section>

<!-- 1. ABOUT PARIQ STORY & VALUES (قصة بريق وفلسفتنا) -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-8 sm:p-14 border border-purple-600/40 shadow-2xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-500/15 border border-brand-orange/30 text-brand-orange text-xs font-bold">
                    <i class="fa-solid fa-crown"></i>
                    <span>فلسفة وكالة بريق</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-white">لماذا تأسست بريق وما الذي يجعلنا مختلفين؟</h2>
                <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                    تأسست وكالة بريق لسد فجوة كبرى يعاني منها معظم أصحاب الأعمال: الشركات التي تقدم تصويراً سينمائياً غالباً لا تفهم في أرقام التسويق والعائد الإعلاني، وشركات الإعلانات غالباً لا تمتلك حساً بصرياً أو معدات إنتاجية فائقة.
                </p>
                <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                    لذلك دمجنا الاثنين معاً! نوفر لك طاقم إنتاج سينمائي متكامل يعمل جنباً إلى جنب مع خبراء إعلانات ممولة ومحللي سلوك المشترين بعقلية واحدة. النتيجة: محتوى يبهر العين ويقود المستهلك للشراء في نفس اللحظة.
                </p>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-4 border-t border-purple-800/40 text-center">
                    <div class="p-4 rounded-2xl bg-[#1B082B] border border-[#3E24C5]/40 hover:border-[#FF9420] transition-colors">
                        <div class="text-2xl font-black text-brand-orange font-mono">+{{ $stats['years_count'] ?? 6 }}</div>
                        <div class="text-[11px] text-gray-300 mt-1 font-bold">{{ $stats['years_label'] ?? 'سنوات خبرة متواصلة' }}</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#1B082B] border border-[#FF9420] shadow-[0_0_20px_rgba(255,148,32,0.18)]">
                        <div class="text-2xl font-black text-white font-mono">+{{ $stats['projects_count'] ?? 480 }}</div>
                        <div class="text-[11px] text-gray-300 mt-1 font-bold">{{ $stats['projects_label'] ?? 'مشروع منجز بنجاح' }}</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#1B082B] border border-[#3E24C5]/40 hover:border-[#FF9420] transition-colors col-span-2 sm:col-span-1">
                        <div class="text-2xl font-black text-brand-peach font-mono">+{{ $stats['clients_count'] ?? 125 }}</div>
                        <div class="text-[11px] text-gray-300 mt-1 font-bold">{{ $stats['clients_label'] ?? 'عميل سعيد في 6 دول' }}</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="conic-glow-border">
                    <div class="rounded-[1.4rem] bg-[#0E031A] p-6 space-y-4">
                        <h3 class="text-base font-black text-white flex items-center gap-2">
                            <i class="fa-solid fa-gem text-brand-orange"></i>
                            <span>قيمنا الجوهرية الأربعة:</span>
                        </h3>
                        <div class="space-y-3 text-xs text-gray-300">
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-orange block mb-1">1. الأرقام فوق الآراء:</strong>
                                نجاح الحملة يُقاس بالمبيعات والـ ROAS والمشاهدات الحقيقية وليس بالمجاملات.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-orange block mb-1">2. احترام المواعيد:</strong>
                                تسليم النسخ الأولية خلال 48-72 ساعة والتزام صارم بجدول النشر الشهري.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-orange block mb-1">3. الإتقان السينمائي:</strong>
                                استخدام كاميرات 4K وإضاءة وهندسة صوت احترافية دون أي تنازل.
                            </div>
                            <div class="p-3 rounded-xl bg-purple-900/30 border border-purple-800/40">
                                <strong class="text-brand-orange block mb-1">4. التعاون بعقلية واحدة:</strong>
                                كافة التخصصات تعمل معاً في غرفة تفكير واحدة لضمان انسجام الهوية والمخرجات.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     2. TEAM MEMBERS SECTION (أعضاء الفريق بالصور الحقيقية والمسميات مع إمكانية الإدارة من CMS)
     ========================================================================= -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10 border-t border-purple-900/40">
    
    <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
        <span class="text-xs font-black text-brand-orange uppercase tracking-widest px-4 py-1.5 rounded-full bg-brand-orange/10 border border-brand-orange/30">
            فريق صناع البريق
        </span>
        
        <!-- جملة السيكشن التي تدل علي التعاون بعقلية واحدة كما طلب العميل نصاً -->
        <h2 class="text-3xl sm:text-5xl font-black text-white leading-tight">
            عقول مبدعة تتعاون 
            <span class="gold-gradient-text">بعقلية واحدة</span> 
            لصناعة نجاح استثنائي
        </h2>
        
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
            فريق متناغم يجمع بين صانعي السينما، خبراء الميديا باينج، مبدعي الهويات البصرية، وكتّاب المحتوى؛ نعمل معاً بتكامل مطلق وتنسيق يومي دقيق لتكون علامتك التجارية في الصدارة دائماً.
        </p>
    </div>

    <!-- Team Members Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $sampleImg = asset('images/team/member_sample.jpg');
            $defaultMembers = [
                [
                    'name' => 'سيف عادل',
                    'role' => 'المؤسس والمدير الإبداعي التنفيذي',
                    'dept' => 'الإدارة العامة والإبداع',
                    'quote' => 'نصنع محتوى لا يُنسى يملأ العلامة بريقاً وهيبة ويحقق أرقام مبيعات حقيقية',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-crown',
                    'gradient' => 'from-brand-orange to-[#FF7A00]',
                    'letter' => 'س'
                ],
                [
                    'name' => 'م. كريم ممدوح',
                    'role' => 'مدير التصوير والإنتاج السينمائي',
                    'dept' => 'قسم التصوير والإخراج',
                    'quote' => 'الصورة السينمائية والإضاءة الدقيقة هي لغة الفخامة التي تجذب عميلك المستهدف',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-video',
                    'gradient' => 'from-purple-500 to-indigo-600',
                    'letter' => 'ك'
                ],
                [
                    'name' => 'أ. ياسمين الشريف',
                    'role' => 'مديرة تصميم الهويات البصرية',
                    'dept' => 'قسم التصميم والبراندنج',
                    'quote' => 'الهوية الناجحة هي شخصية كاملة تعكس قيم البراند وتترسخ في ذهن الجمهور',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-palette',
                    'gradient' => 'from-amber-400 to-orange-500',
                    'letter' => 'ي'
                ],
                [
                    'name' => 'أ. أحمد عبد المنعم',
                    'role' => 'خبير الإعلانات الممولة وميديا باينج',
                    'dept' => 'قسم الميديا باينج والنمو',
                    'quote' => 'كل مليم يُصرف في الإعلانات يجب أن يعود بأقصى ربحية ممكنة ومبيعات مؤكدة',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-chart-line',
                    'gradient' => 'from-emerald-500 to-teal-600',
                    'letter' => 'أ'
                ],
                [
                    'name' => 'أ. نورهان فوزي',
                    'role' => 'كبيرة كُتاب المحتوى والسكريبتات',
                    'dept' => 'قسم كتابة المحتوى والـ Copy',
                    'quote' => 'الكلمة المدروسة والـ Hook الخاطف في أول 3 ثوانٍ هما سر مضاعفة التحويل',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-pen-nib',
                    'gradient' => 'from-pink-500 to-rose-600',
                    'letter' => 'ن'
                ],
                [
                    'name' => 'أ. مروان خالد',
                    'role' => 'مهندس المونتاج والتلوين DaVinci',
                    'dept' => 'قسم المونتاج والبوست برودكشن',
                    'quote' => 'الإيقاع السريع وتناسق الألوان والمؤثرات الصوتية تصنع سحراً لا يقاوم',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-film',
                    'gradient' => 'from-blue-500 to-cyan-600',
                    'letter' => 'م'
                ],
                [
                    'name' => 'أ. زياد طارق',
                    'role' => 'مصمم الموشن جرافيك والمؤثرات',
                    'dept' => 'قسم الموشن والـ VFX',
                    'quote' => 'تحريك العناصر بدقة يضفي حيوية لا تضاهى على كل فكرة وفيديو',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-wand-magic-sparkles',
                    'gradient' => 'from-yellow-400 to-amber-500',
                    'letter' => 'ز'
                ],
                [
                    'name' => 'أ. رنا النجار',
                    'role' => 'مديرة نجاح العملاء والإنتاج',
                    'dept' => 'قسم إدارة المشاريع والجودة',
                    'quote' => 'رضا العميل والتسليم في الموعد المحدد هما الأساس الراسخ لكل شراكة ناجحة',
                    'image_url' => $sampleImg,
                    'icon' => 'fa-solid fa-handshake',
                    'gradient' => 'from-purple-600 to-brand-orange',
                    'letter' => 'ر'
                ]
            ];

            $membersList = (isset($teamMembers) && $teamMembers instanceof \Illuminate\Support\Collection && $teamMembers->isNotEmpty()) 
                ? $teamMembers 
                : collect($defaultMembers);
        @endphp

        @foreach($membersList as $tm)
        @php
            $isModel = $tm instanceof \App\Models\TeamMember;
            $name = $isModel ? $tm->name : $tm['name'];
            $role = $isModel ? $tm->role : $tm['role'];
            $dept = $isModel ? $tm->dept : $tm['dept'];
            $quote = $isModel ? $tm->quote : $tm['quote'];
            $icon = $isModel ? ($tm->icon ?: 'fa-solid fa-user') : ($tm['icon'] ?? 'fa-solid fa-user');
            $gradient = $isModel ? ($tm->gradient ?: 'from-brand-orange to-[#FF7A00]') : ($tm['gradient'] ?? 'from-brand-orange to-[#FF7A00]');
            $letter = $isModel ? ($tm->letter ?: mb_substr($name, 0, 1, 'UTF-8')) : ($tm['letter'] ?? mb_substr($name, 0, 1, 'UTF-8'));
            $imageUrl = $isModel ? $tm->display_image : ($tm['image_url'] ?? null);
            if (!$imageUrl) {
                $imageUrl = asset('images/team/member_sample.jpg');
            }
        @endphp
        <div class="glass-card-purple rounded-3xl p-6 sm:p-7 border border-purple-800/60 hover:border-brand-orange transition-all duration-500 group hover:-translate-y-2.5 flex flex-col justify-between shadow-2xl relative overflow-hidden">
            
            <!-- Ambient Top Card Glow -->
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#FF9420]/15 rounded-full blur-2xl pointer-events-none group-hover:bg-[#FF9420]/30 transition-all"></div>

            <div class="space-y-5 text-center flex flex-col items-center">
                
                <!-- Distinctive Luxury Circular Profile Photo Frame -->
                <div class="relative group/avatar mt-2">
                    
                    <!-- Outer Glowing Concentric Gradient Halo -->
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full p-1 bg-gradient-to-tr from-[#FF9420] via-[#FFBA70] to-[#3E24C5] shadow-[0_0_25px_rgba(255,148,32,0.35)] group-hover:shadow-[0_0_40px_rgba(255,148,32,0.7)] group-hover:scale-105 transition-all duration-500">
                        <div class="w-full h-full p-1 bg-[#150624] rounded-full overflow-hidden">
                            @if($imageUrl)
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $name }}" 
                                 referrerpolicy="no-referrer"
                                 loading="lazy"
                                 class="w-full h-full object-cover object-top rounded-full group-hover:scale-110 transition-transform duration-700 ease-out"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="display: none;" class="w-full h-full rounded-full bg-gradient-to-tr {{ $gradient }} text-brand-dark font-black text-3xl items-center justify-center shadow-lg">
                                {{ $letter }}
                            </div>
                            @else
                            <div class="w-full h-full rounded-full bg-gradient-to-tr {{ $gradient }} text-brand-dark font-black text-3xl flex items-center justify-center shadow-lg">
                                {{ $letter }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Department Floating Icon Badge -->
                    <div class="absolute -top-1 -left-1 w-8 h-8 rounded-full bg-[#1B082B] border border-[#FF9420]/70 text-[#FF9420] flex items-center justify-center text-xs shadow-lg backdrop-blur-md group-hover:scale-110 transition-transform" title="{{ $dept }}">
                        <i class="{{ $icon }}"></i>
                    </div>

                    <!-- Live Active Status Pulse Node -->
                    <div class="absolute bottom-1 right-2 w-5 h-5 rounded-full bg-emerald-500 border-2 border-[#1B082B] shadow-lg flex items-center justify-center" title="عضو نشط في فريق بريق">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                    </div>
                </div>

                <!-- Name & Title -->
                <div class="space-y-1 w-full">
                    <h3 class="text-lg sm:text-xl font-black text-white group-hover:text-brand-orange transition-colors">
                        {{ $name }}
                    </h3>
                    <div class="text-xs font-extrabold text-brand-peach">
                        {{ $role }}
                    </div>
                    @if($dept)
                    <div class="pt-0.5">
                        <span class="inline-block px-3 py-0.5 rounded-full bg-purple-950/70 border border-purple-800/60 text-[10px] text-gray-300 font-medium">
                            {{ $dept }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Member Quote / Philosophy -->
                @if($quote)
                <p class="text-xs text-gray-200 leading-relaxed italic border-t border-purple-800/40 pt-3.5 px-2 relative font-normal">
                    <span class="text-brand-orange font-black text-base mr-1">“</span>{{ $quote }}<span class="text-brand-orange font-black text-base ml-1">”</span>
                </p>
                @endif
            </div>

            <!-- Card Bottom Footer -->
            <div class="pt-4 mt-4 border-t border-purple-800/40 flex items-center justify-between text-[10px] text-gray-400 w-full">
                <span class="flex items-center gap-1.5 text-brand-orange">
                    <i class="fa-solid fa-circle text-[6px] animate-pulse"></i>
                    <span class="font-bold">عقلية تعاون موحدة</span>
                </span>
                <span class="font-mono tracking-widest text-[#FFBA70] font-bold">PARIQ TEAM</span>
            </div>
        </div>
        @endforeach
    </div>

</section>

<!-- BOTTOM CTA -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto text-center relative z-10">
    <div class="glass-card-purple rounded-[2.5rem] p-10 sm:p-14 border border-brand-orange/40 shadow-2xl space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black text-white">مستعد لبدء أولى خطوات نجاح علامتك معنا؟</h2>
        <p class="text-xs sm:text-sm text-gray-300 max-w-2xl mx-auto leading-relaxed">
            تحدث معنا واشرح رؤيتك وسيتولى فريقنا المتكامل رسم خطة العمل والإنتاج المخصصة لمشروعك.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-l from-brand-orange to-[#FF7A00] text-brand-dark font-black text-xs shadow-xl transition hover:brightness-110">
                حجز جلسة استشارة واكتشاف
            </a>
            <a href="{{ route('public.services') }}" class="px-8 py-3.5 rounded-xl bg-[#1D0838] hover:bg-purple-900/60 border border-brand-orange/40 text-white font-bold text-xs transition">
                استعراض خدماتنا المتكاملة
            </a>
        </div>
    </div>
</section>
@endsection
