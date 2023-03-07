<?php
return [
    'service_manager' => [
        'factories' => [
            \API\V1\Rest\Message\MessageResource::class => \API\V1\Rest\Message\MessageResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'api.rest.message' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/message[/:message_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Message\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'api.rest.message',
        ],
    ],
    'api-tools-rest' => [
        'API\\V1\\Rest\\Message\\Controller' => [
            'listener' => \API\V1\Rest\Message\MessageResource::class,
            'route_name' => 'api.rest.message',
            'route_identifier_name' => 'message_id',
            'collection_name' => 'message',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Rest\Message\MessageEntity::class,
            'collection_class' => \API\V1\Rest\Message\MessageCollection::class,
            'service_name' => 'Message',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'API\\V1\\Rest\\Message\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'API\\V1\\Rest\\Message\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'API\\V1\\Rest\\Message\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \API\V1\Rest\Message\MessageEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.message',
                'route_identifier_name' => 'message_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \API\V1\Rest\Message\MessageCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.message',
                'route_identifier_name' => 'message_id',
                'is_collection' => true,
            ],
        ],
    ],
];
