<?php

namespace API\V1\Rest\UserMessage;

use Gila\Entity\UserMessage;
use Gila\Model\UserMessageModel;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\Parameters;

class UserMessageResource extends AbstractResourceListener
{

    private UserMessageModel $userMessageModel;

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
            if (!isset($params['message'])) {
                throw new \RuntimeException('Message not specified');
            }

            $em = $this->getUserMessageModel()->getEntityManager();

            $messages = $em->getRepository(UserMessage::class)->findBy((array)$params);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = [];
        foreach ($messages as $message) {
            $entity = new UserMessageEntity();
            $entity->exchangeArray((new ClassMethodsHydrator())->extract($message));

            $result[] = $entity->getArrayCopy();
        }

        return $result;
    }

    /**
     * Get UserMessageModel
     *
     * @return \Gila\Model\UserMessageModel
     */
    public function getUserMessageModel()
    : UserMessageModel
    {
        return $this->userMessageModel;
    }

    /**
     * Set UserMessageModel
     *
     * @param \Gila\Model\UserMessageModel $userMessageModel
     * @return UserMessageResource
     */
    public function setUserMessageModel(UserMessageModel $userMessageModel)
    : UserMessageResource
    {
        $this->userMessageModel = $userMessageModel;

        return $this;
    }
}
