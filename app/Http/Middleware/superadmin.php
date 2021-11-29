<?php

namespace App\Http\Middleware;

use Closure;

class superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && strval($request->user()->role) !== "0") {
            return response([
                "success" => false,
                "message" => "Unauthorized"
              ], 401);   
        }
        return $next($request);
    }
}
