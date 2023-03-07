<?php
declare(strict_types=1);

namespace Application\Service\Logger;

enum Type: string
{
    case CRON_HANDLER = 'cronHandler';
}
