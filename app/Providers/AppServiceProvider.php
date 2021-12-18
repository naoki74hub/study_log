<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        \URL::forceScheme('https');
        //全ページで使う共通変数を定義（サイドバー）
        view()->composer('*', function ($view) 
        {
            if (Auth::check()) {
                $user = Auth::user();
                $posts2 = $user->posts;
                //総学習時間の処理
                $total_hour = 0;
                $total_minutes = 0;
                $level = 0;
                foreach ($posts2 as $post) {
                    //timeカラムの値から、「時間」の部分のみ取得し、$total_hourに足していく
                    $total_hour += substr($post->time,0,2);
                    //timeカラムの値から、「分」の部分のみ取得し、$total_hourに足していく
                    $total_minutes += substr($post->time,3,2);
                    //$total_minutesが「60」以上であれば、「時間」に+1する
                    if($total_minutes >= 60) {
                        $total_minutes = $total_minutes - 60;  
                        $total_hour ++;
                    }
                    
                    //投稿を日毎に取得し、$post_dayに代入
                    $post_day = $post::where('time', '>', 0)
                           ->Where('user_id', $user->id)
                           ->selectRaw('DATE(created_at) as date')
                           ->groupBy('date')
                           ->get()
                           ->count();
                           
                    //投稿を日毎に取得
                    $continue_days = $post::where('time', '>' , 0)
                          ->where('user_id', $user->id)
                          ->selectRaw('DATE(created_at) as date')
                          ->groupBy('date')
                          ->orderBy('date', 'desc')
                          ->get();
                    
                    //直近の投稿を取得      
                    $start = $continue_days->first() ? $continue_days->first()->date : null;
                    $start = new Carbon($start);
                    
                    // なければ継続日数0
                    if (!$start) {
                        return 0;
                    }
                    
                    // 取得したデータをループし、開始日から-1日していく
                    $result = $continue_days->filter(function ($continue_day) use ($start) {
                        // 開始日からデクリメントした日付と同じものだけフィルタリングされる
                        $r = $start->eq(new Carbon($continue_day->date));
                        $start->subDay();
                        return $r;
                    });
                }
                
                //投稿がある時
                if($posts2->count() > 0) {
                    //レベルを算出
                    $level = floor($total_hour / 10 );
                    
                    $total_time = $total_hour.'時間'.$total_minutes.'分';
                    
                    //継続日数をカウントし、$resultに代入
                    $result = $result->count().'日';
                    
                    //活動日数
                    $post_day = $post_day.'日';
                    
                    $view->with([
                        'posts2' => $posts2,
                        'total_time' => $total_time,
                        'level' => $level,
                        'post_day' => $post_day,
                        'result' => $result,
                    ]);
                
                //投稿が1つもない時
                } elseif ($posts2->count() === 0) { 
                    $level = '0';
                    $result ='0'.'日';
                    $total_time = '0'.'日';
                    $post_day = '0'.'日';
                    
                    $view->with([
                        'posts2 '=> $posts2,
                        'total_time' => $total_time,
                        'level' => $level,
                        'post_day' => $post_day,
                        'result' => $result,
                    ]);
                }
            }
        });
    }
}