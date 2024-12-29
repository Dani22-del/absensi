<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Redirect ke halaman login jika belum login
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Lanjutkan request jika pengguna sudah login
        return $next($request);
    }
}

