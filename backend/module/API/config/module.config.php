<?php
return [
    'service_manager' => [
        'factories' => [
            \API\V1\Rest\Message\MessageResource::class => \API\V1\Rest\Message\MessageResourceFactory::class,
            \API\V1\Rest\Category\CategoryResource::class => \API\V1\Rest\Category\CategoryResourceFactory::class,
            \API\V1\Rest\Channel\ChannelResource::class => \API\V1\Rest\Channel\ChannelResourceFactory::class,
            \API\V1\Rest\UserMessage\UserMessageResource::class => \API\V1\Rest\UserMessage\UserMessageResourceFactory::class,
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
            'api.rest.category' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/category[/:category_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Category\\Controller',
                    ],
                ],
            ],
            'api.rest.channel' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/channel[/:channel_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\Channel\\Controller',
                    ],
                ],
            ],
            'api.rest.user-message' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/user-message[/:user_message_id]',
                    'defaults' => [
                        'controller' => 'API\\V1\\Rest\\UserMessage\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'api.rest.message',
            2 => 'api.rest.category',
            3 => 'api.rest.channel',
            4 => 'api.rest.user-message',
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
            ],
            'collection_http_methods' => [
                0 => 'POST',
                1 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Rest\Message\MessageEntity::class,
            'collection_class' => \API\V1\Rest\Message\MessageCollection::class,
            'service_name' => 'Message',
        ],
        'API\\V1\\Rest\\Category\\Controller' => [
            'listener' => \API\V1\Rest\Category\CategoryResource::class,
            'route_name' => 'api.rest.category',
            'route_identifier_name' => 'category_id',
            'collection_name' => 'category',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Rest\Category\CategoryEntity::class,
            'collection_class' => \API\V1\Rest\Category\CategoryCollection::class,
            'service_name' => 'Category',
        ],
        'API\\V1\\Rest\\Channel\\Controller' => [
            'listener' => \API\V1\Rest\Channel\ChannelResource::class,
            'route_name' => 'api.rest.channel',
            'route_identifier_name' => 'channel_id',
            'collection_name' => 'channel',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Rest\Channel\ChannelEntity::class,
            'collection_class' => \API\V1\Rest\Channel\ChannelCollection::class,
            'service_name' => 'Channel',
        ],
        'API\\V1\\Rest\\UserMessage\\Controller' => [
            'listener' => \API\V1\Rest\UserMessage\UserMessageResource::class,
            'route_name' => 'api.rest.user-message',
            'route_identifier_name' => 'user_message_id',
            'collection_name' => 'user_message',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'message',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \API\V1\Rest\UserMessage\UserMessageEntity::class,
            'collection_class' => \API\V1\Rest\UserMessage\UserMessageCollection::class,
            'service_name' => 'UserMessage',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'API\\V1\\Rest\\Message\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Category\\Controller' => 'HalJson',
            'API\\V1\\Rest\\Channel\\Controller' => 'HalJson',
            'API\\V1\\Rest\\UserMessage\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'API\\V1\\Rest\\Message\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Category\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\Channel\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'API\\V1\\Rest\\UserMessage\\Controller' => [
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
            'API\\V1\\Rest\\Category\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\Channel\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'API\\V1\\Rest\\UserMessage\\Controller' => [
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
            \API\V1\Rest\Category\CategoryEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.category',
                'route_identifier_name' => 'category_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \API\V1\Rest\Category\CategoryCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.category',
                'route_identifier_name' => 'category_id',
                'is_collection' => true,
            ],
            \API\V1\Rest\Channel\ChannelEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.channel',
                'route_identifier_name' => 'channel_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \API\V1\Rest\Channel\ChannelCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.channel',
                'route_identifier_name' => 'channel_id',
                'is_collection' => true,
            ],
            \API\V1\Rest\UserMessage\UserMessageEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.user-message',
                'route_identifier_name' => 'user_message_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \API\V1\Rest\UserMessage\UserMessageCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.user-message',
                'route_identifier_name' => 'user_message_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'API\\V1\\Rest\\Message\\Controller' => [
            'input_filter' => 'API\\V1\\Rest\\Message\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'API\\V1\\Rest\\Message\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => '3',
                            'max' => '255',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'text',
                'description' => 'Text message to broadcast',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \DoctrineModule\Validator\ObjectExists::class,
                        'options' => [
                            'target_class' => \Gila\Entity\Category::class,
                            'fields' => 'id',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'category',
                'description' => 'Broadcast to deliver message',
                'field_type' => 'int',
            ],
        ],
    ],
];
