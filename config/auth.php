<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        // گارد پیش‌فرض لاراول
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // گارد بیمار
        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',
        ],

        // گارد پزشک
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        // مدل اصلی لاراول
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // مدل بیماران
        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Patient::class,
        ],

        // مدل پزشکان
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Doctor::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'patients' => [
            'provider' => 'patients',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'doctors' => [
            'provider' => 'doctors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
