<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckIfUserIsLocked
{
    /**
     * Check if the user is locked.
     * it will log out the user if it is locked.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_locked) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Your Account is locked, contact support.']);
        }

        return $next($request);
    }
}
