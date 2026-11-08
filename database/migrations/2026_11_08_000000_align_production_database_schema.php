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
        // 1. Payments Table Alignment
        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                if (!Schema::hasColumn('payments', 'project_id')) {
                    $table->foreignId('project_id')->nullable()->after('invoice_id')->constrained('projects')->onDelete('set null');
                }
                if (!Schema::hasColumn('payments', 'cashier_user_id')) {
                    $table->foreignId('cashier_user_id')->nullable()->after('project_id')->constrained('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payments', 'payment_type')) {
                    $table->string('payment_type')->default('down_payment')->after('amount');
                }
                if (!Schema::hasColumn('payments', 'transaction_reference')) {
                    $table->string('transaction_reference')->nullable()->after('payment_method');
                }
            });
        }

        // 2. Invoices Table Alignment
        if (Schema::hasTable('invoices')) {
            Schema::table('invoices', function (Blueprint $table) {
                if (!Schema::hasColumn('invoices', 'paid_amount')) {
                    $table->decimal('paid_amount', 12, 2)->default(0)->after('total_amount');
                }
                if (!Schema::hasColumn('invoices', 'balance_due')) {
                    $table->decimal('balance_due', 12, 2)->default(0)->after('paid_amount');
                }
            });
        }

        // 3. Expenses Table Alignment
        if (Schema::hasTable('expenses')) {
            Schema::table('expenses', function (Blueprint $table) {
                if (!Schema::hasColumn('expenses', 'title')) {
                    $table->string('title')->default('مصروف')->after('id');
                }
                if (!Schema::hasColumn('expenses', 'payment_method')) {
                    $table->string('payment_method')->default('instapay')->after('amount');
                }
                if (!Schema::hasColumn('expenses', 'project_id')) {
                    $table->foreignId('project_id')->nullable()->after('payment_method')->constrained('projects')->onDelete('set null');
                }
                if (!Schema::hasColumn('expenses', 'created_by')) {
                    $table->foreignId('created_by')->nullable()->after('project_id')->constrained('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'spent_at')) {
                    $table->date('spent_at')->nullable()->after('created_by');
                }
                if (!Schema::hasColumn('expenses', 'receipt_file')) {
                    $table->string('receipt_file')->nullable()->after('notes');
                }
            });
        }

        // 4. Inquiries Table Alignment
        if (Schema::hasTable('inquiries')) {
            Schema::table('inquiries', function (Blueprint $table) {
                if (!Schema::hasColumn('inquiries', 'brand_name')) {
                    $table->string('brand_name')->nullable()->after('name');
                }
                if (!Schema::hasColumn('inquiries', 'email')) {
                    $table->string('email')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('inquiries', 'service_interested')) {
                    $table->string('service_interested')->nullable()->after('email');
                }
                if (!Schema::hasColumn('inquiries', 'budget_range')) {
                    $table->string('budget_range')->nullable()->after('service_interested');
                }
            });
        }

        // 5. Portfolio Items Table Alignment
        if (Schema::hasTable('portfolio_items')) {
            Schema::table('portfolio_items', function (Blueprint $table) {
                if (!Schema::hasColumn('portfolio_items', 'client_country')) {
                    $table->string('client_country')->nullable()->after('client_name');
                }
                if (!Schema::hasColumn('portfolio_items', 'video_url')) {
                    $table->string('video_url')->nullable()->after('category');
                }
                if (!Schema::hasColumn('portfolio_items', 'thumbnail')) {
                    $table->string('thumbnail')->nullable()->after('video_url');
                }
                if (!Schema::hasColumn('portfolio_items', 'metrics')) {
                    $table->string('metrics')->nullable()->after('thumbnail');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Non-destructive down method
    }
};

