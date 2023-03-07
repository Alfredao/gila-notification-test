<?php
declare(strict_types=1);

namespace API\V1\Rest\Category;

use Gila\Entity\Category;
use Gila\Model\CategoryModel;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\Parameters;

class CategoryResource extends AbstractResourceListener
{

    private CategoryModel $categoryModel;

    /**
     * Fetch a resource
     *
     * @param mixed $id
     * @return ApiProblem|array
     */
    public function fetch($id)
    : array|ApiProblem
    {
        try {
            $em = $this->getCategoryModel()->getEntityManager();

            $message = $em->getRepository(Category::class)->find($id);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        if (!$message) {
            return [];
        }

        $result = new CategoryEntity();
        $result->exchangeArray((new ClassMethodsHydrator())->extract($message));

        return $result->getArrayCopy();
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param array|Parameters $params
     * @return ApiProblem|array
     */
    public function fetchAll($params = [])
    : array|ApiProblem
    {
        try {
            $em = $this->getCategoryModel()->getEntityManager();

            $messages = $em->getRepository(Category::class)->findAll();
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = [];
        foreach ($messages as $message) {
            $entity = new CategoryEntity();
            $entity->exchangeArray((new ClassMethodsHydrator())->extract($message));

            $result[] = $entity->getArrayCopy();
        }

        return $result;
    }

    /**
     * Get CategoryModel
     *
     * @return \Gila\Model\CategoryModel
     */
    public function getCategoryModel()
    : CategoryModel
    {
        return $this->categoryModel;
    }

    /**
     * Set CategoryModel
     *
     * @param \Gila\Model\CategoryModel $categoryModel
     * @return CategoryResource
     */
    public function setCategoryModel(CategoryModel $categoryModel)
    : CategoryResource
    {
        $this->categoryModel = $categoryModel;

        return $this;
    }
}
