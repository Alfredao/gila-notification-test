<?php
declare(strict_types=1);

namespace API\V1\Rest\Channel;

use Gila\Entity\Channel;
use Gila\Model\ChannelModel;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\Parameters;

class ChannelResource extends AbstractResourceListener
{

    private ChannelModel $channelModel;

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
            $em = $this->getChannelModel()->getEntityManager();

            $message = $em->getRepository(Channel::class)->find($id);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        if (!$message) {
            return [];
        }

        $result = new ChannelEntity();
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
            $em = $this->getChannelModel()->getEntityManager();

            $messages = $em->getRepository(Channel::class)->findAll();
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = [];
        foreach ($messages as $message) {
            $entity = new ChannelEntity();
            $entity->exchangeArray((new ClassMethodsHydrator())->extract($message));

            $result[] = $entity->getArrayCopy();
        }

        return $result;
    }

    /**
     * Get ChannelModel
     *
     * @return \Gila\Model\ChannelModel
     */
    public function getChannelModel()
    : ChannelModel
    {
        return $this->channelModel;
    }

    /**
     * Set ChannelModel
     *
     * @param \Gila\Model\ChannelModel $channelModel
     * @return ChannelResource
     */
    public function setChannelModel(ChannelModel $channelModel)
    : ChannelResource
    {
        $this->channelModel = $channelModel;

        return $this;
    }
}
