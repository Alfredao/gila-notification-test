<?php
declare(strict_types=1);

namespace Gila\Repository;

use Application\Repository\AbstractRepository;
use Gila\Entity\Message;
use Gila\Entity\Message\Status;

class MessageRepo extends AbstractRepository
{
    /**
     * Find all messages waiting to be broadcasted
     *
     * @return Message[]
     */
    public function findAllWaiting()
    : array
    {
        $qb = $this->createQueryBuilder('Message');

        $qb->andWhere($qb->expr()->eq('Message.status', Status::WAITING));

        return $qb->getQuery()->getResult();
    }
}
