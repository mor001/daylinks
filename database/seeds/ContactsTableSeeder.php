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
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('contacts')->delete();

      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。まあ今に尊敬通りはどうしてもその戦争なけれなまでが去っけれどもみるないには相違現われますですて、こうには握るありでしましう。文学の進んでしのはけっして場合によくたでん。',
        'destination' => '0',
        'reply_id' => null,
        'created_at' => '2020-07-01 10:00:00',
        'updated_at' => '2020-07-01 10:00:00',
      ]);
      $lastInsertId = DB::getPdo()->lastInsertId();
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '＞あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。<br/> 返信です。',
        'destination' => '1',
        'reply_id' => $lastInsertId,
        'created_at' => '2020-07-01 11:00:00',
        'updated_at' => '2020-07-01 11:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '2度目の問合せです。',
        'destination' => '0',
        'reply_id' => $lastInsertId,
        'created_at' => '2020-07-01 12:00:00',
        'updated_at' => '2020-07-01 12:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '「2度目の問合せです。」に対する返信です。',
        'destination' => '1',
        'reply_id' => $lastInsertId,
        'created_at' => '2020-03-01 13:00:00',
        'updated_at' => '2020-03-01 13:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => 'お迎えを16:00にお願いします。よろしくお願いします。',
        'destination' => '0',
        'reply_id' => null,
        'created_at' => '2020-03-01 11:00:00',
        'updated_at' => '2020-03-01 11:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '了解しました。よろしくお願いいたします。',
        'destination' => '1',
        'reply_id' => null,
        'created_at' => '2020-03-01 12:00:00',
        'updated_at' => '2020-03-01 12:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '15:30に変更可能でしょうか？よろしくお願いします。',
        'destination' => '0',
        'reply_id' => null,
        'created_at' => '2020-03-01 16:00:00',
        'updated_at' => '2020-03-01 16:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => '15:30ですね。了解しました。',
        'destination' => '1',
        'reply_id' => null,
        'created_at' => '2020-03-01 17:00:00',
        'updated_at' => '2020-03-01 17:00:00',
      ]);
      DB::table('contacts')->insert([
        'user_id' => 2,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'お問合せのテストです。',
        'destination' => '0',
        'reply_id' => null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      $lastInsertId = DB::getPdo()->lastInsertId();
      DB::table('contacts')->insert([
        'user_id' => 2,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '返信のテストです。',
        'destination' => '1',
        'reply_id' => $lastInsertId,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('contacts')->insert([
        'user_id' => 2,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'もう一度テストです。',
        'destination' => '0',
        'reply_id' => $lastInsertId,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('contacts')->insert([
        'user_id' => 2,
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => '返信します。あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。まあ今に尊敬通りはどうしてもその戦争なけれなまでが去っけれどもみるないには相違現われますですて、こうには握るありでしましう。',
        'destination' => '1',
        'reply_id' => $lastInsertId,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
