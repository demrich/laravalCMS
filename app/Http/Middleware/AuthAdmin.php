<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
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
        if (Auth::guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unathorized', 401);
            } else{
                return redirect()->guest('admin/login');
            }
        }

        return $next($request);
    }
}
