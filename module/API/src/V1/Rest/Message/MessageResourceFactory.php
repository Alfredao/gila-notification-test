<?php
declare(strict_types=1);

namespace API\V1\Rest\Message;

use Psr\Container\ContainerInterface;

class MessageResourceFactory
{
    public function __invoke(ContainerInterface $services)
    : MessageResource
    {
        $resource = new MessageResource();

        return $resource;
    }
}
