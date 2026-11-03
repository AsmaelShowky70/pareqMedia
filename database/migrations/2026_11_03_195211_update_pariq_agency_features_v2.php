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
        // 1. Update projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('content_creator_id')->nullable()->after('client_id')->constrained('users')->onDelete('set null');
            $table->timestamp('submitted_to_gm_at')->nullable()->after('description');
            $table->string('gm_approval_status')->default('pending')->after('submitted_to_gm_at'); // pending, approved, revisions_needed
            $table->text('delivery_notes')->nullable()->after('gm_approval_status');
        });

        // 2. Update tasks table for Photographer & Location Tracking
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('location_address')->nullable()->after('notes');
            $table->text('location_map_url')->nullable()->after('location_address');
            $table->decimal('location_lat', 10, 7)->nullable()->after('location_map_url');
            $table->decimal('location_lng', 10, 7)->nullable()->after('location_lat');
            $table->integer('geofence_radius_meters')->default(100)->after('location_lng');
            $table->timestamp('photographer_accepted_at')->nullable()->after('geofence_radius_meters');
            $table->decimal('photographer_start_lat', 10, 7)->nullable()->after('photographer_accepted_at');
            $table->decimal('photographer_start_lng', 10, 7)->nullable()->after('photographer_start_lat');
            $table->timestamp('photographer_arrived_at')->nullable()->after('photographer_start_lng');
            $table->decimal('photographer_arrival_lat', 10, 7)->nullable()->after('photographer_arrived_at');
            $table->decimal('photographer_arrival_lng', 10, 7)->nullable()->after('photographer_arrival_lat');
            $table->integer('photographer_arrival_distance_meters')->nullable()->after('photographer_arrival_lng');
            $table->string('attendance_status')->default('none')->after('photographer_arrival_distance_meters'); // none, on_the_way, checked_in, shoot_completed
        });

        // 3. Platform Notifications (General Manager & Agency wide notifications)
        Schema::create('platform_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // task_created, task_delivered, project_assigned, project_delivered, payment_received, photographer_started, photographer_arrived, installment_due
            $table->string('title');
            $table->text('message');
            $table->string('icon')->default('bell');
            $table->string('action_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 4. Client Payment Installments (أقساط ودفعات العملاء ومواعيد الاستحقاق)
        Schema::create('client_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->string('title'); // e.g. دفعة التعاقد الأولى، قسط شهر نوفمبر
            $table->decimal('amount', 12, 2);
            $table->date('due_date');
            $table->string('status')->default('pending'); // pending, paid, overdue
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 5. Detailed Accounting System: Treasury Accounts (الخزائن والحسابات المالية)
        Schema::create('treasury_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. انستاباي الرئيسي، فودافون كاش، بنك CIB، الخزينة النقدية
            $table->string('type')->default('instapay'); // instapay, vodafone_cash, bank, cash
            $table->string('account_number')->nullable();
            $table->decimal('balance', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 6. Detailed Accounting System: Accounting Categories (شجرة الحسابات والبنود)
        Schema::create('accounting_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. رواتب الموظفين، إعلانات ممولة Ad Spend، اشتراكات برامج، أرباح ريلز
            $table->string('type'); // revenue, expense
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 7. Detailed Accounting System: Financial Transactions (سجل القيود والمعاملات المحاسبية التفصيلية)
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->foreignId('treasury_account_id')->nullable()->constrained('treasury_accounts')->onDelete('set null');
            $table->foreignId('accounting_category_id')->nullable()->constrained('accounting_categories')->onDelete('set null');
            $table->string('type'); // revenue, expense, transfer
            $table->decimal('amount', 12, 2);
            $table->string('payment_method')->default('instapay'); // instapay, vodafone_cash, bank_transfer, cash, credit_card
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // الموظف / المستفيد
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('reference_number')->nullable();
            $table->date('transaction_date');
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
        Schema::dropIfExists('accounting_categories');
        Schema::dropIfExists('treasury_accounts');
        Schema::dropIfExists('client_installments');
        Schema::dropIfExists('platform_notifications');

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'location_address',
                'location_map_url',
                'location_lat',
                'location_lng',
                'geofence_radius_meters',
                'photographer_accepted_at',
                'photographer_start_lat',
                'photographer_start_lng',
                'photographer_arrived_at',
                'photographer_arrival_lat',
                'photographer_arrival_lng',
                'photographer_arrival_distance_meters',
                'attendance_status',
            ]);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['content_creator_id']);
            $table->dropColumn([
                'content_creator_id',
                'submitted_to_gm_at',
                'gm_approval_status',
                'delivery_notes',
            ]);
        });
    }
};
