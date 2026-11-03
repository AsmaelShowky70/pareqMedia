<?php

namespace Database\Seeders;

use App\Models\AccountingCategory;
use App\Models\Service;
use App\Models\TreasuryAccount;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionInitialSeeder extends Seeder
{
    /**
     * Run the production database seeds for a fresh, clean client deployment.
     */
    public function run(): void
    {
        // 1. Create General Manager Account (Saif Adel) ONLY
        $admin = User::updateOrCreate(
            ['email' => 'admin@pariqagency.com'],
            [
                'name' => 'Saif Adel',
                'password' => Hash::make('A123@#'),
                'phone' => '+201062330838',
                'role' => User::ROLE_ADMIN,
                'department' => 'management',
                'job_title' => 'صاحب المنصة المدير العام',
                'daily_quota' => 'الإشراف وتوزيع المهام واعتماد التسليمات',
                'is_active' => true,
            ]
        );

        $adminSaif = User::updateOrCreate(
            ['email' => 'saif@pariqagency.com'],
            [
                'name' => 'Saif Adel',
                'password' => Hash::make('A123@#'),
                'phone' => '+201062330838',
                'role' => User::ROLE_ADMIN,
                'department' => 'management',
                'job_title' => 'صاحب المنصة المدير العام',
                'daily_quota' => 'الإشراف وتوزيع المهام واعتماد التسليمات',
                'is_active' => true,
            ]
        );

        // 2. Treasuries (الخزائن والحسابات المالية)
        $treasuries = [
            ['name' => 'انستاباي الرئيسي (Instapay)', 'type' => 'instapay', 'account_number' => 'pariq@instapay', 'balance' => 0.00],
            ['name' => 'محفظة فودافون كاش الرسمية', 'type' => 'vodafone_cash', 'account_number' => '01062330838', 'balance' => 0.00],
            ['name' => 'الحساب البنكي التجاري CIB', 'type' => 'bank', 'account_number' => '100045892147', 'balance' => 0.00],
            ['name' => 'الخزينة النقدية الرئيسية (كاش بالمقر)', 'type' => 'cash', 'account_number' => 'VAULT-01', 'balance' => 0.00],
        ];

        foreach ($treasuries as $t) {
            TreasuryAccount::firstOrCreate(
                ['name' => $t['name']],
                [
                    'type' => $t['type'],
                    'account_number' => $t['account_number'],
                    'balance' => $t['balance'],
                    'is_active' => true,
                ]
            );
        }

        // 3. Accounting Categories (17 بنداً مطابقاً تماماً لجدول الإكسيل المعتمد للوكالة)
        $categories = [
            // الوارد (Revenues)
            ['name' => 'بلان شهرية', 'type' => 'revenue', 'code' => 'REV_MONTHLY_PLAN', 'description' => 'تعاقدات وباقات إدارة السوشيال ميديا الشهرية'],
            ['name' => 'تصوير ومونتاج', 'type' => 'revenue', 'code' => 'REV_SHOOT_MONTAGE', 'description' => 'جلسات تصوير ميداني مع أعمال المونتاج'],
            ['name' => 'مونتاج', 'type' => 'revenue', 'code' => 'REV_MONTAGE', 'description' => 'خدمات مونتاج الفيديوهات والريلز فقط'],
            ['name' => 'تصميمات', 'type' => 'revenue', 'code' => 'REV_DESIGNS', 'description' => 'تصاميم الجرافيك والهويات الإعلانية والكاروسيل'],
            ['name' => 'تصوير إعلانات ممولة', 'type' => 'revenue', 'code' => 'REV_AD_SHOOT', 'description' => 'جلسات تصوير مخصصة للحملات الإعلانية الممولة'],
            ['name' => 'خدمات أخرى', 'type' => 'revenue', 'code' => 'REV_OTHER', 'description' => 'استشارات وأي خدمات إضافية متفرقة'],

            // المنصرف (Expenses)
            ['name' => 'راتب شهري', 'type' => 'expense', 'code' => 'EXP_SALARY', 'description' => 'رواتب ومستحقات موظفي الوكالة وصناع المحتوى'],
            ['name' => 'شحن إعلانات ممولة', 'type' => 'expense', 'code' => 'EXP_AD_SPEND', 'description' => 'ميزانيات الإعلانات الممولة Ad Spend المدفوعة للمنصات'],
            ['name' => 'نت', 'type' => 'expense', 'code' => 'EXP_INTERNET', 'description' => 'فواتير الإنترنت وباقات الخطوط والاتصالات'],
            ['name' => 'اشتراكات مواقع', 'type' => 'expense', 'code' => 'EXP_SUBSCRIPTIONS', 'description' => 'اشتراكات برامج التصميم والذكاء الاصطناعي والمواقع'],
            ['name' => 'مشتريات', 'type' => 'expense', 'code' => 'EXP_PURCHASES', 'description' => 'مشتريات أجهزة ومعدات وكاميرات وإكسسوارات'],
            ['name' => 'صيانة وإصلاحات', 'type' => 'expense', 'code' => 'EXP_MAINTENANCE', 'description' => 'صيانة الأجهزة والمقر والمعدات الفنية'],
            ['name' => 'انتقالات', 'type' => 'expense', 'code' => 'EXP_TRANSPORT', 'description' => 'بدلات مواصلات وتوصيل ومصاريف انتقال المصورين'],
            ['name' => 'نثريات', 'type' => 'expense', 'code' => 'EXP_SUNDRY', 'description' => 'مصاريف ضيافة وبوفيه وأدوات مكتبية'],
            ['name' => 'أخرى', 'type' => 'expense', 'code' => 'EXP_OTHER', 'description' => 'أي مصروفات تشغيلية متنوعة أخرى'],
            ['name' => 'تبرعات لله', 'type' => 'expense', 'code' => 'EXP_CHARITY', 'description' => 'صدقات وتبرعات ومشاركات خيرية من أرباح الوكالة'],
            ['name' => 'مصاريف تحويل', 'type' => 'expense', 'code' => 'EXP_TRANSFER_FEES', 'description' => 'رسوم وعمولات تحويل بنكي وانستاباي وفودافون كاش'],
        ];

        foreach ($categories as $cat) {
            AccountingCategory::firstOrCreate(
                ['name' => $cat['name']],
                [
                    'type' => $cat['type'],
                    'code' => $cat['code'],
                    'description' => $cat['description'],
                ]
            );
        }

        // 4. Default Public Services for Website CMS
        $services = [
            [
                'title_ar' => 'إدارة حسابات السوشيال ميديا وبناء الهوية',
                'title_en' => 'Social Media Management',
                'slug' => 'social-media-management',
                'category' => 'management',
                'short_description' => 'تخطيط استراتيجي شامل، صناعة المحتوى الإبداعي، وجدولة النشر اليومي مع التفاعل وتحليل النتائج.',
                'icon' => 'fa-hashtag',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title_ar' => 'الإنتاج المرئي وتصوير الريلز السينمائي',
                'title_en' => 'Video Production & Reels',
                'slug' => 'video-production',
                'category' => 'video',
                'short_description' => 'جلسات تصوير ميدانية بمعدات سينمائية 4K ومونتاج متطور يواكب أحدث الترندات العالمية.',
                'icon' => 'fa-video',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title_ar' => 'الحملات الإعلانية الممولة (Media Buying)',
                'title_en' => 'Paid Advertising Campaigns',
                'slug' => 'media-buying',
                'category' => 'ads',
                'short_description' => 'استهداف دقيق للعملاء المحتملين وتحقيق أعلى عائد على الإنفاق الإعلاني (ROAS) عبر فيسبوك، إنستغرام، وتيك توك.',
                'icon' => 'fa-bullseye',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title_ar' => 'تصميم الهويات البصرية والمطبوعات',
                'title_en' => 'Branding & Graphic Design',
                'slug' => 'branding-graphic-design',
                'category' => 'design',
                'short_description' => 'بناء هوية تجارية مميزة تترسخ في أذهان عملائك بتصاميم عصرية واحترافية لا تُنسى.',
                'icon' => 'fa-palette',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::firstOrCreate(
                ['slug' => $srv['slug']],
                $srv
            );
        }
    }
}
