<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Administrator',
            'email' => 'informatics.uii.club@gmail.com',
            'password' => bcrypt('12345678'),
            'user_status_id' => 1,
        ]);
    }
}
