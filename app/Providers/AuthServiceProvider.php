<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Auth;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if(\DB::connection()->getDatabaseName() && \Schema::hasTable('permissions'))
        {
            $permissions=\App\Models\Permission::all();

            foreach($permissions as $permission)
            {
                Gate::define($permission['key'], function ($user=null) use ($permission) {
                   if(auth()->guard('admin')->check())
                   {
                        //auth super admin
                        if(auth()->guard('admin')->user()->id==1)
                        {
                            return true;
                        }
                        
                        //other users
                        $roles=\App\Models\UserRole::where('user_id',auth()->guard('admin')->user()['id'])->select('role_id')->get();
                        $has_permission=false;
                        foreach($roles as $role)
                        {
                            $check=\App\Models\RolePermission::where([['role_id',$role['role_id']],['permission_id',$permission['id']]])->count();
        
                            if($check)
                            {
                                $has_permission=true;
                            }
        
                        }
                        
                        return $has_permission;
                   }
                });
            }
            
            Gate::define('admin', function ($user=null) {
                return auth()->guard('admin')->check();
            });
    
            Gate::define('patient', function ($user=null) {
                return auth()->guard('patient')->check();
            });

        }

       
    }
}
