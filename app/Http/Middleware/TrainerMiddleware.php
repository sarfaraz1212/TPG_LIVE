<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class TrainerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('trainer')->check())
        {
            $user = Auth::guard('trainer')->user();
            
            if($user->role == 'T')
            {
                return $next($request); 
            }
            
        }
        return redirect()->route('view.trainer-login');
    }
}
