<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '了解しました。よろしくお願いいたします。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('replies')->insert([
        'user_id' => 2,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('replies')->insert([
        'user_id' => 3,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
