<?php
declare(strict_types=1);

namespace API\V1\Rest\UserMessage;

use Gila\Model\UserMessageModel;
use Psr\Container\ContainerInterface;

class UserMessageResourceFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $services)
    : UserMessageResource
    {
        $resource = new UserMessageResource();
        $resource->setUserMessageModel($services->get(UserMessageModel::class));

        return $resource;
    }
}
