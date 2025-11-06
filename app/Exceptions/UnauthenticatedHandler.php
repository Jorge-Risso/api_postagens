<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class UnauthenticatedHandler
{
    public function handle(AuthenticationException $exception): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Não autenticado. Faça login novamente.',
        ], 401);
    }
}
