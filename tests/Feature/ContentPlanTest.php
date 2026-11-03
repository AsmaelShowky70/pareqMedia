<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\ContentPlan;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class ContentPlanTest extends TestCase
{
    protected User $admin;

    protected User $creatorSara;

    protected User $creatorOmar;

    protected User $employee;

    protected Client $clientA;

    protected Client $clientB;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin@pariqagency.com'],
            [
                'name' => 'المدير العام',
                'password' => bcrypt('password'),
                'role' => User::ROLE_ADMIN,
                'department' => 'management',
                'phone' => '+201000000001',
                'is_active' => true,
            ]
        );

        $this->creatorSara = User::firstOrCreate(
            ['email' => 'sara.creator@pariqagency.com'],
            [
                'name' => 'سارة الشريف',
                'password' => bcrypt('password'),
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'design',
                'phone' => '+201000000002',
                'is_active' => true,
            ]
        );

        $this->creatorOmar = User::firstOrCreate(
            ['email' => 'omar.creator@pariqagency.com'],
            [
                'name' => 'عمر الناصر',
                'password' => bcrypt('password'),
                'role' => User::ROLE_CONTENT_CREATOR,
                'department' => 'video',
                'phone' => '+201000000003',
                'is_active' => true,
            ]
        );

        $this->employee = User::firstOrCreate(
            ['email' => 'karim.video@pariqagency.com'],
            [
                'name' => 'كريم المونتير',
                'password' => bcrypt('password'),
                'role' => User::ROLE_EMPLOYEE,
                'department' => 'editing',
                'phone' => '+201000000004',
                'is_active' => true,
            ]
        );

        $this->clientA = Client::firstOrCreate(
            ['name' => 'عميل سارة (سكوب)'],
            [
                'brand_name' => 'Scope Agency',
                'phone' => '+201111111111',
                'country' => 'مصر',
                'status' => 'active',
                'monthly_retainer' => 15000,
            ]
        );

        $this->clientB = Client::firstOrCreate(
            ['name' => 'عميل عمر (فيرتو)'],
            [
                'brand_name' => 'Vertu Brand',
                'phone' => '+201222222222',
                'country' => 'مصر',
                'status' => 'active',
                'monthly_retainer' => 20000,
            ]
        );
    }

    public function test_regular_employee_cannot_access_content_calendar(): void
    {
        $response = $this->actingAs($this->employee)->get(route('content-plans.index'));
        $response->assertStatus(403);
    }

    public function test_gm_can_view_content_calendar_and_all_plans(): void
    {
        $response = $this->actingAs($this->admin)->get(route('content-plans.index'));
        $response->assertStatus(200);
        $response->assertSee('جدول وخطة نشر المحتوى للعملاء');
    }

    public function test_content_creator_strict_isolation(): void
    {
        $planSara = ContentPlan::create([
            'client_id' => $this->clientA->id,
            'content_creator_id' => $this->creatorSara->id,
            'created_by' => $this->creatorSara->id,
            'title' => 'ريل سارة الخاص جداً لا يراه عمر',
            'content_type' => 'reel',
            'publish_date' => Carbon::today()->format('Y-m-d'),
            'production_status' => 'ready_to_publish',
            'publishing_status' => 'scheduled',
        ]);

        $planOmar = ContentPlan::create([
            'client_id' => $this->clientB->id,
            'content_creator_id' => $this->creatorOmar->id,
            'created_by' => $this->creatorOmar->id,
            'title' => 'ريل عمر الخاص جداً لا تراه سارة',
            'content_type' => 'reel',
            'publish_date' => Carbon::today()->format('Y-m-d'),
            'production_status' => 'ready_to_publish',
            'publishing_status' => 'scheduled',
        ]);

        // Sara logs in: must see her plan, MUST NOT see Omar's plan
        $responseSara = $this->actingAs($this->creatorSara)->get(route('content-plans.index', [
            'year' => Carbon::today()->year,
            'month' => Carbon::today()->month,
        ]));
        $responseSara->assertStatus(200);
        $responseSara->assertSee($planSara->title);
        $responseSara->assertDontSee($planOmar->title);

        // Omar logs in: must see his plan, MUST NOT see Sara's plan
        $responseOmar = $this->actingAs($this->creatorOmar)->get(route('content-plans.index', [
            'year' => Carbon::today()->year,
            'month' => Carbon::today()->month,
        ]));
        $responseOmar->assertStatus(200);
        $responseOmar->assertSee($planOmar->title);
        $responseOmar->assertDontSee($planSara->title);

        // Admin logs in: sees BOTH plans
        $responseAdmin = $this->actingAs($this->admin)->get(route('content-plans.index', [
            'year' => Carbon::today()->year,
            'month' => Carbon::today()->month,
        ]));
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee($planSara->title);
        $responseAdmin->assertSee($planOmar->title);
    }

    public function test_creator_cannot_edit_or_delete_another_creator_plan(): void
    {
        $planSara = ContentPlan::create([
            'client_id' => $this->clientA->id,
            'content_creator_id' => $this->creatorSara->id,
            'created_by' => $this->creatorSara->id,
            'title' => 'منشور سارة المحمي',
            'content_type' => 'post',
            'publish_date' => Carbon::today()->format('Y-m-d'),
            'production_status' => 'ready_to_publish',
            'publishing_status' => 'scheduled',
        ]);

        // Omar tries to update Sara's plan
        $response = $this->actingAs($this->creatorOmar)->put(route('content-plans.update', $planSara), [
            'client_id' => $this->clientB->id,
            'title' => 'محاولة اختراق منشور سارة',
            'content_type' => 'post',
            'publish_date' => Carbon::today()->format('Y-m-d'),
            'production_status' => 'ready_to_publish',
            'publishing_status' => 'scheduled',
        ]);
        $response->assertStatus(403);

        // Omar tries to delete Sara's plan
        $deleteResponse = $this->actingAs($this->creatorOmar)->delete(route('content-plans.destroy', $planSara));
        $deleteResponse->assertStatus(403);
    }

    public function test_create_and_toggle_publish_content_plan(): void
    {
        $uniqueTitle = 'ريل الفرق بين التصميم والواقع الجديد '.uniqid();

        $response = $this->actingAs($this->creatorSara)->post(route('content-plans.store'), [
            'client_id' => $this->clientA->id,
            'title' => $uniqueTitle,
            'content_type' => 'reel',
            'platforms' => ['instagram', 'tiktok'],
            'publish_date' => Carbon::today()->addDays(5)->format('Y-m-d'),
            'publish_time' => '19:30',
            'client_delivery_deadline' => Carbon::today()->addDays(3)->format('Y-m-d'),
            'content_url' => 'https://drive.google.com/test-file',
            'caption' => 'كابشن تسويقي احترافي للريل #بريق',
            'production_status' => 'ready_to_publish',
            'publishing_status' => 'scheduled',
            'notes' => 'جاهز للنشر بعد موافقة العميل',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('content_plans', [
            'title' => $uniqueTitle,
            'content_creator_id' => $this->creatorSara->id,
            'is_published' => false,
        ]);

        $plan = ContentPlan::where('title', $uniqueTitle)->first();
        $this->assertNotNull($plan);
        $this->assertFalse($plan->is_published);

        // Toggle publish status (one click)
        $toggleResponse = $this->actingAs($this->creatorSara)->post(route('content-plans.toggle-publish', $plan));
        $toggleResponse->assertRedirect();

        $plan->refresh();
        $this->assertTrue($plan->is_published);
        $this->assertEquals('published', $plan->publishing_status);
        $this->assertNotNull($plan->published_at);
    }

    public function test_calendar_and_pipeline_views(): void
    {
        // Test Calendar View
        $calendarResponse = $this->actingAs($this->admin)->get(route('content-plans.index', ['view' => 'calendar']));
        $calendarResponse->assertStatus(200);
        $calendarResponse->assertSee('السبت');
        $calendarResponse->assertSee('الأحد');

        // Test Pipeline View
        $pipelineResponse = $this->actingAs($this->admin)->get(route('content-plans.index', ['view' => 'pipeline']));
        $pipelineResponse->assertStatus(200);
        $pipelineResponse->assertSee('أفكار ومسودات');
        $pipelineResponse->assertSee('تم النشر بنجاح');
    }
}
