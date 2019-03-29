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
        $admin = new User;
        $admin->name = 'Hoang Nguyen';
        $admin->username = 'admin';
        $admin->password = Hash::make('admin');
        $admin->save();
    }
}
