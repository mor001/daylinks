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
      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'muto',
          'name' => '武藤 敬司',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'chono',
          'name' => '蝶野 正洋',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test1',
          'userid' => 'hashimoto',
          'name' => '橋本 真也',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'tid'  => 'test2',
          'userid' => 'misawa',
          'name' => '三沢 光晴',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa222'),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
