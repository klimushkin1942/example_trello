<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = "Admin";
        $adminRole->slug = "admin-user";
        $adminRole->save();

        $userRole = new Role();
        $userRole->name = "User";
        $userRole->slug = "user-user";
        $userRole->save();
    }
}
