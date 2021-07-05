<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class Patient extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use LogsActivity;
    
    public $guarded=[];
    public $appends=['age','total','paid','due'];

    public function groups()
    {
        return $this->hasMany(Group::class,'patient_id','id');
    }

    public function getAgeAttribute()
    {
        $date = new \DateTime($this->dob);
        $now = new \DateTime();
        $interval = $now->diff($date);

        // dd($interval);
        if($interval->y==0)
        {
            if($interval->m==0)
            {
                return $interval->d." ".__('Days');
            }
            else{
                return $interval->m." ".__('Months');
            }
        }
        else{
            return $interval->y." ".__('Years');
        }
    }

    public function getTotalAttribute()
    {
        $total=$this->groups->sum('total');

        return $total;
    }

    public function getPaidAttribute()
    {
        $paid=$this->groups->sum('paid');

        return $paid;
    }

    public function getDueAttribute()
    {
        $due=$this->groups->sum('due');

        return $due;
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Patient was {$eventName}";
    }
}
