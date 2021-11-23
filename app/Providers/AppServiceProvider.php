<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\UrlGenerator;

use App\Models\Post;

use App\Models\Folder;

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
            {
        $url->forceScheme('https');
    }
         
    //      view()->composer('*', function ($view) 
    //      {
    //       $url->forceScheme('https');
    //       $user = Auth::user();
    //       $view->with('user', $user );    
         
         
        // if (Schema::hasTable('profiles')) {
        //     $profiles = Profile::all();
        //     foreach($profiles as $profile) {
        //         $profile = $profile->user_id;
        //     }
        //     view()->share('profile', $profile);
        // }
    //   //compose all the views....
    //      view()->composer('*', function ($view) 
    // {
    //     $total_time = 0;
    //     $total_hour = 0;
    //     $total_minutes = 0;
    //     $user = Auth::user();
        
    //     $posts = $user->posts;
        
    //     foreach($posts as $post) {
    //       $total_hour += $post->time;
                    
    //     }
    //     dd($total_hour);
    //     $array = [1,2,3,4,5,6,7,8,9,10];
    //     $sum = 0;
    //     foreach($array as $number) {
          
    //       $sum += $number;
    //     }
        
        
    //     $view->with('total_time', $total_time );    
    // });  
    
    }
    
}