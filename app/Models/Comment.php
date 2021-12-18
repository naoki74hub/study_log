<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];
    
    /**
     * ユーザーへのリレーション
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    /**
     * 投稿へのリレーション
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
    
    /**
     * コメントへのリレーション
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    /**
     * コメントへのリレーション
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }
}
