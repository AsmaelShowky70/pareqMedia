@echo off
title تشغيل سيستم وكالة بريق والرابط الخارجي للعميل
chcp 65001 >nul
echo ==============================================================
echo       تشغيل خادم وكالة بريق والرابط السحابي للعميل
echo ==============================================================
echo.
set PATH=C:\xampp\php;%PATH%
echo [1/2] جاري تشغيل خادم النظام المحلي (Laravel)...
start /b cmd /c "php artisan serve --host=127.0.0.1 --port=8000"
timeout /t 3 >nul
echo.
echo [2/2] جاري تشغيل الرابط الخارجي المباشر عبر Cloudflare...
echo.
cloudflared.exe tunnel --url http://127.0.0.1:8000
pause
