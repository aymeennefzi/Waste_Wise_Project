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
        'scheme' => 'https',
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
        'client_id' => '928957429256685',
        'client_secret' => '8f534f76f3794397f2b69e3823558947',
        'redirect' => 'http://localhost:5000/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '338498366846-km11l8kaj7ida1a5hiik43b1t9lpv1tv.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:5000/auth/google/callback',
    ],


];
