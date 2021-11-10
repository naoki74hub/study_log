<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            
            [
                'title'=>'タイトル1',
                'body'=>'２時間やり切りました',
                'user_id'=> 1,
                'created_at'=> now(),
                'image_url'=>'text.jpg',
            ],[
                'title'=>'タイトル2',
                'body'=>'オブジェクト指向難しいですね笑',
                'created_at'=>now(),
                'user_id'=> 2,
                'image_url'=>null,
                
            ]
            
        ]);
    }
}
