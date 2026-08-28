<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    */

    'company_name' => env('FILAMENT_LOGIN_COMPANY_NAME', 'JKIT Accounting'),

    'logo' => env('FILAMENT_LOGIN_LOGO', 'images/logo1_upscaled.png'),

    'background_image' => env('FILAMENT_LOGIN_BACKGROUND', 'images/image1_upscaled.jpeg'),

    /*
    |--------------------------------------------------------------------------
    | Top Contact Bar
    |--------------------------------------------------------------------------
    */

    'contact_email' => env('FILAMENT_LOGIN_CONTACT_EMAIL', 'support@jkit.com'),

    'contact_phone' => env('FILAMENT_LOGIN_CONTACT_PHONE', '(+63) 918 305 2342'),

    /*
    |--------------------------------------------------------------------------
    | Social Links (leave blank to hide)
    |--------------------------------------------------------------------------
    */

    'social' => [
        'facebook' => env('FILAMENT_LOGIN_SOCIAL_FACEBOOK', '#'),
        'linkedin' => env('FILAMENT_LOGIN_SOCIAL_LINKEDIN', '#'),
        'youtube' => env('FILAMENT_LOGIN_SOCIAL_YOUTUBE', '#'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation Links
    |--------------------------------------------------------------------------
    */

    'nav_links' => [
        ['label' => 'Home', 'url' => '#'],
        ['label' => 'About Us', 'url' => '#'],
        ['label' => 'Services', 'url' => '#'],
        ['label' => 'Login', 'url' => '/admin/login', 'active' => true],
    ],

];