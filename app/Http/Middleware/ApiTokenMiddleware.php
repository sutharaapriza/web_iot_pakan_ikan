<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $savedToken = \App\Models\Setting::get('api_token');

        if (! is_string($savedToken) || $savedToken === '' || ! $token || ! hash_equals($savedToken, $token)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API Token.'
            ], 401);
        }

        return $next($request);
    }
}
