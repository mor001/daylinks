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
        'schedule_id'  => null,
        'is_read' => false,
        'contents' => 'あなたは絶対ちょうど同じ授業論とかいうののためがなっなない。まあ今に尊敬通りはどうしてもその戦争なけれなまでが去っけれどもみるないには相違現われますですて、こうには握るありでしましう。文学の進んでしのはけっして場合によくたでん。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('contacts')->insert([
        'user_id' => 1,
        'schedule_id'  => 119,
        'is_read' => false,
        'contents' => 'お迎えを16:00にお願いします。よろしくお願いします。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
