<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTest extends Model
{
    public $guarded=[];

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id','id')->withTrashed();
    }

    public function results()
    {
        return $this->hasMany(GroupTestResult::class,'group_test_id','id')->orderBy('id','asc');
    }
}
