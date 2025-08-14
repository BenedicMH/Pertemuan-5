<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Return JSON response for API requests
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated. Please login first.'
                ], 401);
            }
            return redirect()->route('login');
        }

        if (!empty($roles)) {
            $userRole = Auth::user()->role ?? 'user';

            if (!in_array($userRole, $roles)) {
                // Return JSON response for API requests
                if ($request->expectsJson() || $request->is('api/*')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized Access. Insufficient permissions.',
                        'required_role' => $roles,
                        'user_role' => $userRole
                    ], 403);
                }
                abort(403, 'Unauthorized Access');
            }
        }
        return $next($request);
    }

}
