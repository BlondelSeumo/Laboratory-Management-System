<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Doctor extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $guarded=[];
    public $appends=['total','paid','due'];

    public function groups()
    {
        return $this->hasMany(Group::class,'doctor_id','id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class,'doctor_id','id');
    }

    public function getTotalAttribute()
    {
        return $this->groups->sum('doctor_commission');
    }

    public function getPaidAttribute()
    {
        return $this->expenses->sum('amount');
    }

    public function getDueAttribute()
    {
        return $this->total-$this->paid;
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Doctor was {$eventName}";
    }
}
