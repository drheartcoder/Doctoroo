<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Flash;
class AuthPatientMiddleware
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
        $arr_except = array();
        $current_url_route = app()->router->getCurrentRoute()->uri();
        if(!in_array($current_url_route,$arr_except))
        {
            $user = Sentinel::check();
            
            if($user)
            {   
                $step_clearance = true;
                if($user->user_status == 'Block')
                {
                    $step_clearance = false;
                    Flash::error('Your Account is Blocked Temporarily by Admin');
                }   
                elseif(!$user->inRole('patient'))
                {
                    $step_clearance = false;
                    Flash::error('You don\'t have sufficient previleges to access this panel ');  
                }
                if($step_clearance == true)
                {
                    return $next($request);    
                }
                else
                {
                    Sentinel::logout();
                    return redirect('/');
                }    
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return $next($request); 
        }
    }
}
