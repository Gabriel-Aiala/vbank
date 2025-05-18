<?php

namespace App\Services;

use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Models\BankAccount;

class BankAccountService
{
    public function __construct(
        private BankAccountRepositoryInterface $BankAccountRepository,
    ) {}
    public function create(int $id): BankAccount
    {
        $data = $this->generateBankAccountData($id);
        return $this->BankAccountRepository->create($data);
    }
    public function generateBankAccountData(int $id): array
    {
        return [
            'branch' => "001",
            'account_number' => str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'balance' => 0,
            'entity_id' => $id,
        ];
    }
}
