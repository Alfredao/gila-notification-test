<?php
declare(strict_types=1);

namespace Gila\Entity\User;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
}
