<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'reply',
        'user_id',
        'comment_id',
        ];
    
    /**
     * コメントへのリレーション
     */
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }
    
    /**
     * ユーザーへのリレーション
     */
    public function user()
    {
        return $this->belongsTo('App\Modles\User');
    }
}
