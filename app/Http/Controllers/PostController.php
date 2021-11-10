<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;

use App\Models\Post;

class PostController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
     }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('posts.create');
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->time = $request->input('time');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        if(request('image_url')){
            $filename=request()->file('image_url')->getClientOriginalName();
            $inputs['image_url']=request('image_url')->storeAs('public/images', $filename);
        }
 
        $post->save();
        
        return redirect('posts/index');
        
    }

}
