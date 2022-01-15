<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        //likesテーブルに、いいねしたユーザーのidを保存
        $post->likes()->attach(Auth::id());
        
        return back();
    }
    
    public function destroy(Post $post)
    {
        //likesテーブルから、いいねを解除したユーザーのidを削除
        $post->likes()->detach(Auth::id());
        
        return back();
    }
}

