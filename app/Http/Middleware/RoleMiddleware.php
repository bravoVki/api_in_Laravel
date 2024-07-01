<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request to check for the roles and action being taken
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'You are not allowed to perform this action.', 'error' => 'Forbidden.'], 403);
        }

        return $next($request);
    }
}
