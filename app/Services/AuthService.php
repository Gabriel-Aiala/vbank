<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquent\PersonRepository;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\EntityRepository;
use App\Repositories\Eloquent\CredentialRepository;

class AuthService
{
    public function __construct(
        private PersonRepository $personRepository,
        private CompanyRepository $companyRepository,
        private EntityRepository $entityRepository,
        private CredentialRepository $credentialRepository
    ) {}

    public function registerUser(array $data): array
    {

        return DB::transaction(function () use ($data) {
            // Cria a entidade específica (Person ou Company)
            $entityable = match ($data['type']) {
                'Person' => $this->personRepository->create([
                    'name' => $data['name'],
                    'cpf' => $data['cpf']
                ]),
                'Company' => $this->companyRepository->create([
                    'name' => $data['name'],
                    'cnpj' => $data['cnpj']
                ]),
                default => throw new \InvalidArgumentException('Tipo de entidade inválido')
            };

            // Cria a entidade principal
            $entity = $this->entityRepository->create([
                'entityable_type' => $entityable::class,
                'entityable_id' => $entityable->id
            ]);

            // Cria a credencial
            $this->credentialRepository->create([
                'entity_id' => $entity->id,
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return [
                'message' => 'Cadastro realizado com sucesso',
                'entity_type' => $data['type']
            ];
        });
    }
}
