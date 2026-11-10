<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('team_members')) {
            Schema::create('team_members', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('role');
                $table->string('dept')->nullable();
                $table->text('quote')->nullable();
                $table->string('image_url')->nullable();
                $table->string('icon')->nullable()->default('fa-solid fa-user');
                $table->string('gradient')->nullable()->default('from-brand-orange to-[#FF7A00]');
                $table->string('letter')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
