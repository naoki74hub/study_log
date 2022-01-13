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
        //総勉強時間の取得
        $user_rankings = User::orderBy('total_hour', 'DESC')->take(100)->get();
        //今月の最初の日を取得
        $dt_from = new \Carbon\Carbon();
        $dt_from->startOfMonth();
		
		//今月の最後の日を取得
		$dt_to = new \Carbon\Carbon();
		$dt_to->endOfMonth();
		
		//今月のデータのみ取得
		$user_month_rankings = User::orderBy('total_hour', 'DESC')->whereBetween('created_at', [$dt_from, $dt_to])->take(100)->get();
		
		return view('ranking/user_ranking', compact('user_rankings', 'user_month_rankings'));
    }
}
    
