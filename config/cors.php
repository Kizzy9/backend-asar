<?php

return [

   /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // Izinkan akses dari mana saja (Vercel atau localhost)
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Ubah ini menjadi true hanya jika Vue.js/Next.js butuh fitur Cookie (Sanctum stateful)
    // Karena kita pakai Bearer Token di Header, set ke false agar aman dengan allowed_origins *
    'supports_credentials' => false,

];
