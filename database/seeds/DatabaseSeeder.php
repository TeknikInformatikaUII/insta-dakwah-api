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
        \Illuminate\Support\Facades\Artisan::call('bouncer:seed');

        $this->call(UserStatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
