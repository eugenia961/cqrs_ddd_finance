<?php

namespace App\Backend\Company\Application\Services;

use App\Backend\Company\Application\Services\CompanySearch;

use App\Backend\Company\Domain\Entity\Company;
use App\Backend\Company\Domain\Exceptions\CompanyExistException;
use App\Backend\Company\Domain\Interfaces\CompanyRepositoryInterface;

final class CompanyCreated {

    private $companyRepositoryInterface;
    private $companySearch;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface, CompanySearch $companySearch) {

        $this->companyRepositoryInterface = $companyRepositoryInterface;
        $this->companySearch = $companySearch;
    }

    public function created($id, $name, $ticker, $market, $country) {

        $findCompany = $this->companySearch->findCompanyByAcronyms($ticker);

        if ($findCompany != null) {

            throw new CompanyExistException(\sprintf('The company %s you are trying to add already exists.', $findCompany->ticker()));
        }

        $company = Company::created($id, $name, $ticker, $market, $country);
        $this->companyRepositoryInterface->save($company);
    }

}
