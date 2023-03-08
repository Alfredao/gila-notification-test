<?php
declare(strict_types=1);

namespace API\V1\Rest\Message;

use Gila\Entity\Message;
use Gila\Model\MessageModel;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Stdlib\Parameters;

class MessageResource extends AbstractResourceListener
{
    private MessageModel $messageModel;

    /**
     * Create a resource
     *
     * @param mixed $data
     * @throws \Throwable
     */
    public function create($data)
    : array|ApiProblem
    {
        try {
            $message = $this->getMessageModel()->create((array)$data);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = new MessageEntity();
        $result->exchangeArray((new ClassMethodsHydrator())->extract($message));

        return $result->getArrayCopy();
    }

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
            $em = $this->getMessageModel()->getEntityManager();

            $message = $em->getRepository(Message::class)->find($id);
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        if (!$message) {
            return [];
        }

        $result = new MessageEntity();
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
            $em = $this->getMessageModel()->getEntityManager();

            $messages = $em->getRepository(Message::class)->findAll();
        } catch (\Exception $e) {
            return new ApiProblem(405, $e->getMessage());
        }

        $result = [];
        foreach ($messages as $message) {
            $entity = new MessageEntity();
            $entity->exchangeArray((new ClassMethodsHydrator())->extract($message));

            $result[] = $entity->getArrayCopy();
        }

        return $result;
    }

    /**
     * Get MessageModel
     *
     * @return \Gila\Model\MessageModel
     */
    public function getMessageModel()
    : MessageModel
    {
        return $this->messageModel;
    }

    /**
     * Set MessageModel
     *
     * @param \Gila\Model\MessageModel $messageModel
     * @return MessageResource
     */
    public function setMessageModel(MessageModel $messageModel)
    : MessageResource
    {
        $this->messageModel = $messageModel;

        return $this;
    }
}
