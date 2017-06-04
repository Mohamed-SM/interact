<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleWare
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
        $isAdmin = false;
        $rols = Auth::user()->rols->pluck('name');

        foreach ($rols as $rol) {
            if ($rol == 'admin') {
                $isAdmin = true;
                break;
            }
        }
        if (!$isAdmin) {
            return redirect('/home')->withErrors([
                'message'=>'you are not an admin'
            ]);
        }

        return $next($request);
    }
}
