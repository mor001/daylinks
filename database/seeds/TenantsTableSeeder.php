<?php

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('tenants')->delete();

      DB::table('tenants')->insert([
        'tid'  => 'test1',
        'name' => 'テスト事業者1',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('tenants')->insert([
        'tid'  => 'test2',
        'name' => 'テスト事業者2',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
