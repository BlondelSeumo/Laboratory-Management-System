<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    public $guarded=[];

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}
