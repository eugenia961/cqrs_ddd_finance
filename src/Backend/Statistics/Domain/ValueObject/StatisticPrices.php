<?php

namespace App\Backend\Statistics\Domain\ValueObject;

use JMS\Serializer\Annotation as Serializer;

class StatisticPrices {

    private $company;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $symbol;

    /**
     * @var float
     * @Serializer\SerializedName("fiftyTwoWeekLow")
     * @Serializer\Type("float")
     */
    private $fiftyTwoWeekLow;

    /**
     * @var float
     * @Serializer\SerializedName("fiftyTwoWeekHigh")
     * @Serializer\Type("float")
     */
    private $fiftyTwoWeekHigh;

    /**
     * @var float
     * @Serializer\SerializedName("trailingPE")
     * @Serializer\Type("float")
     */
    private $trailingPE;

    /**
     * @var float
     * @Serializer\SerializedName("trailingAnnualDividendYield")
     * @Serializer\Type("float")
     */
    private $trailingAnnualDividendYield;

    /**
     * @var float
     * @Serializer\SerializedName("regularMarketPrice")
     * @Serializer\Type("float")
     */
    private $regularMarketPrice;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $market;

    /**
     * @var integer
     * @Serializer\SerializedName("regularMarketTime")
     * @Serializer\Type("integer")
     */
    private $regularMarketTime;

    public function setCompany($company) {
        $this->company = $company;
    }

    public function company() {
        return $this->company;
    }

    public function symbol() {
        return $this->symbol;
    }

    public function fiftyTwoWeekLow() {
        return $this->fiftyTwoWeekLow;
    }

    public function fiftyTwoWeekHigh() {
        return $this->fiftyTwoWeekHigh;
    }

    public function trailingPE() {
        return $this->trailingPE;
    }

    public function trailingAnnualDividendYield() {
        return $this->trailingAnnualDividendYield;
    }

    public function regularMarketPrice() {
        return $this->regularMarketPrice;
    }

    public function market() {
        return $this->market;
    }

    public function regularMarketTime() {
        return $this->regularMarketTime;
    }

}
