<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $isSuper = auth()->user()->role === 'super_admin';
        $superAdminsExist = \App\Models\User::where('role', 'super_admin')->exists();

        // Bootstrap: if no super admin exists yet, let an admin through to create one.
        if ($isSuper || (!$superAdminsExist && auth()->user()->role === 'admin')) {
            return $next($request);
        }

        abort(403);
    }
}
