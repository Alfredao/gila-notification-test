<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;

class ChannelModel extends AbstractModel implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;
}
