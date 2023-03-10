<?php
declare(strict_types=1);

namespace Gila\Command\Message\Factory;

use Gila\Command\Message\BroadcastCommand;
use Gila\Model\SubscriptionModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BroadcastCommandFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Command\Message\BroadcastCommand
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : BroadcastCommand
    {
        $command = new BroadcastCommand();
        $command->setSubscriptionModel($container->get(SubscriptionModel::class));

        return $command;
    }
}
