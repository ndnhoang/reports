<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Role;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_sadmin = Role::where('name', 'sadmin')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $admin = new Admin;
        $admin->name = 'Super Admin';
        $admin->username = 'sadmin';
        $admin->password = Hash::make('sadmin');
        $admin->save();
        $admin->roles()->attach($role_sadmin);

        $admin = new Admin;
        $admin->name = 'Admin';
        $admin->username = 'admin';
        $admin->password = Hash::make('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
