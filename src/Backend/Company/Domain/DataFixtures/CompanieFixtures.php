<?php

namespace App\Backend\Company\Domain\DataFixtures;

use App\Backend\Country\Domain\DataFixtures\CountryFixtures;
use App\Backend\Country\Application\Services\CountrySearch;
use App\Backend\Company\Application\Services\CompanyCreated;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ramsey\Uuid\Uuid;

final class CompanieFixtures extends Fixture implements DependentFixtureInterface {

    private $countrySearch;
    private $companyCreated;

    public function __construct(CountrySearch $countrySearch, CompanyCreated $companyCreated) {

        $this->countrySearch = $countrySearch;
        $this->companyCreated = $companyCreated;
    }

    public function load(ObjectManager $manager) {
        $this->loadComapnies();
    }

    public function loadComapnies() {

        $companies = $this->dataCompanies();
        foreach ($companies as $company) {

            $country = $this->countrySearch->findCountryByAcronyms($company['country']);
            $id = Uuid::uuid4()->toString();
            $this->companyCreated->created($id, $company['name'], $company['ticker'], $company['market'], $country);
        }
    }

    private function dataCompanies() {

        $companies [] = [
            'country' => 'US',
            'ticker' => 'T',
            'name' => "AT&T",
            'market' => 'USA'
        ];

        $companies [] = [
            'country' => 'ES',
            'ticker' => 'IBE.MC',
            'name' => "Iberdrola",
            'market' => 'ES'
        ];

        return $companies;
    }

    public function getDependencies(): array {

        return array(
            CountryFixtures::class,
        );
    }

}
