<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = 'sadmin';
        $role->description = 'Super Admin';
        $role->save();

        $role = new Role;
        $role->name = 'admin';
        $role->description = 'Admin';
        $role->save();
    }
}
