<?php
declare(strict_types=1);

namespace Gila\Messenger;

use Gila\Entity\Message;

class Messenger
{
    private AdapterInterface $adapter;

    /**
     * @throws \Exception
     */
    public function broadcast(Message $message)
    : void
    {
        if (isset($this->adapter)) {
            throw new \RuntimeException('Before broadcasting a message, you should first set an adapter for delivering the message');
        }

        $this->getAdapter()->send($message);
    }

    /**
     * Get Adapter
     *
     * @return \Gila\Messenger\AdapterInterface
     */
    public function getAdapter()
    : AdapterInterface
    {
        return $this->adapter;
    }

    /**
     * Set Adapter
     *
     * @param \Gila\Messenger\AdapterInterface $adapter
     * @return Messenger
     */
    public function setAdapter(AdapterInterface $adapter)
    : Messenger
    {
        $this->adapter = $adapter;

        return $this;
    }
}
