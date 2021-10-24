<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sutatuses')->insert([
            'sutatuse_name' => '導入',
            'slug' => 'introduction',
            'order' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'lesson_id' => 1,
        ]);
        DB::table('sutatuses')->insert([
            'sutatuse_name' => '展開',
            'slug' => 'development',
            'order' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'lesson_id' => 1,
        ]);
        DB::table('sutatuses')->insert([
            'sutatuse_name' => 'まとめ',
            'slug' => 'summary',
            'order' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'lesson_id' => 1,
        ]);
    }
}
