<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
    use LogsActivity;

    public $guarded=[];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id','id')->withTrashed();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Expense was {$eventName}";
    }
}
