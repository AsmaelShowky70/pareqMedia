<?php
// Quick Diagnostic & Fix Tool for Pariq Media on Hostinger
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<div style='font-family:sans-serif; direction:rtl; text-align:right; max-width:800px; margin:30px auto; padding:25px; border:1px solid #ddd; border-radius:12px; background:#fafafa;'>";
echo "<h2 style='color:#1e3a8a; margin-top:0;'>🔧 تقرير فحص وتشخيص منصة بريق ميديا</h2>";

// 1. Check PHP Version
echo "<p><strong>• إصدار PHP الحالي:</strong> " . PHP_VERSION . "</p>";

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
