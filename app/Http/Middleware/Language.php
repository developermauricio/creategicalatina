<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;

class Language
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
//        if (session('languages')){
//            $confingLanguage = config('languages')[session('languages')];
//            setlocale(LC_TIME, $confingLanguage[1] . '.utf8');
//            Carbon::setLocale(session('language'));
//            App::setLocale(session('language'));
//        }else{
//            session()->put('language', config('app.fallback_locale'));
//            setlocale(LC_TIME, 'es_ES.utf8');
//            Carbon::setLocale(session('language'));
//            App::setLocale(config('app.fallback_locale'));
//
//        }
        setCurrentLanguage();
        return $next($request);
    }
}
