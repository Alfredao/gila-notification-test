<?php
declare(strict_types=1);

namespace Gila\Messenger\Factory;

use Gila\Messenger\Messenger;
use interop\container\containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MessengerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param \interop\container\containerinterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return \Gila\Messenger\Messenger
     */
    public function __invoke(containerinterface $container, $requestedName, ?array $options = null)
    : Messenger
    {
        return new Messenger();
    }
}
