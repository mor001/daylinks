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
        'schedule_id' => 15,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('reserves')->insert([
        'schedule_id' => 17,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('reserves')->insert([
        'schedule_id' => 19,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'accept',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('reserves')->insert([
        'schedule_id' => 20,
        'user_id' => 1,
        'leave_school_time' => null,
        'status' => 'cancel',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
