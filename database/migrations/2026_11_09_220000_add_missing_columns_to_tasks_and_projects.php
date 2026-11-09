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
        if (Schema::hasTable('tasks')) {
            Schema::table('tasks', function (Blueprint $table) {
                if (!Schema::hasColumn('tasks', 'daily_delivery_deadline')) {
                    $table->string('daily_delivery_deadline')->nullable()->after('status');
                }
                if (!Schema::hasColumn('tasks', 'delivery_deadline')) {
                    $table->date('delivery_deadline')->nullable()->after('status');
                }
                if (!Schema::hasColumn('tasks', 'material_link')) {
                    $table->text('material_link')->nullable()->after('daily_delivery_deadline');
                }
                if (!Schema::hasColumn('tasks', 'delivery_link')) {
                    $table->text('delivery_link')->nullable()->after('material_link');
                }
                if (!Schema::hasColumn('tasks', 'location_address')) {
                    $table->string('location_address')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'location_map_url')) {
                    $table->text('location_map_url')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'attendance_status')) {
                    $table->string('attendance_status')->default('none');
                }
                if (!Schema::hasColumn('tasks', 'photographer_accepted_at')) {
                    $table->timestamp('photographer_accepted_at')->nullable();
                }
            });
        }

        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                if (!Schema::hasColumn('projects', 'content_creator_id')) {
                    $table->foreignId('content_creator_id')->nullable()->after('client_id')->constrained('users')->onDelete('set null');
                }
                if (!Schema::hasColumn('projects', 'submitted_to_gm_at')) {
                    $table->timestamp('submitted_to_gm_at')->nullable();
                }
                if (!Schema::hasColumn('projects', 'gm_approval_status')) {
                    $table->string('gm_approval_status')->default('pending');
                }
                if (!Schema::hasColumn('projects', 'delivery_notes')) {
                    $table->text('delivery_notes')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Non-destructive down
    }
};

