<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use App\Models\Post;
use App\User;
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
        $url->forceScheme('https');
        
        view()->composer('*', function ($view) 
        {
       
        if(Auth::check()) {
        $user = Auth::user();
        $posts = $user->posts;
        } else {
            return view('auth/login');
        }
        
        //総学習時間の処理
        $total_hour = 0;
        $total_minutes = 0;
        $level = 0;
        foreach($posts as $post) {
          $total_hour += substr($post->time,0,2);
          $total_minutes += substr($post->time,3,2);
          if($total_minutes >= 60) {
          $total_minutes = $total_minutes - 60;  
          $total_hour ++;
        }
        
        //活動日数
        $post_day = $post::where('time', '>', 0)
                 ->selectRaw('DATE(created_at) as date')
                 ->groupBy('date')
                 ->get()
                 ->count();
                 
        //継続日数
        $continue_days = $post::where('time', '>', 0)
                  ->selectRaw('DATE(created_at) as date')
                  ->groupBy('date')
                  ->orderBy('date','desc')
                  ->get();
        
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
        // $result = $result->count().'日';
        });
        
         }
         
        //レベル
        $level = 'Lv.'.floor($total_hour / 10 );
        //勉強合計時間
        $total_time = $total_hour.'時間'.$total_minutes.'分';
        // $post_day = $post_day.'日';
        $view->with([
             'total_time'=>$total_time,
             'level'=>$level,
            //  'result'=>$result,
             
             ]);
        });
            
   }
}