<!-- PWA Install & Push Notification Floating Modals / Banners -->
<div id="pwa-banners-container" class="relative z-[99999]" dir="rtl">

    <!-- 1. ANDROID & DESKTOP PWA INSTALL BANNER -->
    <div id="pwa-install-banner" class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-6 sm:w-96 bg-[#18082B]/95 border-2 border-amber-500/50 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl shadow-black/80 transition-all duration-500 translate-y-32 opacity-0 pointer-events-none flex flex-col gap-3">
        <div class="flex items-start gap-3">
            <img src="/images/icon-192.png" alt="بريق" class="w-12 h-12 rounded-xl border border-amber-500/40 shadow-md flex-shrink-0 bg-brand-dark p-1">
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-sm text-amber-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        <span>تثبيت تطبيق بريق</span>
                    </h4>
                    <button type="button" onclick="dismissPwaInstall()" class="text-gray-400 hover:text-white text-xs p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-300 mt-1 leading-relaxed">
                    ثبّت المنصة كتطبيق على هاتفك للوصول السريع بدون متصفح واستقبال الإشعارات وتحديد الموقع.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-1">
            <button type="button" onclick="executePwaInstall()" class="flex-1 py-2 px-3 bg-gradient-to-l from-amber-500 to-yellow-400 hover:brightness-110 text-[#0B0314] font-black text-xs rounded-xl shadow-lg transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-download"></i>
                <span>تثبيت التطبيق الآن</span>
            </button>
            <button type="button" onclick="dismissPwaInstall()" class="py-2 px-3 text-gray-300 hover:bg-white/10 text-xs font-semibold rounded-xl transition">
                لاحقاً
            </button>
        </div>
    </div>

    <!-- 2. NOTIFICATIONS PERMISSION BANNER -->
    <div id="pwa-notif-banner" class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:left-6 sm:w-96 bg-[#18082B]/95 border-2 border-blue-500/50 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl shadow-black/80 transition-all duration-500 translate-y-32 opacity-0 pointer-events-none flex flex-col gap-3">
        <div class="flex items-start gap-3">
            <div class="w-12 h-12 rounded-xl bg-blue-500/20 border border-blue-500/40 text-blue-400 flex items-center justify-center text-xl flex-shrink-0 shadow-md">
                <i class="fa-solid fa-bell animate-bounce"></i>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-sm text-blue-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>تفعيل الإشعارات الفورية</span>
                    </h4>
                    <button type="button" onclick="dismissNotifBanner()" class="text-gray-400 hover:text-white text-xs p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-300 mt-1 leading-relaxed">
                    اسمح باستقبال إشعارات المهام الجديدة، وتحديثات المشروعات، وحركات الخزينة والحسابات لحظة بلحظة.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-1">
            <button type="button" onclick="executeRequestNotif()" class="flex-1 py-2 px-3 bg-gradient-to-l from-blue-600 to-indigo-500 hover:brightness-110 text-white font-black text-xs rounded-xl shadow-lg transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-bell"></i>
                <span>السماح بالإشعارات الآن</span>
            </button>
            <button type="button" onclick="dismissNotifBanner()" class="py-2 px-3 text-gray-300 hover:bg-white/10 text-xs font-semibold rounded-xl transition">
                لاحقاً
            </button>
        </div>
    </div>

    <!-- 3. IOS SAFARI INSTRUCTIONS BANNER -->
    <div id="pwa-ios-banner" class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-6 sm:w-96 bg-[#18082B]/95 border-2 border-amber-500/50 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl shadow-black/80 transition-all duration-500 translate-y-32 opacity-0 pointer-events-none flex flex-col gap-3">
        <div class="flex items-start gap-3">
            <img src="/images/icon-192.png" alt="بريق" class="w-12 h-12 rounded-xl border border-amber-500/40 shadow-md flex-shrink-0 bg-brand-dark p-1">
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-sm text-amber-400">تثبيت التطبيق على iPhone</h4>
                    <button type="button" onclick="dismissIosBanner()" class="text-gray-400 hover:text-white text-xs p-1"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <p class="text-xs text-gray-300 mt-1 leading-relaxed">
                    لتثبيت منصة بريق على شاشتك الرئيسية: اضغط على زر المشاركة <i class="fa-solid fa-arrow-up-from-bracket text-blue-400"></i> أسفل الشاشة، ثم اختر <strong>"إضافة إلى الصفحة الرئيسية"</strong> (Add to Home Screen) ➕.
                </p>
            </div>
        </div>
        <button type="button" onclick="dismissIosBanner()" class="w-full py-1.5 bg-white/10 hover:bg-white/20 text-xs font-bold rounded-xl transition text-center">
            فهمت ذلك
        </button>
    </div>

</div>

<!-- PWA Registration & Intelligent Banner Trigger Script -->
<script>
    // Global PWA State
    window.pariqDeferredPrompt = null;

    // 1. Register Service Worker Immediately
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(reg) {
                    console.log('✅ Pariq Service Worker Registered successfully with scope:', reg.scope);
                })
                .catch(function(err) {
                    console.error('❌ Service Worker registration error:', err);
                });
        });
    }

    // 2. Capture Chrome / Android PWA Install Event
    window.addEventListener('beforeinstallprompt', function(e) {
        e.preventDefault();
        window.pariqDeferredPrompt = e;
        console.log('📱 PWA beforeinstallprompt captured!');

        // Check if user dismissed recently
        const dismissedAt = localStorage.getItem('pariq_pwa_install_dismissed');
        const now = Date.now();
        // Show after 1.5 seconds if not dismissed in last 24h
        if (!dismissedAt || (now - parseInt(dismissedAt)) > (24 * 60 * 60 * 1000)) {
            setTimeout(showPwaInstallBanner, 1500);
        }
    });

    // 3. Fallback: If on Android/Chrome and standalone not active, show prompt after delay
    document.addEventListener('DOMContentLoaded', function() {
        const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
        const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

        if (isStandalone) {
            console.log('🚀 Running inside PWA standalone app mode!');
            return;
        }

        // Check Notification Permission
        setTimeout(function() {
            if ('Notification' in window && Notification.permission === 'default') {
                const notifDismissed = localStorage.getItem('pariq_notif_dismissed');
                if (!notifDismissed || (Date.now() - parseInt(notifDismissed)) > (24 * 60 * 60 * 1000)) {
                    showNotifBanner();
                }
            }
        }, 3000);

        // iOS Safari Banner
        if (isIOS && !isStandalone) {
            const iosDismissed = localStorage.getItem('pariq_ios_pwa_dismissed');
            if (!iosDismissed) {
                setTimeout(showIosBanner, 4000);
            }
        }
    });

    // PWA Install Handlers
    function showPwaInstallBanner() {
        const el = document.getElementById('pwa-install-banner');
        if (el) {
            el.classList.remove('translate-y-32', 'opacity-0', 'pointer-events-none');
            el.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
        }
    }

    function dismissPwaInstall() {
        const el = document.getElementById('pwa-install-banner');
        if (el) {
            el.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            el.classList.add('translate-y-32', 'opacity-0', 'pointer-events-none');
            localStorage.setItem('pariq_pwa_install_dismissed', Date.now().toString());
        }
    }

    function executePwaInstall() {
        if (window.pariqDeferredPrompt) {
            window.pariqDeferredPrompt.prompt();
            window.pariqDeferredPrompt.userChoice.then(function(choiceResult) {
                if (choiceResult.outcome === 'accepted') {
                    console.log('🎉 User accepted the PWA install prompt');
                } else {
                    console.log('User dismissed the PWA install prompt');
                }
                window.pariqDeferredPrompt = null;
                dismissPwaInstall();
            });
        } else {
            // If beforeinstallprompt hasn't fired yet, alert user how to add via browser menu
            alert('لتثبيت التطبيق على هاتفك الآن:\nاضغط على قائمة المتصفح (الثلاث نقاط ⋮ أعلى أو أسفل الشاشة) ثم اختر "تثبيت التطبيق" أو "إضافة إلى الشاشة الرئيسية" (Install App / Add to Home screen).');
            dismissPwaInstall();
        }
    }

    window.addEventListener('appinstalled', function() {
        console.log('✅ Pariq PWA installed successfully on device!');
        dismissPwaInstall();
    });

    // Notification Handlers
    function showNotifBanner() {
        const el = document.getElementById('pwa-notif-banner');
        if (el) {
            el.classList.remove('translate-y-32', 'opacity-0', 'pointer-events-none');
            el.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
        }
    }

    function dismissNotifBanner() {
        const el = document.getElementById('pwa-notif-banner');
        if (el) {
            el.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            el.classList.add('translate-y-32', 'opacity-0', 'pointer-events-none');
            localStorage.setItem('pariq_notif_dismissed', Date.now().toString());
        }
    }

    function executeRequestNotif() {
        if (!('Notification' in window)) {
            alert('متصفحك الحالي لا يدعم نظام الإشعارات.');
            dismissNotifBanner();
            return;
        }

        Notification.requestPermission().then(function(permission) {
            dismissNotifBanner();
            if (permission === 'granted') {
                if ('serviceWorker' in navigator && navigator.serviceWorker.ready) {
                    navigator.serviceWorker.ready.then(function(reg) {
                        reg.showNotification('وكالة بريق للإعلام', {
                            body: '🎉 تم تفعيل الإشعارات الفورية بنجاح على هاتفك!',
                            icon: '/images/icon-192.png',
                            badge: '/images/icon-72.png',
                            vibrate: [200, 100, 200]
                        });
                    });
                } else {
                    new Notification('وكالة بريق للإعلام', {
                        body: '🎉 تم تفعيل الإشعارات الفورية بنجاح على هذا الجهاز!',
                        icon: '/images/icon-192.png'
                    });
                }
            } else if (permission === 'denied') {
                alert('تم رفض الإشعارات من إعدادات المتصفح. يمكنك تفعيلها بالضغط على أيقونة القفل 🔒 بجانب رابط الموقع في المتصفح.');
            }
        });
    }

    // iOS Banner Handlers
    function showIosBanner() {
        const el = document.getElementById('pwa-ios-banner');
        if (el) {
            el.classList.remove('translate-y-32', 'opacity-0', 'pointer-events-none');
            el.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
        }
    }

    function dismissIosBanner() {
        const el = document.getElementById('pwa-ios-banner');
        if (el) {
            el.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            el.classList.add('translate-y-32', 'opacity-0', 'pointer-events-none');
            localStorage.setItem('pariq_ios_pwa_dismissed', 'true');
        }
    }

    // Geolocation Helper for Mobile Check-in
    window.requestPariqLocation = function(onSuccess, onError) {
        if (!navigator.geolocation) {
            alert('خاصية تحديد الموقع الجغرافي GPS غير مدعومة في جهازك.');
            if (onError) onError('Not supported');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                if (onSuccess) onSuccess(pos.coords.latitude, pos.coords.longitude);
            },
            function(err) {
                console.warn('Geolocation error:', err);
                if (onError) onError(err);
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    };
</script>
