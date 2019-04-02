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
      DB::table('reserves')->delete();
      
      DB::table('reserves')->insert([
        'schedule_id' => 63,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 65,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 69,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'app_c',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 71,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'canceled',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
