<?php
declare(strict_types=1);

namespace Gila\Command\Message;

use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Doctrine\ORM\EntityManager;
use Gila\Entity\Message;
use Gila\Entity\Subscription;
use Gila\Entity\UserMessage;
use Gila\Repository\SubscriptionRepo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BroadcastCommand extends Command implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    protected function configure()
    : void
    {
        $this->setName('message:broadcast');
        $this->setDescription('Broadcasts pending messages to users through channels');
    }

    /**
     * @throws \Throwable
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getEntityManager()->wrapInTransaction(function (EntityManager $em) {
            /** @var SubscriptionRepo $subscriptionRepo */
            $subscriptionRepo = $em->getRepository(Subscription::class);
            /** @var \Gila\Repository\MessageRepo $messageRepo */
            $messageRepo = $em->getRepository(Message::class);

            $messages = $messageRepo->findAllWaiting();
            foreach ($messages as $message) {

            }
        });
    }
}
