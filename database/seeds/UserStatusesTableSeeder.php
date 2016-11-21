<?php

use Illuminate\Database\Seeder;

use App\UserStatus;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserStatus::class)->create([
            'name' => 'Active',
            'slug' => 'active',
        ]);

        factory(UserStatus::class)->create([
            'name' => 'Banned',
            'slug' => 'banned',
        ]);
    }
}
