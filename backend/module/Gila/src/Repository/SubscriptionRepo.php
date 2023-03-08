<?php
declare(strict_types=1);

namespace Gila\Repository;

use Application\Repository\AbstractRepository;

class SubscriptionRepo extends AbstractRepository
{
    public function findSubs(\Gila\Entity\Message $message)
    {
        $qb = $this->createQueryBuilder('Subscription');

        $qb->andWhere($qb->expr()->eq('Subscription.category', $message->getCategory()?->getId()));

        return $qb->getQuery()->getResult();
    }
}
