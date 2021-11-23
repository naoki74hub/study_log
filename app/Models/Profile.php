<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'self_introduction',
        'goal',
        'user_id',
        ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
