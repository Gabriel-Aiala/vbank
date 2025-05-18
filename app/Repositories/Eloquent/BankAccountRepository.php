<?php

namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount
    {
        return BankAccount::create($data);
    }
}
