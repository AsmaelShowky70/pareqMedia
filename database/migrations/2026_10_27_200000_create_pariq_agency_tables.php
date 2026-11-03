<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Clients
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand_name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country')->default('مصر');
            $table->string('service_package')->nullable();
            $table->decimal('monthly_retainer', 12, 2)->nullable()->default(0);
            $table->string('status')->default('active'); // active, lead, completed, paused
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 2. Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('title');
            $table->string('category')->default('video_production'); // video_production, social_media, media_buying, branding, full_campaign
            $table->decimal('total_budget', 12, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status')->default('in_progress'); // planning, in_progress, review, completed, cancelled
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. Tasks
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade'); // المالك / المسؤول
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('department')->default('editing'); // editing, video, design, media_buyer, management
            // الحالات الخمس المطلوبة: لم تبدأ ، جاري العمل ، مكتمل ، إلغاء المشروع ، اجازه
            $table->string('status')->default('not_started'); // not_started, in_progress, completed, cancelled, on_leave
            $table->date('delivery_deadline')->nullable(); // موعد التسليم
            $table->string('daily_delivery_deadline')->nullable(); // موعد التسليم اليومي
            $table->text('material_link')->nullable(); // لينك الماتريال
            $table->text('delivery_link')->nullable(); // لينك التسليم
            $table->text('notes')->nullable(); // ملاحظات
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 4. Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('balance_due', 12, 2)->default(0);
            $table->string('status')->default('unpaid'); // unpaid, partially_paid, paid
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 5. Invoice Items
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('service_name');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->timestamps();
        });

        // 6. Payments (كاشير الوكالة وإيصالات القبض)
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('cashier_user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('payment_type')->default('down_payment'); // down_payment, milestone, final_clearance, quick_service
            $table->string('payment_method')->default('instapay'); // instapay, vodafone_cash, cash, bank_transfer, credit_card
            $table->string('transaction_reference')->nullable(); // كود التحويل / العملية
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 7. Expenses
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('other'); // ad_spend, freelancers, software_tools, equipment, office_rent, other
            $table->decimal('amount', 12, 2);
            $table->string('payment_method')->default('instapay');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->date('spent_at');
            $table->text('notes')->nullable();
            $table->string('receipt_file')->nullable();
            $table->timestamps();
        });

        // 8. Services (خدمات الوكالة)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('icon')->default('video');
            $table->text('short_description');
            $table->text('full_description')->nullable();
            $table->decimal('starting_price', 12, 2)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 9. Portfolio Items (معرض الأعمال)
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('title');
            $table->string('client_name')->nullable();
            $table->string('client_country')->nullable();
            $table->string('category')->default('video_reels'); // video_reels, promo_video, social_design, youtube_thumbnail, branding, ad_results
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('metrics')->nullable(); // e.g. "+1.8M مشاهدة"
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 10. Inquiries (طلبات واستشارات العملاء)
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand_name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('service_interested')->nullable();
            $table->string('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('new'); // new, contacted, converted, closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('portfolio_items');
        Schema::dropIfExists('services');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('clients');
    }
};
