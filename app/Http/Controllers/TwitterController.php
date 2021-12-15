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
