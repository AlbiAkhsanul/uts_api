<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        if ($apiKey && str_starts_with($apiKey, 'Bearer ')) {
            $apiKey = substr($apiKey, 7); // hapus "Bearer "
        }

        $user = \App\Models\User::where('api_key', $apiKey)
            ->where('api_key_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Simpan user ke request (jika perlu)
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
