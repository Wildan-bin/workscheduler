<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekJabatan
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->jabatan !== $role) {
            abort(403, 'Akses hanya untuk ' . $role . '.');
        }
        return $next($request);
    }
}