<!-- Progressive Web App (PWA) Meta & Icons -->
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#0B0314">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="بريق Pariq">

<!-- Apple iOS PWA Meta -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="بريق Pariq">
<link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icon-152.png') }}">
<link rel="apple-touch-icon" sizes="192x192" href="{{ asset('images/icon-192.png') }}">

<!-- Standard Icons -->
<link rel="icon" type="image/png" sizes="72x72" href="{{ asset('images/icon-72.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/icon-192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/icon-512.png') }}">

<!-- Early PWA Registration & Prompt Capture in HEAD -->
<script>
    window.pariqDeferredPrompt = null;
    window.pariqPromptReadyCallbacks = [];

    window.addEventListener('beforeinstallprompt', function(e) {
        e.preventDefault();
        window.pariqDeferredPrompt = e;
        console.log('📱 [PWA-HEAD] beforeinstallprompt captured!');
        if (window.pariqPromptReadyCallbacks && window.pariqPromptReadyCallbacks.length > 0) {
            while (window.pariqPromptReadyCallbacks.length > 0) {
                const cb = window.pariqPromptReadyCallbacks.shift();
                try { cb(e); } catch(err) {}
            }
        }
    });

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js', { scope: '/' })
            .then(function(reg) {
                console.log('✅ [PWA-HEAD] Service Worker active:', reg.scope);
            })
            .catch(function(err) {
                console.log('ServiceWorker info:', err);
            });
    }
</script>
