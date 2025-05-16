<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Entity;
use App\Models\Person;
use App\Models\Company;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;




class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        return DB::transaction(function () use ($request) {
            $entity = new Entity([
                'entityable_type' => $request['type'] === 'Person'
                    ? Person::class
                    : Company::class
            ]);

            match ($request['type']) {
                'Person' => $entity->entityable()->associate(
                    Person::create([
                        'name' => $request['name'],
                        'cpf' => $request['cpf']
                    ])
                ),
                'Company' => $entity->entityable()->associate(
                    Company::create([
                        'name' => $request['name'],
                        'cnpj' => $request['cnpj']
                    ])
                ),
                default => throw new \InvalidArgumentException('Tipo inválido')
            };

            $entity->save();
            // Cria Credencial
            Credential::create([
                'entity_id' => $entity->id,
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            return response()->json([
                'message' => 'Cadastro realizado com sucesso',
                'entity_type' => $request['type']
            ], 201);
        });
    }
}
