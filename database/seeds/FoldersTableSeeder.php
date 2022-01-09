<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first(); // ★
        $titles = ['タイトル'];
        
        foreach($titles as $title) {
         DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
       }
    }
}
