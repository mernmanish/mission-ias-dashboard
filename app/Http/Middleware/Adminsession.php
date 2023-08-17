<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminsession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('sessionadmin')) {
            // user value cannot be found in session
            return redirect('admin');
        }

        return $next($request);
    }

}
