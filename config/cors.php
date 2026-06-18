<?php

return [

   /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // Izinkan akses dari port Vue.js (localhost:5173 atau 5174)
    // Atau gunakan ['*'] untuk mengizinkan semua (hanya untuk tahap development)
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Ubah ini menjadi true jika Vue.js nanti butuh fitur Login/Cookie (Sanctum)
    'supports_credentials' => true,

];
