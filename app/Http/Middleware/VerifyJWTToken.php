<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class VerifyJWTToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        auth()->shouldUse('api');

        $this->checkForToken($request);

        if( !auth('api')->check() ) {
            throw new \Exception('Unauthorized', 401);
        }

        return $next($request);
    }
}
