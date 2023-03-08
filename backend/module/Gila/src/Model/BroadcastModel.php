<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Gila\Entity\Message;
use Gila\Entity\UserMessage;

class BroadcastModel extends AbstractModel implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    /**
     * @throws \Throwable
     */
    private function broadcast(Message $message)
    : Message
    {
        /** @var \Gila\Entity\User $subscriber */
        return $this->getEntityManager()->wrapInTransaction(function (EntityManager $em) use ($message) {

            $channel = $message->getBroadcast()->getChannel();
            $category = $message->getBroadcast()->getCategory();

            foreach ($message->getBroadcast()?->getSubscribers() as $subscriber) {
                $userMessage = new UserMessage();
                $userMessage->setMessage($message);
                $userMessage->setUser($subscriber);

                $em->persist($userMessage);
            }

            $message->setStatus(Message\Status::DELIVERED);
            $message->setDeliveredAt(new \DateTimeImmutable());

            return $message;
        });
    }
}
