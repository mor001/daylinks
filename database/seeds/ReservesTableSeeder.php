<?php

use Illuminate\Database\Seeder;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('reserves')->insert([
        'tid'  => 'test1',
        'schedule_id' => 15,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('reserves')->insert([
        'tid'  => 'test1',
        'schedule_id' => 17,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => '2',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('reserves')->insert([
        'tid'  => 'test1',
        'schedule_id' => 19,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => '2',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
