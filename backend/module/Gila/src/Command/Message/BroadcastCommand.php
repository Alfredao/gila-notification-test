<?php
declare(strict_types=1);

namespace Gila\Command\Message;

use Gila\Model\SubscriptionModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BroadcastCommand extends Command
{
    private SubscriptionModel $subscriptionModel;

    protected function configure()
    : void
    {
        $this->setName('message:broadcast');
        $this->setDescription('Broadcasts pending messages to users through channels');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    : int
    {
        try {
            $this->getSubscriptionModel()->broadcast($input, $output);

            return 0;
        } catch (\Exception|\Throwable $e) {
            $output->writeln($e->getMessage());

            return 1;
        }
    }

    /**
     * Get SubscriptionModel
     *
     * @return \Gila\Model\SubscriptionModel
     */
    public function getSubscriptionModel()
    : SubscriptionModel
    {
        return $this->subscriptionModel;
    }

    /**
     * Set SubscriptionModel
     *
     * @param \Gila\Model\SubscriptionModel $subscriptionModel
     * @return BroadcastCommand
     */
    public function setSubscriptionModel(SubscriptionModel $subscriptionModel)
    : BroadcastCommand
    {
        $this->subscriptionModel = $subscriptionModel;

        return $this;
    }
}
