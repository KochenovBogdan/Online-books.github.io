const CACHE_NAME = 'v1'; 
const urlsToCache = [ 
  '/', 
  '/index.html', 
  '/books.html', 
  '/about.html', 
  '/contact.html', 
  '/styles.css', 
  '/images/logo.png', 
  '/images/icon-192x192.png', 
  '/images/icon-512x512.png', 
]; 
 
self.addEventListener('install', (event) => { 
  event.waitUntil( 
    caches.open(CACHE_NAME) 
      .then((cache) => { 
        return cache.addAll(urlsToCache); 
      }) 
      .catch((error) => { 
        console.error('Failed to open cache: ', error); 
      }) 
  ); 
}); 
 
self.addEventListener('fetch', (event) => { 
  event.respondWith( 
    caches.match(event.request) 
      .then((response) => { 
        // Если ресурс найден в кэше, возвращаем его 
        if (response) { 
          return response; 
        } 
        // В противном случае, загружаем ресурс из сети и добавляем его в кэш 
        return fetch(event.request).then((networkResponse) => { 
          if (!networkResponse || !networkResponse.ok) { 
            return networkResponse; 
          } 
          return caches.open(CACHE_NAME).then((cache) => { 
            cache.put(event.request, networkResponse.clone()); 
            return networkResponse; 
          }); 
        }); 
      }) 
      .catch((error) => { 
        console.error('Failed to fetch: ', error); 
      }) 
  ); 
});
