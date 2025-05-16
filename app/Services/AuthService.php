<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\PersonRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\EntityRepositoryInterface;
use App\Repositories\Interfaces\CredentialRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\InvalidCredentialsException;

class AuthService
{
    public function __construct(
        private PersonRepositoryInterface $personRepository,
        private CompanyRepositoryInterface $companyRepository,
        private EntityRepositoryInterface $entityRepository,
        private CredentialRepositoryInterface $credentialRepository
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
    public function login(array $credentials): array
    {
        $credential = $this->credentialRepository->findByEmail($credentials['email']);

        if (!$credential || !Hash::check($credentials['password'], $credential->password)) {
            throw new InvalidCredentialsException();
        }

        return $this->generateTokenResponse($credential);
    }

    private function generateTokenResponse($credential): array
    {
        $token = JWTAuth::fromUser($credential);
        $expiresIn = JWTAuth::factory()->getTTL() * 60;

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn
        ];
    }
}
