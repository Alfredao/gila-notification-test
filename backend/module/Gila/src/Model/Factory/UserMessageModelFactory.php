<?php
declare(strict_types=1);

namespace Gila\Model\Factory;

use Doctrine\ORM\EntityManager;
use Gila\Model\UserMessageModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserMessageModelFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Model\UserMessageModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : UserMessageModel
    {
        $model = new UserMessageModel();
        $model->setEntityManager($container->get(EntityManager::class));

        return $model;
    }
}
