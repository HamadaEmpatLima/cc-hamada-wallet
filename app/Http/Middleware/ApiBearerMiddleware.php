<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiBearerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Authorization header missing'], 401);
        }

        $authorizationHeader = $request->header('Authorization');
        $tokenParts = explode(' ', $authorizationHeader);

        if (count($tokenParts) !== 2 || $tokenParts[0] !== 'Bearer') {
            return response()->json(['message' => 'Invalid authorization header'], 401);
        }

        $base64Token  = $tokenParts[1];
        $decodedToken = base64_decode($base64Token);
        session(['authorization_value' => $decodedToken]);

        return $next($request);
    }
}
