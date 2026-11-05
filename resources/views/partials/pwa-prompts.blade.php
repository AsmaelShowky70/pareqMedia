<!-- PWA Smart Mobile Installer & Desktop Notifications System -->
<div id="pwa-system-container" dir="rtl" class="relative z-[999999]">

    <!-- 1. MOBILE AUTO INSTALL MODAL (Android & iPhone Only) -->
    <div id="pwa-mobile-modal" class="fixed inset-0 z-[999999] flex items-end sm:items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md transition-all duration-300 opacity-0 pointer-events-none" style="display: none;">
        <div id="pwa-mobile-modal-card" class="w-full max-w-sm sm:max-w-md bg-[#18082B] border-2 border-amber-500/60 rounded-3xl p-5 sm:p-6 shadow-2xl shadow-black text-white text-center transform translate-y-20 transition-all duration-300 space-y-4">
            
            <!-- App Icon & Header -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="/images/icon-192.png" alt="تطبيق بريق" class="w-20 h-20 rounded-2xl border-2 border-amber-400 p-1.5 bg-[#0B0314] shadow-xl shadow-amber-500/20">
                    <span id="pwa-platform-badge" class="absolute -bottom-2 bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] font-black text-[10px] px-2.5 py-0.5 rounded-full shadow">
                        تطبيق بريق الرسمي
                    </span>
                </div>
                <h3 id="pwa-modal-title" class="text-lg font-black text-white mt-3">
                    تثبيت تطبيق وكالة بريق
                </h3>
                <p class="text-xs text-amber-300/90 font-medium mt-0.5">منصة الإدارة والإنتاج وبصمة الحضور على هاتفك</p>
            </div>

            <!-- Features Highlights -->
            <div class="bg-[#240c42] border border-brand-border/60 rounded-2xl p-3 text-right space-y-2 text-xs text-gray-200">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-bolt text-amber-400 text-sm w-4 text-center"></i>
                    <span>أسرع بـ 3 أضعاف وبكامل الشاشة بدون شريط المتصفح</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-bell text-blue-400 text-sm w-4 text-center"></i>
                    <span>إشعارات فورية لصاحب الشركة وفريق العمل</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-location-crosshairs text-emerald-400 text-sm w-4 text-center"></i>
                    <span>بصمة الحضور الميداني للمصورين (GPS)</span>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- A. iPhone (iOS Safari) Dedicated Visual Guide -->
            <!-- ============================================== -->
            <div id="pwa-ios-section" class="hidden text-right space-y-2.5 bg-gradient-to-b from-blue-950/40 to-brand-card/90 border border-blue-500/40 rounded-2xl p-3.5 text-xs text-gray-200">
                <div class="font-black text-amber-400 flex items-center gap-1.5 text-sm border-b border-brand-border/60 pb-2">
                    <i class="fa-brands fa-apple text-base"></i>
                    <span>خطوات التثبيت على الآيفون (iOS):</span>
                </div>
                <div class="space-y-2">
                    <div class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-blue-500/30 text-blue-300 font-bold flex items-center justify-center text-[11px] flex-shrink-0 mt-0.5">1</span>
                        <p class="leading-relaxed">
                            اضغط على زر المشاركة <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 font-bold mx-1"><i class="fa-solid fa-arrow-up-from-bracket ml-1"></i> Share</span> في شريط Safari أسفل الشاشة.
                        </p>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-emerald-500/30 text-emerald-300 font-bold flex items-center justify-center text-[11px] flex-shrink-0 mt-0.5">2</span>
                        <p class="leading-relaxed">
                            مرر القائمة واختر <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold mx-1"><i class="fa-solid fa-square-plus ml-1"></i> إضافة إلى الصفحة الرئيسية</span> (Add to Home Screen).
                        </p>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-amber-500/30 text-amber-300 font-bold flex items-center justify-center text-[11px] flex-shrink-0 mt-0.5">3</span>
                        <p class="leading-relaxed">
                            اضغط على كلمة <strong>"إضافة" (Add)</strong> في أعلى الزاوية.
                        </p>
                    </div>
                </div>
                <div class="pt-2 text-center text-[11px] text-amber-300 font-medium">
                    📲 سيظهر تطبيق بريق كبرنامج رسمي على شاشتك مع الإشعارات وحفظ الدخول.
                </div>
                <!-- Bouncing Pointer to bottom Safari bar -->
                <div class="pt-1 text-center animate-bounce text-blue-400 font-bold text-xs flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-arrow-down"></i>
                    <span>زر المشاركة موجود أسفل شاشة سفاري</span>
                    <i class="fa-solid fa-arrow-down"></i>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- B. Android Dedicated Action Buttons            -->
            <!-- ============================================== -->
            <div id="pwa-android-section" class="space-y-2 pt-1">
                <!-- Status Feedback Message -->
                <div id="pwa-status-msg" class="hidden p-2.5 rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-300 text-xs text-center font-bold"></div>

                <button type="button" id="pwa-install-btn" onclick="executeDirectPwaInstall()" class="w-full py-3.5 px-4 rounded-2xl font-black text-sm bg-gradient-to-l from-amber-500 via-yellow-400 to-amber-300 text-[#0B0314] hover:brightness-110 active:scale-[0.98] transition-all shadow-xl shadow-amber-500/25 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-download text-base"></i>
                    <span id="pwa-btn-label">تثبيت التطبيق على هاتفك الآن</span>
                </button>
                <div class="text-center pt-0.5">
                    <a id="pwa-apk-direct-link" href="/pariq-media.apk" download="pariq-media.apk" class="inline-block text-[11px] text-amber-400/90 hover:text-amber-300 underline font-medium">
                        <i class="fa-solid fa-file-arrow-down ml-1"></i> تحميل مباشر لملف التطبيق (APK خفيف 21 KB)
                    </a>
                </div>
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
            <span id="pwa-floating-pill-label">تثبيت التطبيق</span>
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
                const pillLabel = document.getElementById('pwa-floating-pill-label');
                if (pill) {
                    if (isIOS && pillLabel) {
                        pillLabel.innerText = 'تطبيق الآيفون';
                    }
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
        const iosSection = document.getElementById('pwa-ios-section');
        const androidSection = document.getElementById('pwa-android-section');
        const title = document.getElementById('pwa-modal-title');
        const badge = document.getElementById('pwa-platform-badge');

        if (isIOS) {
            if (iosSection) iosSection.classList.remove('hidden');
            if (androidSection) androidSection.classList.add('hidden');
            if (title) title.innerText = 'تطبيق بريق على الآيفون (iOS)';
            if (badge) badge.innerText = 'تطبيق رسمي للآيفون';
        } else {
            if (iosSection) iosSection.classList.add('hidden');
            if (androidSection) androidSection.classList.remove('hidden');
            if (title) title.innerText = 'تثبيت تطبيق وكالة بريق (Android)';
            if (badge) badge.innerText = 'تطبيق رسمي للأندرويد';
        }

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

    // DIRECT INSTALLATION (Android & PWA)
    window.executeDirectPwaInstall = function() {
        const btn = document.getElementById('pwa-install-btn');
        const label = document.getElementById('pwa-btn-label');
        const statusBox = document.getElementById('pwa-status-msg');

        // 1. If Chrome native PWA prompt is available, trigger it
        if (window.pariqDeferredPrompt) {
            try {
                window.pariqDeferredPrompt.prompt();
                window.pariqDeferredPrompt.userChoice.then(function(choiceResult) {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('🎉 PWA Installation accepted!');
                        localStorage.setItem('pariq_pwa_never_show', 'true');
                        dismissPwaModal();
                    } else {
                        window.location.href = '/pariq-media.apk';
                    }
                    window.pariqDeferredPrompt = null;
                }).catch(function() {
                    window.location.href = '/pariq-media.apk';
                });
                return;
            } catch(e) {}
        }

        // 2. Direct Android APK Installation (Guaranteed on Realme C11 and all Android versions)
        if (btn && label) {
            label.innerHTML = '<i class="fa-solid fa-spinner fa-spin ml-2"></i> جاري تنزيل التطبيق...';
            btn.disabled = true;
        }

        if (statusBox) {
            statusBox.innerHTML = '✅ بدأ تنزيل التطبيق الخفيف (21 KB)! اضغط على إشعار التنزيل في هاتفك لتثبيته فوراً 📲';
            statusBox.classList.remove('hidden');
        }

        setTimeout(function() {
            window.location.href = '/pariq-media.apk';
        }, 150);

        setTimeout(function() {
            if (label) label.innerHTML = '<i class="fa-solid fa-download ml-2"></i> تنزيل التطبيق مرة أخرى (APK)';
            if (btn) btn.disabled = false;
        }, 3000);
    };

    // Global hook called from header buttons
    window.executePwaInstall = function() {
        if (isMobile) {
            openPwaModal();
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
