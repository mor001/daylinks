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
        $y = 2018;
        $m = 12;
        $lastday = date('d', mktime(0, 0, 0, $m + 1, 0, $y)); 

        for($i = 1; $i <= $lastday; $i++)
        {
            $day = date('Y-m-d', mktime(0, 0, 0, $m , $i, $y) );
            DB::table('schedules')->insert([
              'tid'  => 'test1',
              'date' => $day,
              'title' => 'test1: '.$day.'のイベントです。',
              'description' => $day.'のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
              'register' => 1,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]);
            DB::table('schedules')->insert([
              'tid'  => 'test2',
              'date' => $day,
              'title' => 'test2: '.$day.'のイベントです。',
              'description' => $day.'のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
              'register' => 1,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
/*
        DB::table('schedules')->insert([
          'tid'  => 'test1',
          'date' => '2018-04-01',
          'title' => '04/01のイベントです。',
          'description' => '04/01のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
          'register' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('schedules')->insert([
          'tid'  => 'test1',
          'date' => '2018-04-02',
          'title' => '04/02のイベントです。',
          'description' => '04/02のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
          'register' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('schedules')->insert([
          'tid'  => 'test1',
          'date' => '2018-04-03',
          'title' => '04/03のイベントです。',
          'description' => '04/03のイベントの説明文が入ります。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。',
          'register' => 1,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
*/

    }
}
