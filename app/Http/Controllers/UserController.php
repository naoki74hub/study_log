<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use DateTime;
use App\Models\Follower;
use Storage;

class UserController extends Controller
{
    public function store(UserRequest $request, User $user)
    {
        $user = Auth::user();
        $user->self_introduction = $request->input('self_introduction');
        $user->goal = $request->input('goal');
        $user->important_day_title = $request->input('important_day_title');
        $user->important_day = $request->input('important_day');
        
        //s3アップロード開始
        if(!empty($request->file('avatar'))) {
           $image = $request->file('avatar');
           // バケットの`image_url`フォルダへアップロード
           $path = Storage::disk('s3')->putFile('image', $image, 'public');
           // アップロードした画像のフルパスを取得
           $user->avatar = Storage::disk('s3')->url($path);
        }
        
        $user->save();
        
        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Post $post, Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        //自分の投稿のみプロフィール画面に表示
        $timelines = $post->getUserTimeLine($user->id);
        //投稿数を算出し、$post_countに代入
        $post_count = $post->getPostCount($user->id);
        //フォローしている人数を算出し、$follow_countに代入
        $follow_count = $follower->getFollowCount($user->id);
        //フォロワーの人数を算出し、$follower_countに代入
        $follower_count = $follower->getFollowerCount($user->id);
        $important_day_title = $user->important_day_title;
        
        $important_day = new DateTime($user->important_day);
        //現在の日時を取得し、$todayに代入
        $today = new DateTime('now');
        //現在の日時から、important_dayで設定した日時までの差分を求め、$diffに代入
        $diff = $today->diff($important_day);
        //日付の差分のみ求めて、$count_downに代入
        $count_down = $diff->days;
        
        return view('users/show', compact([
            'user',
            'is_following',
            'is_followed',
            'timelines',
            'post_count', 
            'follow_count',
            'follower_count',
            'important_day_title',
            'important_day',
            'count_down',
            ])
        );
    }
    
    public function create(User $user)
    {
        $this->authorize('update', $user);
        
        return view('users/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        
        return view('users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user = Auth::user();
        $user->self_introduction = $request->input('self_introduction');
        $user->goal = $request->input('goal');
        $user->important_day_title = $request->input('important_day_title');
        $user->important_day = $request->input('important_day');
          //s3アップロード開始
        if(!empty($request->file('avatar'))) {
           $image = $request->file('avatar');
           // バケットの`image_url`フォルダへアップロード
           $path = Storage::disk('s3')->putFile('image', $image, 'public');
           // アップロードした画像のフルパスを取得
           $user->avatar = Storage::disk('s3')->url($path);
        }
        
        $user->save();
        
        return redirect()->route('users.show', ['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    
    public function followings(Follower $follower, User $user)
    {
        $follow_count = $follower->getFollowCount($user->id);
        $user = User::where('name', $user->name)->first();
        $post = $user->id;
        $followings = $user->follows->sortByDesc('created_at');
        $self_introdunction = $user->self_introduction;
        
        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
            'post' => $post,
            'self_introduction' => $self_introdunction,
            'follow_count' => $follow_count,
        ]);
    }
    
    public function followers(User $user, Follower $follower)
    {
        $follower_count = $follower->getFollowerCount($user->id);
        $user = User::where('name', $user->name)->first();
        $followers = $user->followers->sortByDesc('created_at');
        
        return view('users.followers', compact('user', 'followers', 'follower_count'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if (!$is_following) {
            //フォローしていなければフォローする
            $follower->follow($user->id);
            
            return back();
        }
    }  
    
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            //フォローしていればフォロー解除する
            $follower->unfollow($user->id);
            
            return back();
        }
    }
}
