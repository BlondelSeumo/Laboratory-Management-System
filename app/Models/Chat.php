<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $appends=['since'];
    
    public $guarded=[];

    protected $casts = [
        'created_at' => 'datetime:H:i',
    ];

    public function from_user()
    {
        return $this->belongsTo(User::class,'from','id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class,'to','id');
    }

    public function getSinceAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
