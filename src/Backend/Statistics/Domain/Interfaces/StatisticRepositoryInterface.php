<?php

namespace App\Backend\Statistics\Domain\Interfaces;

interface StatisticRepositoryInterface {

    public function save($statistic);

    public function remove($statistic);

    public function findStatisticsById($company);
    
   
}
