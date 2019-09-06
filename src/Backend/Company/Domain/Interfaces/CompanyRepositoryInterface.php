<?php

namespace App\Backend\Company\Domain\Interfaces;

interface CompanyRepositoryInterface {

    public function save($company);
    
    public function findCompanyByTicker($ticker);
    
    public function findAllActivePaginationCompanies($page=0,$limit);
    
    public function countTotal();
}
