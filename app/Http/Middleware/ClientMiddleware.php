<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('client')->check())
        {
            $user = Auth::guard('client')->user();
            
            if($user->role == 'C')
            {
                return $next($request); 
            }

        }
        return redirect()->route('view.client-login');
        
    }
}
