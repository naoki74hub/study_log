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
        return $this->belongsTo('App\User');
    }
    
    
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    
    
    //後でViewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool 
    {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
   public function comments()
   {
       return $this->hasMany('App\Models\Comment','post_id','id');
   }

}
