<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class multiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('karyawan')->check()) {
            return $next($request);
        } elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user->hasVerifiedEmail() && in_array($user->status, ['free', 'premium'])) {
                return $next($request);
            }
        }
        
        // dd($user->hasVerifiedEmail());
        return redirect()->route('login');
    }
}
