<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * idがないため、follower_id、followed_idにプライマリーキーを付与
     */
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'following_id',
        'followed_id',
    ];
    
        
    public $timestamps = false;
    public $incrementing = false;
    
    /**
     * 自分がフォローしている人数を算出
     */
    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }
    
    /**
     * 自分のフォロワー数を算出
     */
    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }
}
