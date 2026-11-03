<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. تفعيل عرض الأخطاء المباشرة لتشخيص أي مشكلة فوراً
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 2. إنشاء وتأمين مجلدات التخزين وتصاريح الكتابة تلقائياً
$storageDirs = [
    __DIR__ . '/../storage',
    __DIR__ . '/../storage/app',
    __DIR__ . '/../storage/app/public',
    __DIR__ . '/../storage/framework',
    __DIR__ . '/../storage/framework/cache',
    __DIR__ . '/../storage/framework/cache/data',
    __DIR__ . '/../storage/framework/sessions',
    __DIR__ . '/../storage/framework/views',
    __DIR__ . '/../storage/logs',
    __DIR__ . '/../bootstrap/cache',
];
foreach ($storageDirs as $sDir) {
    if (!is_dir($sDir)) {
        @mkdir($sDir, 0777, true);
    }
    @chmod($sDir, 0777);
}

// 3. التأكد من وجود ملف .env
if (!file_exists(__DIR__ . '/../.env') && file_exists(__DIR__ . '/../env_infinityfree.txt')) {
    @copy(__DIR__ . '/../env_infinityfree.txt', __DIR__ . '/../.env');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request
try {
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    header("Content-Type: text/html; charset=UTF-8", true, 500);
    echo '<!DOCTYPE html><html dir="rtl" lang="ar"><head><meta charset="utf-8"><title>تقرير خطأ Laravel</title>';
    echo '<style>body{font-family:Segoe UI,Tahoma,sans-serif;background:#0f172a;color:#f8fafc;padding:30px;line-height:1.6;}';
    echo '.err-card{background:#1e293b;border:1px solid #ef4444;border-radius:12px;padding:25px;max-width:900px;margin:0 auto;}';
    echo 'h2{color:#f87171;margin-top:0;} pre{background:#0b1120;padding:15px;border-radius:8px;overflow-x:auto;direction:ltr;text-align:left;color:#e2e8f0;font-size:13px;border:1px solid #334155;}';
    echo '.file{color:#38bdf8;} code{background:#334155;padding:2px 6px;border-radius:4px;}';
    echo '</style></head><body><div class="err-card">';
    echo '<h2>⚠️ سبب توقف صفحة Laravel:</h2>';
    echo '<p style="font-size:17px;font-weight:bold;color:#fca5a5;">' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p>الملف: <code class="file">' . htmlspecialchars($e->getFile()) . '</code> (سطر: <code>' . $e->getLine() . '</code>)</p>';
    echo '<h3 style="color:#94a3b8;margin-top:20px;">مسار التتبع (Stack Trace):</h3>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div></body></html>';
    exit;
}
