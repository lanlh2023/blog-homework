<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Str;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isAdmin() || $this->isEditor()) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * Get group route by prefix uri
     *
     * @param string $prefix
     *
     * return collect
     */
    private function getGroupRouteByPrefix($prefix)
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) use ($prefix) {
            return Str::startsWith($route->uri, $prefix);
        });

        return $routes->map(function ($route) use ($prefix) {
            return ['name' => $route->getName()];
        });
    }

    /**
     * Check if the user is an admin
     *
     * return bool true|false
     */
    private function isAdmin()
    {
        $prefix = 'admin';
        $adminAllowRoute = $this->getGroupRouteByPrefix($prefix);

        if ($adminAllowRoute->contains('name', Route::currentRouteName()) && Auth::user()->role->name == config('role.ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Check if the user is an editor
     *
     * return bool true|false
     */

    private function isEditor()
    {
        $prefix = 'admin/post';
        // $commonAllowRoute = ['name' => 'admin.index'];
        $editorAllowRoute = $this->getGroupRouteByPrefix($prefix)->push(['name' => 'admin.index']);

        if ($editorAllowRoute->contains('name', Route::currentRouteName()) && Auth::user()->role->name == config('role.EDITOR')) {
            return true;
        }

        return false;
    }
}
