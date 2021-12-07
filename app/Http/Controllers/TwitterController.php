<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Post;

class TwitterController extends Controller
{
    public function create()
    {
        return view('posts/twitter_create');
    }
    
    public function store(Request $request)
    { 
        // $post->title = $request->input('title');
        // $post->time = $request->input('time');
        // $post->body = $request->input('body');
        // $post->user_id = auth()->user()->id;
        // //s3アップロード開始
        // if(!empty($request->file('image_url'))) {
        // $image = $request->file('image_url');
        // // バケットの`image_url`フォルダへアップロード
        // $path = Storage::disk('s3')->putFile('image', $image, 'public');
        // // アップロードした画像のフルパスを取得
        // $post->image_url = Storage::disk('s3')->url($path);
        // }
        $twitter = new TwitterOAuth(env('TWITTER_CLIENT_ID'),
            env('TWITTER_CLIENT_SECRET'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET'));
            
        $twitter->post("statuses/update", [
            "status" =>'あ'
        ]);
            
        
        return redirect('posts/index');
    }
}
