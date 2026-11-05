// Pariq Agency Progressive Web App (PWA) Service Worker v3
const CACHE_NAME = 'pariq-pwa-v4';
const STATIC_ASSETS = [
    '/',
    '/?source=pwa',
    '/manifest.json',
    '/images/icon-192.png',
    '/images/icon-512.png'
];

// 1. Install & Cache Core Shell Assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS).catch((err) => {
                console.log('PWA Shell cache partial warning:', err);
            });
        })
    );
    self.skipWaiting();
});

// 2. Activate & Clean Outdated Caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// 3. Fetch Strategy: Network First with Cache Fallback
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;

    const url = new URL(event.request.url);

    // Bypass API calls, auth routes, and dynamic admin endpoints
    if (url.pathname.startsWith('/api/') || 
        url.pathname.startsWith('/logout') || 
        url.pathname.startsWith('/admin') ||
        url.pathname.endsWith('fix.php')) {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then((response) => {
                if (response && response.status === 200 && response.type === 'basic') {
                    const responseClone = response.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                }
                return response;
            })
            .catch(() => {
                return caches.match(event.request).then((cached) => {
                    if (cached) return cached;
                    if (event.request.mode === 'navigate') {
                        return caches.match('/');
                    }
                });
            })
    );
});

// 4. Handle Incoming Push Notifications
self.addEventListener('push', (event) => {
    let data = {
        title: 'وكالة بريق للتسويق',
        body: 'لديك إشعار جديد في منصة بريق',
        icon: '/images/icon-192.png',
        badge: '/images/icon-72.png',
        url: '/dashboard'
    };

    if (event.data) {
        try {
            const parsed = event.data.json();
            data = Object.assign(data, parsed);
        } catch (e) {
            data.body = event.data.text();
        }
    }

    const options = {
        body: data.body,
        icon: data.icon || '/images/icon-192.png',
        badge: data.badge || '/images/icon-72.png',
        vibrate: [200, 100, 200],
        data: {
            url: data.url || '/dashboard'
        },
        dir: 'rtl',
        lang: 'ar',
        actions: [
            { action: 'open', title: 'عرض التفاصيل' },
            { action: 'close', title: 'إغلاق' }
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

// 5. Notification Click Action
self.addEventListener('notificationclick', (event) => {
    event.notification.close();

    const targetUrl = (event.notification.data && event.notification.data.url) 
        ? event.notification.data.url 
        : '/dashboard';

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then((windowClients) => {
            for (let i = 0; i < windowClients.length; i++) {
                const client = windowClients[i];
                if (client.url.includes(self.location.origin) && 'focus' in client) {
                    client.navigate(targetUrl);
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});
