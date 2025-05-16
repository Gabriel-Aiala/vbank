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
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Services\AuthService;




class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->registerUser($request->validated());

        return response()->json($response, 201);
    }
    public function login(LoginRequest $request)
    {
        $tokenData = $this->authService->login($request->validated());

        return response()->json($tokenData);
    }
}
