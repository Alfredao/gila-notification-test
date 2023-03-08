<?php
declare(strict_types=1);

namespace Gila\Model;

use Application\Model\AbstractModel;
use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Gila\Entity\Channel\EmailChannel;
use Gila\Entity\Channel\PushChannel;
use Gila\Entity\Channel\SmsChannel;
use Gila\Entity\Message;
use Gila\Entity\Subscription;
use Gila\Entity\UserMessage;
use Gila\Messenger\Adapter\EmailAdapter;
use Gila\Messenger\Adapter\PushAdapter;
use Gila\Messenger\Adapter\SmsAdapter;
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
    : void
    {
        $output->writeln('Starting message broadcast');

        $this->getEntityManager()->wrapInTransaction(function (EntityManager $em) use ($output) {
            /** @var SubscriptionRepo $subscriptionRepo */
            $subscriptionRepo = $em->getRepository(Subscription::class);
            /** @var \Gila\Repository\MessageRepo $messageRepo */
            $messageRepo = $em->getRepository(Message::class);

            $messages = $messageRepo->findAllWaiting();
            foreach ($messages as $message) {
                $subscribers = $subscriptionRepo->findSubscribers($message);

                foreach ($subscribers as $subscriber) {
                    $this->deliverMessage($message, $subscriber);

                    $output->writeln(sprintf(
                        'Message %s delivered successfully by %s',
                        $message->getId(),
                        $subscriber->getChannel()?->getName()
                    ));
                }

                $message->setStatus(Message\Status::DELIVERED);
                $message->setDeliveredAt(new \DateTimeImmutable());

                $em->persist($message);
            }
        });

        $output->writeln('All messages have been broadcast');

    }

    /**
     * Deliver message
     *
     * @param \Gila\Entity\Message $message
     * @param \Gila\Entity\Subscription $subscription
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function deliverMessage(Message $message, Subscription $subscription)
    : void
    {
        $channel = $subscription->getChannel();

        if ($channel instanceof EmailChannel) {
            $adapter = new EmailAdapter();
        } elseif ($channel instanceof SmsChannel) {
            $adapter = new SmsAdapter();
        } elseif ($channel instanceof PushChannel) {
            $adapter = new PushAdapter();
        } else {
            throw new \RuntimeException('Invalid message channel');
        }

        $this->getMessenger()->setAdapter($adapter);
        $this->getMessenger()->broadcast($message);

        $this->getEntityManager()->wrapInTransaction(static function (EntityManager $em) use ($message, $subscription) {
            $userMessage = new UserMessage();
            $userMessage->setMessage($message);
            $userMessage->setUser($subscription->getUser());

            $em->persist($userMessage);
        });

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
