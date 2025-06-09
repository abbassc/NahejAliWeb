<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        Log::info('Role middleware called', [
            'user' => Auth::user(),
            'required_role' => $role,
            'user_role' => Auth::user()?->role
        ]);

        if (!Auth::check()) {
            Log::warning('User not authenticated');
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->role !== $role) {
            Log::warning('User role mismatch', [
                'user_role' => $user->role,
                'required_role' => $role
            ]);
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
