-- Pariq Agency Platform - Clean Production Database for Hostinger MySQL
-- Host: Hostinger MySQL / phpMyAdmin
-- Generation Time: 2026-11-03 23:54:23
-- Character Set: utf8mb4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'employee',
  `department` varchar(255) NOT NULL DEFAULT 'management',
  `job_title` varchar(255) DEFAULT NULL,
  `daily_quota` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `department`, `job_title`, `daily_quota`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Saif Adel', 'admin@pariqagency.com', '$2y$12$jdbKalaQt9BDI3sMgptokuBtKekMgFuu3N4KtNqJHH/29hWfThfi2', '+201062330838', 'admin', 'management', 'صاحب المنصة المدير العام', 'الإشراف العام وتوزيع المهام واعتماد التسليمات', 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(2, 'Saif Adel', 'saif@pariqagency.com', '$2y$12$jdbKalaQt9BDI3sMgptokuBtKekMgFuu3N4KtNqJHH/29hWfThfi2', '+201062330838', 'admin', 'management', 'صاحب المنصة المدير العام', 'الإشراف العام وتوزيع المهام واعتماد التسليمات', 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23');

-- --------------------------------------------------------
-- Table structure for table `treasury_accounts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `treasury_accounts`;
CREATE TABLE `treasury_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'instapay',
  `account_number` varchar(255) DEFAULT NULL,
  `balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `treasury_accounts`
INSERT INTO `treasury_accounts` (`id`, `name`, `type`, `account_number`, `balance`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'انستاباي الرئيسي (Instapay)', 'instapay', 'pariq@instapay', 0.00, 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(2, 'محفظة فودافون كاش الرسمية', 'vodafone_cash', '01062330838', 0.00, 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(3, 'الحساب البنكي التجاري CIB', 'bank', '100045892147', 0.00, 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(4, 'الخزينة النقدية الرئيسية (كاش بالمقر)', 'cash', 'VAULT-01', 0.00, 1, '2026-11-03 23:54:23', '2026-11-03 23:54:23');

-- --------------------------------------------------------
-- Table structure for table `accounting_categories`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `accounting_categories`;
CREATE TABLE `accounting_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `accounting_categories` (Exact 17 Categories from Excel Sheet)
INSERT INTO `accounting_categories` (`id`, `name`, `type`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'بلان شهرية', 'revenue', 'REV_MONTHLY_PLAN', 'تعاقدات وباقات إدارة السوشيال ميديا الشهرية', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(2, 'تصوير ومونتاج', 'revenue', 'REV_SHOOT_MONTAGE', 'جلسات تصوير ميداني مع أعمال المونتاج', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(3, 'مونتاج', 'revenue', 'REV_MONTAGE', 'خدمات مونتاج الفيديوهات والريلز فقط', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(4, 'تصميمات', 'revenue', 'REV_DESIGNS', 'تصاميم الجرافيك والهويات الإعلانية والكاروسيل', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(5, 'تصوير إعلانات ممولة', 'revenue', 'REV_AD_SHOOT', 'جلسات تصوير مخصصة للحملات الإعلانية الممولة', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(6, 'خدمات أخرى', 'revenue', 'REV_OTHER', 'استشارات وأي خدمات إضافية متفرقة', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(7, 'راتب شهري', 'expense', 'EXP_SALARY', 'رواتب ومستحقات موظفي الوكالة وصناع المحتوى', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(8, 'شحن إعلانات ممولة', 'expense', 'EXP_AD_SPEND', 'ميزانيات الإعلانات الممولة Ad Spend المدفوعة للمنصات', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(9, 'نت', 'expense', 'EXP_INTERNET', 'فواتير الإنترنت وباقات الخطوط والاتصالات', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(10, 'اشتراكات مواقع', 'expense', 'EXP_SUBSCRIPTIONS', 'اشتراكات برامج التصميم والذكاء الاصطناعي والمواقع', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(11, 'مشتريات', 'expense', 'EXP_PURCHASES', 'مشتريات أجهزة ومعدات وكاميرات وإكسسوارات', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(12, 'صيانة وإصلاحات', 'expense', 'EXP_MAINTENANCE', 'صيانة الأجهزة والمقر والمعدات الفنية', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(13, 'انتقالات', 'expense', 'EXP_TRANSPORT', 'بدلات مواصلات وتوصيل ومصاريف انتقال المصورين', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(14, 'نثريات', 'expense', 'EXP_SUNDRY', 'مصاريف ضيافة وبوفيه وأدوات مكتبية', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(15, 'أخرى', 'expense', 'EXP_OTHER', 'أي مصروفات تشغيلية متنوعة أخرى', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(16, 'تبرعات لله', 'expense', 'EXP_CHARITY', 'صدقات وتبرعات ومشاركات خيرية من أرباح الوكالة', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(17, 'مصاريف تحويل', 'expense', 'EXP_TRANSFER_FEES', 'رسوم وعمولات تحويل بنكي وانستاباي وفودافون كاش', '2026-11-03 23:54:23', '2026-11-03 23:54:23');

-- --------------------------------------------------------
-- Table structure for table `services`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `full_description` text DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `category` varchar(255) NOT NULL DEFAULT 'management',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `services`
INSERT INTO `services` (`id`, `title_ar`, `title_en`, `slug`, `icon`, `short_description`, `sort_order`, `is_active`, `category`, `created_at`, `updated_at`) VALUES
(1, 'إدارة حسابات السوشيال ميديا وبناء الهوية', 'Social Media Management', 'social-media-management', 'fa-hashtag', 'تخطيط استراتيجي شامل، صناعة المحتوى الإبداعي، وجدولة النشر اليومي مع التفاعل وتحليل النتائج.', 1, 1, 'management', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(2, 'الإنتاج المرئي وتصوير الريلز السينمائي', 'Video Production & Reels', 'video-production', 'fa-video', 'جلسات تصوير ميدانية بمعدات سينمائية 4K ومونتاج متطور يواكب أحدث الترندات العالمية.', 2, 1, 'video', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(3, 'الحملات الإعلانية الممولة (Media Buying)', 'Paid Advertising Campaigns', 'media-buying', 'fa-bullseye', 'استهداف دقيق للعملاء المحتملين وتحقيق أعلى عائد على الإنفاق الإعلاني (ROAS) عبر فيسبوك، إنستغرام، وتيك توك.', 3, 1, 'ads', '2026-11-03 23:54:23', '2026-11-03 23:54:23'),
(4, 'تصميم الهويات البصرية والمطبوعات', 'Branding & Graphic Design', 'branding-graphic-design', 'fa-palette', 'بناء هوية تجارية مميزة تترسخ في أذهان عملائك بتصاميم عصرية واحترافية لا تُنسى.', 4, 1, 'design', '2026-11-03 23:54:23', '2026-11-03 23:54:23');

-- --------------------------------------------------------
-- Table structure for table `clients`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'مصر',
  `service_package` varchar(255) DEFAULT NULL,
  `monthly_retainer` decimal(10,2) DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `projects`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `content_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'social_media',
  `status` varchar(255) NOT NULL DEFAULT 'in_progress',
  `progress_percentage` int(11) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `total_budget` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `submitted_to_gm_at` timestamp NULL DEFAULT NULL,
  `gm_approval_status` varchar(255) NOT NULL DEFAULT 'pending',
  `delivery_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_client_id_foreign` (`client_id`),
  KEY `projects_content_creator_id_foreign` (`content_creator_id`),
  CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_content_creator_id_foreign` FOREIGN KEY (`content_creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `tasks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'video',
  `status` varchar(255) NOT NULL DEFAULT 'not_started',
  `delivery_deadline` date DEFAULT NULL,
  `delivery_link` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `location_address` varchar(255) DEFAULT NULL,
  `location_map_url` text DEFAULT NULL,
  `location_lat` decimal(10,7) DEFAULT NULL,
  `location_lng` decimal(10,7) DEFAULT NULL,
  `geofence_radius_meters` int(11) NOT NULL DEFAULT 100,
  `photographer_accepted_at` timestamp NULL DEFAULT NULL,
  `photographer_start_lat` decimal(10,7) DEFAULT NULL,
  `photographer_start_lng` decimal(10,7) DEFAULT NULL,
  `photographer_arrived_at` timestamp NULL DEFAULT NULL,
  `photographer_arrival_lat` decimal(10,7) DEFAULT NULL,
  `photographer_arrival_lng` decimal(10,7) DEFAULT NULL,
  `photographer_arrival_distance_meters` int(11) DEFAULT NULL,
  `attendance_status` varchar(255) NOT NULL DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_client_id_foreign` (`client_id`),
  KEY `tasks_assigned_to_foreign` (`assigned_to`),
  KEY `tasks_created_by_foreign` (`created_by`),
  CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tasks_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `content_plans`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `content_plans`;
CREATE TABLE `content_plans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content_type` varchar(255) NOT NULL DEFAULT 'reel',
  `platforms` json DEFAULT NULL,
  `publish_date` date NOT NULL,
  `publish_time` varchar(255) DEFAULT '18:00',
  `client_delivery_deadline` date DEFAULT NULL,
  `content_url` text DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `production_status` varchar(255) NOT NULL DEFAULT 'ready_to_publish',
  `publishing_status` varchar(255) NOT NULL DEFAULT 'scheduled',
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_plans_client_id_foreign` (`client_id`),
  KEY `content_plans_project_id_foreign` (`project_id`),
  KEY `content_plans_content_creator_id_foreign` (`content_creator_id`),
  KEY `content_plans_task_id_foreign` (`task_id`),
  KEY `content_plans_created_by_foreign` (`created_by`),
  KEY `content_plans_publish_date_index` (`publish_date`),
  KEY `content_plans_publishing_status_index` (`publishing_status`),
  CONSTRAINT `content_plans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `content_plans_content_creator_id_foreign` FOREIGN KEY (`content_creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `content_plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `content_plans_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `content_plans_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `client_installments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `client_installments`;
CREATE TABLE `client_installments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_installments_client_id_foreign` (`client_id`),
  KEY `client_installments_project_id_foreign` (`project_id`),
  CONSTRAINT `client_installments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `client_installments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `financial_transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `financial_transactions`;
CREATE TABLE `financial_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(255) NOT NULL,
  `treasury_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accounting_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'instapay',
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `financial_transactions_transaction_number_unique` (`transaction_number`),
  KEY `financial_transactions_treasury_account_id_foreign` (`treasury_account_id`),
  KEY `financial_transactions_accounting_category_id_foreign` (`accounting_category_id`),
  KEY `financial_transactions_client_id_foreign` (`client_id`),
  KEY `financial_transactions_project_id_foreign` (`project_id`),
  KEY `financial_transactions_user_id_foreign` (`user_id`),
  KEY `financial_transactions_created_by_foreign` (`created_by`),
  CONSTRAINT `financial_transactions_accounting_category_id_foreign` FOREIGN KEY (`accounting_category_id`) REFERENCES `accounting_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `financial_transactions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `financial_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `financial_transactions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `financial_transactions_treasury_account_id_foreign` FOREIGN KEY (`treasury_account_id`) REFERENCES `treasury_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `financial_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `platform_notifications`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `platform_notifications`;
CREATE TABLE `platform_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'bell',
  `action_url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `platform_notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `platform_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `invoices`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_project_id_foreign` (`project_id`),
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `invoice_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `payments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cashier_id` bigint(20) UNSIGNED NOT NULL,
  `cashier_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT 'down_payment',
  `payment_method` varchar(255) NOT NULL,
  `transaction_reference` varchar(255) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_receipt_number_unique` (`receipt_number`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  KEY `payments_client_id_foreign` (`client_id`),
  KEY `payments_cashier_id_foreign` (`cashier_id`),
  CONSTRAINT `payments_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `expenses`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'مصروف',
  `category` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'instapay',
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `spent_at` date DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `inquiries`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `service_interested` varchar(255) DEFAULT NULL,
  `budget_range` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `portfolio_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `portfolio_items`;
CREATE TABLE `portfolio_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'video',
  `media_type` varchar(255) NOT NULL DEFAULT 'image',
  `media_url` text DEFAULT NULL,
  `thumbnail_url` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `metrics` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_country` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_items_service_id_foreign` (`service_id`),
  CONSTRAINT `portfolio_items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_27_200000_create_pariq_agency_tables', 1),
(5, '2026_10_27_214356_add_category_to_services_table', 1),
(6, '2026_11_03_195211_update_pariq_agency_features_v2', 1),
(7, '2026_11_03_202959_create_content_plans_table', 1);

SET FOREIGN_KEY_CHECKS=1;
COMMIT;