<?php
namespace App\Backend\Statistics\Domain\Interfaces;

interface StatisticCommandBusInterface {
    
    public function dispatch($command): void;
}
