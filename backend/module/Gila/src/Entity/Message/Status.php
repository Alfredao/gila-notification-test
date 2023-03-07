<?php
declare(strict_types=1);

namespace Gila\Entity\Message;

enum Status: int
{
    case WAITING = 0;
    case DELIVERED = 1;
}
