<?php

namespace App\Http\Middleware;

use Closure;

class DetectLang
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
        if ($request->has('lang'))
        {
            $lang = $request->lang;
            app()->setLocale($lang);
            $response = $next($request);
            return $response->withCookie(cookie()->forever('lang', $lang));
        }else
        {
            $lang = $request->cookie('lang', 'vi');
            app()->setLocale($lang);
            return $next($request);
        }
    }
}
