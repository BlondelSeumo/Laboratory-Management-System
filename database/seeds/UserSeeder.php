<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        Role::truncate();

        RolePermission::truncate();

        UserRole::truncate();

        $user=User::create([
            'name'=>'Super Admin',
            'email'=>'super_admin@lab.com',
            'password'=>bcrypt(123456),
            'token'=>\Str::random(32),
        ]);

        $role=Role::create([
            'name'=>'super_admin'
        ]);

        //asign permissions to role
        $permissions=Permission::all();
        foreach($permissions as $permission)
        {
            RolePermission::create([
                'role_id'=>$role['id'],
                'permission_id'=>$permission['id']
            ]);
        }
        
        //asign role to user
        UserRole::create([
            'role_id'=>$role['id'],
            'user_id'=>$user['id']
        ]);

       
    }
}
