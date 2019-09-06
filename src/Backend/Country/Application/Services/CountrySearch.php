<?php

namespace App\Backend\Country\Application\Services;

use App\Backend\Country\Domain\Interfaces\CountryRepositoryInterface;

final class CountrySearch {

    private $countryRepositoryInterface;

    public function __construct(CountryRepositoryInterface $countryRepositoryInterface) {
        $this->countryRepositoryInterface = $countryRepositoryInterface;
    }

    public function findCountryByAcronyms($acronyms) {

        $country = $this->countryRepositoryInterface->findCountryByAcronyms($acronyms);

        return $country;
    }

}
