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
}
