<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use LogsActivity;

    public $guarded=[];
    
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i',
    ];

    public function tests()
    {
        return $this->hasMany(GroupTest::class,'group_id','id');
    }

    public function cultures()
    {
        return $this->hasMany(GroupCulture::class,'group_id','id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id','id')->withTrashed();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id')->withTrashed();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id')->withTrashed();
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class,'contract_id','id')->withTrashed();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Group test was {$eventName}";
    }
    
}
