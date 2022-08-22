<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '508433067730596', 
        'client_secret' => '32d6dc4d7a38e20848ca243923bf53ba', 
        'redirect' => 'http://localhost/shopZay/callback' 
    ],

    'google' => [
        'client_id' => '822453206136-g514hsocegdmnccc8ocog1d7adp1a6c8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shopZay/google/callback' 
    ],
    'captcha' => [
        'captcha_key' => env('CAPTCHA_KEY'),
    ],

];
