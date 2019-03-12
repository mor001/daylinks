<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TenantsTableSeeder::class,
            UsersTableSeeder::class,
            StaffTableSeeder::class,
            HolidaysTableSeeder::class,
            SchedulesTableSeeder::class,
            ReservesTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
}
