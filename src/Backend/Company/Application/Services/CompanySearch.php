<?php

namespace App\Backend\Company\Application\Services;

use App\Backend\Company\Domain\Interfaces\CompanyRepositoryInterface;

final class CompanySearch {

    private $companyRepositoryInterface;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface) {
        
        $this->companyRepositoryInterface = $companyRepositoryInterface;
    }

    public function findCompanyByAcronyms($ticker) {

        $company = $this->companyRepositoryInterface->findCompanyByTicker($ticker);

       
        return $company;
    }

}
