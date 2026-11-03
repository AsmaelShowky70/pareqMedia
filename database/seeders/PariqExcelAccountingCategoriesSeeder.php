<?php

namespace Database\Seeders;

use App\Models\AccountingCategory;
use Illuminate\Database\Seeder;

class PariqExcelAccountingCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds matching the client's Excel sheet.
     */
    public function run(): void
    {
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
    }
}
