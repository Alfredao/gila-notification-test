<?php
declare(strict_types=1);

namespace Gila\Command\Message;

use Application\Resources\EntityManagerAwareInterface;
use Application\Resources\EntityManagerAwareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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

        $this->addArgument('arg1', InputArgument::REQUIRED, 'Argument 1 description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get the arguments
        $arg1 = $input->getArgument('arg1');
    }
}
