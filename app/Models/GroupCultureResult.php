<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCultureResult extends Model
{
    public $guarded=[];
    
    public function antibiotic()
    {
        return $this->belongsTo(Antibiotic::class,'antibiotic_id','id')->withTrashed();
    }
}
