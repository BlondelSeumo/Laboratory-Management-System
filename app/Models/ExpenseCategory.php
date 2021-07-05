<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ExpenseCategory extends Model
{
    use SoftDeletes;
    use LogsActivity;
    
    public $guarded=[];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Expense category was {$eventName}";
    }
}
