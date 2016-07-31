<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencyCommand extends ContainerAwareCommand {
    
    protected function configure() {
        $this
            ->setName('currency:rate-exchange')
            ->setDescription('Updater currency exchange rates');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $container = $this->getContainer();
        $service = $container->get('kdr_currency_service');
        $service->getCurrencyConvert($output);
    }
}
