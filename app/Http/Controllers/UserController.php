<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Models\Post;

use App\Models\Follower;

use App\Models\Profile;

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
          $user_profile = $user;
          return view('users/create',compact('user_profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, Profile $profile)
    {
        $profile->self_introduction = $request->input('self_introduction');
        $profile->goal = $request->input('goal');
        $profile->user_id = $request->user()->id;
        $profile->save();
        
        return redirect()->route('users.show',['user'=>$profile->user_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileRequest $request, User $user,Post $post,Follower $follower)
    {
        $user = Auth::user();
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $post->getUserTimeLine($user->id);
        $post_count = $post->getPostCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        
        
        return view('users.show',compact([
            'user',
            'is_following',
            'is_followed',
            'timelines',
            'post_count', 
            'follow_count',
            'follower_count',
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
    public function update(ProfileRequest $request, User $user,Profile $profile)
    {
         $profile->user_id = $request->user()->id;
         $profile->fill($request->all())->save();
         
         return redirect('users.show',['user'=>$user->profile->user_id]);
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
}
