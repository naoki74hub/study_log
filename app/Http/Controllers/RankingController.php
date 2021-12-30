<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index(User $user, Post $post)
    {
        $user_rankings = User::orderBy('total_hour', 'DESC')->take(100)->get();
        
        return view('ranking/user_ranking', compact('user_rankings'));
    }
}
    
