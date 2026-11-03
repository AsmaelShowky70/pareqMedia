<?php

namespace Database\Seeders;

use App\Models\AccountingCategory;
use App\Models\Client;
use App\Models\ClientInstallment;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\TreasuryAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgencyV2Seeder extends Seeder
{
    public function run(): void
    {
        // 1. Create / Update Content Creators
        $creator1 = User::firstOrCreate(
            ['email' => 'sara.creator@pariqagency.com'],
            [
                'name' => 'سارة أحمد (Content Creator 1)',
                'password' => Hash::make('password'),
                'phone' => '+201099988771',
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'management',
                'job_title' => 'صانع محتوى ومدير مشروعات (Team A)',
                'daily_quota' => 'توزيع ومتابعة مشاريع الفريق وتسليمها للمدير العام',
                'is_active' => true,
            ]
        );

        $creator2 = User::firstOrCreate(
            ['email' => 'omar.creator@pariqagency.com'],
            [
                'name' => 'عمر خالد (Content Creator 2)',
                'password' => Hash::make('password'),
                'phone' => '+201099988772',
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'management',
                'job_title' => 'صانع محتوى ومدير مشروعات (Team B)',
                'daily_quota' => 'إدارة حملات العملاء الخاصة به ومتابعة الموظفين',
                'is_active' => true,
            ]
        );

        // 2. Create Field Photographer
        $photographer = User::firstOrCreate(
            ['email' => 'youssef.photo@pariqagency.com'],
            [
                'name' => 'يوسف مصطفى (المصور الميداني)',
                'password' => Hash::make('password'),
                'phone' => '+201055566778',
                'role' => User::ROLE_EMPLOYEE,
                'department' => 'video',
                'job_title' => 'مصور سينمائي وفوتوغرافي ميداني',
                'daily_quota' => 'تغطية 1 إلى 2 موقع تصوير مع بصمة الحضور وتسليم الماتريال',
                'is_active' => true,
            ]
        );

        // 3. Create Treasury Accounts
        $treasuries = [
            ['name' => 'انستاباي الرئيسي (InstaPay)', 'type' => 'instapay', 'account_number' => 'pariq@instapay', 'balance' => 48500.00],
            ['name' => 'محفظة فودافون كاش', 'type' => 'vodafone_cash', 'account_number' => '01062330838', 'balance' => 18200.00],
            ['name' => 'البنك التجاري الدولي (CIB)', 'type' => 'bank', 'account_number' => 'EG1200000001234567890123', 'balance' => 145000.00],
            ['name' => 'خزينة المقر (كاش)', 'type' => 'cash', 'account_number' => 'VAULT-01', 'balance' => 12400.00],
        ];

        foreach ($treasuries as $t) {
            TreasuryAccount::firstOrCreate(['name' => $t['name']], $t);
        }

        // 4. Create Accounting Categories
        $categories = [
            // Revenues
            ['name' => 'تعاقدات سوشيال ميديا شهرية (Retainers)', 'type' => 'revenue', 'code' => 'REV-RET'],
            ['name' => 'إنتاج وتصوير فيديو سينمائي', 'type' => 'revenue', 'code' => 'REV-VID'],
            ['name' => 'أتعاب إدارة إعلانات ممولة', 'type' => 'revenue', 'code' => 'REV-ADS'],
            ['name' => 'تصميم هويات وجرافيك وبوستات', 'type' => 'revenue', 'code' => 'REV-DSG'],
            // Expenses
            ['name' => 'ميزانيات إعلانات ممولة (Ad Spend)', 'type' => 'expense', 'code' => 'EXP-ADS'],
            ['name' => 'رواتب ومستحقات الموظفين', 'type' => 'expense', 'code' => 'EXP-SAL'],
            ['name' => 'أتعاب فريلانسرز وطواقم خارجية', 'type' => 'expense', 'code' => 'EXP-FRL'],
            ['name' => 'اشتراكات برامج وأدوات وسيرفرات (Adobe, AI)', 'type' => 'expense', 'code' => 'EXP-SFT'],
            ['name' => 'معدات تصوير وصيانة أجهزة', 'type' => 'expense', 'code' => 'EXP-EQP'],
            ['name' => 'إيجار المقر وفواتير تشغيلية', 'type' => 'expense', 'code' => 'EXP-RNT'],
            ['name' => 'نثريات وضيافة وبوفيه', 'type' => 'expense', 'code' => 'EXP-MISC'],
        ];

        foreach ($categories as $cat) {
            AccountingCategory::firstOrCreate(['name' => $cat['name']], $cat);
        }

        // 5. Assign Content Creator to existing projects & create sample projects
        $clients = Client::take(3)->get();
        if ($clients->isNotEmpty()) {
            $client1 = $clients[0];
            $project1 = Project::firstOrCreate(
                ['title' => 'حملة إطلاق براند عطور فاخرة (فريق سارة)'],
                [
                    'client_id' => $client1->id,
                    'content_creator_id' => $creator1->id,
                    'category' => 'video_production',
                    'total_budget' => 25000.00,
                    'start_date' => Carbon::now()->subDays(5),
                    'deadline' => Carbon::now()->addDays(15),
                    'status' => 'in_progress',
                    'description' => 'مشروع مدار بالكامل بواسطة صانع المحتوى سارة أحمد وتوزيع المهام على فريقها.',
                ]
            );

            // Installments for project1
            ClientInstallment::firstOrCreate(
                ['title' => 'الدفعة الأولى - مقدم تعاقد عطور'],
                [
                    'client_id' => $client1->id,
                    'project_id' => $project1->id,
                    'amount' => 12500.00,
                    'due_date' => Carbon::now()->subDays(3),
                    'status' => 'paid',
                    'paid_amount' => 12500.00,
                    'paid_at' => Carbon::now()->subDays(3),
                    'payment_method' => 'instapay',
                ]
            );

            ClientInstallment::firstOrCreate(
                ['title' => 'الدفعة الثانية - بعد تسليم المونتاج الأولي'],
                [
                    'client_id' => $client1->id,
                    'project_id' => $project1->id,
                    'amount' => 12500.00,
                    'due_date' => Carbon::now()->addDays(2), // approaching!
                    'status' => 'pending',
                ]
            );

            // Photographer Field Task
            Task::firstOrCreate(
                ['title' => 'جلسة تصوير موديل في موقع العميل (مصر الجديدة)'],
                [
                    'project_id' => $project1->id,
                    'client_id' => $client1->id,
                    'assigned_to' => $photographer->id,
                    'created_by' => $creator1->id,
                    'department' => 'video',
                    'status' => 'in_progress',
                    'priority' => 'urgent',
                    'delivery_deadline' => Carbon::now()->addDay(),
                    'location_address' => 'مصر الجديدة - شارع الثورة - برج الأطباء - استوديو العميل',
                    'location_map_url' => 'https://maps.google.com/?q=30.0886,31.3325',
                    'location_lat' => 30.0886000,
                    'location_lng' => 31.3325000,
                    'geofence_radius_meters' => 100,
                    'attendance_status' => 'none',
                    'notes' => 'المطلوب تصوير 3 فيديوهات ريلز للمنتجات + صور فوتوسيشن مع الموديل.',
                ]
            );
        }

        if ($clients->count() >= 2) {
            $client2 = $clients[1];
            $project2 = Project::firstOrCreate(
                ['title' => 'إدارة حسابات مطعم برجر شهرياً (فريق عمر)'],
                [
                    'client_id' => $client2->id,
                    'content_creator_id' => $creator2->id,
                    'category' => 'social_media',
                    'total_budget' => 18000.00,
                    'start_date' => Carbon::now()->subDays(10),
                    'deadline' => Carbon::now()->addDays(20),
                    'status' => 'in_progress',
                    'description' => 'مشروع مدار بواسطة عمر خالد. لا تستطيع سارة رؤيته، فقط عمر والمدير العام.',
                ]
            );

            ClientInstallment::firstOrCreate(
                ['title' => 'دفعة تعاقد شهر نوفمبر لمطعم البرجر'],
                [
                    'client_id' => $client2->id,
                    'project_id' => $project2->id,
                    'amount' => 9000.00,
                    'due_date' => Carbon::now()->addDays(1), // due tomorrow!
                    'status' => 'pending',
                ]
            );
        }

        // 6. Send sample Notification to General Manager
        PlatformNotification::notifyGM(
            'welcome',
            'ترقية نظام وكالة بريق 2.0 جاهزة بنجاح!',
            'تم تفعيل عزل صناع المحتوى، وبصمة حضور المصور، ونظام الحسابات المتكامل، وإشعارات الـ PWA.',
            'rocket',
            '/dashboard'
        );
    }
}
