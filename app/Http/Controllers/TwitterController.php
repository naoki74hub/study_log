<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Post;
use App\Models\User;

class TwitterController extends Controller
{
    public function redirectToProvider() {
        return Socialite::driver('twitter')->redirect();
    }
 
    public function handleProviderCallback() {
        try {
            $twitterUser=Socialite::with('twitter')->user();
        }catch (Exception $e) {
            return redirect('login/twitter');
        }
 
        $user=User::where('twitter', $twitterUser->id)->first();
 
        if($user) {
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->update();
        }else {
            $user=New User();
            $user->twitter = $twitterUser->id;
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->save();
        }
 
        Auth::login($user);
        return redirect()->to('/home');
    }
    
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
