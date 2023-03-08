<?php
declare(strict_types=1);

namespace Gila\Entity\Channel;

enum Type: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case PUSH = 'push';
}
