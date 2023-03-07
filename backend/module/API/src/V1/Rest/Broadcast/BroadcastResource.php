<?php
declare(strict_types=1);

namespace API\V1\Rest\Broadcast;

use Gila\Entity\Broadcast;
use Gila\Model\BroadcastModel;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\Parameters;

class BroadcastResource extends AbstractResourceListener
{

    private BroadcastModel $broadcastModel;

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
            $em = $this->getBroadcastModel()->getEntityManager();

            $message = $em->getRepository(Broadcast::class)->find($id);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        if (!$message) {
            return [];
        }

        $result = new BroadcastEntity();
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
            $em = $this->getBroadcastModel()->getEntityManager();

            $messages = $em->getRepository(Broadcast::class)->findAll();
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = [];
        foreach ($messages as $message) {
            $entity = new BroadcastEntity();
            $entity->exchangeArray((new ClassMethodsHydrator())->extract($message));

            $result[] = $entity->getArrayCopy();
        }

        return $result;
    }

    /**
     * Get BroadcastModel
     *
     * @return \Gila\Model\BroadcastModel
     */
    public function getBroadcastModel()
    : BroadcastModel
    {
        return $this->broadcastModel;
    }

    /**
     * Set BroadcastModel
     *
     * @param \Gila\Model\BroadcastModel $broadcastModel
     * @return BroadcastResource
     */
    public function setBroadcastModel(BroadcastModel $broadcastModel)
    : BroadcastResource
    {
        $this->broadcastModel = $broadcastModel;

        return $this;
    }
}
