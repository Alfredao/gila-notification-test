<?php
declare(strict_types=1);

namespace API\V1\Rest\Category;

use Gila\Model\CategoryModel;
use Psr\Container\ContainerInterface;

class CategoryResourceFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $services)
    : CategoryResource
    {
        $resource = new CategoryResource();
        $resource->setCategoryModel($services->get(CategoryModel::class));

        return $resource;
    }
}
