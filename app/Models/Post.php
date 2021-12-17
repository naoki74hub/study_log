<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'time',
        'body',
        'image_url',
    ];

    /**
     * ユーザーへのリレーション
     */ 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * タグへのリレーション
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    /**
     * ユーザーへのリレーション
     */
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }
    
    /**
     * コメントへのリレーション
     */
    public function comments()
   {
       return $this->hasMany('App\Models\Comment', 'post_id', 'id');
   }
   
   /**
    * 自分の投稿のみプロフィール画面に表示
    */
   public function getUserTimeLine($user_id)
   {
       return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
   }
   
   /**
    * 自分の投稿数を算出
    */
   public function getPostCount(Int $user_id)
   {
       return $this->where('user_id', $user_id)->count();
   }
}
