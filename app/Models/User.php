<?php

namespace App\Models;

use App\Notifications\PasswordResetUserNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'level',
        'total_hour',
        'self_introduction',
        'goal',
        'important_day_title',
        'important_day',
        'avatar',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * 投稿へのリレーション
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    
    /**
     * 投稿へのリレーション
     */
    public function likes()
    {
        //中間テーブルlikesは、created_atカラム、updated_atカラムを作成していないので、withTimestamps()で自動的に更新するようにする
        return $this->belongsToMany('App\Models\Post', 'likes')->withTimestamps();
    }
    
    /**
     * フォルダーへのリレーション
     */
    public function folders()
    {
        return $this->hasMany('App\Models\Folder');
    }
    
    /**
     * ユーザーへのリレーション
     */
    public function followers()
    {
       return $this->belongsToMany('App\Models\User', 'followers', 'followed_id', 'following_id');   
    }
    
    /**
     * ユーザーへのリレーション
     */
    public function follows()
    {
        return $this->belongsToMany('App\Models\User', 'followers', 'following_id', 'followed_id');
    }
    
    /**
     * フォローする
     */
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }

    /**
     * フォロー解除する
     */
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    /**
     * フォローしているかの判定
     */
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    /**
     * フォローされているかの判定
     */
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    
    /**
     * パスワード再設定メール
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetUserNotification($token));    
    }   
}

