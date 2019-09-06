<?php

namespace App\Backend\Statistics\Infrastructe\Executable;

use App\Backend\Statistics\Domain\Command\StatisticPricesCommand;
use App\Backend\Statistics\Domain\Interfaces\StatisticCommandBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class StatisticCommand extends Command {

    protected static $defaultName = 'statistic';
    private $statisticCommandBusInterface;

    public function __construct(StatisticCommandBusInterface $statisticCommandBusInterface) {

        $this->statisticCommandBusInterface = $statisticCommandBusInterface;

        parent::__construct();
    }

    protected function configure() {
              
        $this->setDescription('Get data from the Yahoo Finance API for some companies and store it in databases.') ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $io = new SymfonyStyle($input, $output);
        $statisticPricesCommand = new StatisticPricesCommand();
        $this->statisticCommandBusInterface->dispatch($statisticPricesCommand);
        $io->success('OK.');
    }

}
