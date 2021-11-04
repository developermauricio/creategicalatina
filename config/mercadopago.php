<?php

return [

    /**
     * Si es verdadero entonces no se validan las credenciales
     * en mercadopago
     */
    'local_debug'        => false,

    /**
     * Especifica el modo en el que se estara usando
     * el mercado pago, : sandbox, production
     */
    'mode'              => 'sandbox',

    /**
     * Credenciales para el caso en que la aplicacion este en modo
     * produccion (especificado en la clave mode)
     */
    'production'        => [

        'access_token'  => env('MP_ACCESS_TOKEN', 'APP_USR-2916179751806361-091300-76c41957f3e43375cc7b3311a45b6b30-719262693'),


        'public_key'    => env('MP_PUBLIC_KEY', 'APP_USR-5571b9a7-b434-471d-82a5-84f5ac75a06a'),


    ],

    /**
     * Credenciales para el modo sandbox
     * especificado el uso en la clave "mode"
     */
    'sandbox'           => [
        'access_token'  => env('MP_SANDBOX_ACCESS_TOKEN', 'TEST-2916179751806361-091300-0b72d1bc3af5c671594d2c9c591a7bbc-719262693'),

        'public_key'    => env('MP_SANDBOX_PUBLIC_KEY', 'TEST-f475af46-09c8-4c49-bf0e-9d89f4ac60ea')
    ],


    /**
     * Tipo de identificacion usada para los pagos
     */
    'identification_type'   => 'DNI',


    /**
     * Codigo de area telefonico
     */
    'area_code'             => '+57',

    /**
     * Especifica las URL de retorno para el smartcheckout
     */
    'back_urls'             => [

        'success'   => 'https://creategicalatina.test/es/purchase-orders',

        'failure'   => 'https://creategicalatina.test/es/purchase-orders',

        'pending'   => 'https://creategicalatina.test/es/purchase-orders',

    ],

    // Indica en que caso de respuesta del pago se ejecutara una autorecarga
    // Por defecto: approved (el usuario pagador volvera automaticamente en caso de que el pago haya sido completado y aprobado)
    'auto_return'   => 'approved',


];
