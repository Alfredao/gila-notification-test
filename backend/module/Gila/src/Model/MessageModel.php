<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Gila\Entity\Broadcast;
use Gila\Entity\Message;

class MessageModel extends AbstractModel implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    /**
     * Broadcast message
     *
     * @param array $data
     * @return \Gila\Entity\Message
     * @throws \Throwable
     */
    public function create(array $data)
    : Message
    {
        return $this->getEntityManager()->wrapInTransaction(function (EntityManager $em) use ($data) {

            $broadcast = $em->getRepository(Broadcast::class)->find($data['broadcast']);

            $message = new Message();
            $message->setText($data['text']);
            $message->setStatus(Message\Status::WAITING);
            $message->setBroadcast($broadcast);

            $em->persist($message);

            return $message;
        });
    }
}
