<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Patient
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
        if(\Schema::hasTable('migrations'))
        {
            if(!Auth::guard('patient')->check())
            {
                return redirect()->route('patient.auth.login');
            }
    
            //share settings
            $info=setting('info');
            $api_keys=setting('api_keys');

            
            view()->share([
                'info'=>$info,
                'api_keys'=>$api_keys
            ]);
        }
        
        return $next($request);
    }
}
