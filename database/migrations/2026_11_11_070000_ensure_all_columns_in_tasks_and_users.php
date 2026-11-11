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
                if (!Schema::hasColumn('tasks', 'priority')) {
                    $table->string('priority', 50)->default('medium');
                }
                if (!Schema::hasColumn('tasks', 'delivery_deadline')) {
                    $table->date('delivery_deadline')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'daily_delivery_deadline')) {
                    $table->string('daily_delivery_deadline')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'material_link')) {
                    $table->text('material_link')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'delivery_link')) {
                    $table->text('delivery_link')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'notes')) {
                    $table->text('notes')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'completed_at')) {
                    $table->timestamp('completed_at')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'location_address')) {
                    $table->string('location_address', 500)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'location_map_url')) {
                    $table->text('location_map_url')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'location_lat')) {
                    $table->decimal('location_lat', 10, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'location_lng')) {
                    $table->decimal('location_lng', 11, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'geofence_radius_meters')) {
                    $table->integer('geofence_radius_meters')->default(100);
                }
                if (!Schema::hasColumn('tasks', 'photographer_accepted_at')) {
                    $table->timestamp('photographer_accepted_at')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_start_lat')) {
                    $table->decimal('photographer_start_lat', 10, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_start_lng')) {
                    $table->decimal('photographer_start_lng', 11, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_arrived_at')) {
                    $table->timestamp('photographer_arrived_at')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_arrival_lat')) {
                    $table->decimal('photographer_arrival_lat', 10, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_arrival_lng')) {
                    $table->decimal('photographer_arrival_lng', 11, 8)->nullable();
                }
                if (!Schema::hasColumn('tasks', 'photographer_arrival_distance_meters')) {
                    $table->integer('photographer_arrival_distance_meters')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'attendance_status')) {
                    $table->string('attendance_status', 50)->default('none');
                }
                if (!Schema::hasColumn('tasks', 'client_id')) {
                    $table->unsignedBigInteger('client_id')->nullable();
                }
                if (!Schema::hasColumn('tasks', 'project_id')) {
                    $table->unsignedBigInteger('project_id')->nullable();
                }
            });
        }

        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role', 50)->default('employee');
                }
                if (!Schema::hasColumn('users', 'department')) {
                    $table->string('department', 100)->default('editing');
                }
                if (!Schema::hasColumn('users', 'job_title')) {
                    $table->string('job_title')->default('عضو فريق');
                }
                if (!Schema::hasColumn('users', 'daily_quota')) {
                    $table->string('daily_quota')->nullable();
                }
                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone', 50)->nullable();
                }
                if (!Schema::hasColumn('users', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe no-op
    }
};
