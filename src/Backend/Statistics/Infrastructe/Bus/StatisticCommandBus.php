<?php

namespace App\Backend\Statistics\Infrastructe\Bus;

use App\Backend\Statistics\Domain\Interfaces\StatisticCommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class StatisticCommandBus implements StatisticCommandBusInterface {

    private $messageBusInterface;

    public function __construct(MessageBusInterface $messageBusInterface) {

        $this->messageBusInterface = $messageBusInterface;
    }

    public function dispatch($command): void {

        $this->messageBusInterface->dispatch($command);
    }

}
