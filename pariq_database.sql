-- Pariq Agency Database Dump for InfinityFree / MySQL
-- Generated at: 2026-10-28 18:33:33
SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pariq_temp_export
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'مصر',
  `service_package` varchar(255) DEFAULT NULL,
  `monthly_retainer` decimal(12,2) DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `name`, `brand_name`, `phone`, `email`, `country`, `service_package`, `monthly_retainer`, `status`, `notes`, `created_at`, `updated_at`) VALUES (1,'شركة ويلفير للمنتجات الغذائية والألبان','Welfare Dairy (تأسست 1970)','+201099887766',NULL,'مصر','إنتاج مرئي وإعلانات سنوية',25000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(2,'مطاعم شاورماكر بالأردن','Shawrmaker Jordan','+962791112233',NULL,'الأردن','باقة 20 ريلز شهرية + تصوير طعام',18000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(3,'مستشفى ومجمع ماجستي الطبي بالرياض','Majesty Health Riyadh','+966501234567',NULL,'السعودية','إدارة محتوى طبي وتصاميم وإعلانات سناب شات',32000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(4,'صيدليات رحيق ليبيا','Raheeq Pharmacies','+218912345678',NULL,'ليبيا','إعلانات ممولة وتصاميم عروض ترويجية',15000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(5,'فوكس لسياحة المغامرات','Fox ATVs Oman','+96898765432',NULL,'سلطنة عمان','إنتاج برومو سنيمائي وتغطية سياحية',22000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(6,'مول ذا ميت هب التجاري','The Met Hub Mall','+201155443322',NULL,'مصر','تغطيات افتتاحية وفيديوهات فعاليات',28000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(7,'مؤسسة A One التعليمية','A One Education','+201044332211',NULL,'مصر','إعلانات استقطاب طلاب وتصاميم كورسات',12000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(8,'مطاعم الرفاعي بيتزا','Elrifaee Pizza Jordan','+962799884433',NULL,'الأردن','تصوير جلسات وجبات وريلز تيك توك',14000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(9,'صانع المحتوى ضياء فيلمز','Diaa Films YouTube','+201122334455',NULL,'مصر','مونتاج حلقات وأغلفة يوتيوب مصغرة',16000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(10,'صانع المحتوى محمد السيد','Mohammed Ahmed Creator','+966554433221',NULL,'السعودية','تصميمات أغلفة يوتيوب مصغرة',10000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(11,'كافيه جبل الأردن','Jabal Coffee','+962776655443',NULL,'الأردن','تغطيات ريلز ومحتوى قهوة مختصة',11000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25'),(12,'مطاحن بن الحسيني','El-Husseiny Coffee','+201088776655',NULL,'مصر','هوية بصرية وإعلانات منتجات القهوة',13000.00,'active','عميل معتمد لدى وكالة بريق للتسويق الإلكتروني','2026-10-27 18:19:25','2026-10-27 18:19:25');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'other',
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'instapay',
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `spent_at` date NOT NULL,
  `notes` text DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_project_id_foreign` (`project_id`),
  KEY `expenses_created_by_foreign` (`created_by`),
  CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` (`id`, `title`, `category`, `amount`, `payment_method`, `project_id`, `created_by`, `spent_at`, `notes`, `receipt_file`, `created_at`, `updated_at`) VALUES (1,'شحن ميزانية إعلانات Meta لعميل مستشفى ماجستي بالرياض','ad_spend',14000.00,'instapay',2,4,'2026-10-24','تحويل قيمة رصيد الإعلانات على مدير الإعلانات.',NULL,'2026-10-27 18:19:26','2026-10-27 18:19:26'),(2,'اشتراك باقة Adobe Creative Cloud السنوية للفريق','software_tools',3200.00,'bank_transfer',NULL,1,'2026-10-19','تجديد تراخيص أدوبي بريمير، فوتوشوب، وأفتر إفكتس.',NULL,'2026-10-27 18:19:26','2026-10-27 18:19:26'),(3,'تصوير ريل','freelancers',500.00,'cash',2,1,'2026-10-28',NULL,NULL,'2026-10-27 19:49:39','2026-10-27 19:49:39'),(4,'تصوير ريل','freelancers',500.00,'cash',2,1,'2026-10-28',NULL,NULL,'2026-10-27 19:49:40','2026-10-27 19:49:40');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inquiries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `service_interested` varchar(255) DEFAULT NULL,
  `budget_range` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` (`id`, `name`, `brand_name`, `phone`, `email`, `service_interested`, `budget_range`, `message`, `status`, `created_at`, `updated_at`) VALUES (1,'م. طارق العتيبي','برجر لاين - الرياض','+966551239874','tariq@burgerline.sa','تصوير ومونتاج ريلز وإعلانات ممولة','20,000 - 35,000 ريال','نود إطلاق 4 فروع جديدة ونحتاج خطة تسويقية كاملة وإنتاج فيديوهات ريلز متميزة.','new','2026-10-27 18:19:26','2026-10-27 18:19:26');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `balance_due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `due_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_project_id_foreign` (`project_id`),
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` (`id`, `invoice_number`, `client_id`, `project_id`, `total_amount`, `paid_amount`, `balance_due`, `status`, `due_date`, `notes`, `created_at`, `updated_at`) VALUES (1,'INV-2026-001',2,1,24000.00,15000.00,9000.00,'partially_paid','2026-11-06','فاتورة باقة إنتاج 15 ريلز لمطاعم شاورماكر - الأردن','2026-10-27 18:19:26','2026-10-27 18:19:26');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_200000_create_pariq_agency_tables',1),(5,'2026_10_27_214356_add_category_to_services_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(255) NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `cashier_user_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT 'down_payment',
  `payment_method` varchar(255) NOT NULL DEFAULT 'instapay',
  `transaction_reference` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_receipt_number_unique` (`receipt_number`),
  KEY `payments_client_id_foreign` (`client_id`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  KEY `payments_project_id_foreign` (`project_id`),
  KEY `payments_cashier_user_id_foreign` (`cashier_user_id`),
  CONSTRAINT `payments_cashier_user_id_foreign` FOREIGN KEY (`cashier_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` (`id`, `receipt_number`, `client_id`, `invoice_id`, `project_id`, `cashier_user_id`, `amount`, `payment_type`, `payment_method`, `transaction_reference`, `notes`, `created_at`, `updated_at`) VALUES (1,'REC-2026-0001',2,1,1,5,15000.00,'down_payment','instapay','INSTA-99824102','دفعة مقدمة 60% تعاقد باقة الريلز - تم استلامها عبر إنستاباي وإصدار الإيصال.','2026-10-27 18:19:26','2026-10-27 18:19:26'),(2,'REC-2026-0002',3,NULL,2,5,20000.00,'quick_service','bank_transfer','SAR-BNK-771829','دفعة ميزانية إعلانية لحملة مستشفى ماجستي الرياض - تحويل بنكي رسمي.','2026-10-27 18:19:26','2026-10-27 18:19:26'),(3,'REC-2026-0003',4,NULL,NULL,1,7500.00,'quick_service','vodafone_cash','VF-88291039','سداد سريع كاشير: باقة تصاميم عروض أدوية لصيدليات رحيق ليبيا.','2026-10-27 18:19:26','2026-10-27 18:19:26');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_items`
--

DROP TABLE IF EXISTS `portfolio_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_country` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'video_reels',
  `video_url` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `metrics` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_items_service_id_foreign` (`service_id`),
  CONSTRAINT `portfolio_items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_items`
--

LOCK TABLES `portfolio_items` WRITE;
/*!40000 ALTER TABLE `portfolio_items` DISABLE KEYS */;
INSERT INTO `portfolio_items` (`id`, `service_id`, `title`, `client_name`, `client_country`, `category`, `video_url`, `thumbnail`, `metrics`, `description`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES (1,3,'تصميم غلاف يوتيوب برنامج رامز جاب من الآخر - كيو لايت','كيو لايت (صانع محتوى)','مصر','youtube_thumbnail',NULL,'/images/portfolio/ramez_qlight.webp','+3.5M مشاهدة','تصميم غلاف فيديو مصغر عالي التباين وجاذب للعين يحقق أعلى نسبة نقر لمحتوى الترفيه والألعاب.',1,1,'2026-10-27 18:19:25','2026-10-27 18:56:54'),(2,3,'تصميم غلاف حلقة صانع المحتوى محمد السيد','محمد السيد','السعودية','youtube_thumbnail',NULL,'/images/portfolio/mohammed_elsayed.webp','CTR 14.5% | تفاعل قياسي','إخراج وتصميم أغلفة يوتيوب احترافية بأسلوب السيكولوجيا البصرية التي تشد المشاهدين للتفاعل الفوري.',1,2,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(3,3,'تصميم غلاف يوتيوب وثائقي \"ذكرى\"','وثائقيات ذكرى','مصر','youtube_thumbnail',NULL,'/images/portfolio/zekra_cover.webp','CTR 15.2% | +800 ألف مشاهدة','تصميم يعبر عن المشاعر والدراما التاريخية مع تناسق ألوان احترافي للأعمال الوثائقية.',0,3,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(4,3,'تصميم غلاف حلقة سلسلة الطوارئ الطبية','سلسلة الطوارئ الطبية','السعودية','youtube_thumbnail',NULL,'/images/portfolio/emergency_cover.webp','CTR 13.9% | وصول واسع','إبراز العنصر التشويقي في المشاهد الطبية الطارئة مع خطوط عربية قوية ومباشرة.',0,4,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(5,3,'غلاف يوتيوب استضافة أكسفورد التعليمية','أكاديمية أكسفورد','مصر','youtube_thumbnail',NULL,'/images/portfolio/oxford_host.webp','زيادة 35% في نسبة النقر','تصميم تعليمي وتدريبي عصري يناسب الندوات واللقاءات الحوارية لكبار المتحدثين.',0,5,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(6,4,'نتائج حملة مبيعات متجر إلكتروني - ميتا آدز (ROAS 6.8x)','متجر إلكتروني للتجزئة','السعودية ومصر','ad_results',NULL,'/images/portfolio/ad_result_69.webp','عائد إعلاني ROAS 6.8x | 1,420 طلب مؤكد','لقطة شاشة موثقة من مدير إعلانات Meta Ads توضح تحقيق أرباح قياسية وتكلفة نقرة منخفضة للغاية بفضل الاستهداف المتقدم.',1,6,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(7,4,'نتائج حملة رسائل وحجوزات مباشرة لعيادات ومطاعم','سلسلة عيادات ومطاعم','الأردن ومصر','ad_results',NULL,'/images/portfolio/ad_result_70.webp','تكلفة رسالة 1.2 ج.م | +3,800 عميل محتمل','استهداف دقيق للمهتمين بالخدمات والحجوزات وتوليد مئات العملاء المستعدين للشراء يومياً.',1,7,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(8,4,'نتائج حملة تفاعل ومشاهدات فيديو ريلز (+850 ألف مشاهدة)','براند أغذية ومشروبات','الأردن','ad_results',NULL,'/images/portfolio/ad_result_72.webp','+850K مشاهدة حقيقية | تفاعل 18%','تحقيق انتشار عضوي ومدفوع واسع النطاق أدى لزيادة مباشرة في عدد متابعي وزوار الفروع.',1,8,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(9,3,'تصميم سوشيال ميديا ترويجي لعرض مطعم إمبابة','مطعم إمبابة','مصر','social_design',NULL,'/images/portfolio/social_1.webp','وصول تفاعلي +120 ألف','تصميم إعلاني جذاب يبرز شهية الوجبة وسعر العرض بطريقة تسويقية تزيد رغبة الشراء الفوري.',1,9,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(10,3,'تصميم بوستر افتتاح خاص وعروض استثنائية','براند أزياء وتجزئة','مصر','social_design',NULL,'/images/portfolio/social_2.webp','تفاعل +4,000 عميل','بوستر إعلاني متميز بألوان متناسقة وإخراج طباعي ورقمي فاخر يناسب منصات التواصل.',0,10,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(11,3,'تصميم غلاف وبوستر التوصيل المجاني','مطاعم كبرى','مصر','social_design',NULL,'/images/portfolio/free_delivery.webp','زيادة 40% في طلبات الدليفري','إبراز ميزة التوصيل المجاني بتصميم ديناميكي مرح ومحفز للاتصال المباشر.',0,11,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(12,3,'تصميم إعلاني جذاب لمنتج استهلاكي','شركة منتجات غذائية','مصر','social_design',NULL,'/images/portfolio/social_3.webp','هوية بصرية معتمدة','إبراز عبوة المنتج ومكوناته الطبيعية بألوان زاهية تجذب المتسوقين.',0,12,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(13,3,'تصميم شعار وهوية متجر إلكتروني حديث (Logo Design)','براند تجارة إلكترونية','السعودية','branding',NULL,'/images/portfolio/logo_1.webp','هوية بصرية متكاملة','شعار هندسي حديث يعبر عن السرعة والموثوقية والتجارة الرقمية الحديثة.',1,13,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(14,3,'تصميم هوية بصرية لعلامة تجارية راقية','شركة خدمات وأعمال','قطر','branding',NULL,'/images/portfolio/logo_3.webp','دليل هوية Brand Guidelines','بناء فلسفة العلامة واختيار الألوان والخطوط والأيقونات الخاصة بالنشاط.',0,14,'2026-10-27 18:19:26','2026-10-27 18:19:26'),(15,3,'تصميم شعار كافيه ومطعم عصري','كافيه شبابي عصري','الأردن','branding',NULL,'/images/portfolio/logo_4.webp','لوجو ثلاثي الأبعاد وعصري','تصميم لوجو أنيق يعبر عن أجواء الاسترخاء وجودة المشروبات المقدمة.',0,15,'2026-10-27 18:19:26','2026-10-27 18:19:26'),(16,3,'تصميم لوجو شركة مقاولات وهندسة متطورة','شركة مقاولات وإنشاءات','مصر','branding',NULL,'/images/portfolio/logo_5.webp','هوية شركات कॉर्पोरेट','خطوط معمارية صلبة تعكس الثبات الهندسي والخبرة العريقة.',0,16,'2026-10-27 18:19:26','2026-10-27 18:19:26'),(17,2,'ريلز سينمائي سريع لمطاعم شاورماكر (Shawrmaker Jordan)','Shawrmaker','الأردن','video_reels','/videos/food_commercial.mp4','/images/portfolio/social_4.webp','+1.4M مشاهدة | زيادة 45% في الطلبات','مونتاج سريع الإيقاع مع هندسة صوتية واقعية تجعل المشاهد يعيش تجربة الطعام بكل تفاصيلها.',1,17,'2026-10-27 18:19:26','2026-10-27 18:46:56'),(18,1,'برومو المغامرة الصحراوية 4K - Fox ATVs سلطنة عمان','Fox ATVs Oman','سلطنة عمان','promo_video','/videos/safari_tour.mp4','/images/portfolio/social_3.webp','تغطية سياحية وتلفزيونية كاملة','تصوير درونز وسينما رقمية في تلال الرمال الذهبية لسياحة المغامرات بالشرق الأوسط.',1,18,'2026-10-27 18:19:26','2026-10-27 18:46:56'),(19,NULL,'ريلز ترويجي سينمائي سريع ومؤثرات بصرية (Viral Fast Reels)','بريق استوديو الإنتاج','مصر ودول الخليج','video_reels','/videos/promo_reels_1.mp4','/images/portfolio/social_2.webp','+2.3M مشاهدة عضوية | تفاعل 24%','نموذج ريلز سينمائي سريع بالتقطيع الديناميكي والمؤثرات الصوتية لجذب انتباه المشاهد في أول 3 ثوانٍ.',1,1,'2026-10-27 18:46:56','2026-10-27 18:46:56');
/*!40000 ALTER TABLE `portfolio_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'video_production',
  `total_budget` decimal(12,2) NOT NULL DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'in_progress',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_client_id_foreign` (`client_id`),
  CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `client_id`, `title`, `category`, `total_budget`, `start_date`, `deadline`, `status`, `description`, `created_at`, `updated_at`) VALUES (1,2,'حملة إطلاق سندوتش الشاورما المكسيكية (15 فيديو ريلز)','video_production',24000.00,'2026-10-17','2026-11-11','in_progress','تصوير وجبات جديدة بالأردن، مونتاج سريع جذاب (Fast-paced reels) مع مقاطع صوتية تريند لتيك توك وإنستجرام.','2026-10-27 18:19:25','2026-10-27 18:19:25'),(2,3,'حملة الكشف الطبي الموسمي ومستشفى ماجستي بالرياض','media_buying',38000.00,'2026-10-22','2026-11-16','in_progress','إعلانات ليدز على سناب شات وميتا لجذب حجوزات الاستشارات الطبية في مدينة الرياض.','2026-10-27 18:19:25','2026-10-27 18:19:25'),(3,1,'تحديث الهوية البصرية وفيديوهات المنتجات الطبيعية','branding',30000.00,'2026-10-07','2026-11-01','in_progress','جلسات تصوير لمنتجات الأجبان والألبان وتصميم مطبوعات وتغليف وكتالوج ديجيتال.','2026-10-27 18:19:25','2026-10-27 18:19:25'),(4,5,'برومو المغامرة الصحراوية 4K - فوكس عمان','video_production',26000.00,'2026-10-02','2026-10-25','completed','تصوير درون وسينما لفريق الدراجات في صحراء الرمال الذهبية بعمان مع تصحيح ألوان سينمائي.','2026-10-27 18:19:25','2026-10-27 18:19:25');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'video_production',
  `icon` varchar(255) NOT NULL DEFAULT 'video',
  `short_description` text NOT NULL,
  `full_description` text DEFAULT NULL,
  `starting_price` decimal(12,2) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `title_ar`, `title_en`, `slug`, `category`, `icon`, `short_description`, `full_description`, `starting_price`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES (1,'تصوير فيديو احترافي','Professional Video Shooting','video-shooting','video_shooting','video','تصوير سينمائي عالي الجودة 4K بأحدث كاميرات السينما ومعدات الإضاءة والصوت الاحترافية.','نوفر طواقم تصوير متكاملة لتصوير إعلانات المنتجات، البروموهات، التغطيات، وفيديوهات الريلز والشوربس.',3500.00,1,1,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(2,'مونتاج فيديو وبوست برودكشن','Video Editing & Post Production','video-editing','video_editing','film','مونتاج ريلز وبرومو سينمائي سريع وجذاب مع مؤثرات بصرية وتصحيح ألوان احترافي.','تقطيع ديناميكي، مؤثرات صوتية تحبس الأنفاس، ومؤثرات جرافيك متحركة لزيادة مدة المشاهدة والانتشار.',2000.00,2,1,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(3,'تصميم الجرافيك وبناء الهويات','Graphic Design & Visual Identity','graphic-design','graphic_design','palette','تصميمات سوشيال ميديا استثنائية، أغلفة يوتيوب CTR لرفع المشاهدات، وتصميم شعارات وهويات بصرية كاملة.','تصاميم تسويقية مدروسة نفسياً لتحفيز التفاعل والطلب، متناسقة بدقة مع ألوان علامتك التجارية.',1500.00,3,1,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(4,'الإعلانات الممولة (Media Buying)','Sponsored Ads & Performance Marketing','sponsored-ads','media_buying','chart-line','إدارة حملات Meta, TikTok, Google بحساب دقيق للعائد على الإنفاق (ROAS) وتحقيق أعلى مبيعات.','استهداف دقيق للشريحة الأكثر استعداداً للشراء، واختبارات مستمرة لتقليل تكلفة العميل ومضاعفة العائد.',4000.00,4,1,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(5,'إدارة وسائل التواصل الاجتماعي','Social Media Management','social-management','social_media','share-nodes','إدارة كاملة لحسابات السوشيال ميديا مع خطط نشر دورية ومتابعة التفاعل وبناء المجتمع.','خطة محتوى شهرية، النشر في الأوقات الذهبية، الرد على الرسائل والتعليقات، وبناء علاقة وثيقة مع العملاء.',5000.00,5,1,'2026-10-27 18:19:25','2026-10-27 18:46:56'),(6,'إعداد الخطط والاستراتيجيات','Marketing Strategy & Copywriting','strategy-content','marketing_strategy','lightbulb','دراسة السوق وتحليل المنافسين وبناء خطة عمل تسويقية متكاملة مع كتابة سكريبتات إعلانية إبداعية.','استراتيجيات قائمة على البيانات وسلوك الجمهور لصناعة رسائل إعلانية تقود للبيع المباشر.',3000.00,6,1,'2026-10-27 18:19:25','2026-10-27 18:46:56');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `assigned_to` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'editing',
  `status` varchar(255) NOT NULL DEFAULT 'not_started',
  `delivery_deadline` date DEFAULT NULL,
  `daily_delivery_deadline` varchar(255) DEFAULT NULL,
  `material_link` text DEFAULT NULL,
  `delivery_link` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_client_id_foreign` (`client_id`),
  KEY `tasks_assigned_to_foreign` (`assigned_to`),
  KEY `tasks_created_by_foreign` (`created_by`),
  CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `project_id`, `client_id`, `assigned_to`, `created_by`, `title`, `department`, `status`, `delivery_deadline`, `daily_delivery_deadline`, `material_link`, `delivery_link`, `notes`, `priority`, `completed_at`, `created_at`, `updated_at`) VALUES (1,1,2,2,1,'مونتاج ريلز رقم 4 و 5: وجبة الشاورما المكسيكية مع تريند الصوت','editing','not_started','2026-10-29','اليوم الساعة 7:00 مساءً (المسودة الأولى)','https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc','https://drive.google.com/drive/folders/pariq-delivery-shawrmaker-drafts','التركيز على تقطيع المشاهد السريع (Dynamic Cuts) وإبراز بخار الطعام مع موسيقى تشويقية وتطبيق ألوان الهوية.','urgent',NULL,'2026-10-27 18:19:25','2026-10-27 19:57:29'),(2,1,2,3,1,'تصميم 3 أغلفة بوسترات وقصص إنستجرام لعرض الشاورما الخاص','design','not_started','2026-10-31','غداً الساعة 3:00 عصراً (الأفكار والخطوط)','https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc','','مقاسات 1080x1920 للستوري و 1080x1350 للبوستات مع إضافة رمز الخصم والكول تو أكشن.','high',NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(3,4,5,2,1,'التصدير النهائي للبرومو السينمائي 4K مع الصوت المحيطي - Fox ATVs','editing','completed','2026-10-25','تم التسليم والاعتماد في الموعد المحدد','https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc','https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc','تم اعتماد النسخة النهائية من العميل بدون أي تعديلات وحصلت على إشادة خاصة.','medium','2026-10-25 18:19:25','2026-10-27 18:19:25','2026-10-27 18:19:25'),(4,2,3,4,1,'ضبط جمهور حملة ماجستي بالرياض واختبار 4 أشكال إعلانية (Creative Testing)','media_buyer','in_progress','2026-10-30','اليوم الساعة 6:00 مساءً (تقرير نتائج اليوم الأول)','https://drive.google.com/drive/u/1/folders/18DIywEbd-sRSzglpKWJPbpuDhq2MZRHc','https://lookerstudio.google.com/reporting/pariq-majesty-live-dashboard','الميزانية اليومية 600 ريال، الهدف حجز كشوفات بمتوسط تكلفة ليد أقل من 35 ريال.','urgent',NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(5,3,1,3,1,'تصميم تغليف علب زجاجية تجريبية - فكرة ملغاة من الإدارة','design','cancelled','2026-10-22','ملغي','','','تم إلغاء المهمة بناءً على طلب العميل لاستبدال العلب الزجاجية بعبوات ورقية صديقة للبيئة.','low',NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(6,NULL,NULL,3,1,'إجازة اعتيادية معتمدة للمصمم نور الدين حسن','design','on_leave','2026-10-28','إجازة رسمية حتى غداً','','','الموظف في إجازة، تم ترحيل مهام التصميم غير المستعجلة لما بعد العودة.','low',NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'employee',
  `department` varchar(255) NOT NULL DEFAULT 'general',
  `job_title` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `daily_quota` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `department`, `job_title`, `avatar`, `daily_quota`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES (1,'المدير العام (صاحب الوكالة)','admin@pariqagency.com',NULL,'$2y$12$5HqGJGIFwtYlGd.Slghxp.eE4ErkqJY7nhbq5Y5TgSni1Zz1zldAy','+201062330838','admin','management','المدير التنفيذي والمؤسس',NULL,'الإشراف وتوزيع المهام واعتماد التسليمات',1,'oCIo7kfdjg8wQKaG1JSOtdPXwvA4KEUNG1QV0ygPmM8hfeByOCnvJ23PCpxZ','2026-10-27 18:19:24','2026-10-27 18:19:24'),(2,'كريم إبراهيم','karim.video@pariqagency.com',NULL,'$2y$12$NI2bjdeEtXGHRpUzh9HdqO6gdpkXr.sZ8lEYcB8oIS0s/lxI25WWW','+201011122334','employee','editing','كبير مونتيري الفيديو (Senior Video Editor)',NULL,'مونتاج 2 فيديو ريلز يومياً + تطبيق التعديلات',1,NULL,'2026-10-27 18:19:24','2026-10-27 18:19:24'),(3,'نور الدين حسن','nour.design@pariqagency.com',NULL,'$2y$12$uibov8S0mhnQJgxtp0AmS./4P0lqSuV3kgZfcyzYf7slyR1K3ZiLO','+201022233445','employee','design','مصمم جرافيك وهويات بصرية (Senior Graphic Designer)',NULL,'4 تصميمات سوشيال ميديا أو غلافي يوتيوب',1,NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(4,'أحمد مصطفى','ahmed.mediabuy@pariqagency.com',NULL,'$2y$12$VwneQBp0mfxjxa3kCSTJcOKn3k1ixRlAzUroDH7jHpveUnOThZln2','+201033344556','employee','media_buyer','أخصائي حملات إعلانية (Senior Media Buyer)',NULL,'إدارة وتحسين 8 حملات ممولة ومتابعة الـ ROAS',1,NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25'),(5,'سارة علي','sara.cashier@pariqagency.com',NULL,'$2y$12$V02cJ1nnRi7VwSjCNCLVTOAInaq88YzHQor9d8InnajLICqtpbexS','+201044455667','manager','accounting','مسؤولة الحسابات والكاشير المالي',NULL,'تقفيل الخزينة اليومية وإصدار إيصالات القبض',1,NULL,'2026-10-27 18:19:25','2026-10-27 18:19:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-28 20:33:33

SET FOREIGN_KEY_CHECKS=1;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
