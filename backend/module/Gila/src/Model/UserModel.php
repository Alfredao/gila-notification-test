<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;

class UserModel extends AbstractModel implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;
}
