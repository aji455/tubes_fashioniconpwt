<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        return $next($request);
    }
}
