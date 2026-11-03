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
        Schema::create('content_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->foreignId('content_creator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            $table->string('title'); // e.g. ريل الفرق بين التصميم والواقع
            $table->string('content_type')->default('reel'); // reel, carousel, post, story, video, other
            $table->json('platforms')->nullable(); // ['instagram', 'facebook', 'tiktok', 'linkedin', 'youtube']
            $table->date('publish_date'); // ميعاد النشر
            $table->string('publish_time')->nullable()->default('18:00'); // توقيت النشر
            $table->date('client_delivery_deadline')->nullable(); // ميعاد تسليم المحتوى للعميل بحد أقصى للمراجعة
            $table->text('content_url')->nullable(); // لينك المحتوى (جوجل درايف / فيجما / فيديو)
            $table->text('caption')->nullable(); // نص المنشور / الكابشن والهاشتاجات

            // حالة التنفيذ البرمجية / الإنتاجية vs حالة النشر المجدولة
            $table->string('production_status')->default('ready_to_publish'); // idea, in_production, client_review, ready_to_publish
            $table->string('publishing_status')->default('scheduled'); // scheduled, published, postponed, cancelled
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for lightning fast queries
            $table->index(['client_id', 'publish_date']);
            $table->index(['content_creator_id', 'publish_date']);
            $table->index('publish_date');
            $table->index('publishing_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_plans');
    }
};
