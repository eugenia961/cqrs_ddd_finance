<?php

namespace App\Backend\Country\Application\Services;

use App\Backend\Country\Domain\Entity\Country;
use App\Backend\Country\Domain\Interfaces\CountryRepositoryInterface;

final class CountryCreated {

    private $countryRepositoryInterface;

    public function __construct(CountryRepositoryInterface $countryRepositoryInterface) {
        
        $this->countryRepositoryInterface = $countryRepositoryInterface;
    }

    public function created($id, $name, $currency, $acronyms, $color) {

        $country = Country::created($id, $name, $acronyms, $currency, $color);
        $this->countryRepositoryInterface->save($country);
    }

}
