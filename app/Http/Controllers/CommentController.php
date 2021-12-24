<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $q = $request->query();
        
        return view('comments/create', [
           'post_id' => $q['post_id'],
            ]);
    }
    
    public function store(CommentRequest $request, Comment $comment)
    {
        //コメント送信時に、コメントモデル内の$fillableの値を取得し、$inputに代入
        $input = $request->only($comment->getfillable());
        $comment->fill($input);
        $comment->save();
        
        return redirect()->route('posts.show', ['post' => $comment->post->id]);
    }
    
    public function edit(Comment $comment)
    {
        return view('comments/edit', compact('comment'));
    } 
    
    public function update(CommentRequest $request, Comment $comment, Post $post)
    {
        $comment->comment = $request->input('comment');
        $comment->save();
        
        return redirect()->route('posts.show', ['post' => $comment->post->id]);
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        return redirect()->route('posts.show', ['post' => $comment->post->id]); 
    }
}
