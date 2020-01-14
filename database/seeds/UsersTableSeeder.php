<?php

use App\User;
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
        $user = [
            'username'      => 'admin',
            'password'  => app('hash')->make('12345'),
        ];

        User::create($user);
    }
}
