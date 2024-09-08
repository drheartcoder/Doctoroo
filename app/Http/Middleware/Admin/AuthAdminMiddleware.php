<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AuthAdminMiddleware
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

        $path = 'admin';

        $arr_except[] =  $path;
        $arr_except[] =  $path.'login';
        $arr_except[] =  $path.'process_login';
        $arr_except[] =  $path.'change_password';
        $arr_except[] =  $path.'update_password';
        $arr_except[] =  $path.'forgot_password';
        $arr_except[] =  $path.'reset_password';
        $arr_except[] =  $path.'update_reset_password';

        /*-----------------------------------------------------------------
            Code for {enc_id} or {extra_code} in url
        ------------------------------------------------------------------*/
        $request_path = $request->route()->getCompiled()->getStaticPrefix();
        $request_path = substr($request_path,1,strlen($request_path));
        
        /*-----------------------------------------------------------------
                End
        -----------------------------------------------------------------*/        

        if(!in_array($request_path, $arr_except))
        {
            $user = Sentinel::check();
            if($user)
            {
                if($user->inRole('admin'))
                {
                    return $next($request);    
                }
                else
                {
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
