<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class Administrateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
         //utilisateur non authetifié
            if(!$user){   
                return redirect() ->route ('dashboard');
            }

            // utilisateur authentifié mais pas comme administrateur
            if ($user->role !== User::admin_role){
                return redirect() ->route ('dashboard');

            }   
          //dd($user->role);
        return $next($request);
    }
}