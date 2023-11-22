<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class IsUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->id == $request->id) {
            return $next($request);
        }

        return redirect()->back()
            ->with('message', Lang::get('notification-message.ACCESS_ERROR'))
            ->with('success', false);
    }
}
