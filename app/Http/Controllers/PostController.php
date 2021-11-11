<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;

use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class,'post');
    }
    
   //index
   public function index()
    {
       $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
     }
    
    
    //create
    public function create()
    {
        return view('posts.create');
    }
    
    //store
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
    
    
    //edit
    public function edit(Post $post)
    {
        return view('posts/edit',['post'=>$post]);
    }
    
    
    //update
    public function update(PostRequest $request,Post $post)
    {
        $post->fill($request->all())->save();
        return redirect('posts/index');
    }
    
    
    //destroy
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts/index');
    }
}
