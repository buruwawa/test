const staticCacheName = 'Moxa-App';

self.addEventListener("fetch", function (event) {


    event.respondWith(
      caches.open("dynamiccache").then(function (cache) {
        return fetch(event.request).then(function (res) {
          cache.put(event.request, res.clone());
          return res;
        })
      })
    )
  });


// Register Service worker for Add to Home Screen option to work

if ('serviceWorker' in navigator) { navigator.serviceWorker.register('/sw.js') }
