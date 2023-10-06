<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
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
        // $user = Auth::user();
        // if ($user) {
        //     if ($user->hasRole('Admin')) {
        //         return redirect()->route('dashboard'); // Ganti dengan rute dashboard admin Anda
        //     } else {
        //         return redirect('/'); // Ganti dengan rute dashboard pengguna biasa Anda
        //     }
        // }
        return $next($request);
    }
}