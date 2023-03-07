<?php
declare(strict_types=1);

namespace Gila;

use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements BootstrapListenerInterface, ConfigProviderInterface
{

    public function onBootstrap(EventInterface $e)
    : void
    {

    }

    public function getConfig()
    : array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';

        return $config;
    }
}
