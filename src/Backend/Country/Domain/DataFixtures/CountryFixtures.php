<?php

namespace App\Backend\Country\Domain\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Backend\Country\Application\Services\CountryCreated;
use Ramsey\Uuid\Uuid;

class CountryFixtures extends Fixture {

    private $rootDir;
    private $countryCreated;

    public function __construct($rootDir, CountryCreated $countryCreated) {

        $this->rootDir = realpath($rootDir);
        $this->countryCreated = $countryCreated;
    }

    public function load(ObjectManager $manager) {

        $this->loadCountries();
    }

    public function loadCountries() {

        $countries = \explode("\n", \file_get_contents($this->rootDir . "/Backend/Country/Domain/Data/countries.csv"));

        foreach ($countries as $countryData) {

            $color = substr(str_shuffle('AABBCCDDEEFF00112233445566778899AABBCCDDEEFF00112233445566778899AABBCCDDEEFF00112233445566778899'), 0, 6);
            $id = Uuid::uuid4()->toString();
            list($name, $acronyms, $currency) = \explode(",", $countryData);
            $this->countryCreated->created($id, $name, $currency, $acronyms, $color);
        }
    }
    
    

}
