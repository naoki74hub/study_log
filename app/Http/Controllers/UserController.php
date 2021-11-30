<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Post;
use DateTime;
use App\Models\Follower;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $user = Auth::user();
        $user->self_introduction = $request->input('self_introduction');
        $user->goal = $request->input('goal');
        $user->important_day_title = $request->input('important_day_title');
        $user->important_day = $request->input('important_day');
        $user->save();
        return redirect()->route('users.show',['user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Post $post,Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $post->getUserTimeLine($user->id);
        $post_count = $post->getPostCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        
        $important_day_title = $user->important_day_title;
        //カウントダウン
        $important_day = new DateTime($user->important_day);
        $today = new DateTime('now');
        //差分を求める
        $diff = $today->diff($important_day);
        //日
        $count_down = $diff->days;
        
        return view('users/show',compact([
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         return view('users/edit',['user'=>$user]);
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
        $user->save();
        return redirect()->route('users.show',['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();
        $post = $user->id;
        $followings = $user->follows->sortByDesc('created_at');
        $self_introdunction = $user->self_introduction;
        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
            'post'=>$post,
            'self_introduction'=>$self_introdunction,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();
        $followers = $user->followers->sortByDesc('created_at');
        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }
    
    //フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        //フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
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
        if($is_following) {
            //フォローしていればフォロー解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
    
}
