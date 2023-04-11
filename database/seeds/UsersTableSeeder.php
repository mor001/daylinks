<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('users')->delete();

      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'muto',
          'name' => '武藤 愛莉',
          'kana' => 'むとうあいり',
          'parents' => '武藤 敬司',
          'parents_kana' => 'むとうけいじ',
          'email' => 'mor001@yahoo.co.jp',
          'password' => bcrypt('aaa111'),
          'usernote' => 'XX小学校5年\nアレルギー:たまご、そば',
          'tenantnote' => 'アレルギー持ちの為、たまご、そばは厳禁',
          'limit' => 23,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'chono',
          'name' => '蝶野 正洋',
          'kana' => 'ちょうのまさひろ',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'limit' => -8,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'hashimoto',
          'name' => '橋本 真也',
          'kana' => 'はしもとしんや',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'limit' => 20,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test2',
          'userid' => 'misawa',
          'name' => '三沢 光晴',
          'kana' => 'みさわみつはる',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'limit' => 23,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
