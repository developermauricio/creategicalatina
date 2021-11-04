<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (\auth()->user()){
            $userAdministrator = \auth()->user()->hasRole('Administrator');
        }

        if (Auth::guard($guard)->check()) {
            if ($userAdministrator){
                return redirect('/'.session('language').'/dashboard');
            }
        }

        return $next($request);
    }
}
