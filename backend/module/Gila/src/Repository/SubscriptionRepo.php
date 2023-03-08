<?php
declare(strict_types=1);

namespace Gila\Repository;

use Application\Repository\AbstractRepository;
use Gila\Entity\Message;
use Gila\Entity\Subscription;

class SubscriptionRepo extends AbstractRepository
{
    /**
     * @param \Gila\Entity\Message $message
     * @return Subscription[]
     */
    public function findSubscribers(Message $message)
    : array
    {
        $qb = $this->createQueryBuilder('Subscription');

        $qb->andWhere($qb->expr()->eq('Subscription.category', $message->getCategory()?->getId()));

        return $qb->getQuery()->getResult();
    }
}
