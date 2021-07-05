<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
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
        if(\Schema::hasTable('migrations'))
        {
            if(!Auth::guard('admin')->check())
            {
                return redirect()->route('admin.auth.login');
            }
        
            //add online
            Cache::put('user-'.auth()->guard('admin')->user()['id'],'online',now()->addMinutes(2));

            //share settings
            $info=setting('info');
            $whatsapp=setting('whatsapp');
            $api_keys=setting('api_keys');
        

            view()->share([
                'info'=>$info,
                'whatsapp'=>$whatsapp,
                'api_keys'=>$api_keys
            ]);
        }

        return $next($request);
    }
}
