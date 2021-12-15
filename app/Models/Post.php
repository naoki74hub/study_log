<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
    'title',
    'time',
    'body',
    'image_url',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    
    public function likes()
    {
        return $this->belongsToMany('App\Models\User','likes')->withTimestamps();
    }
    
    
    public function comments()
   {
       return $this->hasMany('App\Models\Comment','post_id','id');
   }
   
   
   public function getUserTimeLine(Int $user_id)
   {
       return $this->where('user_id',$user_id)->orderBy('created_at','DESC')->get();
   }
   
   public function getPostCount(Int $user_id)
   {
       return $this->where('user_id',$user_id)->count();
   }
   
 }
