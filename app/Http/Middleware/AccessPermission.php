<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AccessPermission
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
        if (!$this->isLogin()) {
            return redirect(route('admin'));
        } else {
            return $next($request);
        }
    }

    public function isLogin()
    {
        if (Session::get('admin_id')) {
            return true;
        } else {
            return false;
        }
    }
}
