<?php
declare(strict_types=1);

namespace API\V1\Rest\Channel;

use Gila\Model\ChannelModel;
use Psr\Container\ContainerInterface;

class ChannelResourceFactory
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $services)
    : ChannelResource
    {
        $resource = new ChannelResource();
        $resource->setChannelModel($services->get(ChannelModel::class));

        return $resource;
    }
}
