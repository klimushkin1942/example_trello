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
        $readOrganizations = new Permission();
        $readOrganizations->name = "Read organizations";
        $readOrganizations->slug = "read-organizations";
        $readOrganizations->save();

        $deleteOrganizations = new Permission();
        $deleteOrganizations->name = "Delete organizations";
        $deleteOrganizations->slug = "delete-organizations";
        $deleteOrganizations->save();

        $createOrganizations = new Permission();
        $createOrganizations->name = "Create organizations";
        $createOrganizations->slug = "create-organizations";
        $createOrganizations->save();
    }
}
