<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCultureOption extends Model
{
    public $guarded=[];

    public function  culture_option()
    {
        return $this->belongsTo(CultureOption::class,'culture_option_id','id')->withTrashed();
    }

    public function  group_culture()
    {
        return $this->belongsTo(GroupCulture::class,'group_culture_id','id');
    }
}
