<?php
declare(strict_types=1);

namespace Gila;

use Doctrine\ORM\Mapping\Driver\AttributeDriver;

return [
    'service_manager' => [
        'aliases'   => [

        ],
        'factories' => [
            Model\PaymentModel::class => Model\Factory\PaymentModelFactory::class,
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
