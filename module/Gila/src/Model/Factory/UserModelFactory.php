<?php
declare(strict_types=1);

namespace Gila\Model\Factory;

use Doctrine\ORM\EntityManager;
use Gila\Model\UserModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserModelFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Model\UserModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : UserModel
    {
        $model = new UserModel();
        $model->setEntityManager($container->get(EntityManager::class));

        return $model;
    }
}
