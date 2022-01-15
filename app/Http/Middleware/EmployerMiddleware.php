<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    	public function handle(Request $request, Closure $next)
	{
	  if (Auth::user()->user_type == 'employer'){
		return $next($request);
	  } else {
		  if (Auth::user()->is_verified == true){
			  return redirect('/employerdashboard')->with('error','You dont have a permision for the desired URL.');
		  } else {
			  return redirect('/home')->with('error','You dont have a permision for the desired URL.');
		  }		
	  }
	}
	
	/*public function redirectTo() {
	  $role = Auth::user()->user_type; 
	  switch ($role) {
		case 'employer':
		  return '/employerdashboard';
		  break;
		case 'employee':
		  return '/dashboard';
		  break; 

		default:
		  return '/'; 
		break;
	  }
	}*/
}
