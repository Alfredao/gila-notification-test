<?php
return [
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db'                            => [
        'adapters' => [],
    ],
    'api-tools-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'Admin\\V1'   => 'oauth2_doctrine',
                'Payment\\V1' => 'oauth2_doctrine',
            ],
        ],
    ],
];
