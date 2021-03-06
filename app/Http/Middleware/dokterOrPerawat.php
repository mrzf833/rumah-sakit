<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class dokterOrPerawat
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
        if($role == 'dokter' || $role == 'perawat'){
            return $next($request);
        }
        return abort(403,'User does not have the right roles.');
    }
}
