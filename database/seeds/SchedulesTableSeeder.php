<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('schedules')->delete();

    $y = 2020;
    for($m = 1; $m <= 12; $m++) {
      $lastday = date('d', mktime(0, 0, 0, $m + 1, 0, $y));
      $publish = date('Y-m-d H:i:s', mktime(10, 0, 0, $m - 1, 15, $y) );
      for($i = 1; $i <= $lastday; $i++) {
        $day = date('Y-m-d', mktime(0, 0, 0, $m , $i, $y) );
        $tid = 'test1';
        DB::table('schedules')->insert([
          'tid'  => $tid,
          'date' => $day,
          'title' => $tid.': '.$day.'のイベントです。',
          'description' => $day.'のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
          'register' => 1,
          'publish' => $publish,
          'status' => 'open',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $tid = 'test2';
        DB::table('schedules')->insert([
          'tid'  => $tid,
          'date' => $day,
          'title' => $tid.': '.$day.'のイベントです。',
          'description' => $day.'のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
          'register' => 1,
          'publish' => $publish,
          'status' => 'open',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
