<?php

namespace App\Backend\Statistics\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Statistic {

    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Backend\Company\Domain\Entity\Company", inversedBy="statistic")
     * @@ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * 
     */
    private $company;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fiftyTwoWeekLow;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fiftyTwoWeekHigh;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $trailingPE;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $trailingAnnualDividendYield;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $regularMarketPrice;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $market;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $regularMarketTime;

    public function __construct($company, $fiftyTwoWeekLow, $fiftyTwoWeekHigh, $trailingPE
    , $trailingAnnualDividendYield, $regularMarketPrice, $market, $regularMarketTime) {

        $this->company = $company;
        $this->fiftyTwoWeekLow = $fiftyTwoWeekLow;
        $this->fiftyTwoWeekHigh = $fiftyTwoWeekHigh;
        $this->trailingPE = $trailingPE;
        $this->trailingAnnualDividendYield = $trailingAnnualDividendYield;
        $this->regularMarketPrice = $regularMarketPrice;
        $this->market = $market;
        $this->regularMarketTime = $regularMarketTime;
    }

    public static function created($company, $fiftyTwoWeekLow, $fiftyTwoWeekHigh
    , $trailingPE, $trailingAnnualDividendYield, $regularMarketPrice, $market, $regularMarketTime) {

        $regularMarketTime = new \DateTime(date("Y-m-d H:i:s", $regularMarketTime));
        $statistic = new static($company, $fiftyTwoWeekLow, $fiftyTwoWeekHigh, $trailingPE
                , $trailingAnnualDividendYield, $regularMarketPrice, $market, $regularMarketTime);

        return $statistic;
    }

}
