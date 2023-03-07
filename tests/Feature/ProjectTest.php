<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function test_post_create_project()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Привет, что-то там...',
            'description' => 'Как там и что',
        ]);

        $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Привет, что-то там...',
            'description' => 'Как там и что',
        ]);

        $organization = User::find($user->id)->organizations()->first();

        $response = $this->actingAs($user)->post('/api/organizations/' . $organization->id . "/projects", [
            'name' => 'Название проекта №1',
            'description' => 'Описание проекта №1'
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'Название проекта №1',
            'description' => 'Описание проекта №1'
        ]);

        return $response->assertStatus(201);
    }

    public function test_get_all_projects()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $organization = User::find($user->id)->organizations()->first();

        $response = $this->actingAs($user)->json('GET', '/api/organizations/' . $organization->id . '/projects',
            ['limit' => 5, 'offset' => 0]);

        return $response->assertStatus(200);
    }

    public function test_get_one_project()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $organization = User::find($user->id)->organizations()->first();

        $project = Project::where('organization_id', $organization->id)->first();

        $response = $this->actingAs($user)->get('/api/organizations/' .
            $organization->id . "/projects/" . $project->id);

        $this->assertDatabaseHas('projects',['id' => $project->id]);
        return $response->assertStatus(200);
    }

    public function test_put_update_project()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $organization = User::find($user->id)->organizations()->first();

        $project = Project::where('organization_id', $organization->id)->first();

        $response = $this->actingAs($user)->put('/api/organizations/'
            . $organization->id . "/projects/" . $project->id, [
                'name' => 'Обновленное название проекта №1',
                'description' => 'Обновленное описание проекта №1'
        ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Обновленное название проекта №1',
            'description' => 'Обновленное описание проекта №1'
        ]);
        return $response->assertStatus(200);
    }

    public function test_delete_project()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $organization = User::find($user->id)->organizations()->first();

        $project = Project::where('organization_id', $organization->id)->first();

        $response = $this->actingAs($user)->delete('/api/organizations/'
            . $organization->id . "/projects/" . $project->id);

        $response->assertStatus(200);
        return $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
