<?php

namespace App\Backend\Statistics\Application\Handlers;

use App\Backend\Statistics\Domain\Interfaces\StatisticDataInterfaces;
use App\Backend\Statistics\Domain\Command\StatisticPricesCommand;
use App\Backend\Statistics\Domain\Interfaces\StatisticRepositoryInterface;
use App\Backend\Statistics\Domain\Entity\Statistic;

class StatisticPricesCommandHandler {

    private $statisticDataInterfaces;
    private $statisticRepositoryInterface;

    public function __construct(StatisticDataInterfaces $statisticDataInterfaces, StatisticRepositoryInterface $statisticRepositoryInterface) {

        $this->statisticDataInterfaces = $statisticDataInterfaces;
        $this->statisticRepositoryInterface = $statisticRepositoryInterface;
    }

    public function __invoke(StatisticPricesCommand $statisticPricesCommand) {

        $pricesData = $this->statisticDataInterfaces->data();

        if ($pricesData) {

            foreach ($pricesData as $data) {

                $statisticSearch = $this->statisticRepositoryInterface->findStatisticsById($data->company()->id());

                if ($statisticSearch != null) {

                    $this->statisticRepositoryInterface->remove($statisticSearch);
                }


                $statistic = Statistic::created($data->company(), $data->fiftyTwoWeekLow(), $data->fiftyTwoWeekHigh(), $data->trailingPE()
                            , $data->trailingAnnualDividendYield(), $data->regularMarketPrice(), $data->market(), $data->regularMarketTime());

                   $this->statisticRepositoryInterface->save($statistic);
                
            }
        }
    }

}
