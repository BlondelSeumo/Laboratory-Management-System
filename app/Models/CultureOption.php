<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CultureOption extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $guarded=[];

    public function childs()
    {
        return $this->hasMany(CultureOption::class,'parent_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Culture option was {$eventName}";
    }
}
