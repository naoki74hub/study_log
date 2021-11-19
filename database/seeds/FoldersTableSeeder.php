<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends seeder


{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $titles = ['英語', '仕事', 'プログラミング'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
