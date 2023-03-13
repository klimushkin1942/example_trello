<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Project;
use App\Models\UsersOrganizations;
use App\Models\UsersRolesOrganizations;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\RoleTypes;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Артемий',
            'email' => 'muhammed1942ali@gmail.com',
            'password' => 'klimushkin1942'
        ]);

        $organization = User::findOrFail($user->id)->organizations()->create([
            'name' => 'Организация',
            'description' => 'Описание'
        ]);

        $project = Project::create([
            'organization_id' => $organization->id,
            'name' => 'Проект №' . $user->id,
            'description' => 'Описание №' . $user->id
        ]);



        UsersRolesOrganizations::create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role_id' => RoleTypes::ADMIN->value
        ]);
    }
}
