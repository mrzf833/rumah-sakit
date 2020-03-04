<?php

namespace App\Http\Middleware;

use App\role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class admin
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
        $role = Auth::user()->roles()->first()->nama;
        if($role == 'admin'){
            return $next($request);
        }
        return abort(403,'User does not have the right roles.');
    }
}
