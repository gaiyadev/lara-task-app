<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;

class EnsureJsonResponse
{
    use ResponseAPI;
    const INVALID_REQUEST_FORMAT_MESSAGE = "Invalid request format. Please add 'Accept: application/json' in the request header";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            // return response()->json(['error' => 'Invalid request format.'], 400);
            return $this->error(self::INVALID_REQUEST_FORMAT_MESSAGE, 400);

        }

        return $next($request);
    }
}
