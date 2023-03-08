<?php
declare(strict_types=1);

namespace Gila\Messenger;

use Gila\Entity\Message;

interface AdapterInterface
{

    /**
     * Send message
     *
     * @param \Gila\Entity\Message $message
     * @return bool
     */
    public function send(Message $message)
    : bool;
}
