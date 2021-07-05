<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    public $guarded=[];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class,'role_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Role was {$eventName}";
    }

}
