<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'owner';
        $role->description = 'Owner';
        $role->grant_name = 'ROLE_OWNER';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->grant_name = 'ROLE_ADMIN';
        $role->save();

        $role = new Role();
        $role->name = 'client';
        $role->grant_name = 'ROLE_CLIENT';
        $role->description = 'Client';
        $role->save();
    }
}
