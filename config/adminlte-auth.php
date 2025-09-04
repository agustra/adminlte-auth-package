<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    
    'enable_registration' => true,
    'enable_password_reset' => true,
    'enable_email_verification' => false,
    'enable_remember_me' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    */
    
    'routes' => [
        'login' => '/login',
        'register' => '/register',
        'logout' => '/logout',
        'password_reset' => '/forgot-password',
        'profile' => '/profile',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Redirects Configuration
    |--------------------------------------------------------------------------
    */
    
    'redirects' => [
        'after_login' => '/dashboard',
        'after_logout' => '/login',
        'after_register' => '/dashboard',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | User Model Configuration
    |--------------------------------------------------------------------------
    */
    
    'user_model' => \AgusUsk\AdminLteAuth\Models\User::class,
    
    /*
    |--------------------------------------------------------------------------
    | Middleware Configuration
    |--------------------------------------------------------------------------
    */
    
    'middleware' => [
        'auth' => 'adminlte.auth',
        'guest' => 'adminlte.guest',
    ],
];