<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('admin')->check())
        {
            $user = Auth::guard('admin')->user();
            
            if($user->role == 'A')
            {
                return $next($request); 
            }

        }
        return redirect()->route('view.login');
        
    }
}
