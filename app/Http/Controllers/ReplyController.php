<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class ReplyController extends Controller
{
    public function create(Comment $comment)
    {
        return view('replies/create', ['comment'=>$comment]);
    }
    
    public function store()
    {
        $reply->reply = $request->input('reply');
        $reply->save();
    }
}
