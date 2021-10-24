<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'task_name' => '出欠確認',
            'time' => 3,
            'description' => '',
            'order' => 1,
            'lesson_id' => 1,
            'status_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tasks')->insert([
            'task_name' => '準備運動',
            'time' => 5,
            'description' => '怪我予防のためにしっかりと動かすよう伝える。',
            'order' => 2,
            'lesson_id' => 1,
            'status_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
