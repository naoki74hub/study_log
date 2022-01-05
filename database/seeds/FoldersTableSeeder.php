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
        $titles = ['英語','プログラミング','読書'];
        
        foreach($titles as $title) {
         DB::table('folders')->insert([
                'title' => $title,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
       }
    }
}
