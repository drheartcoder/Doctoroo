<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        /*'STRIPE_KEY'    => 'pk_test_LlFheH2GtxpNIKrE5DyNSl5c',
        'STRIPE_SECRET' => 'sk_test_IuzVB3tfAEqNRe6gpg8iU6aJ',
        'CLIENT_ID'     => 'ca_AZrRJH8AmgEzIon18r3ve8H5gmqIQ0QZ',*/
        'STRIPE_KEY'    => 'pk_test_jDOCAOclbIq2n9FYRpUY51UK',
        'STRIPE_SECRET' => 'sk_test_yorBbUmxrxR7ay5a3LoSXJ3b',
        'CLIENT_ID'     => 'ca_AvKPRFej5xooGJd43KtC5lr7eOCnNUSD',
        'TOKEN_URI'     => 'https://connect.stripe.com/oauth/token',
        'AUTHORIZE_URI' => 'https://connect.stripe.com/oauth/authorize',
        'currencyType'  => 'AUD'
    ],

    'twilio' => [
        /*'accountSid' => 'ACf49f6196864adc895b1cc765c8f6f7dd',
        'apiKey'     => 'SK6a66b8f651ed18428b1aadddeb6b61f3',
        'apiSecret'  => 'QBy7E4iJDfhXqITZ8X4KLvUSS22rmPnm',
        'auth_token' => '4641eb5754829bf6c90e24b378ae4538',
        'service_id' => 'ISb3f0bdde0f644b15b4749b1fc944959d',*/

        'accountSid' => 'AC48e3daf98868c5cf0e5829a250bf78dd',
        'auth_token' => '5795a2f7c4f2be1dec8e7d2bda7bb194',
        'apiKey'     => 'SKf09b24cb365ceb18abd53ba521a473f1',
        'apiSecret'  => 'mQSYcQLquAQv8okBEkGjsZ0kwkDJx9Fp',
        'service_id' => 'ISe3266f306e2a4840b7ccb8e523b814d3',
    ],

    'EWAY'=>[
        'API_KEY'       =>'C3AB9CaQ+yoeX4z/2UcSr87iib4LMl+qM3KkTJhZpeAYC7Z1mFkNr8ebqVPNxCuH+tv+S+',
        'API_PASSWORD'  =>'n385yFLV',
        'ENDPOINT'      =>'MODE_SANDBOX'
    ]


];
