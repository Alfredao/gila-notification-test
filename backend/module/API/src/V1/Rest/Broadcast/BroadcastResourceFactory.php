<?php
declare(strict_types=1);

namespace API\V1\Rest\Broadcast;

use Gila\Model\BroadcastModel;
use Psr\Container\ContainerInterface;

class BroadcastResourceFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $services)
    : BroadcastResource
    {
        $resource = new BroadcastResource();
        $resource->setBroadcastModel($services->get(BroadcastModel::class));

        return $resource;
    }
}
