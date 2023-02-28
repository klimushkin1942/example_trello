<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
//        $organizations = Organization::factory(10)->create();
//        $users = User::factory(10)->create();
//
//        foreach ($organizations as $organization) {
//            $orgIds = $organizations->random()->pluck('id');
//            $organization->users()->attach($orgIds);
//        }
    }
}
