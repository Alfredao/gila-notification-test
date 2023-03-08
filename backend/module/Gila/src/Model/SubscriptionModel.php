<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Gila\Entity\Message;
use Gila\Entity\Subscription;
use Gila\Messenger\Adapter\EmailAdapter;
use Gila\Messenger\Messenger;
use Gila\Repository\SubscriptionRepo;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SubscriptionModel extends AbstractModel implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    private Messenger $messenger;

    /**
     * @throws \Throwable
     */
    public function broadcast(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting message broadcast');

        $this->getEntityManager()->wrapInTransaction(function (EntityManager $em) {
            /** @var SubscriptionRepo $subscriptionRepo */
            $subscriptionRepo = $em->getRepository(Subscription::class);
            /** @var \Gila\Repository\MessageRepo $messageRepo */
            $messageRepo = $em->getRepository(Message::class);

            $messages = $messageRepo->findAllWaiting();
            foreach ($messages as $message) {
                $subscribers = $subscriptionRepo->findSubscribers($message);

                foreach ($subscribers as $subscriber) {
                    $this->deliverMessage($message, $subscriber);
                }

            }
        });
    }

    public function deliverMessage(Message $message, Subscription $subscription)
    {
        $adapter = new EmailAdapter();

        $this->getMessenger()->setAdapter($adapter);
        $this->getMessenger()->broadcast($message);
    }

    /**
     * Get Messenger
     *
     * @return \Gila\Messenger\Messenger
     */
    public function getMessenger()
    : Messenger
    {
        return $this->messenger;
    }

    /**
     * Set Messenger
     *
     * @param \Gila\Messenger\Messenger $messenger
     * @return SubscriptionModel
     */
    public function setMessenger(Messenger $messenger)
    : SubscriptionModel
    {
        $this->messenger = $messenger;

        return $this;
    }
}
