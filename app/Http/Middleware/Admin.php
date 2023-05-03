<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//Si l'user connecté n'a pas un profil administrateur on le redirige a l'accueil
		
		
		if (Auth::user()->profil_id !=1 )
		{
			
			return redirect('home');
			
		}
		
        return $next($request);
		
    }
	
}
