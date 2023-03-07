<?php
declare(strict_types=1);

namespace API\V1\Rest\Message;

use Gila\Model\MessageModel;
use Psr\Container\ContainerInterface;

class MessageResourceFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $services)
    : MessageResource
    {
        $resource = new MessageResource();
        $resource->setMessageModel($services->get(MessageModel::class));

        return $resource;
    }
}
