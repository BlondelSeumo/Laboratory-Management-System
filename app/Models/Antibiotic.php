<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Antibiotic extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $guarded=[];

    public $timestamps=false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Antibiotic was {$eventName}";
    }
}
