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
        
        // Check if token header exists
        if (! $token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. API Token is required.'
            ], 401);
        }

        $savedToken = \App\Models\Setting::get('api_token');

        // Check if token is configured
        if (! $savedToken || ! is_string($savedToken)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. API Token is not configured.'
            ], 401);
        }

        // Compare tokens using hash_equals to prevent timing attacks
        if (! hash_equals($savedToken, $token)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid API Token.'
            ], 401);
        }

        return $next($request);
    }
}
