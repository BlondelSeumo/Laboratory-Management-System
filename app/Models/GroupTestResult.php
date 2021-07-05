<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTestResult extends Model
{
    public $guarded=[];

    public function component()
    {
        return $this->belongsTo(Test::class,'test_id','id')->withTrashed();
    }
}
