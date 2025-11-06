<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Override do comportamento padrão para APIs.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            abort(response()->json([
                'status' => 'error',
                'message' => 'Não autenticado. Forneça um token JWT válido.'
            ], 401));
        }

        return null;
    }
}
