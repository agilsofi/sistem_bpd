<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        if (empty($roles)) {
            return $next($request);
        }

        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses ditolak. Peran Anda: ' . $userRole . '. Dibutuhkan: ' . implode(', ', $roles));
        }

        return $next($request);
    }
}
