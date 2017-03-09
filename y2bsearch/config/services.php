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
        "private_key_id" => "90b8ace0b2fe774b96b43609b99871593546f6e8",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCmHo6jF7OMPBz9\nTbkRe4I9LnN9M+uEXTV27K6DO6kVfQUzXC3DYSl8wj+f1nsJg7xr3kZdFPO5LWdP\nY+QHTm3/2YYEEDU6XY9ZpdGBa46T54QXyz3KMAXbqrVqKFs52CwieBVbOAKB4AH7\nMl/zj+KXaL8hXDHIb1N4glME/2xRpn/DNpDPBfs+oK5+lAl1ZN20pfpowTDeP+aQ\nOk9fBZNrik2g46VI8I81CePxfDSAU7FGPk7tXFyAl+P+/5ebeg+iJ+0TDotVwEBf\nLLdVLK5veMAlk8I3InpWz2DtuyH2TdlrG5T1t2voXNgS2yfqOWXVha7HZ6o2n+tq\nSf4sn97TAgMBAAECggEBAJN3/wHzsXWli8qma8uETEsJ6IZWSBa6NBM963IezWyB\nDtPYWdvfblgNjTPU0GbS5rsPmIFbbz2Ne+/zamO+EVKWhS0oQkhs9CwOUx1EIU9V\nsGL7DwBlf13Rfrkd2FZSfGOhHLxczYUEGl4oCxwKOIpW942i7aLUiVIqx45hPYSB\nDso86r+1sDM8MFHDuqpXCmthinrrCnqjT87Bw6KaOIKlOV9sN+8qf8VLPHKe06i+\nDmKJMjmJy7epBWs7g4BrrqbWbZ/iE5oJf9Uto4LCX6mG6kagCtSFolCVTi9P8Lr4\n03MYq4nZME/qGavyU2WIcZC990QI2vnOuKrxhorZADECgYEA2HtujFhouuCb4p+h\nceIp9BDjrAlVIcnjdD6CdVPDw60X1Sj7I2yL7LhTw1499XVvVSd16OHQ0pad4PSm\n50XxBsfY7/OaFnf3/kA5Q0DOFbra1sf3q98e8HCQmcVj78bBJ2IzceoK5p/rHWPk\nKR1AxFkibrgZbfF9NhIys0WYHJsCgYEAxHGWytS7n0IZAQ1UfrRuV+lcm+lJi9lX\njBLHhyjyKamyaPWNwFVcoqoAt2XC5xRslMHWxVC2QT8xObQBeS2AWAYFGS1g5TrM\nRHe24+jDj9ttt4fnNcomHuPAgY1i9SaY3DTvTnOQa5AzfFLMR+ttALgI3qyc2X7d\nAcS7POz9fikCgYEAgujJZgdEddXDjpy3lVWNxzC7bNpL593dNPtkCq030cmHgviA\nPeCzENg6lwcTcq6sP5NYQxbjH6XDHTj1ASATa+VIM3pdML8lcVPHDPtQZGWVVpKg\nHAgV/pIjb0mlcGcBgN5qe7VrGCGWnTQ90fsFonbAUrHzdr+01xDUJgKsxIcCgYAE\nZbKFaculXfpnTqAUkf9iUmPzTX6K9duC1CzJNr5s9lJ7DPwWURLYxUtsz4dUWt2v\nWsNu+UaLIVn9u6zIxJ752XClxqFDoFRQOAnNAjnWb4f+MrmXN6YwzNJTVBHiAPIt\nA7ZToDycW8b7QnM2LOvstzHjoiOErtVNo9S5IWjvOQKBgF9GZs7CJZENb8sqhmcH\nIat4mhQEnSMqJfMJsfnOQ5FykmZBgQhuy2X/bTdWT4tYdZG/Wk9vBHrZMS6LRgaY\nQxyAdzsXcP6IIiJnYEMLjFFekFbVMwRgwYR+pBpvZmYNmxEoXVIYXh/yo6LLIU6R\ntW0vQGZGbQYBzUZU5XyTwm+X\n-----END PRIVATE KEY-----\n",
        "client_email" => "searchyoutubesanalytics@youtubesearch-151013.iam.gserviceaccount.com",
        "client_id" => "105473191996490009005",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://accounts.google.com/o/oauth2/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/searchyoutubesanalytics%40youtubesearch-151013.iam.gserviceaccount.com",
    ],


];
