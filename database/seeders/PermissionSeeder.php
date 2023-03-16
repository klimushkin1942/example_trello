<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'show organizations']);
        Permission::create(['name' => 'add organizations']);
        Permission::create(['name' => 'edit organizations']);
        Permission::create(['name' => 'delete organizations']);
    }
}
