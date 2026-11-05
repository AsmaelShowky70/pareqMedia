<!-- PWA Smart Mobile Installer & Desktop Notifications System -->
<div id="pwa-system-container" dir="rtl" class="relative z-[999999]">

    <!-- 1. MOBILE AUTO INSTALL MODAL (Android & iPhone Interactive Choice) -->
    <div id="pwa-mobile-modal" class="fixed inset-0 z-[999999] flex items-end sm:items-center justify-center p-3 sm:p-4 bg-black/85 backdrop-blur-md transition-all duration-300 opacity-0 pointer-events-none" style="display: none;">
        <div id="pwa-mobile-modal-card" class="w-full max-w-sm sm:max-w-md bg-[#18082B] border-2 border-amber-500/60 rounded-3xl p-5 sm:p-6 shadow-2xl shadow-black text-white text-center transform translate-y-20 transition-all duration-300 space-y-4">
            
            <!-- App Icon & Header -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="/images/icon-192.png" alt="تطبيق بريق" class="w-20 h-20 rounded-2xl border-2 border-amber-400 p-1.5 bg-[#0B0314] shadow-xl shadow-amber-500/20">
                    <span id="pwa-platform-badge" class="absolute -bottom-2 bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] font-black text-[10px] px-2.5 py-0.5 rounded-full shadow">
                        تطبيق معتمد وآمن 100%
                    </span>
                </div>
                <h3 class="text-lg font-black text-white mt-3">
                    تثبيت تطبيق وكالة بريق
                </h3>
                <p class="text-xs text-amber-300/90 font-medium mt-0.5">منصة الإدارة والإنتاج وبصمة الحضور على هاتفك</p>
            </div>

            <!-- Features Highlights -->
            <div class="bg-[#240c42] border border-brand-border/60 rounded-2xl p-3 text-right space-y-1.5 text-xs text-gray-200">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-shield-halved text-emerald-400 text-sm w-4 text-center"></i>
                    <span>تثبيت رسمي آمن عبر المتصفح بدون أي ملفات ضارة</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-bell text-blue-400 text-sm w-4 text-center"></i>
                    <span>إشعارات فورية لصاحب الشركة والمدير وفريق العمل</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-location-crosshairs text-amber-400 text-sm w-4 text-center"></i>
                    <span>بصمة الحضور الميداني للمصورين (GPS)</span>
                </div>
            </div>

            <!-- PLATFORM SELECTOR TABS (اختيار نوع الهاتف بوضوح) -->
            <div class="space-y-1">
                <div class="text-[11px] font-bold text-gray-300 text-right pr-1">
                    اختر نوع هاتفك للتثبيت المناسب:
                </div>
                <div class="grid grid-cols-2 gap-2 p-1 bg-[#0B0314] rounded-2xl border border-brand-border/60">
                    <button type="button" id="tab-btn-android" onclick="selectPlatform('android')" 
                            class="py-2.5 px-3 rounded-xl font-black text-xs flex items-center justify-center gap-2 transition-all">
                        <i class="fa-brands fa-android text-base text-emerald-400"></i>
                        <span>هاتف أندرويد</span>
                    </button>
                    <button type="button" id="tab-btn-ios" onclick="selectPlatform('ios')" 
                            class="py-2.5 px-3 rounded-xl font-black text-xs flex items-center justify-center gap-2 transition-all">
                        <i class="fa-brands fa-apple text-base text-gray-200"></i>
                        <span>هاتف آيفون (iOS)</span>
                    </button>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 1. ANDROID SECTION (Safe Browser PWA Install)   -->
            <!-- ============================================== -->
            <div id="section-android" class="space-y-3 pt-1">
                
                <!-- Safe Feedback / Instructions Box -->
                <div id="android-steps-box" class="hidden text-right space-y-2 bg-emerald-950/30 border border-emerald-500/40 rounded-2xl p-3 text-xs text-gray-200">
                    <div class="font-black text-emerald-400 flex items-center gap-1.5 text-xs pb-1 border-b border-emerald-500/20">
                        <i class="fa-solid fa-shield-check text-sm"></i>
                        <span>طريقة التثبيت الآمن عبر المتصفح (Chrome):</span>
                    </div>
                    <div class="space-y-1.5 pt-1">
                        <div class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/30 text-emerald-300 font-bold flex items-center justify-center text-[10px] flex-shrink-0 mt-0.5">1</span>
                            <p class="leading-relaxed">
                                اضغط على قائمة المتصفح <span class="px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold mx-1"><i class="fa-solid fa-ellipsis-vertical ml-1"></i> (الثلاث نقاط)</span> أعلى الشاشة.
                            </p>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/30 text-emerald-300 font-bold flex items-center justify-center text-[10px] flex-shrink-0 mt-0.5">2</span>
                            <p class="leading-relaxed">
                                اختر <span class="px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold mx-1"><i class="fa-solid fa-mobile-screen-button ml-1"></i> تثبيت التطبيق</span> (أو إضافة إلى الشاشة).
                            </p>
                        </div>
                    </div>
                    <div class="text-[11px] text-emerald-300/90 font-medium text-center pt-1">
                        ✅ تثبيت مباشر ومعتمد من Google بدون أي تحذيرات أمان.
                    </div>
                </div>

                <!-- Primary Safe Install Button -->
                <button type="button" id="android-install-btn" onclick="executeSafeAndroidInstall()" class="w-full py-3.5 px-4 rounded-2xl font-black text-sm bg-gradient-to-l from-amber-500 via-yellow-400 to-amber-300 text-[#0B0314] hover:brightness-110 active:scale-[0.98] transition-all shadow-xl shadow-amber-500/25 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-mobile-screen-button text-base"></i>
                    <span id="android-btn-label">تثبيت التطبيق على هاتفك الآن (آمن 100%)</span>
                </button>

                <!-- Optional direct APK fallback (discreet) -->
                <div class="text-center pt-1">
                    <a href="/pariq-media.apk" download="pariq-media.apk" class="text-[11px] text-gray-400 hover:text-amber-300 transition underline">
                        أو تنزيل ملف APK بديل (لمن لا يملكون متصفح جوجل كروم)
                    </a>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. IPHONE (iOS Safari) SECTION                  -->
            <!-- ============================================== -->
            <div id="section-ios" class="hidden text-right space-y-2.5 bg-gradient-to-b from-blue-950/40 to-brand-card/90 border border-blue-500/40 rounded-2xl p-3.5 text-xs text-gray-200">
                <div class="font-black text-amber-400 flex items-center gap-1.5 text-xs border-b border-brand-border/60 pb-2">
                    <i class="fa-brands fa-apple text-base"></i>
                    <span>خطوات التثبيت الآمن على الآيفون (iOS Safari):</span>
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
                <div class="pt-1.5 text-center text-[11px] text-amber-300 font-medium">
                    ✅ معتمد رسمياً من Apple بدون تحميل أي ملفات خارجية.
                </div>
                <!-- Bouncing Pointer to bottom Safari bar -->
                <div class="pt-1 text-center animate-bounce text-blue-400 font-bold text-xs flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-arrow-down"></i>
                    <span>زر المشاركة موجود أسفل شاشة سفاري</span>
                    <i class="fa-solid fa-arrow-down"></i>
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
    
    const isIOSDevice = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

    let currentSelectedPlatform = isIOSDevice ? 'ios' : 'android';

    document.addEventListener('DOMContentLoaded', function() {
        if (isStandalone) return;

        // Auto platform setup
        selectPlatform(currentSelectedPlatform);

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
        else {
            if ('Notification' in window && Notification.permission === 'default') {
                const notifDismissed = localStorage.getItem('pariq_desktop_notif_dismissed');
                if (!notifDismissed || (Date.now() - parseInt(notifDismissed)) > (24 * 60 * 60 * 1000)) {
                    setTimeout(showDesktopNotifCard, 2000);
                }
            }
        }
    });

    // Switch between Android and iPhone tabs
    window.selectPlatform = function(platform) {
        currentSelectedPlatform = platform;
        const btnAndroid = document.getElementById('tab-btn-android');
        const btnIos = document.getElementById('tab-btn-ios');
        const secAndroid = document.getElementById('section-android');
        const secIos = document.getElementById('section-ios');
        const badge = document.getElementById('pwa-platform-badge');

        if (!btnAndroid || !btnIos) return;

        if (platform === 'android') {
            btnAndroid.className = 'py-2.5 px-3 rounded-xl font-black text-xs flex items-center justify-center gap-2 transition-all bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] shadow-md';
            btnIos.className = 'py-2.5 px-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2 transition-all text-gray-400 hover:text-white';
            if (secAndroid) secAndroid.classList.remove('hidden');
            if (secIos) secIos.classList.add('hidden');
            if (badge) badge.innerText = 'تطبيق رسمي للأندرويد (PWA)';
        } else {
            btnIos.className = 'py-2.5 px-3 rounded-xl font-black text-xs flex items-center justify-center gap-2 transition-all bg-gradient-to-l from-amber-500 to-yellow-400 text-[#0B0314] shadow-md';
            btnAndroid.className = 'py-2.5 px-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2 transition-all text-gray-400 hover:text-white';
            if (secIos) secIos.classList.remove('hidden');
            if (secAndroid) secAndroid.classList.add('hidden');
            if (badge) badge.innerText = 'تطبيق رسمي للآيفون (Apple iOS)';
        }
    };

    window.openPwaModal = function() {
        const modal = document.getElementById('pwa-mobile-modal');
        const card = document.getElementById('pwa-mobile-modal-card');
        selectPlatform(currentSelectedPlatform);

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

    // Safe Android Installation (No scary warnings!)
    window.executeSafeAndroidInstall = function() {
        const stepsBox = document.getElementById('android-steps-box');
        const btnLabel = document.getElementById('android-btn-label');

        // 1. If native browser PWA prompt is ready, trigger it
        if (window.pariqDeferredPrompt) {
            try {
                window.pariqDeferredPrompt.prompt();
                window.pariqDeferredPrompt.userChoice.then(function(choiceResult) {
                    if (choiceResult.outcome === 'accepted') {
                        localStorage.setItem('pariq_pwa_never_show', 'true');
                        dismissPwaModal();
                    }
                    window.pariqDeferredPrompt = null;
                }).catch(function() {});
                return;
            } catch(e) {}
        }

        // 2. If prompt was in cooldown or not ready, show the 2-step safe guide (ZERO scary file warnings!)
        if (stepsBox) {
            stepsBox.classList.remove('hidden');
        }
        if (btnLabel) {
            btnLabel.innerText = 'اتبع الخطوات أعلاه لإتمام التثبيت الآمن 👆';
        }
    };

    // Global hook called from header buttons
    window.executePwaInstall = function() {
        if (isMobile) {
            openPwaModal();
        }
    };

    // Celebration on installed
    window.addEventListener('appinstalled', function() {
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
