<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => 'あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。まあ今に尊敬通りはどうしてもその戦争なけれなまでが去っけれどもみるないには相違現われますですて、こうには握るありでしましう。文学の進んでしのはけっして場合によくたでん。',
        'created_at' => '2019-03-01 10:00:00',
        'updated_at' => '2019-03-01 10:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => 'お迎えを16:00にお願いします。よろしくお願いします。',
        'created_at' => '2019-03-01 11:00:00',
        'updated_at' => '2019-03-01 11:00:00',
      ]);
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '了解しました。よろしくお願いいたします。',
        'created_at' => '2019-03-01 12:00:00',
        'updated_at' => '2019-03-01 12:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '15:30に変更可能でしょうか？よろしくお願いします。',
        'created_at' => '2019-03-01 16:00:00',
        'updated_at' => '2019-03-01 16:00:00',
      ]);
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '15:30ですね。了解しました。',
        'created_at' => '2019-03-01 17:00:00',
        'updated_at' => '2019-03-01 17:00:00',
      ]);
      /*
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'お問合せのテストです。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '返信のテストです。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'もう一度テストです。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('replies')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '返信します。あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。まあ今に尊敬通りはどうしてもその戦争なけれなまでが去っけれどもみるないには相違現われますですて、こうには握るありでしましう。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      */
    }
}
