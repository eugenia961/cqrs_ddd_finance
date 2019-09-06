<?php

namespace App\Backend\Statistics\Infrastructe\Finances;

use App\Backend\Statistics\Domain\Interfaces\StatisticDataInterfaces;
use App\Backend\Company\Domain\Interfaces\CompanyRepositoryInterface;
use App\Backend\Statistics\Domain\Interfaces\SerializerDeserializeInterface;
use App\Backend\Statistics\Domain\Exceptions\DataResponseDosentExistException;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;

class YahooStatisticData implements StatisticDataInterfaces {

    private $companyRepositoryInterface;
    private $limit;
    private $url;
    private $serializerDeserializeInterface;
    private $quotesPricesTotal;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface, SerializerDeserializeInterface $serializerDeserializeInterface) {

        $this->companyRepositoryInterface = $companyRepositoryInterface;
        $this->serializerDeserializeInterface = $serializerDeserializeInterface;
        $this->limit = 5;
        $this->url = "https://query1.finance.yahoo.com/v7/finance/quote?symbols=%s";
        $this->quotesPricesTotal = new ArrayCollection();
    }

    public function data() {

        $pagesTotalNum = $this->getPagesTotalComapanies($this->limit);


        for ($i = 1; $i <= $pagesTotalNum; $i++) {

            list($tickers,$comaniesTickers) = $this->getTickers($i);

            if (\count($tickers) != 0) {

                $json = $this->getJsonYahooResponse($tickers);
                $quotes = $this->serializerDeserializeInterface->deserialize($json, 'array<App\Backend\Statistics\Domain\ValueObject\StatisticPrices>');
                $this->addQuotesPricesValues($quotes, $comaniesTickers);
            }
        }

        return $this->quotesPricesTotal;
    }

    private function addQuotesPricesValues($quotes, $comaniesTickers) {

        if (\count($quotes) == 0) {

            throw new DataResponseDosentExistException('Data response dosent exist.');
        }


        foreach ($quotes as $valueQuote) {

            $valueQuote->setCompany($comaniesTickers[$valueQuote->symbol()]);
            $this->quotesPricesTotal->add($valueQuote);
        }
    }

    private function getJsonYahooResponse($tickers) {

        $tickersString = \implode(",", $tickers);
        $urlYahoo = \sprintf($this->url, $tickersString);
        $response = $this->getUrlDataSrc($urlYahoo);
        $json = \json_decode($response, true);
        $jsonData = $json['quoteResponse']['result'];



        if (\count($jsonData) == 0) {

            throw new DataResponseDosentExistException('Data response dosent exist.');
        }

        return \json_encode($jsonData);
    }

    private function getTickers($page) {

        $companies = $this->companyRepositoryInterface->findAllActivePaginationCompanies($page, $this->limit);

        if ($companies) {

            foreach ($companies as $company) {

                $tickers[$company->id()] = $company->ticker();
                $comaniesTickers[$company->ticker()] = $company;
            }
        }

        return [$tickers, $comaniesTickers];
    }

    private function getUrlDataSrc($url): string {

        $client = new Client();
        $response = $client->request("GET", $url);

        $response->getStatusCode(); # 200
        $response->getHeaderLine('application/json; charset=utf8'); # 'application/json; charset=utf8  

        return $response->getBody();
    }

    private function getPagesTotalComapanies() {

        $count = $this->companyRepositoryInterface->countTotal();
        $pagesTotalNum = \ceil($count / $this->limit);

        return $pagesTotalNum;
    }

}
