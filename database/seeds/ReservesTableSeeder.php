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
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('reserves')->delete();

      DB::table('reserves')->insert([
        'schedule_id' => 123,
        'user_id' => 1,
        'leave_school_time' => '15:30',
        'status' => 'reserve',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 123,
        'user_id' => 2,
        'leave_school_time' => '15:30',
        'status' => 'reserved',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 123,
        'user_id' => 3,
        'leave_school_time' => '15:30',
        'status' => 'cancel',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('reserves')->insert([
        'schedule_id' => 71,
        'user_id' => 1,
        'leave_school_time' => '16:00',
        'status' => 'cancelled',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
