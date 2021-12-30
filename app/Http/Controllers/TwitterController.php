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
        $twitter = new TwitterOAuth(config('services.twitter.client_id'),
            config('services.twitter.client_secret'),
            config('services.twitter.client_id_access_token'),
            config('services.twitter.client_id_access_token_secret'));
        $twitter->post("statuses/update", [
            "status" =>'あ'
        ]);
        
        return redirect()->route('posts.index');
    }
}
