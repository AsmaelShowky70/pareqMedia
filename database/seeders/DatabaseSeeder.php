<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Expense;
use App\Models\Inquiry;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PortfolioItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with real Pariq Agency content.
     */
    public function run(): void
    {
        // 1. Create Core Users (Strict individual accounts)
        $admin = User::create([
            'name' => 'المدير العام (صاحب الوكالة)',
            'email' => 'admin@pariqagency.com',
            'password' => Hash::make('password'),
            'phone' => '+201062330838',
            'role' => 'admin',
            'department' => 'management',
            'job_title' => 'المدير التنفيذي والمؤسس',
            'daily_quota' => 'الإشراف وتوزيع المهام واعتماد التسليمات',
            'is_active' => true,
        ]);

        $editor = User::create([
            'name' => 'كريم إبراهيم',
            'email' => 'karim.video@pariqagency.com',
            'password' => Hash::make('password'),
            'phone' => '+201011122334',
            'role' => 'employee',
            'department' => 'editing',
            'job_title' => 'كبير مونتيري الفيديو (Senior Video Editor)',
            'daily_quota' => 'مونتاج 2 فيديو ريلز يومياً + تطبيق التعديلات',
            'is_active' => true,
        ]);

        $designer = User::create([
            'name' => 'نور الدين حسن',
            'email' => 'nour.design@pariqagency.com',
            'password' => Hash::make('password'),
            'phone' => '+201022233445',
            'role' => 'employee',
            'department' => 'design',
            'job_title' => 'مصمم جرافيك وهويات بصرية (Senior Graphic Designer)',
            'daily_quota' => '4 تصميمات سوشيال ميديا أو غلافي يوتيوب',
            'is_active' => true,
        ]);

        $mediabuyer = User::create([
            'name' => 'أحمد مصطفى',
            'email' => 'ahmed.mediabuy@pariqagency.com',
            'password' => Hash::make('password'),
            'phone' => '+201033344556',
            'role' => 'employee',
            'department' => 'media_buyer',
            'job_title' => 'أخصائي حملات إعلانية (Senior Media Buyer)',
            'daily_quota' => 'إدارة وتحسين 8 حملات ممولة ومتابعة الـ ROAS',
            'is_active' => true,
        ]);

        $cashier = User::create([
            'name' => 'سارة علي',
            'email' => 'sara.cashier@pariqagency.com',
            'password' => Hash::make('password'),
            'phone' => '+201044455667',
            'role' => 'manager',
            'department' => 'accounting',
            'job_title' => 'مسؤولة الحسابات والكاشير المالي',
            'daily_quota' => 'تقفيل الخزينة اليومية وإصدار إيصالات القبض',
            'is_active' => true,
        ]);

        // 2. Real Services from Pariq Agency
        $services = [
            [
                'title_ar' => 'تصوير فيديو احترافي',
                'title_en' => 'Professional Video Shooting',
                'slug' => 'video-shooting',
                'category' => 'video_shooting',
                'icon' => 'video',
                'short_description' => 'تصوير سينمائي عالي الجودة 4K بأحدث كاميرات السينما ومعدات الإضاءة والصوت الاحترافية.',
                'full_description' => 'نوفر طواقم تصوير متكاملة لتصوير إعلانات المنتجات، البروموهات، التغطيات، وفيديوهات الريلز والشوربس.',
                'starting_price' => 3500,
                'sort_order' => 1,
            ],
            [
                'title_ar' => 'مونتاج فيديو وبوست برودكشن',
                'title_en' => 'Video Editing & Post Production',
                'slug' => 'video-editing',
                'category' => 'video_editing',
                'icon' => 'film',
                'short_description' => 'مونتاج ريلز وبرومو سينمائي سريع وجذاب مع مؤثرات بصرية وتصحيح ألوان احترافي.',
                'full_description' => 'تقطيع ديناميكي، مؤثرات صوتية تحبس الأنفاس، ومؤثرات جرافيك متحركة لزيادة مدة المشاهدة والانتشار.',
                'starting_price' => 2000,
                'sort_order' => 2,
            ],
            [
                'title_ar' => 'تصميم الجرافيك وبناء الهويات',
                'title_en' => 'Graphic Design & Visual Identity',
                'slug' => 'graphic-design',
                'category' => 'graphic_design',
                'icon' => 'pen-nib',
                'short_description' => 'تصميمات سوشيال ميديا استثنائية، أغلفة يوتيوب CTR لرفع المشاهدات، وتصميم شعارات وهويات بصرية كاملة.',
                'full_description' => 'تصاميم تسويقية مدروسة نفسياً لتحفيز التفاعل والطلب، متناسقة بدقة مع ألوان علامتك التجارية.',
                'starting_price' => 1500,
                'sort_order' => 3,
            ],
            [
                'title_ar' => 'الإعلانات الممولة (Media Buying)',
                'title_en' => 'Sponsored Ads & Performance Marketing',
                'slug' => 'sponsored-ads',
                'category' => 'media_buying',
                'icon' => 'chart-line',
                'short_description' => 'إدارة حملات Meta, TikTok, Google بحساب دقيق للعائد على الإنفاق (ROAS) وتحقيق أعلى مبيعات.',
                'full_description' => 'استهداف دقيق للشريحة الأكثر استعداداً للشراء، واختبارات مستمرة لتقليل تكلفة العميل ومضاعفة العائد.',
                'starting_price' => 4000,
                'sort_order' => 4,
            ],
            [
                'title_ar' => 'إدارة وسائل التواصل الاجتماعي',
                'title_en' => 'Social Media Management',
                'slug' => 'social-management',
                'category' => 'social_media',
                'icon' => 'share-nodes',
                'short_description' => 'إدارة كاملة لحسابات السوشيال ميديا مع خطط نشر دورية ومتابعة التفاعل وبناء المجتمع.',
                'full_description' => 'خطة محتوى شهرية، النشر في الأوقات الذهبية، الرد على الرسائل والتعليقات، وبناء علاقة وثيقة مع العملاء.',
                'starting_price' => 5000,
                'sort_order' => 5,
            ],
            [
                'title_ar' => 'إعداد الخطط والاستراتيجيات',
                'title_en' => 'Marketing Strategy & Copywriting',
                'slug' => 'strategy-content',
                'category' => 'marketing_strategy',
                'icon' => 'lightbulb',
                'short_description' => 'دراسة السوق وتحليل المنافسين وبناء خطة عمل تسويقية متكاملة مع كتابة سكريبتات إعلانية إبداعية.',
                'full_description' => 'استراتيجيات قائمة على البيانات وسلوك الجمهور لصناعة رسائل إعلانية تقود للبيع المباشر.',
                'starting_price' => 3000,
                'sort_order' => 6,
            ],
        ];

        $serviceModels = [];
        foreach ($services as $srv) {
            $serviceModels[$srv['slug']] = Service::create($srv);
        }

        // 3. Real Clients from Pariq Agency
        $clientsData = [
            ['name' => 'شركة ويلفير للمنتجات الغذائية والألبان', 'brand_name' => 'Welfare Dairy (تأسست 1970)', 'phone' => '+201099887766', 'country' => 'مصر', 'package' => 'إنتاج مرئي وإعلانات سنوية', 'retainer' => 25000],
            ['name' => 'مطاعم شاورماكر بالأردن', 'brand_name' => 'Shawrmaker Jordan', 'phone' => '+962791112233', 'country' => 'الأردن', 'package' => 'باقة 20 ريلز شهرية + تصوير طعام', 'retainer' => 18000],
            ['name' => 'مستشفى ومجمع ماجستي الطبي بالرياض', 'brand_name' => 'Majesty Health Riyadh', 'phone' => '+966501234567', 'country' => 'السعودية', 'package' => 'إدارة محتوى طبي وتصاميم وإعلانات سناب شات', 'retainer' => 32000],
            ['name' => 'صيدليات رحيق ليبيا', 'brand_name' => 'Raheeq Pharmacies', 'phone' => '+218912345678', 'country' => 'ليبيا', 'package' => 'إعلانات ممولة وتصاميم عروض ترويجية', 'retainer' => 15000],
            ['name' => 'فوكس لسياحة المغامرات', 'brand_name' => 'Fox ATVs Oman', 'phone' => '+96898765432', 'country' => 'سلطنة عمان', 'package' => 'إنتاج برومو سنيمائي وتغطية سياحية', 'retainer' => 22000],
            ['name' => 'مول ذا ميت هب التجاري', 'brand_name' => 'The Met Hub Mall', 'phone' => '+201155443322', 'country' => 'مصر', 'package' => 'تغطيات افتتاحية وفيديوهات فعاليات', 'retainer' => 28000],
            ['name' => 'مؤسسة A One التعليمية', 'brand_name' => 'A One Education', 'phone' => '+201044332211', 'country' => 'مصر', 'package' => 'إعلانات استقطاب طلاب وتصاميم كورسات', 'retainer' => 12000],
            ['name' => 'مطاعم الرفاعي بيتزا', 'brand_name' => 'Elrifaee Pizza Jordan', 'phone' => '+962799884433', 'country' => 'الأردن', 'package' => 'تصوير جلسات وجبات وريلز تيك توك', 'retainer' => 14000],
            ['name' => 'صانع المحتوى ضياء فيلمز', 'brand_name' => 'Diaa Films YouTube', 'phone' => '+201122334455', 'country' => 'مصر', 'package' => 'مونتاج حلقات وأغلفة يوتيوب مصغرة', 'retainer' => 16000],
            ['name' => 'صانع المحتوى محمد السيد', 'brand_name' => 'Mohammed Ahmed Creator', 'phone' => '+966554433221', 'country' => 'السعودية', 'package' => 'تصميمات أغلفة يوتيوب مصغرة', 'retainer' => 10000],
            ['name' => 'كافيه جبل الأردن', 'brand_name' => 'Jabal Coffee', 'phone' => '+962776655443', 'country' => 'الأردن', 'package' => 'تغطيات ريلز ومحتوى قهوة مختصة', 'retainer' => 11000],
            ['name' => 'مطاحن بن الحسيني', 'brand_name' => 'El-Husseiny Coffee', 'phone' => '+201088776655', 'country' => 'مصر', 'package' => 'هوية بصرية وإعلانات منتجات القهوة', 'retainer' => 13000],
        ];

        $clients = [];
        foreach ($clientsData as $c) {
            $clients[] = Client::create([
                'name' => $c['name'],
                'brand_name' => $c['brand_name'],
                'phone' => $c['phone'],
                'country' => $c['country'],
                'service_package' => $c['package'],
                'monthly_retainer' => $c['retainer'],
                'status' => 'active',
                'notes' => 'عميل معتمد لدى وكالة بريق للتسويق الإلكتروني',
            ]);
        }

        // 4. Projects
        $p1 = Project::create([
            'client_id' => $clients[1]->id, // Shawrmaker
            'title' => 'حملة إطلاق سندوتش الشاورما المكسيكية (15 فيديو ريلز)',
            'category' => 'video_production',
            'total_budget' => 24000,
            'start_date' => Carbon::now()->subDays(10),
            'deadline' => Carbon::now()->addDays(15),
            'status' => 'in_progress',
            'description' => 'تصوير وجبات جديدة بالأردن، مونتاج سريع جذاب (Fast-paced reels) مع مقاطع صوتية تريند لتيك توك وإنستجرام.',
        ]);

        $p2 = Project::create([
            'client_id' => $clients[2]->id, // Majesty Health
            'title' => 'حملة الكشف الطبي الموسمي ومستشفى ماجستي بالرياض',
            'category' => 'media_buying',
            'total_budget' => 38000,
            'start_date' => Carbon::now()->subDays(5),
            'deadline' => Carbon::now()->addDays(20),
            'status' => 'in_progress',
            'description' => 'إعلانات ليدز على سناب شات وميتا لجذب حجوزات الاستشارات الطبية في مدينة الرياض.',
        ]);

        $p3 = Project::create([
            'client_id' => $clients[0]->id, // Welfare Dairy
            'title' => 'تحديث الهوية البصرية وفيديوهات المنتجات الطبيعية',
            'category' => 'branding',
            'total_budget' => 30000,
            'start_date' => Carbon::now()->subDays(20),
            'deadline' => Carbon::now()->addDays(5),
            'status' => 'in_progress',
            'description' => 'جلسات تصوير لمنتجات الأجبان والألبان وتصميم مطبوعات وتغليف وكتالوج ديجيتال.',
        ]);

        $p4 = Project::create([
            'client_id' => $clients[4]->id, // Fox ATVs
            'title' => 'برومو المغامرة الصحراوية 4K - فوكس عمان',
            'category' => 'video_production',
            'total_budget' => 26000,
            'start_date' => Carbon::now()->subDays(25),
            'deadline' => Carbon::now()->subDays(2),
            'status' => 'completed',
            'description' => 'تصوير درون وسينما لفريق الدراجات في صحراء الرمال الذهبية بعمان مع تصحيح ألوان سينمائي.',
        ]);

        // 5. Tasks Distributed by Admin to Employees (5 Strict Statuses)
        // Task 1: In Progress -> كريم إبراهيم (مونتير)
        Task::create([
            'project_id' => $p1->id,
            'client_id' => $clients[1]->id,
            'assigned_to' => $editor->id, // المالك
            'created_by' => $admin->id,
            'title' => 'مونتاج ريلز رقم 4 و 5: وجبة الشاورما المكسيكية مع تريند الصوت',
            'department' => 'editing',
            'status' => Task::STATUS_IN_PROGRESS,
            'delivery_deadline' => Carbon::now()->addDays(2),
            'daily_delivery_deadline' => 'اليوم الساعة 7:00 مساءً (المسودة الأولى)',
            'material_link' => 'https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc',
            'delivery_link' => 'https://drive.google.com/drive/folders/pariq-delivery-shawrmaker-drafts',
            'notes' => 'التركيز على تقطيع المشاهد السريع (Dynamic Cuts) وإبراز بخار الطعام مع موسيقى تشويقية وتطبيق ألوان الهوية.',
            'priority' => 'urgent',
        ]);

        // Task 2: Not Started -> نور الدين حسن (مصمم جرافيك)
        Task::create([
            'project_id' => $p1->id,
            'client_id' => $clients[1]->id,
            'assigned_to' => $designer->id, // المالك
            'created_by' => $admin->id,
            'title' => 'تصميم 3 أغلفة بوسترات وقصص إنستجرام لعرض الشاورما الخاص',
            'department' => 'design',
            'status' => Task::STATUS_NOT_STARTED,
            'delivery_deadline' => Carbon::now()->addDays(4),
            'daily_delivery_deadline' => 'غداً الساعة 3:00 عصراً (الأفكار والخطوط)',
            'material_link' => 'https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc',
            'delivery_link' => '',
            'notes' => 'مقاسات 1080x1920 للستوري و 1080x1350 للبوستات مع إضافة رمز الخصم والكول تو أكشن.',
            'priority' => 'high',
        ]);

        // Task 3: Completed -> كريم إبراهيم
        Task::create([
            'project_id' => $p4->id,
            'client_id' => $clients[4]->id,
            'assigned_to' => $editor->id,
            'created_by' => $admin->id,
            'title' => 'التصدير النهائي للبرومو السينمائي 4K مع الصوت المحيطي - Fox ATVs',
            'department' => 'editing',
            'status' => Task::STATUS_COMPLETED,
            'delivery_deadline' => Carbon::now()->subDays(2),
            'daily_delivery_deadline' => 'تم التسليم والاعتماد في الموعد المحدد',
            'material_link' => 'https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc',
            'delivery_link' => 'https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc',
            'notes' => 'تم اعتماد النسخة النهائية من العميل بدون أي تعديلات وحصلت على إشادة خاصة.',
            'priority' => 'medium',
            'completed_at' => Carbon::now()->subDays(2),
        ]);

        // Task 4: In Progress -> أحمد مصطفى (ميديا باير)
        Task::create([
            'project_id' => $p2->id,
            'client_id' => $clients[2]->id,
            'assigned_to' => $mediabuyer->id,
            'created_by' => $admin->id,
            'title' => 'ضبط جمهور حملة ماجستي بالرياض واختبار 4 أشكال إعلانية (Creative Testing)',
            'department' => 'media_buyer',
            'status' => Task::STATUS_IN_PROGRESS,
            'delivery_deadline' => Carbon::now()->addDays(3),
            'daily_delivery_deadline' => 'اليوم الساعة 6:00 مساءً (تقرير نتائج اليوم الأول)',
            'material_link' => 'https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc',
            'delivery_link' => 'https://lookerstudio.google.com/reporting/pariq-majesty-live-dashboard',
            'notes' => 'الميزانية اليومية 600 ريال، الهدف حجز كشوفات بمتوسط تكلفة ليد أقل من 35 ريال.',
            'priority' => 'urgent',
        ]);

        // Task 5: Cancelled -> نور الدين
        Task::create([
            'project_id' => $p3->id,
            'client_id' => $clients[0]->id,
            'assigned_to' => $designer->id,
            'created_by' => $admin->id,
            'title' => 'تصميم تغليف علب زجاجية تجريبية - فكرة ملغاة من الإدارة',
            'department' => 'design',
            'status' => Task::STATUS_CANCELLED,
            'delivery_deadline' => Carbon::now()->subDays(5),
            'daily_delivery_deadline' => 'ملغي',
            'material_link' => '',
            'delivery_link' => '',
            'notes' => 'تم إلغاء المهمة بناءً على طلب العميل لاستبدال العلب الزجاجية بعبوات ورقية صديقة للبيئة.',
            'priority' => 'low',
        ]);

        // Task 6: On Leave -> نور الدين
        Task::create([
            'project_id' => null,
            'client_id' => null,
            'assigned_to' => $designer->id,
            'created_by' => $admin->id,
            'title' => 'إجازة اعتيادية معتمدة للمصمم نور الدين حسن',
            'department' => 'design',
            'status' => Task::STATUS_ON_LEAVE,
            'delivery_deadline' => Carbon::now()->addDays(1),
            'daily_delivery_deadline' => 'إجازة رسمية حتى غداً',
            'material_link' => '',
            'delivery_link' => '',
            'notes' => 'الموظف في إجازة، تم ترحيل مهام التصميم غير المستعجلة لما بعد العودة.',
            'priority' => 'low',
        ]);

        // 6. Real Portfolio Items from Pariq Agency with Actual Downloaded WebP Images!
        $portfolioData = [
            // YouTube Thumbnails (أغلفة يوتيوب حقيقية من الموقع)
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم غلاف يوتيوب برنامج رامز جاب من الآخر - كيو لايت',
                'client_name' => 'كيو لايت (صانع محتوى)',
                'client_country' => 'مصر',
                'category' => 'youtube_thumbnail',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/ramez_qlight.webp',
                'metrics' => 'CTR 16.8% | +4.2M مشاهدة',
                'desc' => 'تصميم غلاف فيديو مصغر عالي التباين وجاذب للعين يحقق أعلى نسبة نقر لمحتوى الترفيه والألعاب.',
                'featured' => true,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم غلاف حلقة صانع المحتوى محمد السيد',
                'client_name' => 'محمد السيد',
                'client_country' => 'السعودية',
                'category' => 'youtube_thumbnail',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/mohammed_elsayed.webp',
                'metrics' => 'CTR 14.5% | تفاعل قياسي',
                'desc' => 'إخراج وتصميم أغلفة يوتيوب احترافية بأسلوب السيكولوجيا البصرية التي تشد المشاهدين للتفاعل الفوري.',
                'featured' => true,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم غلاف يوتيوب وثائقي "ذكرى"',
                'client_name' => 'وثائقيات ذكرى',
                'client_country' => 'مصر',
                'category' => 'youtube_thumbnail',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/zekra_cover.webp',
                'metrics' => 'CTR 15.2% | +800 ألف مشاهدة',
                'desc' => 'تصميم يعبر عن المشاعر والدراما التاريخية مع تناسق ألوان احترافي للأعمال الوثائقية.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم غلاف حلقة سلسلة الطوارئ الطبية',
                'client_name' => 'سلسلة الطوارئ الطبية',
                'client_country' => 'السعودية',
                'category' => 'youtube_thumbnail',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/emergency_cover.webp',
                'metrics' => 'CTR 13.9% | وصول واسع',
                'desc' => 'إبراز العنصر التشويقي في المشاهد الطبية الطارئة مع خطوط عربية قوية ومباشرة.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'غلاف يوتيوب استضافة أكسفورد التعليمية',
                'client_name' => 'أكاديمية أكسفورد',
                'client_country' => 'مصر',
                'category' => 'youtube_thumbnail',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/oxford_host.webp',
                'metrics' => 'زيادة 35% في نسبة النقر',
                'desc' => 'تصميم تعليمي وتدريبي عصري يناسب الندوات واللقاءات الحوارية لكبار المتحدثين.',
                'featured' => false,
            ],

            // Real Ads Results (نتائج الحملات الإعلانية الموثقة من الموقع)
            [
                'service_slug' => 'sponsored-ads',
                'title' => 'نتائج حملة مبيعات متجر إلكتروني - ميتا آدز (ROAS 6.8x)',
                'client_name' => 'متجر إلكتروني للتجزئة',
                'client_country' => 'السعودية ومصر',
                'category' => 'ad_results',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/ad_result_69.webp',
                'metrics' => 'عائد إعلاني ROAS 6.8x | 1,420 طلب مؤكد',
                'desc' => 'لقطة شاشة موثقة من مدير إعلانات Meta Ads توضح تحقيق أرباح قياسية وتكلفة نقرة منخفضة للغاية بفضل الاستهداف المتقدم.',
                'featured' => true,
            ],
            [
                'service_slug' => 'sponsored-ads',
                'title' => 'نتائج حملة رسائل وحجوزات مباشرة لعيادات ومطاعم',
                'client_name' => 'سلسلة عيادات ومطاعم',
                'client_country' => 'الأردن ومصر',
                'category' => 'ad_results',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/ad_result_70.webp',
                'metrics' => 'تكلفة رسالة 1.2 ج.م | +3,800 عميل محتمل',
                'desc' => 'استهداف دقيق للمهتمين بالخدمات والحجوزات وتوليد مئات العملاء المستعدين للشراء يومياً.',
                'featured' => true,
            ],
            [
                'service_slug' => 'sponsored-ads',
                'title' => 'نتائج حملة تفاعل ومشاهدات فيديو ريلز (+850 ألف مشاهدة)',
                'client_name' => 'براند أغذية ومشروبات',
                'client_country' => 'الأردن',
                'category' => 'ad_results',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/ad_result_72.webp',
                'metrics' => '+850K مشاهدة حقيقية | تفاعل 18%',
                'desc' => 'تحقيق انتشار عضوي ومدفوع واسع النطاق أدى لزيادة مباشرة في عدد متابعي وزوار الفروع.',
                'featured' => true,
            ],

            // Social Media Designs (تصميمات سوشيال ميديا حقيقية)
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم سوشيال ميديا ترويجي لعرض مطعم إمبابة',
                'client_name' => 'مطعم إمبابة',
                'client_country' => 'مصر',
                'category' => 'social_design',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/social_1.webp',
                'metrics' => 'وصول تفاعلي +120 ألف',
                'desc' => 'تصميم إعلاني جذاب يبرز شهية الوجبة وسعر العرض بطريقة تسويقية تزيد رغبة الشراء الفوري.',
                'featured' => true,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم بوستر افتتاح خاص وعروض استثنائية',
                'client_name' => 'براند أزياء وتجزئة',
                'client_country' => 'مصر',
                'category' => 'social_design',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/social_2.webp',
                'metrics' => 'تفاعل +4,000 عميل',
                'desc' => 'بوستر إعلاني متميز بألوان متناسقة وإخراج طباعي ورقمي فاخر يناسب منصات التواصل.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم غلاف وبوستر التوصيل المجاني',
                'client_name' => 'مطاعم كبرى',
                'client_country' => 'مصر',
                'category' => 'social_design',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/free_delivery.webp',
                'metrics' => 'زيادة 40% في طلبات الدليفري',
                'desc' => 'إبراز ميزة التوصيل المجاني بتصميم ديناميكي مرح ومحفز للاتصال المباشر.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم إعلاني جذاب لمنتج استهلاكي',
                'client_name' => 'شركة منتجات غذائية',
                'client_country' => 'مصر',
                'category' => 'social_design',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/social_3.webp',
                'metrics' => 'هوية بصرية معتمدة',
                'desc' => 'إبراز عبوة المنتج ومكوناته الطبيعية بألوان زاهية تجذب المتسوقين.',
                'featured' => false,
            ],

            // Logo & Branding Designs (تصميم شعارات وهويات بصرية)
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم شعار وهوية متجر إلكتروني حديث (Logo Design)',
                'client_name' => 'براند تجارة إلكترونية',
                'client_country' => 'السعودية',
                'category' => 'branding',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/logo_1.webp',
                'metrics' => 'هوية بصرية متكاملة',
                'desc' => 'شعار هندسي حديث يعبر عن السرعة والموثوقية والتجارة الرقمية الحديثة.',
                'featured' => true,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم هوية بصرية لعلامة تجارية راقية',
                'client_name' => 'شركة خدمات وأعمال',
                'client_country' => 'قطر',
                'category' => 'branding',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/logo_3.webp',
                'metrics' => 'دليل هوية Brand Guidelines',
                'desc' => 'بناء فلسفة العلامة واختيار الألوان والخطوط والأيقونات الخاصة بالنشاط.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم شعار كافيه ومطعم عصري',
                'client_name' => 'كافيه شبابي عصري',
                'client_country' => 'الأردن',
                'category' => 'branding',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/logo_4.webp',
                'metrics' => 'لوجو ثلاثي الأبعاد وعصري',
                'desc' => 'تصميم لوجو أنيق يعبر عن أجواء الاسترخاء وجودة المشروبات المقدمة.',
                'featured' => false,
            ],
            [
                'service_slug' => 'graphic-design',
                'title' => 'تصميم لوجو شركة مقاولات وهندسة متطورة',
                'client_name' => 'شركة مقاولات وإنشاءات',
                'client_country' => 'مصر',
                'category' => 'branding',
                'video_url' => null,
                'thumbnail' => '/images/portfolio/logo_5.webp',
                'metrics' => 'هوية شركات कॉर्पोरेट',
                'desc' => 'خطوط معمارية صلبة تعكس الثبات الهندسي والخبرة العريقة.',
                'featured' => false,
            ],

            // Videos (Reels & Promos)
            [
                'service_slug' => 'video-editing',
                'title' => 'ريلز سينمائي سريع لمطاعم شاورماكر (Shawrmaker Jordan)',
                'client_name' => 'Shawrmaker',
                'client_country' => 'الأردن',
                'category' => 'video_reels',
                'video_url' => '/videos/food_commercial.mp4',
                'thumbnail' => '/images/portfolio/social_4.webp',
                'metrics' => '+1.4M مشاهدة | زيادة 45% في الطلبات',
                'desc' => 'مونتاج سريع الإيقاع مع هندسة صوتية واقعية تجعل المشاهد يعيش تجربة الطعام بكل تفاصيلها.',
                'featured' => true,
            ],
            [
                'service_slug' => 'video-shooting',
                'title' => 'برومو المغامرة الصحراوية 4K - Fox ATVs سلطنة عمان',
                'client_name' => 'Fox ATVs Oman',
                'client_country' => 'سلطنة عمان',
                'category' => 'promo_video',
                'video_url' => '/videos/safari_tour.mp4',
                'thumbnail' => '/images/portfolio/social_3.webp',
                'metrics' => 'تغطية سياحية وتلفزيونية كاملة',
                'desc' => 'تصوير درونز وسينما رقمية في تلال الرمال الذهبية لسياحة المغامرات بالشرق الأوسط.',
                'featured' => true,
            ],
            [
                'service_slug' => 'video-editing',
                'title' => 'ريلز إعلاني ومؤثرات سينمائية للشركات والمتاجر (Viral Promo Reel)',
                'client_name' => 'بريق استوديو الإنتاج',
                'client_country' => 'مصر ودول الخليج',
                'category' => 'video_reels',
                'video_url' => '/videos/promo_reels_1.mp4',
                'thumbnail' => '/images/portfolio/social_2.webp',
                'metrics' => '+2.3M مشاهدة عضوية | تفاعل 24%',
                'desc' => 'نموذج ريلز سينمائي سريع بالتقطيع الديناميكي والمؤثرات الصوتية لجذب انتباه المشاهد في أول 3 ثوانٍ.',
                'featured' => true,
            ],
        ];

        $sort = 1;
        foreach ($portfolioData as $item) {
            PortfolioItem::create([
                'service_id' => $serviceModels[$item['service_slug']]->id ?? null,
                'title' => $item['title'],
                'client_name' => $item['client_name'],
                'client_country' => $item['client_country'],
                'category' => $item['category'],
                'video_url' => $item['video_url'],
                'thumbnail' => $item['thumbnail'],
                'metrics' => $item['metrics'],
                'description' => $item['desc'],
                'is_featured' => $item['featured'],
                'sort_order' => $sort++,
            ]);
        }

        // 7. Cashier & Invoicing
        $inv1 = Invoice::create([
            'invoice_number' => 'INV-2026-001',
            'client_id' => $clients[1]->id,
            'project_id' => $p1->id,
            'total_amount' => 24000,
            'paid_amount' => 15000,
            'balance_due' => 9000,
            'status' => 'partially_paid',
            'due_date' => Carbon::now()->addDays(10),
            'notes' => 'فاتورة باقة إنتاج 15 ريلز لمطاعم شاورماكر - الأردن',
        ]);

        Payment::create([
            'receipt_number' => 'REC-2026-0001',
            'client_id' => $clients[1]->id,
            'invoice_id' => $inv1->id,
            'project_id' => $p1->id,
            'cashier_user_id' => $cashier->id,
            'amount' => 15000,
            'payment_type' => 'down_payment',
            'payment_method' => 'instapay',
            'transaction_reference' => 'INSTA-99824102',
            'notes' => 'دفعة مقدمة 60% تعاقد باقة الريلز - تم استلامها عبر إنستاباي وإصدار الإيصال.',
        ]);

        Payment::create([
            'receipt_number' => 'REC-2026-0002',
            'client_id' => $clients[2]->id,
            'invoice_id' => null,
            'project_id' => $p2->id,
            'cashier_user_id' => $cashier->id,
            'amount' => 20000,
            'payment_type' => 'quick_service',
            'payment_method' => 'bank_transfer',
            'transaction_reference' => 'SAR-BNK-771829',
            'notes' => 'دفعة ميزانية إعلانية لحملة مستشفى ماجستي الرياض - تحويل بنكي رسمي.',
        ]);

        Payment::create([
            'receipt_number' => 'REC-2026-0003',
            'client_id' => $clients[3]->id,
            'invoice_id' => null,
            'project_id' => null,
            'cashier_user_id' => $admin->id,
            'amount' => 7500,
            'payment_type' => 'quick_service',
            'payment_method' => 'vodafone_cash',
            'transaction_reference' => 'VF-88291039',
            'notes' => 'سداد سريع كاشير: باقة تصاميم عروض أدوية لصيدليات رحيق ليبيا.',
        ]);

        // 8. Expenses
        Expense::create([
            'title' => 'شحن ميزانية إعلانات Meta لعميل مستشفى ماجستي بالرياض',
            'category' => 'ad_spend',
            'amount' => 14000,
            'payment_method' => 'instapay',
            'project_id' => $p2->id,
            'created_by' => $mediabuyer->id,
            'spent_at' => Carbon::now()->subDays(3),
            'notes' => 'تحويل قيمة رصيد الإعلانات على مدير الإعلانات.',
        ]);

        Expense::create([
            'title' => 'اشتراك باقة Adobe Creative Cloud السنوية للفريق',
            'category' => 'software_tools',
            'amount' => 3200,
            'payment_method' => 'bank_transfer',
            'project_id' => null,
            'created_by' => $admin->id,
            'spent_at' => Carbon::now()->subDays(8),
            'notes' => 'تجديد تراخيص أدوبي بريمير، فوتوشوب، وأفتر إفكتس.',
        ]);

        // 9. Inquiries
        Inquiry::create([
            'name' => 'م. طارق العتيبي',
            'brand_name' => 'برجر لاين - الرياض',
            'phone' => '+966551239874',
            'email' => 'tariq@burgerline.sa',
            'service_interested' => 'تصوير ومونتاج ريلز وإعلانات ممولة',
            'budget_range' => '20,000 - 35,000 ريال',
            'message' => 'نود إطلاق 4 فروع جديدة ونحتاج خطة تسويقية كاملة وإنتاج فيديوهات ريلز متميزة.',
            'status' => 'new',
        ]);
    }
}
