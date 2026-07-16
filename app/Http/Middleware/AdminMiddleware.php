<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika sudah login dan rolenya adalah admin, izinkan lewat
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, gagalkan langsung dengan error 403 (Forbidden) daripada di-redirect
        abort(403, 'Anda tidak memiliki hak akses admin!');
    }
}