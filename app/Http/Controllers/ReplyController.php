<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function create(Comment $comment)
    {
        return view('replies/create', compact('comment'));
    }
    
    public function store(CommentRequest $request, Comment $comment, Reply $reply)
    {
       $reply->reply = $request->input('reply');
       $reply->user_id = auth()->user()->id;
       $reply->comment_id = $comment->id;
       $reply->save();
       
       return redirect()->route('posts.show');
    }
}
