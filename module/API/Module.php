<?php
declare(strict_types=1);

namespace API;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\ApiTools\Autoloader;

class Module implements ApiToolsProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    : array
    {
        return [
            Autoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
