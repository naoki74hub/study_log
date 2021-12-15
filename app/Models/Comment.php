<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id','post_id','comment'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function replies()
    {
        return $this->belongsToMany('App\Models\Comment','replies');
    }
}
