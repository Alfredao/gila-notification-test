<?php
declare(strict_types=1);

namespace Gila\Model\Factory;

use Doctrine\ORM\EntityManager;
use Gila\Model\CategoryModel;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CategoryModelFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Model\CategoryModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : CategoryModel
    {
        $model = new CategoryModel();
        $model->setEntityManager($container->get(EntityManager::class));

        return $model;
    }
}
