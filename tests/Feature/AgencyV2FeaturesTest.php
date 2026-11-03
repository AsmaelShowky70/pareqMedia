<?php

namespace Tests\Feature;

use App\Models\AccountingCategory;
use App\Models\Client;
use App\Models\ClientInstallment;
use App\Models\PlatformNotification;
use App\Models\Project;
use App\Models\Task;
use App\Models\TreasuryAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AgencyV2FeaturesTest extends TestCase
{
    use DatabaseTransactions;

    protected User $admin;

    protected User $creator1;

    protected User $creator2;

    protected User $employee;

    protected User $photographer;

    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin@pariqagency.com'],
            ['name' => 'المدير العام', 'password' => bcrypt('password'), 'role' => 'admin', 'department' => 'management', 'is_active' => true]
        );

        $this->creator1 = User::firstOrCreate(
            ['email' => 'creator1.test@pariqagency.com'],
            ['name' => 'صانع محتوى 1', 'password' => bcrypt('password'), 'role' => 'content_creator', 'department' => 'management', 'is_active' => true]
        );

        $this->creator2 = User::firstOrCreate(
            ['email' => 'creator2.test@pariqagency.com'],
            ['name' => 'صانع محتوى 2', 'password' => bcrypt('password'), 'role' => 'content_creator', 'department' => 'management', 'is_active' => true]
        );

        $this->employee = User::firstOrCreate(
            ['email' => 'employee.test@pariqagency.com'],
            ['name' => 'مونتير تجريبي', 'password' => bcrypt('password'), 'role' => 'employee', 'department' => 'editing', 'is_active' => true]
        );

        $this->photographer = User::firstOrCreate(
            ['email' => 'photographer.test@pariqagency.com'],
            ['name' => 'مصور ميداني تجريبي', 'password' => bcrypt('password'), 'role' => 'employee', 'department' => 'video', 'job_title' => 'مصور', 'is_active' => true]
        );

        $this->client = Client::firstOrCreate(
            ['name' => 'عميل اختبار VIP'],
            ['phone' => '01011111111', 'country' => 'مصر', 'monthly_retainer' => 15000, 'status' => 'active']
        );
    }

    /**
     * Test 1: Content Creator Isolation Policy:
     * Creator 1 CANNOT view Creator 2's project or tasks.
     * General Manager can view all projects.
     */
    public function test_content_creator_isolation(): void
    {
        $project1 = Project::create([
            'client_id' => $this->client->id,
            'content_creator_id' => $this->creator1->id,
            'title' => 'مشروع صانع المحتوى الأول',
            'category' => 'video_production',
            'total_budget' => 20000,
            'status' => 'in_progress',
        ]);

        $project2 = Project::create([
            'client_id' => $this->client->id,
            'content_creator_id' => $this->creator2->id,
            'title' => 'مشروع صانع المحتوى الثاني السري',
            'category' => 'social_media',
            'total_budget' => 15000,
            'status' => 'in_progress',
        ]);

        // Creator 1 cannot view Project 2
        $response = $this->actingAs($this->creator1)->get(route('projects.show', $project2->id));
        $response->assertStatus(403);

        // Creator 1 sees only Project 1 in index
        $indexResponse = $this->actingAs($this->creator1)->get(route('projects.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('مشروع صانع المحتوى الأول');
        $indexResponse->assertDontSee('مشروع صانع المحتوى الثاني السري');

        // Admin (General Manager) sees both projects
        $adminResponse = $this->actingAs($this->admin)->get(route('projects.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('مشروع صانع المحتوى الأول');
        $adminResponse->assertSee('مشروع صانع المحتوى الثاني السري');
    }

    /**
     * Test 2: Project Delivery to General Manager & GM Approval Workflow
     */
    public function test_project_delivery_to_gm_and_decision(): void
    {
        $project = Project::create([
            'client_id' => $this->client->id,
            'content_creator_id' => $this->creator1->id,
            'title' => 'مشروع للتسليم للمدير العام',
            'category' => 'video_production',
            'total_budget' => 30000,
            'status' => 'in_progress',
        ]);

        // Creator delivers project to GM
        $deliverResponse = $this->actingAs($this->creator1)->post(route('projects.deliver-to-gm', $project->id), [
            'delivery_notes' => 'تم إنهاء كافة الفيديوهات والمونتاج بنجاح وروابط التسليم جاهزة.',
        ]);
        $deliverResponse->assertRedirect();

        $project->refresh();
        $this->assertEquals('delivered', $project->status);
        $this->assertEquals('pending', $project->gm_approval_status);

        // GM Approves project
        $decisionResponse = $this->actingAs($this->admin)->post(route('projects.gm-decision', $project->id), [
            'decision' => 'approved',
            'notes' => 'ممتاز جداً، عمل رائع واعتمد بنجاح.',
        ]);
        $decisionResponse->assertRedirect();

        $project->refresh();
        $this->assertEquals('completed', $project->status);
        $this->assertEquals('approved', $project->gm_approval_status);
    }

    /**
     * Test 3: Employee Dashboard, Urgency Colors & Portfolio
     */
    public function test_employee_dashboard_and_portfolio(): void
    {
        // Urgent task (Due tomorrow) -> Red urgency
        $urgentTask = Task::create([
            'client_id' => $this->client->id,
            'assigned_to' => $this->employee->id,
            'created_by' => $this->creator1->id,
            'title' => 'مهمة عاجلة جداً تنتهي غداً',
            'department' => 'editing',
            'status' => 'in_progress',
            'priority' => 'urgent',
            'delivery_deadline' => Carbon::tomorrow(),
        ]);

        // Safe task (Due in 10 days) -> Green urgency
        $safeTask = Task::create([
            'client_id' => $this->client->id,
            'assigned_to' => $this->employee->id,
            'created_by' => $this->creator1->id,
            'title' => 'مهمة متبقي وقت كافي',
            'department' => 'editing',
            'status' => 'not_started',
            'priority' => 'medium',
            'delivery_deadline' => Carbon::now()->addDays(10),
        ]);

        // Completed task for Portfolio
        $completedTask = Task::create([
            'client_id' => $this->client->id,
            'assigned_to' => $this->employee->id,
            'created_by' => $this->creator1->id,
            'title' => 'فيديو ريلز معتمد ومسلم سابقاً',
            'department' => 'editing',
            'status' => 'completed',
            'priority' => 'high',
            'delivery_link' => 'https://drive.google.com/test-work',
            'completed_at' => Carbon::now()->subDays(2),
        ]);

        $this->assertEquals('red', $urgentTask->urgency_info['code']);
        $this->assertEquals('green', $safeTask->urgency_info['code']);
        $this->assertEquals('completed', $completedTask->urgency_info['code']);

        // Employee Dashboard
        $dashResponse = $this->actingAs($this->employee)->get(route('dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('مهمة عاجلة جداً تنتهي غداً');

        // Employee Portfolio Page
        $portfolioResponse = $this->actingAs($this->employee)->get(route('my-portfolio'));
        $portfolioResponse->assertStatus(200);
        $portfolioResponse->assertSee('فيديو ريلز معتمد ومسلم سابقاً');
        $portfolioResponse->assertSee('https://drive.google.com/test-work');
    }

    /**
     * Test 4: Photographer Field Tracking & Geofence Check-in
     */
    public function test_photographer_geofence_attendance(): void
    {
        // Client shoot location: Heliopolis (30.0886000, 31.3325000)
        $shootTask = Task::create([
            'client_id' => $this->client->id,
            'assigned_to' => $this->photographer->id,
            'created_by' => $this->creator1->id,
            'title' => 'جلسة تصوير موديل في موقع العميل',
            'department' => 'video',
            'status' => 'in_progress',
            'priority' => 'urgent',
            'location_address' => 'مصر الجديدة شارع الثورة',
            'location_lat' => 30.0886000,
            'location_lng' => 31.3325000,
            'geofence_radius_meters' => 100,
            'attendance_status' => 'none',
        ]);

        // Step 1: Photographer accepts task and starts moving
        $startResponse = $this->actingAs($this->photographer)->postJson(route('tasks.photographer.accept', $shootTask->id), [
            'lat' => 30.0500000,
            'lng' => 31.3000000,
        ]);
        $startResponse->assertStatus(200);
        $shootTask->refresh();
        $this->assertEquals('on_the_way', $shootTask->attendance_status);

        // Step 2a: Check-in while far away (e.g. 5 km away) should fail without override
        $farCheckinResponse = $this->actingAs($this->photographer)->postJson(route('tasks.photographer.checkin', $shootTask->id), [
            'lat' => 30.0500000,
            'lng' => 31.3000000,
        ]);
        $farCheckinResponse->assertStatus(422);

        // Step 2b: Check-in close to location (within 50 meters, ~ 30.0887, 31.3326)
        $closeCheckinResponse = $this->actingAs($this->photographer)->postJson(route('tasks.photographer.checkin', $shootTask->id), [
            'lat' => 30.0886200,
            'lng' => 31.3325100,
        ]);
        $closeCheckinResponse->assertStatus(200);
        $shootTask->refresh();
        $this->assertEquals('checked_in', $shootTask->attendance_status);
        $this->assertNotNull($shootTask->photographer_arrived_at);

        // Step 3: Photographer delivers shoot footage
        $deliverResponse = $this->actingAs($this->photographer)->post(route('tasks.photographer.deliver', $shootTask->id), [
            'delivery_link' => 'https://drive.google.com/raw-photos',
            'notes' => 'تم إنهاء الجلسة بنجاح وتصوير كافة المنتجات.',
        ]);
        $deliverResponse->assertRedirect();
        $shootTask->refresh();
        $this->assertEquals('shoot_completed', $shootTask->attendance_status);
        $this->assertEquals('completed', $shootTask->status);
    }

    /**
     * Test 5: Client Installments & Monthly Retainer Filter
     */
    public function test_crm_installments_and_monthly_filter(): void
    {
        // Create installment due in 2 days
        $installment = ClientInstallment::create([
            'client_id' => $this->client->id,
            'title' => 'دفعة تعاقد ريلز',
            'amount' => 7500,
            'due_date' => Carbon::now()->addDays(2),
            'status' => 'pending',
        ]);

        $this->assertTrue($installment->urgency_info['is_approaching']);

        // Treasury account
        $treasury = TreasuryAccount::create([
            'name' => 'خزينة انستاباي للاختبار',
            'type' => 'instapay',
            'balance' => 10000,
            'is_active' => true,
        ]);

        // Pay installment
        $payResponse = $this->actingAs($this->admin)->post(route('installments.pay', $installment->id), [
            'paid_amount' => 7500,
            'payment_method' => 'instapay',
            'treasury_account_id' => $treasury->id,
            'transaction_reference' => 'TXN-TEST-123',
        ]);
        $payResponse->assertRedirect();

        $installment->refresh();
        $this->assertEquals('paid', $installment->status);
        $this->assertEquals(7500, $installment->paid_amount);

        $treasury->refresh();
        $this->assertEquals(17500, $treasury->balance); // incremented!

        // CRM monthly filter
        $crmResponse = $this->actingAs($this->admin)->get(route('clients.index', ['month' => Carbon::now()->format('Y-m')]));
        $crmResponse->assertStatus(200);
        $crmResponse->assertSee($this->client->name);
    }

    /**
     * Test 6: Detailed Accounting System (Revenues, Expenses, Treasuries)
     */
    public function test_detailed_accounting_system(): void
    {
        $treasury = TreasuryAccount::create([
            'name' => 'محفظة بنكية للاختبار',
            'type' => 'bank',
            'balance' => 50000,
            'is_active' => true,
        ]);

        $category = AccountingCategory::create([
            'name' => 'اشتراكات برامج وأدوات الذكاء الاصطناعي',
            'type' => 'expense',
            'code' => 'EXP-AI',
        ]);

        // Record expense transaction
        $expenseResponse = $this->actingAs($this->admin)->post(route('accounting.transactions.store'), [
            'type' => 'expense',
            'amount' => 3000,
            'treasury_account_id' => $treasury->id,
            'accounting_category_id' => $category->id,
            'payment_method' => 'bank_transfer',
            'transaction_date' => Carbon::today()->format('Y-m-d'),
            'description' => 'تجديد اشتراك أدوبي وميدجورني لشهر كامل',
        ]);
        $expenseResponse->assertRedirect();

        $treasury->refresh();
        $this->assertEquals(47000, $treasury->balance); // decremented!

        // Accounting Index & Reports
        $accountingResponse = $this->actingAs($this->admin)->get(route('accounting.index'));
        $accountingResponse->assertStatus(200);
        $accountingResponse->assertSee('تجديد اشتراك أدوبي وميدجورني لشهر كامل');

        $reportsResponse = $this->actingAs($this->admin)->get(route('accounting.reports'));
        $reportsResponse->assertStatus(200);
        $reportsResponse->assertSee('اشتراكات برامج وأدوات الذكاء الاصطناعي');
    }

    /**
     * Test 7: Notifications API Feed (PWA & Topbar Real-Time Polling)
     */
    public function test_notifications_pwa_api_feed(): void
    {
        PlatformNotification::send(
            $this->admin->id,
            'test_alert',
            'إشعار اختبار فوري للمدير العام',
            'تم تسجيل قيد مالي جديد بنجاح',
            'bell',
            '/accounting'
        );

        $feedResponse = $this->actingAs($this->admin)->getJson(route('notifications.unread-feed'));
        $feedResponse->assertStatus(200);
        $feedResponse->assertJsonStructure([
            'count',
            'notifications' => [
                '*' => ['id', 'type', 'title', 'message', 'icon', 'action_url', 'is_read', 'time_ago'],
            ],
        ]);
        $this->assertGreaterThanOrEqual(1, $feedResponse->json('count'));
    }
}
