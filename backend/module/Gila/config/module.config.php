<?php
declare(strict_types=1);

namespace Gila;

use Doctrine\ORM\Mapping\Driver\AttributeDriver;

return [
    'service_manager' => [
        'factories' => [
            Messenger\Messenger::class              => Messenger\Factory\MessengerFactory::class,
            Model\CategoryModel::class              => Model\Factory\CategoryModelFactory::class,
            Model\ChannelModel::class               => Model\Factory\ChannelModelFactory::class,
            Model\MessageModel::class               => Model\Factory\MessageModelFactory::class,
            Model\UserMessageModel::class           => Model\Factory\UserMessageModelFactory::class,
            Model\UserModel::class                  => Model\Factory\UserModelFactory::class,
            Model\SubscriptionModel::class          => Model\Factory\SubscriptionModelFactory::class,
            Command\Message\BroadcastCommand::class => Command\Message\Factory\BroadcastCommandFactory::class,
        ],
    ],
    'laminas-cli'     => [
        'commands' => [
            'message:broadcast' => Command\Message\BroadcastCommand::class,
        ],
    ],
    'doctrine'        => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AttributeDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity',
                ],
            ],
            'orm_default'             => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],
];
