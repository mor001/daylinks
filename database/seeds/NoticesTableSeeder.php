<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('notices')->delete();

      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト1】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト2】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト3】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト4】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト5】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト6】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト7】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト8】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト9】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト10】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト11】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト12】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト13】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト14】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト15】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト16】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト17】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト18】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト19】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト20】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト21】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト22】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト23】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト24】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト25】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト26】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト27】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト28】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト29】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト30】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト31】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト32】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 1,
        'is_read' => false,
        'contents' => '【テスト33】XX月XX日このお知らせはテスト用です。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 2,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test1',
        'user_id' => 3,
        'is_read' => false,
        'contents' => '【全体連絡】XX月XX日はスタッフ研修の為臨時休業とさせて頂きます。ご了承ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('notices')->insert([
        'tid' => 'test2',
        'user_id' => 4,
        'is_read' => false,
        'contents' => '【テスト用】このお知らせはtest2のものです。test1で見えていないこと。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

    }
}
