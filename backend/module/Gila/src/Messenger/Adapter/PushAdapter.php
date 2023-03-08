<?php
declare(strict_types=1);

namespace Gila\Messenger\Adapter;

use Gila\Entity\Message;
use Gila\Messenger\AdapterInterface;

class PushAdapter implements AdapterInterface
{
    public function send(Message $message)
    : bool
    {
        // TODO: Implement send() method for E-mail delivering.
        return true;
    }
}
