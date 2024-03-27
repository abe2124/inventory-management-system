<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Nurse
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $user = Auth::user();
            if ($user->role == 2) {
                return $next($request);
            }
            if ($user->role == 1) {
                return redirect('/admin');
            }
            if ($user->role == 0) {
                return redirect('/director');
            }
        }
    }
}
