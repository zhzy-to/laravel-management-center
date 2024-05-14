<?php

namespace App\Http\Middleware;

use App\Enums\ErrorCodeEnum;
use App\Exceptions\Admin\AuthException;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        auth()->shouldUse('admin');

        if (! $request->bearerToken()) {
            throw new AuthException('Token is illegal', ErrorCodeEnum::Token_expired);
        }


        if( ! auth('admin')->check() ) {
            throw new AuthException('Unauthorized', ErrorCodeEnum::Token_expired);
        }

        return $next($request);
    }
}
