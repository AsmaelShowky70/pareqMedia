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
                        تطبيق رسمي
                    </span>
                </div>
                <h3 class="text-lg font-black text-white mt-3">
                    تثبيت تطبيق وكالة بريق
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
                    <span>إشعارات فورية وتنبيهات المهام والحسابات</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-mobile-screen text-emerald-400 text-sm w-4 text-center"></i>
                    <span>أيقونة خاصة على شاشتك مع حفظ الدخول</span>
                </div>
            </div>

            <!-- iOS Safari Visual Guide (Only displayed on iPhone) -->
            <div id="pwa-ios-instructions" class="hidden bg-amber-500/10 border border-amber-500/40 rounded-2xl p-3 text-right text-xs text-amber-200 space-y-1.5">
                <div class="font-bold text-amber-400 flex items-center gap-1.5">
                    <i class="fa-brands fa-apple text-sm"></i>
                    <span>تثبيت التطبيق على الآيفون:</span>
                </div>
                <p>1. اضغط على زر المشاركة <i class="fa-solid fa-arrow-up-from-bracket text-blue-400 font-bold mx-1"></i> أسفل الشاشة.</p>
                <p>2. اختر <strong>"إضافة إلى الصفحة الرئيسية"</strong> (Add to Home Screen) ➕.</p>
            </div>

            <!-- Status Feedback Message (No Alerts!) -->
            <div id="pwa-status-msg" class="hidden p-2.5 rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-300 text-xs text-center font-bold">
            </div>

            <!-- Primary Action Button -->
            <div class="space-y-2 pt-1">
                <button type="button" id="pwa-install-btn" onclick="executeDirectPwaInstall()" class="w-full py-3.5 px-4 rounded-2xl font-black text-sm bg-gradient-to-l from-amber-500 via-yellow-400 to-amber-300 text-[#0B0314] hover:brightness-110 active:scale-[0.98] transition-all shadow-xl shadow-amber-500/25 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-download text-base"></i>
                    <span id="pwa-btn-label">تثبيت التطبيق على هاتفك الآن</span>
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

<!-- Direct PWA Execution Script -->
<script>
(function() {
    const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) 
        || (window.matchMedia && window.matchMedia("(max-width: 768px)").matches)
        || (navigator.maxTouchPoints > 1 && window.innerWidth <= 1024);
    
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

    // In-App browser check (WhatsApp, Facebook, Instagram, TikTok)
    const isInApp = /FBAN|FBAV|Instagram|WhatsApp|TikTok|Line|Snapchat/i.test(navigator.userAgent);

    document.addEventListener('DOMContentLoaded', function() {
        if (isStandalone) return;

        // ==========================================
        // A) MOBILE (Android / iPhone)
        // ==========================================
        if (isMobile) {
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
                    }, 600);
                }

                // Auto modal after 800ms
                if (!sessionDismissed) {
                    setTimeout(openPwaModal, 800);
                }
            }
        } 
        // ==========================================
        // B) DESKTOP (PC / Laptop) - Notifications Only
        // ==========================================
        else {
            if ('Notification' in window && Notification.permission === 'default') {
                const notifDismissed = localStorage.getItem('pariq_desktop_notif_dismissed');
                if (!notifDismissed || (Date.now() - parseInt(notifDismissed)) > (24 * 60 * 60 * 1000)) {
                    setTimeout(showDesktopNotifCard, 2000);
                }
            }
        }
    });

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
            const pill = document.getElementById('pwa-floating-pill');
            if (pill) {
                pill.classList.remove('scale-100', 'pointer-events-auto');
                pill.classList.add('scale-0', 'pointer-events-none');
            }
        } else {
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

    // DIRECT INSTALLATION - NO MANUAL ALERTS
    window.executeDirectPwaInstall = function() {
        const btn = document.getElementById('pwa-install-btn');
        const label = document.getElementById('pwa-btn-label');
        const statusBox = document.getElementById('pwa-status-msg');

        // 1. If on iPhone (iOS)
        if (isIOS) {
            const iosGuide = document.getElementById('pwa-ios-instructions');
            if (iosGuide) {
                iosGuide.classList.remove('hidden');
            }
            return;
        }

        // 2. If inside In-App Browser (WhatsApp / Facebook) -> Launch real Chrome via Android Intent!
        if (isInApp) {
            const currentUrl = window.location.href.replace(/^https?:\/\//, '');
            window.location.href = 'intent://' + currentUrl + '#Intent;scheme=https;package=com.android.chrome;end';
            return;
        }

        // 3. Android Chrome Direct Trigger
        if (window.pariqDeferredPrompt) {
            promptNativeInstall(window.pariqDeferredPrompt);
            return;
        }

        // 4. If prompt event is still registering, wait seamlessly (DO NOT SHOW ALERT!)
        if (btn && label) {
            btn.disabled = true;
            label.innerHTML = 'جاري التثبيت المباشر...';
        }

        let resolved = false;
        // Register callback for when event arrives
        if (window.pariqPromptReadyCallbacks) {
            window.pariqPromptReadyCallbacks.push(function(promptEvent) {
                if (!resolved) {
                    resolved = true;
                    restoreBtn();
                    promptNativeInstall(promptEvent);
                }
            });
        }

        // Fast poll every 80ms for 3 seconds
        let elapsed = 0;
        const timer = setInterval(function() {
            elapsed += 80;
            if (window.pariqDeferredPrompt && !resolved) {
                resolved = true;
                clearInterval(timer);
                restoreBtn();
                promptNativeInstall(window.pariqDeferredPrompt);
            } else if (elapsed >= 3000) {
                clearInterval(timer);
                if (!resolved) {
                    resolved = true;
                    restoreBtn();
                    // Fallback without annoying alert:
                    if (statusBox) {
                        statusBox.innerHTML = '✨ المتصفح يقوم بتهيئة التطبيق، اضغط مرة أخرى للتثبيت';
                        statusBox.classList.remove('hidden');
                    }
                }
            }
        }, 80);

        function restoreBtn() {
            if (btn && label) {
                btn.disabled = false;
                label.innerHTML = 'تثبيت التطبيق على هاتفك الآن';
            }
        }
    };

    function promptNativeInstall(promptEvent) {
        promptEvent.prompt();
        promptEvent.userChoice.then(function(choiceResult) {
            if (choiceResult.outcome === 'accepted') {
                console.log('🎉 PWA Installation accepted!');
                localStorage.setItem('pariq_pwa_never_show', 'true');
            }
            window.pariqDeferredPrompt = null;
            dismissPwaModal();
        }).catch(function() {
            dismissPwaModal();
        });
    }

    // Global hook called from header buttons
    window.executePwaInstall = function() {
        if (isMobile) {
            openPwaModal();
            executeDirectPwaInstall();
        }
    };

    // Celebration on installed
    window.addEventListener('appinstalled', function() {
        console.log('✅ Pariq App installed successfully!');
        localStorage.setItem('pariq_pwa_never_show', 'true');
        dismissPwaModal();
    });

    // Desktop Notifications
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
        if (!('Notification' in window)) return;
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
