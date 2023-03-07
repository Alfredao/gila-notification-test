<?php

declare(strict_types=1);

namespace Gila\Entity\Payment;

enum Status: int
{
    case WAITING = 0;
    case PARTIALLY_PAID = 1;
    case FULLY_PAID = 2;
    case EXPIRED = 3;
    case CANCELED = 4;
}
