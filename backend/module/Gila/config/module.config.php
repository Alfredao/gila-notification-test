<?php
declare(strict_types=1);

namespace Gila;

use Doctrine\ORM\Mapping\Driver\AttributeDriver;

return [
    'service_manager' => [
        'factories' => [
            Model\ChannelModel::class  => Model\Factory\CategoryModelFactory::class,
            Model\CategoryModel::class => Model\Factory\ChannelModelFactory::class,
            Model\MessageModel::class  => Model\Factory\MessageModelFactory::class,
            Model\UserModel::class     => Model\Factory\UserModelFactory::class,
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