<!-- PWA Smart Mobile Installer & Desktop Notifications System -->
<div id="pwa-system-container" dir="rtl" class="relative z-[999999]">

    <!-- 1. MOBILE AUTO INSTALL MODAL (Android & iPhone Only) -->
    <div id="pwa-mobile-modal" class="fixed inset-0 z-[999999] flex items-end sm:items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md transition-all duration-300 opacity-0 pointer-events-none" style="display: none;">
        <div id="pwa-mobile-modal-card" class="w-full max-w-sm sm:max-w-md bg-[#18082B] border-2 border-amber-500/60 rounded-3xl p-5 sm:p-6 shadow-2xl shadow-black text-white text-center transform translate-y-20 transition-all duration-300 space-y-4">
            
            <!-- App Icon & Header -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="/images/icon-192.png" alt="تطبيق بريق" class="w-20 h-20 rounded-2xl border-2 border-amber-400 p-1.5 bg-[#0B0314] shadow-xl shadow-amber-500/20">
                    <span class="absolute -bottom-2 bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] font-black text-[10px] px-2 py-0.5 rounded-full shadow">
                        PWA APP
                    </span>
                </div>
                <h3 class="text-lg font-black text-white mt-3 flex items-center gap-2">
                    <span>تثبيت تطبيق وكالة بريق</span>
                </h3>
                <p class="text-xs text-amber-300/90 font-medium mt-0.5">منصة الإدارة والإنتاج المرئي على هاتفك</p>
            </div>

            <!-- Features Highlights -->
            <div class="bg-[#240c42] border border-brand-border/60 rounded-2xl p-3 text-right space-y-2 text-xs text-gray-200">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-bolt text-amber-400 text-sm w-4 text-center"></i>
                    <span>أسرع بـ 3 أضعاف وبدون شريط المتصفح</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-bell text-blue-400 text-sm w-4 text-center"></i>
                    <span>استقبال الإشعارات الفورية وتنبيهات المهام أولاً بأول</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-mobile-screen text-emerald-400 text-sm w-4 text-center"></i>
                    <span>أيقونة خاصة على شاشة هاتفك مع تسجيل دخول دائم</span>
                </div>
            </div>

            <!-- iOS Instructions Guide (Shown on iPhone when triggered) -->
            <div id="pwa-ios-instructions" class="hidden bg-amber-500/10 border border-amber-500/30 rounded-2xl p-3 text-right text-xs text-amber-200 space-y-1.5 animate-pulse">
                <div class="font-bold text-amber-400 flex items-center gap-1.5">
                    <i class="fa-brands fa-apple text-sm"></i>
                    <span>خطوات التثبيت على الآيفون (Safari):</span>
                </div>
                <p>1. اضغط على زر المشاركة <i class="fa-solid fa-arrow-up-from-bracket text-blue-400 font-bold mx-1"></i> أسفل الشاشة.</p>
                <p>2. مرر للأسفل واختر <strong>"إضافة إلى الصفحة الرئيسية"</strong> (Add to Home Screen) ➕.</p>
            </div>

            <!-- Primary Action Button -->
            <div class="space-y-2 pt-1">
                <button type="button" id="pwa-install-btn" onclick="executePwaInstallFromModal()" class="w-full py-3.5 px-4 rounded-2xl font-black text-sm bg-gradient-to-l from-amber-500 via-yellow-400 to-amber-300 text-[#0B0314] hover:brightness-110 active:scale-[0.98] transition-all shadow-xl shadow-amber-500/25 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-download text-base"></i>
                    <span>تثبيت التطبيق على هاتفك الآن</span>
                </button>
            </div>

            <!-- Never Show Again Option & Dismiss -->
            <div class="pt-2 border-t border-brand-border/40 flex flex-col items-center gap-2.5">
                <label class="flex items-center gap-2 text-xs text-gray-300 cursor-pointer select-none">
                    <input type="checkbox" id="pwa-never-show-cb" class="w-4 h-4 rounded bg-[#240c42] border-brand-border text-amber-500 focus:ring-0 cursor-pointer">
                    <span>عدم إظهار هذه الرسالة مرة أخرى</span>
                </label>

                <button type="button" onclick="dismissPwaModal()" class="text-xs text-gray-400 hover:text-white transition">
                    تصفح عبر الويب (إغلاق)
                </button>
            </div>

        </div>
    </div>

    <!-- 2. FLOATING INSTALL PILL (Mobile Only Fallback) -->
    <div id="pwa-floating-pill" class="fixed bottom-5 left-4 z-[9999] transition-all duration-300 scale-0 pointer-events-none" style="display: none;">
        <button type="button" onclick="openPwaModal()" class="px-3.5 py-2 rounded-full bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] font-black text-xs shadow-2xl flex items-center gap-2 border border-amber-300 hover:scale-105 transition-transform">
            <i class="fa-solid fa-mobile-screen-button"></i>
            <span>تثبيت التطبيق</span>
        </button>
    </div>

    <!-- 3. DESKTOP NOTIFICATIONS PROMPT (PC & Laptop Only) -->
    <div id="pwa-desktop-notif-card" class="fixed bottom-5 left-6 z-[9999] max-w-sm bg-[#18082B]/95 border border-blue-500/40 rounded-2xl p-4 text-white shadow-2xl shadow-black/80 backdrop-blur-md transition-all duration-300 translate-y-24 opacity-0 pointer-events-none" style="display: none;">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-xs font-black text-white">إشعارات منصة بريق لسطح المكتب</h4>
                <p class="text-[11px] text-gray-300 mt-0.5 leading-relaxed">
                    فعّل إشعارات المتصفح لتصلك تنبيهات المهام والمشاريع والحسابات أثناء العمل.
                </p>
                <div class="flex items-center gap-2 mt-2.5">
                    <button type="button" onclick="enableDesktopNotifications()" class="px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow transition">
                        تفعيل الإشعارات
                    </button>
                    <button type="button" onclick="dismissDesktopNotif()" class="px-2.5 py-1.5 text-xs text-gray-400 hover:text-white transition">
                        لاحقاً
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- PWA & Device-Specific Automation Engine -->
<script>
(function() {
    // 1. Device Classifier
    const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) 
        || (window.matchMedia && window.matchMedia("(max-width: 768px)").matches)
        || (navigator.maxTouchPoints > 1 && window.innerWidth <= 1024);
    
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

    // Global variable for Chrome deferred prompt
    window.pariqDeferredPrompt = null;

    // 2. Register Service Worker on All Devices
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(reg) {
                    console.log('✅ Pariq Service Worker active with scope:', reg.scope);
                })
                .catch(function(err) {
                    console.log('ServiceWorker note:', err);
                });
        });
    }

    // 3. Listen for Android Chrome beforeinstallprompt event
    window.addEventListener('beforeinstallprompt', function(e) {
        e.preventDefault();
        window.pariqDeferredPrompt = e;
        console.log('📱 PWA beforeinstallprompt captured successfully.');
    });

    // 4. Initial Launch Logic
    document.addEventListener('DOMContentLoaded', function() {
        // If already installed and running inside the app: Do nothing!
        if (isStandalone) {
            console.log('🚀 Running in standalone PWA app mode.');
            return;
        }

        // ==========================================
        // A) MOBILE DEVICES (Android & iPhone)
        // ==========================================
        if (isMobile) {
            // Check if user chose "Never show again"
            const neverShow = localStorage.getItem('pariq_pwa_never_show');
            const sessionDismissed = sessionStorage.getItem('pariq_pwa_session_dismissed');

            if (!neverShow) {
                // Show floating pill
                const pill = document.getElementById('pwa-floating-pill');
                if (pill) {
                    pill.style.display = 'block';
                    setTimeout(() => {
                        pill.classList.remove('scale-0', 'pointer-events-none');
                        pill.classList.add('scale-100', 'pointer-events-auto');
                    }, 800);
                }

                // If not dismissed during this current session, show auto modal after 1.2s
                if (!sessionDismissed) {
                    setTimeout(openPwaModal, 1200);
                }
            }
        } 
        // ==========================================
        // B) DESKTOP / PC (Notifications Only)
        // ==========================================
        else {
            // Check desktop notification permission
            if ('Notification' in window && Notification.permission === 'default') {
                const notifDismissed = localStorage.getItem('pariq_desktop_notif_dismissed');
                if (!notifDismissed || (Date.now() - parseInt(notifDismissed)) > (24 * 60 * 60 * 1000)) {
                    setTimeout(showDesktopNotifCard, 2500);
                }
            }
        }
    });

    // Modal Controls
    window.openPwaModal = function() {
        const modal = document.getElementById('pwa-mobile-modal');
        const card = document.getElementById('pwa-mobile-modal-card');
        if (modal && card) {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100', 'pointer-events-auto');
                card.classList.remove('translate-y-20');
                card.classList.add('translate-y-0');
            }, 20);
        }
    };

    window.dismissPwaModal = function() {
        const modal = document.getElementById('pwa-mobile-modal');
        const card = document.getElementById('pwa-mobile-modal-card');
        const cb = document.getElementById('pwa-never-show-cb');

        if (cb && cb.checked) {
            localStorage.setItem('pariq_pwa_never_show', 'true');
            // Hide floating pill as well
            const pill = document.getElementById('pwa-floating-pill');
            if (pill) {
                pill.classList.remove('scale-100', 'pointer-events-auto');
                pill.classList.add('scale-0', 'pointer-events-none');
            }
        } else {
            // Dismiss for current browser session
            sessionStorage.setItem('pariq_pwa_session_dismissed', 'true');
        }

        if (modal && card) {
            card.classList.remove('translate-y-0');
            card.classList.add('translate-y-20');
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
    };

    // Install Action Execution
    window.executePwaInstallFromModal = function() {
        // 1. If on iOS (iPhone / iPad)
        if (isIOS) {
            const iosGuide = document.getElementById('pwa-ios-instructions');
            if (iosGuide) {
                iosGuide.classList.remove('hidden');
            }
            return;
        }

        // 2. Android: Check if deferred prompt is available
        if (window.pariqDeferredPrompt) {
            window.pariqDeferredPrompt.prompt();
            window.pariqDeferredPrompt.userChoice.then(function(choiceResult) {
                if (choiceResult.outcome === 'accepted') {
                    console.log('🎉 PWA Installation accepted by user');
                    localStorage.setItem('pariq_pwa_never_show', 'true');
                }
                window.pariqDeferredPrompt = null;
                dismissPwaModal();
            });
        } else {
            // In case user is inside in-app browser (WhatsApp, Facebook, etc.) or Chrome hasn't fired event
            const isWebview = /FBAN|FBAV|Instagram|WhatsApp|TikTok/i.test(navigator.userAgent);
            if (isWebview) {
                alert('⚠️ أنت تتصفح الرابط من داخل تطبيق (مثل واتساب أو فيسبوك).\n\nلتنزيل التطبيق:\nاضغط على النقاط الثلاث ⋮ في أعلى أو أسفل الشاشة واختر "فتح في متصفح Chrome" (Open in Chrome) ثم اضغط تثبيت.');
            } else {
                alert('لتثبيت التطبيق على هاتفك الآن:\nاضغط على قائمة المتصفح (الثلاث نقاط ⋮) ثم اختر "تثبيت التطبيق" أو "إضافة إلى الشاشة الرئيسية" (Install App).');
            }
            dismissPwaModal();
        }
    };

    // Also support global executePwaInstall() called from any header/menu button
    window.executePwaInstall = function() {
        if (isMobile) {
            openPwaModal();
        }
    };

    // Listen to successful install event
    window.addEventListener('appinstalled', function() {
        console.log('✅ Pariq App installed successfully!');
        localStorage.setItem('pariq_pwa_never_show', 'true');
        dismissPwaModal();
    });

    // Desktop Notifications Functions
    function showDesktopNotifCard() {
        const el = document.getElementById('pwa-desktop-notif-card');
        if (el) {
            el.style.display = 'block';
            setTimeout(() => {
                el.classList.remove('translate-y-24', 'opacity-0', 'pointer-events-none');
                el.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            }, 20);
        }
    }

    window.dismissDesktopNotif = function() {
        const el = document.getElementById('pwa-desktop-notif-card');
        if (el) {
            el.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            el.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
            localStorage.setItem('pariq_desktop_notif_dismissed', Date.now().toString());
            setTimeout(() => {
                el.style.display = 'none';
            }, 300);
        }
    };

    window.enableDesktopNotifications = function() {
        if (!('Notification' in window)) {
            alert('متصفحك لا يدعم نظام الإشعارات.');
            dismissDesktopNotif();
            return;
        }

        Notification.requestPermission().then(function(permission) {
            dismissDesktopNotif();
            if (permission === 'granted') {
                new Notification('وكالة بريق للإعلام', {
                    body: '🎉 تم تفعيل إشعارات سطح المكتب بنجاح!',
                    icon: '/images/icon-192.png'
                });
            }
        });
    };
})();
</script>
