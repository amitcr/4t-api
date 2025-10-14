<?php

return [
    'driver' => getenv('MAIL_DRIVER') ?: 'smtp',

    'smtp' => [
        'host' => getenv('MAIL_HOST') ?: 'localhost',
        'port' => getenv('MAIL_PORT') ?: 587,
        'username' => getenv('MAIL_USERNAME') ?: null,
        'password' => getenv('MAIL_PASSWORD') ?: null,
        'encryption' => getenv('MAIL_ENCRYPTION') ?: 'tls',
        'from' => [
            'address' => getenv('MAIL_FROM_ADDRESS') ?: 'support@fourtemperaments.com',
            'name' => getenv('MAIL_FROM_NAME') ?: 'Four Temperaments',
        ],
    ],

    'ses' => [
        'key' => getenv('AWS_ACCESS_KEY_ID') ?: null,
        'secret' => getenv('AWS_SECRET_ACCESS_KEY') ?: null,
        'region' => getenv('AWS_REGION') ?: 'us-east-1',
        'from' => [
            'address' => getenv('MAIL_FROM_ADDRESS') ?:'support@fourtemperaments.com',
            'name' => getenv('MAIL_FROM_NAME') ?:'Four Temperaments',
        ],
    ],
];
