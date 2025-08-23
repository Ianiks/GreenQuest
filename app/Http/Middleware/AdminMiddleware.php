<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        \Log::info('AdminMiddleware hit');
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return redirect()->route('admin.login')->with('error', 'Please login as admin');
    }
}