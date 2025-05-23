<?php

namespace App\Repositories\Eloquent;

use App\Models\Credential;
use App\Repositories\Interfaces\CredentialRepositoryInterface;

class CredentialRepository implements CredentialRepositoryInterface
{
    public function create(array $data): Credential
    {
        return Credential::create($data);
    }
    public function findByEmail(string $email): ?Credential
    {
        return Credential::where('email', $email)->first();
    }
}
