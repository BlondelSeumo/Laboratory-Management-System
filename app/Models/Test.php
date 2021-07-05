<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Test extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $guarded=[];

    public $timestamps=false;


    public function components()
    {
        return $this->hasMany(Test::class,'parent_id','id')->orderBy('id','asc');
    }

    public function sub_analyses()
    {
        return $this->hasMany(Test::class,'parent_id','id')->where('separated',1);
    }

    public function options()
    {
        return $this->hasMany(TestOption::class,'test_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Test was {$eventName}";
    }


}
