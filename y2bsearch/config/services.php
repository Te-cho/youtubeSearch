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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'ga' => [
        "type" => "service_account",
        "project_id" => "youtubesearch-151013",
        "private_key_id" => "56754a5935fbcac60c8528059c4bfab995fcc852",
        "private_key" => "-----BEGIN PRIVATE KEY-----\n
        MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC2XSai+Ut7X4cV\n
        0Hf9vuGWXy20ZB2AhtuizVnhwJh3KbzaiWB9byrLPTKPCnOXbtFMWkbbWGw4OKlv\n
        o+AXRIn5wR/z6SsHqkNT4sTfHbEZpOcHTUeKLUbhY5ClwXu0TShoeHS7lWUZBz/E\n
        RItGbdSHF3hajqd/QLmLauBVzgceUEogooHBNays6jaAICm2kwiQUGjns3SKYdYO\n
        VYDGJH7Wl7RaBLLneYZdc1t3dwIllXSsuWkWQIHbsWXXVHfBT5z0lByVNzwItech\n
        KXRH+cGmKkApbOGu2EKs/CLwP7Am/DgoGeqXOiRTvBYJO2BCJL+uVWKJdtlr+LVw\n
        NQ+yovD5AgMBAAECggEBAJOiVeUabUEz1OiUHJAQOBDEfPvNERU8GBN0q49XnBbc\n
        c0d4b+UcWkivAn9KtsmhrU9ixnpM20+oj4MR6BjuI8VN09Bis7NA48DFlRwLrZRV\n
        K7N9nK0AeqF9OVz3hm4xCMWKvvYdu/rHI5iA5T/fKm8zUPv/ARrEC3IS1AqjAKBI\n
        gK4J7BlbNwyjLnlvZ/nTxt8vuo+uZgW7nBB+H8wYHCUvb0bAdMddL/RmmOegr+rj\n
        ajliWZd6KSrd9ZhtCq35wmrKA8hshOSqJSYO0W9fK4RXYlX/03XDQQdOcNh8K2mM\n
        pAEg3WZYCrKHSXaiMBO0YRERgdMZIXXafvnVH+hXoAECgYEA6sIizh4D2PrEAJUH\n
        ERYKmUL8PFr4VGs+a/5X2oyJS7JsQB2vIFRJDTNTyj8H+rToxRMfQex5ld6KANmL\n
        1tjBFsPaPyE2FOwkEc6HW5SXQqKF1J2NZDF3qBa3oZdhvgKZXCFGlaq8pE+cmWHs\n
        xaPEcLAu3NhgJYCPgmbKvatI61ECgYEAxt1d6m9HrEkHWoc1p2e7sXMMaCbvrBFj\n
        e5siyCT0jy2v1T+ANZYw0vExuPzdd8oijEHXNHi8a1jVto/9kuG92MYgyA57rzZI\n
        SkgxHVdvVhSc0nfx0YkAnBR+mT8E1iro0NfdEPOkymMl/b6Qz3kkw2LizXeFT3xC\n
        pwy3FsAO8SkCgYEA3HOYSaTICi9adg18iGABbfEIewkWX/ghszoyeAo3N/2CSCdX\n
        +G0N+LZ1fdv4+0Z9u+t8E+UkPEexoqCoAAamNGGRBm2Cot0p9grS834zGSETuhiF\n
        2UvWyOMkaDuHTu6T439gEFY4NbiJH0RlGyfx5bydFUif6Te0DEnJI5nArTECgYAq\n
        Q1F6STwKOVr+uk2Ezl7tT24LlHrLLsbdthKmRnRTGXqM73nn6YtmySuwDM1kb+j3\n
        teZumFoy1iZVLjTNynv2XeUJn0pZ6kdiwgTuH27h9G9/q04RIfSnNxPQrbvxaB0i\n
        hT3OJHmZKYkhbCaKcUyG2bUpxYTnZ5kit2kRxK9oQQKBgAJ17IL37yMl4yy3bl79\n
        oqKqr49ikv/DI7uz92tyip35EBxTsJCspKNvTLR9mVwou2QrKijC1pKcX/OUN7AM\n
        r6nRA9ArdRHjAPp0uxpz/3q4JphiQEEi1EHoBib6JKezG/Xv32P2wiRdWT6b2uM1\n
        4Tp3dqYEJtOxXGUJwGACuLFm\n
        -----END PRIVATE KEY-----\n
        ",
        "client_email" => "ytsearchanalytics@youtubesearch-151013.iam.gserviceaccount.com",
        "client_id" => "104421361846623047390",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://accounts.google.com/o/oauth2/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/ytsearchanalytics%40youtubesearch-151013.iam.gserviceaccount.com",
    ],


];
