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
	'google' => [
        'client_id' => '548697632443-e8k8jltgggkl7vqj97iudua56jftqdaf.apps.googleusercontent.com', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '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', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        //'redirect' => 'http://localhost:8000/auth/google/callback'
        'redirect' => 'https://204.236.175.219/auth/google/callback'
    ],
	'linkedin' => [
        'client_id' => '867sx3is9mutqi',
        'client_secret' => '3TqgkGUP2CCJAmwU',
        //'redirect' => 'http://localhost:8000/auth/linkedin/callback'
        'redirect' => 'https://204.236.175.219/auth/linkedin/callback'
	],

];
