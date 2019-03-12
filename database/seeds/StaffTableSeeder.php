<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('staff')->insert([
          'tid'  => 'test1',
          'userid' => 'admin',
          'name' => 'テスト1管理者',
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('aaa111'),
          'isAdmin' => '1',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('staff')->insert([
        'tid'  => 'test1',
        'userid' => 'staffa',
        'name' => 'スタッフA',
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('aaa111'),
        'isAdmin' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('staff')->insert([
        'tid'  => 'test1',
        'userid' => 'staffb',
        'name' => 'スタッフb',
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('aaa111'),
        'isAdmin' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('staff')->insert([
        'tid'  => 'test2',
        'userid' => 'admin',
        'name' => 'テスト2管理者',
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('aaa111'),
        'isAdmin' => '1',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('staff')->insert([
        'tid'  => 'test2',
        'userid' => 'staffc',
        'name' => 'スタッフC',
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('aaa111'),
        'isAdmin' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('staff')->insert([
        'tid'  => 'test2',
        'userid' => 'staffd',
        'name' => 'スタッフD',
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('aaa111'),
        'isAdmin' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
