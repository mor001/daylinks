<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
        'schedule_id'  => 119,
        'flow' => 'user_to_tenant',
        'is_read' => false,
        'contents' => 'コメントの内容です。ご確認ください。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('comments')->insert([
        'schedule_id'  => 119,
        'flow' => 'tenant_to_user',
        'is_read' => false,
        'contents' => 'コメントに対する返信です。',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
}
