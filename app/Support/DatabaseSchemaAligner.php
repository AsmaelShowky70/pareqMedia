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
            self::alignPartners();
            self::alignTestimonials();
            self::alignSiteSettings();
            self::alignTeamMembers();
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
            if (!Schema::hasColumn('portfolio_items', 'is_featured')) {
                $columnsToAdd[] = "ADD COLUMN `is_featured` tinyint(1) NOT NULL DEFAULT 0";
            }
            if (!Schema::hasColumn('portfolio_items', 'sort_order')) {
                $columnsToAdd[] = "ADD COLUMN `sort_order` int(11) NOT NULL DEFAULT 0";
            }

            if (!empty($columnsToAdd)) {
                DB::statement("ALTER TABLE `portfolio_items` " . implode(', ', $columnsToAdd));
            }

            // Self-repair any portfolio items with Google Drive links:
            // 1) Converts them to direct Google Cloud CDN (0 MB hosting storage!)
            // 2) If a Drive link was saved in video_url, sets it as thumbnail/media_url, clears video_url, sets media_type = image
            $driveItems = DB::table('portfolio_items')
                ->where('thumbnail', 'like', '%drive.google.com%')
                ->orWhere('thumbnail', 'like', '%googleusercontent.com%')
                ->orWhere('thumbnail_url', 'like', '%drive.google.com%')
                ->orWhere('thumbnail_url', 'like', '%googleusercontent.com%')
                ->orWhere('media_url', 'like', '%drive.google.com%')
                ->orWhere('media_url', 'like', '%googleusercontent.com%')
                ->orWhere('video_url', 'like', '%drive.google.com%')
                ->orWhere('video_url', 'like', '%googleusercontent.com%')
                ->get();

            foreach ($driveItems as $di) {
                $rawDrive = null;
                foreach ([$di->thumbnail, $di->thumbnail_url, $di->media_url, $di->video_url] as $candidate) {
                    if (!empty($candidate) && (str_contains($candidate, 'drive.google.com') || str_contains($candidate, 'googleusercontent.com'))) {
                        $rawDrive = $candidate;
                        break;
                    }
                }

                if ($rawDrive) {
                    $cdnUrl = \App\Support\MediaHelper::convertToDirectCdnUrl($rawDrive);
                    if ($cdnUrl) {
                        $updates = [
                            'thumbnail' => $cdnUrl,
                            'thumbnail_url' => $cdnUrl,
                        ];

                        $imageCats = ['social_design', 'branding', 'youtube_thumbnail', 'ad_results', 'design', 'campaigns'];
                        $isImage = in_array($di->category, $imageCats, true) || (str_contains($di->video_url ?? '', 'drive.google.com') || str_contains($di->video_url ?? '', 'googleusercontent.com'));

                        if ($isImage) {
                            $updates['media_type'] = 'image';
                            $updates['media_url'] = $cdnUrl;
                            $updates['video_url'] = null;
                        }

                        DB::table('portfolio_items')->where('id', $di->id)->update($updates);
                    }
                }
            }

            // Auto-fix any YouTube portfolio item that had /images/portfolio/social_1.webp set by default:
            $ytItems = DB::table('portfolio_items')
                ->whereNotNull('video_url')
                ->where(function($q) {
                    $q->whereNull('thumbnail')
                      ->orWhere('thumbnail', '')
                      ->orWhere('thumbnail', '/images/portfolio/social_1.webp');
                })
                ->get();
            foreach ($ytItems as $yi) {
                $ytThumb = \App\Support\MediaHelper::fetchAndCacheYouTubeThumbnail($yi->video_url);
                if ($ytThumb) {
                    DB::table('portfolio_items')->where('id', $yi->id)->update([
                        'thumbnail' => $ytThumb,
                        'thumbnail_url' => $ytThumb,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignPortfolioItems warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `partners` table exists.
     */
    public static function alignPartners(): void
    {
        try {
            if (!Schema::hasTable('partners')) {
                Schema::create('partners', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('category')->nullable();
                    $table->string('logo_url')->nullable();
                    $table->integer('sort_order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            } else {
                // Self-heal and cache any Google Drive links already stored in `partners` table
                $drivePartners = DB::table('partners')
                    ->where('logo_url', 'like', '%drive.google.com%')
                    ->orWhere('logo_url', 'like', '%googleusercontent.com%')
                    ->get();
                foreach ($drivePartners as $dp) {
                    $localPath = \App\Support\MediaHelper::downloadAndCacheGoogleDrive($dp->logo_url);
                    if ($localPath) {
                        DB::table('partners')->where('id', $dp->id)->update([
                            'logo_url' => $localPath
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignPartners warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `testimonials` table exists.
     */
    public static function alignTestimonials(): void
    {
        try {
            if (!Schema::hasTable('testimonials')) {
                Schema::create('testimonials', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('client_name');
                    $table->string('client_title')->nullable();
                    $table->string('client_country')->nullable();
                    $table->string('type')->default('video_reel');
                    $table->text('content')->nullable();
                    $table->integer('rating')->default(5);
                    $table->string('media_url')->nullable();
                    $table->string('thumbnail')->nullable();
                    $table->integer('sort_order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }

            // Self-repair: Auto-fetch YouTube thumbnails and normalize URLs for any existing testimonial
            $existingTestimonials = DB::table('testimonials')->whereNotNull('media_url')->get();
            foreach ($existingTestimonials as $et) {
                $ytId = \App\Support\MediaHelper::extractYouTubeId($et->media_url);
                if ($ytId) {
                    $updates = [];
                    $normalized = \App\Support\MediaHelper::normalizeYouTubeUrl($et->media_url);
                    if ($normalized !== $et->media_url) {
                        $updates['media_url'] = $normalized;
                    }
                    if (empty($et->thumbnail)) {
                        $updates['thumbnail'] = 'https://img.youtube.com/vi/' . $ytId . '/hqdefault.jpg';
                    }
                    if (!empty($updates)) {
                        DB::table('testimonials')->where('id', $et->id)->update($updates);
                    }
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignTestimonials warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `site_settings` table exists.
     */
    public static function alignSiteSettings(): void
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                Schema::create('site_settings', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('key')->unique();
                    $table->longText('value')->nullable();
                    $table->timestamps();
                });
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignSiteSettings warning: ' . $e->getMessage());
        }
    }

    /**
     * Ensure `team_members` table exists and initial members are populated.
     */
    public static function alignTeamMembers(): void
    {
        try {
            if (!Schema::hasTable('team_members')) {
                Schema::create('team_members', function (\Illuminate\Database\Schema\Blueprint $table) {
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

            // Seed initial 8 team members if table is empty
            if (DB::table('team_members')->count() === 0) {
                $sampleImg = '/images/team/member_sample.jpg';
                $initialMembers = [
                    [
                        'name' => 'سيف عادل',
                        'role' => 'المؤسس والمدير الإبداعي التنفيذي',
                        'dept' => 'الإدارة العامة والإبداع',
                        'quote' => 'نصنع محتوى لا يُنسى يملأ العلامة بريقاً وهيبة ويحقق أرقام مبيعات حقيقية',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-crown',
                        'gradient' => 'from-brand-orange to-[#FF7A00]',
                        'letter' => 'س',
                        'sort_order' => 1,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'م. كريم ممدوح',
                        'role' => 'مدير التصوير والإنتاج السينمائي',
                        'dept' => 'قسم التصوير والإخراج',
                        'quote' => 'الصورة السينمائية والإضاءة الدقيقة هي لغة الفخامة التي تجذب عميلك المستهدف',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-video',
                        'gradient' => 'from-purple-500 to-indigo-600',
                        'letter' => 'ك',
                        'sort_order' => 2,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. ياسمين الشريف',
                        'role' => 'مديرة تصميم الهويات البصرية',
                        'dept' => 'قسم التصميم والبراندنج',
                        'quote' => 'الهوية الناجحة هي شخصية كاملة تعكس قيم البراند وتترسخ في ذهن الجمهور',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-palette',
                        'gradient' => 'from-amber-400 to-orange-500',
                        'letter' => 'ي',
                        'sort_order' => 3,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. أحمد عبد المنعم',
                        'role' => 'خبير الإعلانات الممولة وميديا باينج',
                        'dept' => 'قسم الميديا باينج والنمو',
                        'quote' => 'كل مليم يُصرف في الإعلانات يجب أن يعود بأقصى ربحية ممكنة ومبيعات مؤكدة',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-chart-line',
                        'gradient' => 'from-emerald-500 to-teal-600',
                        'letter' => 'أ',
                        'sort_order' => 4,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. نورهان فوزي',
                        'role' => 'كبيرة كُتاب المحتوى والسكريبتات',
                        'dept' => 'قسم كتابة المحتوى والـ Copy',
                        'quote' => 'الكلمة المدروسة والـ Hook الخاطف في أول 3 ثوانٍ هما سر مضاعفة التحويل',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-pen-nib',
                        'gradient' => 'from-pink-500 to-rose-600',
                        'letter' => 'ن',
                        'sort_order' => 5,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. مروان خالد',
                        'role' => 'مهندس المونتاج والتلوين DaVinci',
                        'dept' => 'قسم المونتاج والبوست برودكشن',
                        'quote' => 'الإيقاع السريع وتناسق الألوان والمؤثرات الصوتية تصنع سحراً لا يقاوم',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-film',
                        'gradient' => 'from-blue-500 to-cyan-600',
                        'letter' => 'م',
                        'sort_order' => 6,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. زياد طارق',
                        'role' => 'مصمم الموشن جرافيك والمؤثرات',
                        'dept' => 'قسم الموشن والـ VFX',
                        'quote' => 'تحريك العناصر بدقة يضفي حيوية لا تضاهى على كل فكرة وفيديو',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-wand-magic-sparkles',
                        'gradient' => 'from-yellow-400 to-amber-500',
                        'letter' => 'ز',
                        'sort_order' => 7,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'أ. رنا النجار',
                        'role' => 'مديرة نجاح العملاء والإنتاج',
                        'dept' => 'قسم إدارة المشاريع والجودة',
                        'quote' => 'رضا العميل والتسليم في الموعد المحدد هما الأساس الراسخ لكل شراكة ناجحة',
                        'image_url' => $sampleImg,
                        'icon' => 'fa-solid fa-handshake',
                        'gradient' => 'from-purple-600 to-brand-orange',
                        'letter' => 'ر',
                        'sort_order' => 8,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];

                DB::table('team_members')->insert($initialMembers);
            }

            if (Schema::hasTable('team_members')) {
                $driveMembers = DB::table('team_members')
                    ->where('image_url', 'like', '%drive.google.com%')
                    ->orWhere('image_url', 'like', '%googleusercontent.com%')
                    ->get();
                foreach ($driveMembers as $dm) {
                    $localPath = \App\Support\MediaHelper::downloadAndCacheGoogleDrive($dm->image_url);
                    if ($localPath) {
                        DB::table('team_members')->where('id', $dm->id)->update([
                            'image_url' => $localPath
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('alignTeamMembers warning: ' . $e->getMessage());
        }
    }
}

