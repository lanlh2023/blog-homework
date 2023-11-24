<?php

namespace App\Http\Middleware;

use App\Enums\RoleType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // RoleType same Role->name
        $groupPermissions[RoleType::ADMIN] = RoleType::ADMIN;
        $groupPermissions[RoleType::EDITOR] = 'post';

        if (strpos($request->route()->getName(), $groupPermissions[Auth::user()->roles->first()->name])) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
