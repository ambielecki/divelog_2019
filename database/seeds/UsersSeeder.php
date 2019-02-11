<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new User();
        $user->email = 'ambielecki@gmail.com';
        $user->first_name = 'Andrew';
        $user->last_name = 'Bielecki';
        $user->password = Hash::make('Ch@ng3m3');
        $user->level = 1;
        $user->save();
    }
}
