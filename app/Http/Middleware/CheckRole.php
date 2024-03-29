<?php

namespace App\Http\Middleware;

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
        if ($this->isAdmin($request) || $this->isEditor($request)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * Check if the user is an admin
     *
     * @param  Request  $request
     *                            return bool true|false
     */
    private function isAdmin(Request $request)
    {
        $adminAllowRoute = ['admin.index', 'admin.post.*', 'admin.user.*', 'admin.role_user.*'];

        return $request->routeIs($adminAllowRoute) && Auth::user()->role->name == config('role.ADMIN');
    }

    /**
     * Check if the user is an editor
     *
     * @param  Request  $request
     *                            return bool true|false
     */
    private function isEditor(Request $request)
    {
        $editorAllowRoute = ['admin.index', 'admin.post.*'];

        return $request->routeIs($editorAllowRoute) && Auth::user()->role->name == config('role.EDITOR');
    }
}
