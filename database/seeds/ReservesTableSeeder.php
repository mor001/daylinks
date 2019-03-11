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
        'schedule_id' => 119,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 122,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 123,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 124,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 125,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 126,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 127,
        'user_id' => 1,
        'leave_school_time' => null,
        'status' => 'app_c',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 128,
        'user_id' => 1,
        'leave_school_time' => null,
        'status' => 'canceled',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 186,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 187,
        'user_id' => 1,
        'leave_school_time' => null,
        'status' => 'canceled',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 119,
        'user_id' => 2,
        'leave_school_time' => '15:30',
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);      
      DB::table('reserves')->insert([
        'schedule_id' => 123,
        'user_id' => 2,
        'leave_school_time' => '16:00',
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 124,
        'user_id' => 2,
        'leave_school_time' => null,
        'status' => 'app_r',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
