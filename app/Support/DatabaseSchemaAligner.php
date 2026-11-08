<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSchemaAligner
{
    /**
     * Run all schema alignment checks to guarantee seamless compatibility
     * between production database tables and Laravel models.
     */
    public static function align(): void
    {
        try {
            self::alignPayments();
            self::alignInvoices();
            self::alignExpenses();
            self::alignInquiries();
            self::alignPortfolioItems();
        } catch (\Throwable $e) {
            // Fail safely without disrupting user requests
            \Illuminate\Support\Facades\Log::warning('DatabaseSchemaAligner warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `payments` table has all required columns.
     */
    public static function alignPayments(): void
    {
        try {
            if (!Schema::hasTable('payments')) {
                return;
            }

            $columnsToAdd = [];

            if (!Schema::hasColumn('payments', 'project_id')) {
                $columnsToAdd[] = "ADD COLUMN `project_id` bigint(20) UNSIGNED DEFAULT NULL";
            }
            if (!Schema::hasColumn('payments', 'cashier_user_id')) {
                $columnsToAdd[] = "ADD COLUMN `cashier_user_id` bigint(20) UNSIGNED DEFAULT NULL";
            }
            if (!Schema::hasColumn('payments', 'payment_type')) {
                $columnsToAdd[] = "ADD COLUMN `payment_type` varchar(255) NOT NULL DEFAULT 'down_payment'";
            }
            if (!Schema::hasColumn('payments', 'transaction_reference')) {
                $columnsToAdd[] = "ADD COLUMN `transaction_reference` varchar(255) DEFAULT NULL";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `payments` " . implode(', ', $columnsToAdd));
            }

            // Make payment_date nullable if exists so it doesn't block inserts
            if (Schema::hasColumn('payments', 'payment_date')) {
                try {
                    DB::statement("ALTER TABLE `payments` MODIFY COLUMN `payment_date` date NULL DEFAULT NULL");
                } catch (\Throwable $e) {}
            }

            // Sync cashier_id and cashier_user_id if both exist
            if (Schema::hasColumn('payments', 'cashier_id') && Schema::hasColumn('payments', 'cashier_user_id')) {
                try {
                    DB::statement("UPDATE `payments` SET `cashier_user_id` = `cashier_id` WHERE `cashier_user_id` IS NULL AND `cashier_id` IS NOT NULL");
                } catch (\Throwable $e) {}
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignPayments warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `invoices` table has paid_amount and balance_due.
     */
    public static function alignInvoices(): void
    {
        try {
            if (!Schema::hasTable('invoices')) {
                return;
            }

            $columnsToAdd = [];
            if (!Schema::hasColumn('invoices', 'paid_amount')) {
                $columnsToAdd[] = "ADD COLUMN `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00";
            }
            if (!Schema::hasColumn('invoices', 'balance_due')) {
                $columnsToAdd[] = "ADD COLUMN `balance_due` decimal(12,2) NOT NULL DEFAULT 0.00";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `invoices` " . implode(', ', $columnsToAdd));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignInvoices warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `expenses` table has all required columns.
     */
    public static function alignExpenses(): void
    {
        try {
            if (!Schema::hasTable('expenses')) {
                return;
            }

            $columnsToAdd = [];
            if (!Schema::hasColumn('expenses', 'title')) {
                $columnsToAdd[] = "ADD COLUMN `title` varchar(255) NOT NULL DEFAULT 'مصروف'";
            }
            if (!Schema::hasColumn('expenses', 'payment_method')) {
                $columnsToAdd[] = "ADD COLUMN `payment_method` varchar(255) NOT NULL DEFAULT 'instapay'";
            }
            if (!Schema::hasColumn('expenses', 'project_id')) {
                $columnsToAdd[] = "ADD COLUMN `project_id` bigint(20) UNSIGNED DEFAULT NULL";
            }
            if (!Schema::hasColumn('expenses', 'created_by')) {
                $columnsToAdd[] = "ADD COLUMN `created_by` bigint(20) UNSIGNED DEFAULT NULL";
            }
            if (!Schema::hasColumn('expenses', 'spent_at')) {
                $columnsToAdd[] = "ADD COLUMN `spent_at` date DEFAULT NULL";
            }
            if (!Schema::hasColumn('expenses', 'receipt_file')) {
                $columnsToAdd[] = "ADD COLUMN `receipt_file` varchar(255) DEFAULT NULL";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `expenses` " . implode(', ', $columnsToAdd));
            }

            if (Schema::hasColumn('expenses', 'expense_date') && Schema::hasColumn('expenses', 'spent_at')) {
                try {
                    DB::statement("UPDATE `expenses` SET `spent_at` = `expense_date` WHERE `spent_at` IS NULL AND `expense_date` IS NOT NULL");
                } catch (\Throwable $e) {}
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignExpenses warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `inquiries` table has all required columns.
     */
    public static function alignInquiries(): void
    {
        try {
            if (!Schema::hasTable('inquiries')) {
                return;
            }

            $columnsToAdd = [];
            if (!Schema::hasColumn('inquiries', 'brand_name')) {
                $columnsToAdd[] = "ADD COLUMN `brand_name` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('inquiries', 'email')) {
                $columnsToAdd[] = "ADD COLUMN `email` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('inquiries', 'service_interested')) {
                $columnsToAdd[] = "ADD COLUMN `service_interested` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('inquiries', 'budget_range')) {
                $columnsToAdd[] = "ADD COLUMN `budget_range` varchar(255) DEFAULT NULL";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `inquiries` " . implode(', ', $columnsToAdd));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignInquiries warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `portfolio_items` table has all required columns.
     */
    public static function alignPortfolioItems(): void
    {
        try {
            if (!Schema::hasTable('portfolio_items')) {
                return;
            }

            $columnsToAdd = [];
            if (!Schema::hasColumn('portfolio_items', 'client_country')) {
                $columnsToAdd[] = "ADD COLUMN `client_country` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('portfolio_items', 'video_url')) {
                $columnsToAdd[] = "ADD COLUMN `video_url` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('portfolio_items', 'thumbnail')) {
                $columnsToAdd[] = "ADD COLUMN `thumbnail` varchar(255) DEFAULT NULL";
            }
            if (!Schema::hasColumn('portfolio_items', 'metrics')) {
                $columnsToAdd[] = "ADD COLUMN `metrics` varchar(255) DEFAULT NULL";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `portfolio_items` " . implode(', ', $columnsToAdd));
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignPortfolioItems warning: ' . $e->getMessage());
        }
    }
}
