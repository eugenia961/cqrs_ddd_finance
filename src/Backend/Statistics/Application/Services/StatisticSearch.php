<?php

namespace App\Backend\Statistics\Application\Services;

use App\Backend\Statistics\Domain\Interfaces\StatisticRepositoryInterface;

final class StatisticSearch {

    private $statisticRepositoryInterface;

    public function __construct(StatisticRepositoryInterface $statisticRepositoryInterface) {

        $this->statisticRepositoryInterface = $statisticRepositoryInterface;
    }

    public function findStatisticsById($id) {


        $statistic = $this->statisticRepositoryInterface->findStatisticsById($id);

        return $statistic;
    }

}
