<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Credenciais inválidas'
        ], 401);
    }
}
