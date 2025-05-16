<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function create(array $data): Company
    {
        return Company::create($data);
    }
}
