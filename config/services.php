<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'twitter' => [
        'client_id'     => env('MWjWkeRuN2vDcDb4UwWHSYcuw'),
        'client_secret' => env('MVwaH6KDl546LYorDO09NHTDDnUumP3qdZDgETZUxiNQrqG03m'),
        'redirect'      => env('callbackurl'),
    ],
    'facebook' => [
        'client_id'     => '1446736222291786',
        'client_secret' => 'd833a679851e15e5cd2e7186bb175c51',
        'redirect'      => 'http://interact.com/callback',
    ],


];
