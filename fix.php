<?php
// Quick Diagnostic & Fix Tool for Pariq Media on Hostinger
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<div style='font-family:sans-serif; direction:rtl; text-align:right; max-width:800px; margin:30px auto; padding:25px; border:1px solid #ddd; border-radius:12px; background:#fafafa;'>";
echo "<h2 style='color:#1e3a8a; margin-top:0;'>🔧 تقرير فحص وتشخيص منصة بريق ميديا</h2>";

// 1. Check PHP Version & Git Pull
echo "<p><strong>• إصدار PHP الحالي:</strong> " . PHP_VERSION . "</p>";

if (function_exists('shell_exec')) {
    $gitPull = shell_exec('git pull origin main 2>&1');
    echo "<div style='background:#0f172a; color:#38bdf8; padding:10px; border-radius:8px; margin:10px 0; font-family:monospace; direction:ltr; text-align:left;'>";
    echo "<strong>$ git pull origin main:</strong><br>" . nl2br(htmlspecialchars($gitPull ?? 'No output returned.'));
    echo "</div>";
}

// 2. Check .env file
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    echo "<p style='color:green;'>✔️ <strong>ملف .env:</strong> موجود وسليم.</p>";
} else {
    echo "<p style='color:red;'>❌ <strong>ملف .env:</strong> غير موجود في المجلد الرئيسي!</p>";
}

// 3. Test MySQL Connection
$host = 'localhost';
$db = 'u111359515_Pariq';
$user = 'u111359515_pariq';
$pass = 'Pariq#Db2026@Pass!';

if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    if (preg_match('/DB_PASSWORD=(.*)/', $envContent, $m)) {
        $pass = trim($m[1], " \t\n\r\0\x0B\"'");
    }
    if (preg_match('/DB_DATABASE=(.*)/', $envContent, $m)) {
        $db = trim($m[1], " \t\n\r\0\x0B\"'");
    }
    if (preg_match('/DB_USERNAME=(.*)/', $envContent, $m)) {
        $user = trim($m[1], " \t\n\r\0\x0B\"'");
    }
}

echo "<div style='background:#f1f5f9; padding:15px; border-radius:8px; margin:15px 0;'>";
echo "<h4 style='margin:0 0 10px;'>بيانات الاتصال بقاعدة البيانات المستخدمة:</h4>";
echo "<p style='margin:4px 0;'>• قاعدة البيانات: <code>{$db}</code></p>";
echo "<p style='margin:4px 0;'>• اسم المستخدم: <code>{$user}</code></p>";

try {
    $pdo = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3
    ]);
    echo "<p style='color:green; font-weight:bold; margin-top:10px;'>✔️ نجح الاتصال بقاعدة بيانات MySQL بنجاح تام!</p>";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $tableCount = count($tables);
    echo "<p style='color:green;'>✔️ عدد الجداول الموجودة: <strong>{$tableCount}</strong> جدول.</p>";
    if ($tableCount === 0) {
        echo "<p style='color:#b45309; background:#fef3c7; padding:10px; border-radius:6px;'>⚠️ <strong>تنبيه:</strong> تم الاتصال بالقاعدة ولكنها فارغة! يرجى الدخول إلى phpMyAdmin واستيراد ملف <code>pariq_production_clean.sql</code>.</p>";
    } else {
        // Check users
        try {
            $uStmt = $pdo->query("SELECT name, email, role FROM users LIMIT 3");
            $users = $uStmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<p style='color:#047857;'>✔️ تم العثور على حسابات المستخدمين بنجاح (الأدمن: " . htmlspecialchars($users[0]['name'] ?? 'لا يوجد') . " - " . htmlspecialchars($users[0]['email'] ?? '') . ").</p>";
        } catch (\Exception $e) {
            echo "<p style='color:orange;'>تنبيه في جدول users: " . $e->getMessage() . "</p>";
        }

        // Auto-align tables
        echo "<h4>فحص وتحديث بنية الجداول الناقصة تلقائياً:</h4><ul>";
        $tableRepairs = [
            'payments' => [
                'project_id' => "ALTER TABLE `payments` ADD COLUMN `project_id` bigint(20) UNSIGNED DEFAULT NULL",
                'cashier_user_id' => "ALTER TABLE `payments` ADD COLUMN `cashier_user_id` bigint(20) UNSIGNED DEFAULT NULL",
                'payment_type' => "ALTER TABLE `payments` ADD COLUMN `payment_type` varchar(255) NOT NULL DEFAULT 'down_payment'",
                'transaction_reference' => "ALTER TABLE `payments` ADD COLUMN `transaction_reference` varchar(255) DEFAULT NULL",
            ],
            'invoices' => [
                'paid_amount' => "ALTER TABLE `invoices` ADD COLUMN `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00",
                'balance_due' => "ALTER TABLE `invoices` ADD COLUMN `balance_due` decimal(12,2) NOT NULL DEFAULT 0.00",
            ],
            'expenses' => [
                'title' => "ALTER TABLE `expenses` ADD COLUMN `title` varchar(255) NOT NULL DEFAULT 'مصروف'",
                'payment_method' => "ALTER TABLE `expenses` ADD COLUMN `payment_method` varchar(255) NOT NULL DEFAULT 'instapay'",
                'project_id' => "ALTER TABLE `expenses` ADD COLUMN `project_id` bigint(20) UNSIGNED DEFAULT NULL",
                'created_by' => "ALTER TABLE `expenses` ADD COLUMN `created_by` bigint(20) UNSIGNED DEFAULT NULL",
                'spent_at' => "ALTER TABLE `expenses` ADD COLUMN `spent_at` date DEFAULT NULL",
                'receipt_file' => "ALTER TABLE `expenses` ADD COLUMN `receipt_file` varchar(255) DEFAULT NULL",
            ],
            'inquiries' => [
                'brand_name' => "ALTER TABLE `inquiries` ADD COLUMN `brand_name` varchar(255) DEFAULT NULL",
                'email' => "ALTER TABLE `inquiries` ADD COLUMN `email` varchar(255) DEFAULT NULL",
                'service_interested' => "ALTER TABLE `inquiries` ADD COLUMN `service_interested` varchar(255) DEFAULT NULL",
                'budget_range' => "ALTER TABLE `inquiries` ADD COLUMN `budget_range` varchar(255) DEFAULT NULL",
            ],
            'portfolio_items' => [
                'client_country' => "ALTER TABLE `portfolio_items` ADD COLUMN `client_country` varchar(255) DEFAULT NULL",
                'video_url' => "ALTER TABLE `portfolio_items` ADD COLUMN `video_url` varchar(255) DEFAULT NULL",
                'thumbnail' => "ALTER TABLE `portfolio_items` ADD COLUMN `thumbnail` varchar(255) DEFAULT NULL",
                'metrics' => "ALTER TABLE `portfolio_items` ADD COLUMN `metrics` varchar(255) DEFAULT NULL",
            ],
            'tasks' => [
                'daily_delivery_deadline' => "ALTER TABLE `tasks` ADD COLUMN `daily_delivery_deadline` varchar(255) DEFAULT NULL",
                'delivery_deadline' => "ALTER TABLE `tasks` ADD COLUMN `delivery_deadline` date DEFAULT NULL",
                'material_link' => "ALTER TABLE `tasks` ADD COLUMN `material_link` text DEFAULT NULL",
                'delivery_link' => "ALTER TABLE `tasks` ADD COLUMN `delivery_link` text DEFAULT NULL",
                'location_address' => "ALTER TABLE `tasks` ADD COLUMN `location_address` varchar(255) DEFAULT NULL",
                'location_map_url' => "ALTER TABLE `tasks` ADD COLUMN `location_map_url` text DEFAULT NULL",
                'attendance_status' => "ALTER TABLE `tasks` ADD COLUMN `attendance_status` varchar(255) NOT NULL DEFAULT 'none'",
                'photographer_accepted_at' => "ALTER TABLE `tasks` ADD COLUMN `photographer_accepted_at` timestamp NULL DEFAULT NULL",
            ],
            'projects' => [
                'content_creator_id' => "ALTER TABLE `projects` ADD COLUMN `content_creator_id` bigint(20) UNSIGNED DEFAULT NULL",
                'submitted_to_gm_at' => "ALTER TABLE `projects` ADD COLUMN `submitted_to_gm_at` timestamp NULL DEFAULT NULL",
                'gm_approval_status' => "ALTER TABLE `projects` ADD COLUMN `gm_approval_status` varchar(255) NOT NULL DEFAULT 'pending'",
                'delivery_notes' => "ALTER TABLE `projects` ADD COLUMN `delivery_notes` text DEFAULT NULL",
            ]
        ];

        foreach ($tableRepairs as $tbl => $cols) {
            if (in_array($tbl, $tables)) {
                $cStmt = $pdo->query("SHOW COLUMNS FROM `{$tbl}`");
                $existingCols = $cStmt->fetchAll(PDO::FETCH_COLUMN);
                foreach ($cols as $colName => $sql) {
                    if (!in_array($colName, $existingCols)) {
                        try {
                            $pdo->exec($sql);
                            echo "<li style='color:green;'>✔️ تم بنجاح إضافة العمود <code>{$colName}</code> في جدول <code>{$tbl}</code>.</li>";
                        } catch (\Exception $ex) {
                            echo "<li style='color:red;'>❌ تعذر إضافة <code>{$colName}</code> في <code>{$tbl}</code>: " . $ex->getMessage() . "</li>";
                        }
                    }
                }
            }
        }
        echo "<li style='color:green; font-weight:bold;'>✔️ اكتمل فحص وتحديث جداول الكاشير والمصروفات والفواتير بنجاح!</li>";

        // 3.5 Sync 10 Official Services
        echo "<h4>تحديث خدمات الوكالة الـ 10 المعتمدة:</h4><ul>";
        $targetServices = [
            ['title_ar' => 'إدارة حسابات السوشيال ميديا', 'slug' => 'social-media-management', 'icon' => 'share-nodes', 'short_description' => 'إدارة شاملة لحساباتك تشمل وضع الاستراتيجيات، جدولة المنشورات، التفاعل مع المتابعين، وتحليل الأداء لتحقيق أعلى وصول وتفاعل لعلامتك.'],
            ['title_ar' => 'صناعة المحتوى', 'slug' => 'content-creation', 'icon' => 'pen-nib', 'short_description' => 'ابتكار محتوى إبداعي يروي قصة علامتك التجارية من خلال بوستات جذابة، مقالات، وتصاميم تواكب أحدث التريندات وتلهم جمهورك المستهدف.'],
            ['title_ar' => 'إدارة الحملات الإعلانية', 'slug' => 'paid-ads', 'icon' => 'bullhorn', 'short_description' => 'إطلاق وتحسين إعلاناتك الممولة على مختلف المنصات (Meta, Google, TikTok, Snapchat) باستهداف ذكي يحقق أعلى عائد على الاستثمار (ROAS).'],
            ['title_ar' => 'التصوير والمونتاج الاحترافي', 'slug' => 'video-production', 'icon' => 'video', 'short_description' => 'إنتاج وتصوير فيديوهات احترافية ومونتاج سينمائي يناسب إعلاناتك وريلز إنستغرام وتيك توك لإبراز علامتك بأعلى جودة بصرية.'],
            ['title_ar' => 'تصميم الهوية البصرية', 'slug' => 'branding-identity', 'icon' => 'palette', 'short_description' => 'بناء هوية كاملة تعبر عن روح علامتك، تبدأ من تصميم الشعار وحتى الألوان والخطوط والأدلة الإرشادية لترسيخ علامتك في الأذهان.'],
            ['title_ar' => 'كتابة السيناريو والإعلانات', 'slug' => 'scriptwriting', 'icon' => 'scroll', 'short_description' => 'كتابة نصوص إعلانية وسيناريوهات مؤثرة (Copywriting) تجمع بين الإبداع والإقناع لتحفيز جمهورك على اتخاذ قرار الشراء.'],
            ['title_ar' => 'تصوير المنتجات والفيديو', 'slug' => 'product-photography', 'icon' => 'camera', 'short_description' => 'جلسات تصوير مخصصة للمنتجات بأحدث معدات الإضاءة والكاميرات لتظهر تفاصيل منتجاتك بجاذبية لا تقاوم في متجرك وإعلاناتك.'],
            ['title_ar' => 'التسويق عبر المؤثرين', 'slug' => 'influencer-marketing', 'icon' => 'users', 'short_description' => 'اختيار وتنسيق الحملات الإعلانية مع أنسب المؤثرين وصناع المحتوى الذين يثق بهم جمهورك لبناء مصداقية سريعة وزيادة مبيعاتك.'],
            ['title_ar' => 'استشارات التسويق الرقمي', 'slug' => 'marketing-consulting', 'icon' => 'chart-pie', 'short_description' => 'جلسات استشارية متخصصة لتحليل وضع علامتك الحالي ووضع خطة نمو واضحة ومدروسة تساعدك على تخطي المنافسين وتوسيع أعمالك.'],
            ['title_ar' => 'تحسين محركات البحث SEO', 'slug' => 'seo-optimization', 'icon' => 'magnifying-glass-chart', 'short_description' => 'تهيئة موقعك الإلكتروني ليتصدر النتائج الأولى في محركات البحث مثل جوجل لجلب زوار مهتمين ومبيعات عضوية مستمرة بدون إعلانات.']
        ];

        foreach ($targetServices as $idx => $ts) {
            $checkSvc = $pdo->prepare("SELECT id FROM services WHERE slug = ? OR title_ar = ?");
            $checkSvc->execute([$ts['slug'], $ts['title_ar']]);
            $existingSvc = $checkSvc->fetch(PDO::FETCH_ASSOC);
            if ($existingSvc) {
                $upSvc = $pdo->prepare("UPDATE services SET title_ar = ?, short_description = ?, icon = ?, sort_order = ?, is_active = 1 WHERE id = ?");
                $upSvc->execute([$ts['title_ar'], $ts['short_description'], $ts['icon'], $idx + 1, $existingSvc['id']]);
            } else {
                $inSvc = $pdo->prepare("INSERT INTO services (title_ar, slug, icon, short_description, sort_order, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())");
                $inSvc->execute([$ts['title_ar'], $ts['slug'], $ts['icon'], $ts['short_description'], $idx + 1]);
            }
        }
        echo "<li style='color:green;'>✔️ تم بنجاح مزامنة وتحديث جميع الخدمات الـ 10 الرسمية في قاعدة البيانات.</li>";

        // 3.6 Create and Sync Partners Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS `partners` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `category` varchar(255) DEFAULT NULL,
            `logo_url` varchar(255) DEFAULT NULL,
            `sort_order` int(11) NOT NULL DEFAULT 0,
            `is_active` tinyint(1) NOT NULL DEFAULT 1,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $pCount = $pdo->query("SELECT COUNT(*) FROM partners")->fetchColumn();
        if ($pCount == 0) {
            $defaultPartners = [
                ['name' => 'Mercedes-Benz', 'category' => 'سيارات فاخرة', 'logo_url' => null, 'sort_order' => 1],
                ['name' => 'سيمنز Siemens', 'category' => 'هندسة وتكنولوجيا', 'logo_url' => null, 'sort_order' => 2],
                ['name' => 'داماك DAMAC', 'category' => 'تطوير عقاري', 'logo_url' => null, 'sort_order' => 3],
                ['name' => 'بنده Panda', 'category' => 'تجزئة وسوبرماركت', 'logo_url' => null, 'sort_order' => 4],
                ['name' => 'بلتون Beltone', 'category' => 'استثمار ومالية', 'logo_url' => null, 'sort_order' => 5],
                ['name' => 'GSK Global', 'category' => 'أدوية وصحة', 'logo_url' => null, 'sort_order' => 6],
                ['name' => 'باتشي Patchi', 'category' => 'شوكولاتة وهدايا', 'logo_url' => null, 'sort_order' => 7],
                ['name' => 'مجمع ماجستي الطبي', 'category' => 'رعاية صحية', 'logo_url' => null, 'sort_order' => 8],
                ['name' => 'The Met Hub', 'category' => 'مجمعات تجارية', 'logo_url' => null, 'sort_order' => 9],
                ['name' => 'Shawrmaker Jordan', 'category' => 'سلسلة مطاعم', 'logo_url' => null, 'sort_order' => 10],
                ['name' => 'صيدليات رحيق', 'category' => 'صيدليات ودواء', 'logo_url' => null, 'sort_order' => 11],
                ['name' => 'Fox ATVs Oman', 'category' => 'سياحة وترفيه', 'logo_url' => null, 'sort_order' => 12],
                ['name' => 'Crystal Auto', 'category' => 'خدمات سيارات', 'logo_url' => null, 'sort_order' => 13],
                ['name' => 'جامعة قطر', 'category' => 'تعليم عالي', 'logo_url' => null, 'sort_order' => 14],
            ];
            $inPart = $pdo->prepare("INSERT INTO partners (name, category, logo_url, sort_order, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, 1, NOW(), NOW())");
            foreach ($defaultPartners as $dp) {
                $inPart->execute([$dp['name'], $dp['category'], $dp['logo_url'], $dp['sort_order']]);
            }
            echo "<li style='color:green;'>✔️ تم إنشاء جدول شركاء النجاح `partners` وتجهيز الشركاء الافتراضيين.</li>";
        }

        // 3.7 Create and Sync Testimonials Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS `testimonials` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `client_name` varchar(255) NOT NULL,
            `client_title` varchar(255) DEFAULT NULL,
            `client_country` varchar(255) DEFAULT NULL,
            `type` varchar(50) NOT NULL DEFAULT 'video_reel',
            `content` text DEFAULT NULL,
            `rating` int(11) NOT NULL DEFAULT 5,
            `media_url` varchar(255) DEFAULT NULL,
            `thumbnail` varchar(255) DEFAULT NULL,
            `sort_order` int(11) NOT NULL DEFAULT 0,
            `is_active` tinyint(1) NOT NULL DEFAULT 1,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $tCount = $pdo->query("SELECT COUNT(*) FROM testimonials")->fetchColumn();
        if ($tCount == 0) {
            $defaultTestimonials = [
                [
                    'client_name' => 'أ. حسام الدين غانم',
                    'client_title' => 'مؤسس Shawrmaker',
                    'client_country' => 'عمان، الأردن',
                    'type' => 'video_reel',
                    'content' => 'شهادة وتجربة تصوير الفيديوهات الترويجية وزيادة المبيعات بنسبة 140%',
                    'rating' => 5,
                    'media_url' => '/videos/food_commercial.mp4',
                    'thumbnail' => '/images/portfolio/social_4.webp',
                    'sort_order' => 1
                ],
                [
                    'client_name' => 'د. عبد الرحمن المجيدي',
                    'client_title' => 'مجمع ماجستي الطبي',
                    'client_country' => 'الرياض، السعودية',
                    'type' => 'video_reel',
                    'content' => 'تجربة مضاعفة حجوزات العيادات بنسبة 180% خلال أول شهرين مع وكالة بريق',
                    'rating' => 5,
                    'media_url' => '/videos/promo_reels_1.mp4',
                    'thumbnail' => '/images/portfolio/ramez_qlight.webp',
                    'sort_order' => 2
                ],
                [
                    'client_name' => 'م. سيف النمر',
                    'client_title' => 'مدير تسويق شركة ألبان',
                    'client_country' => 'القاهرة، مصر',
                    'type' => 'text_review',
                    'content' => 'الاحترافية في التزام مواعيد التسليم وتصميم الهوية الإعلانية جعلت بريق شريكنا الدائم لكافة علاماتنا التجارية. أنصح بهم بشدة لكل صاحب مشروع يريد نمواً حقيقياً.',
                    'rating' => 5,
                    'media_url' => null,
                    'thumbnail' => null,
                    'sort_order' => 3
                ],
            ];
            $inTest = $pdo->prepare("INSERT INTO testimonials (client_name, client_title, client_country, type, content, rating, media_url, thumbnail, sort_order, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW(), NOW())");
            foreach ($defaultTestimonials as $dt) {
                $inTest->execute([$dt['client_name'], $dt['client_title'], $dt['client_country'], $dt['type'], $dt['content'], $dt['rating'], $dt['media_url'], $dt['thumbnail'], $dt['sort_order']]);
            }
            echo "<li style='color:green;'>✔️ تم إنشاء جدول آراء العملاء `testimonials` وإضافة الفيدباك الافتراضي بنجاح.</li>";
        }

        // 3.8 Create and Sync Site Settings Table
        $pdo->exec("CREATE TABLE IF NOT EXISTS `site_settings` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `key` varchar(255) NOT NULL UNIQUE,
            `value` longtext DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Seed default stats if not already set
        $defaultStats = [
            'stat_sync_mode' => 'custom',
            'stat_projects_count' => '480',
            'stat_projects_label' => 'مشروع مكتمل بنجاح',
            'stat_clients_count' => '125',
            'stat_clients_label' => 'عميل سعيد في 6 دول',
            'stat_years_count' => '6',
            'stat_years_label' => 'سنوات خبرة متواصلة',
            'stat_team_count' => '18',
            'stat_team_label' => 'مبدع وخبير متخصص',
        ];
        $inSetting = $pdo->prepare("INSERT IGNORE INTO `site_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES (?, ?, NOW(), NOW())");
        foreach ($defaultStats as $k => $v) {
            $inSetting->execute([$k, $v]);
        }
        echo "<li style='color:green;'>✔️ تم إنشاء جدول إعدادات وإحصائيات المنصة `site_settings` وتجهيز القيم الافتراضية.</li>";

        // Clear compiled views & lock files
        @unlink(__DIR__ . '/storage/framework/schema_aligned_v2.lock');
        @unlink(__DIR__ . '/storage/framework/schema_aligned_v3.lock');
        $cachedViews = glob(__DIR__ . '/storage/framework/views/*.php');
        if ($cachedViews) {
            foreach ($cachedViews as $cv) { @unlink($cv); }
            echo "<li style='color:green;'>✔️ تم تنظيف وتحديث كاش القوالب (Views Cache) بنجاح.</li>";
        }

        echo "</ul>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red; font-weight:bold; margin-top:10px;'>❌ فشل الاتصال بقاعدة البيانات:</p>";
    echo "<pre style='background:#fee2e2; color:#991b1b; padding:10px; border-radius:6px; direction:ltr; text-align:left;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<p style='color:#b91c1c;'><strong>السبب الأكيد:</strong> كلمة المرور المسجلة في الكود لا تطابق كلمة المرور التي اخترتها عند إنشاء قاعدة البيانات في هوستينجر.</p>";
}
echo "</div>";

// 4. Check Storage Permissions
$dirs = [
    __DIR__ . '/storage',
    __DIR__ . '/storage/framework',
    __DIR__ . '/storage/framework/views',
    __DIR__ . '/storage/framework/cache',
    __DIR__ . '/storage/framework/sessions',
    __DIR__ . '/storage/logs',
    __DIR__ . '/bootstrap/cache',
];

echo "<h4>فحص وتصحيح صلاحيات المجلدات:</h4><ul>";
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    @chmod($dir, 0777);
    $w = is_writable($dir);
    $name = basename($dir);
    if ($w) {
        echo "<li style='color:green;'>✔️ مجلد <code>{$name}</code>: جاهز وقابل للكتابة.</li>";
    } else {
        echo "<li style='color:red;'>❌ مجلد <code>{$name}</code>: غير قابل للكتابة!</li>";
    }
}
echo "</ul>";

// 5. Clear old cached configs
$configs = glob(__DIR__ . '/bootstrap/cache/config.php');
foreach ($configs as $cfg) {
    @unlink($cfg);
}

// 6. Check PWA Assets
echo "<h4>فحص ملفات تطبيق الهاتف (PWA):</h4><ul>";
$pwaFiles = [
    '/manifest.json' => 'ملف إعدادات التطبيق (manifest.json)',
    '/sw.js' => 'محرك التطبيق في الخلفية (sw.js)',
    '/images/icon-192.png' => 'أيقونة الهاتف (192x192)',
    '/images/icon-512.png' => 'أيقونة الهاتف عالية الدقة (512x512)',
];
foreach ($pwaFiles as $file => $desc) {
    $exists = file_exists(__DIR__ . $file) || file_exists(__DIR__ . '/public' . $file);
    if ($exists) {
        echo "<li style='color:green;'>✔️ {$desc}: جاهز وسليم.</li>";
    } else {
        echo "<li style='color:red;'>❌ {$desc}: غير موجود!</li>";
    }
}
echo "</ul>";

echo "<hr style='margin:20px 0;'>";
echo "<p style='text-align:center;'><a href='/' style='display:inline-block; background:#10b981; color:white; padding:12px 25px; border-radius:8px; text-decoration:none; font-weight:bold;'>⬅️ اضغط هنا لفتح الصفحة الرئيسية</a></p>";
echo "</div>";
