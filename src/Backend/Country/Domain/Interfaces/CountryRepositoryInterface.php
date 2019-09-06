<?php

namespace App\Backend\Country\Domain\Interfaces;

use App\Backend\Country\Domain\Entity\Country;

interface CountryRepositoryInterface {

    public function save(Country $country);

    public function findCountryById($id);
    
     public function findCountryByAcronyms($acronyms);
     
}
