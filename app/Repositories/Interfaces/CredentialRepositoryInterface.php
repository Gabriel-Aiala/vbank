<?php

namespace App\Repositories\Interfaces;

interface CredentialRepositoryInterface
{
    public function create(array $data);


    public function findByEmail(string $email);
}
