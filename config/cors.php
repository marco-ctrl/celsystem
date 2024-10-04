<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'storage/images/*'], // Agrega aquí las rutas que deben permitir CORS

    'allowed_methods' => ['*'],  // Permite todos los métodos HTTP

    'allowed_origins' => ['http://localhost:4200'],  // Permite tu dominio frontend

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],  // Permite todos los headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
