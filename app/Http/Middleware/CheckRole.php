<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles (ini artinya bisa menerima banyak role, cth: 'staff', 'admin')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika pengguna tidak memiliki role yang ada di dalam daftar $roles
        if (! in_array($request->user()->role, $roles)) {
            // Tolak akses
            abort(403, 'AKSES DITOLAK. ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        // Jika punya, lanjutkan ke halaman yang dituju
        return $next($request);
    }
}