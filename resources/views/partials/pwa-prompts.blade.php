<!-- Passive Browser Notifications Helper (Zero Modals, Zero Popups) -->
<script>
(function() {
    // Passive service worker registration for offline caching and web push
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .then(function(reg) {
                    console.log('✅ ServiceWorker active:', reg.scope);
                })
                .catch(function(err) {
                    console.log('ServiceWorker note:', err);
                });
        });
    }

    // Global helper for push notifications
    window.enableDesktopNotifications = function() {
        if (!('Notification' in window)) return;
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                new Notification('وكالة بريق للإعلام', {
                    body: '🎉 تم تفعيل إشعارات المنصة بنجاح!',
                    icon: '/images/icon-192.png'
                });
            }
        });
    };
})();
</script>
