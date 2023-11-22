<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Check role if contains role in roles then continue
     *
     * @param string roles
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $hasRoles = false;
        if (is_array($roles)) {
            foreach ($roles as $roleItem) {
                if (Auth::user()->hasRole($roleItem)) {
                    $hasRoles = true;
                    break;
                }
            }
        }

        if (!Auth::check() || !$hasRoles) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
