<?php
declare(strict_types=1);

namespace Gila\Model\Factory;

use Doctrine\ORM\EntityManager;
use Gila\Model\SubscriptionModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SubscriptionModelFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Model\SubscriptionModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : SubscriptionModel
    {
        $model = new SubscriptionModel();
        $model->setEntityManager($container->get(EntityManager::class));

        return $model;
    }
}
