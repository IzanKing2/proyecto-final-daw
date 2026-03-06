<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();

        if ($user && $user->role->name === 'Admin') {
            return $next($request);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permisos de administrador',
            ], 403);
        }
    }
}
