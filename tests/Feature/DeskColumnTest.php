<?php

namespace Tests\Feature;

use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\DesksTemplates;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeskColumnTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateDeskColumn()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Тестовая',
            'description' => 'Как там и что',
        ]);

        $organization = Organization::where('name', 'Тестовая')->first();

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . "/projects", [
            'name' => 'Для колонки №1',
            'description' => 'Описание для колонки №1'
        ]);

        $project = Project::where('name', 'Для колонки №1')->first();

        $deskTemplate = DesksTemplates::findOrFail(1);

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks', [
            'desk_template_id' => $deskTemplate->id
        ]);


        $desk = Desk::where('project_id', $project->id)->first();

        $response = $this->actingAs($user)->post('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks/' . $desk->id . '/columns', [
            'desk_id' => $desk->id,
            'status' => 'Супер статус' . $desk->id
        ]);
//        dd($desk->id);
        $this->assertDatabaseHas('desk_columns', ['desk_id' => $desk->id]);

        $response->assertStatus(201);
    }

    public function  testUpdateColumn()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Тестовая',
            'description' => 'Как там и что',
        ]);

        $organization = Organization::where('name', 'Тестовая')->first();

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . "/projects", [
            'name' => 'Тестовый проект №1',
            'description' => 'Описание проекта №1'
        ]);

        $project = Project::where('name', 'Тестовый проект №1')->first();

        $deskTemplate = DesksTemplates::findOrFail(1);

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks', [
            'desk_template_id' => $deskTemplate->id
        ]);

        $desk = Desk::where('project_id', $project->id)->first();

        $deskColumn = DeskColumn::where('desk_id', $desk->id)->first();

        $response = $this->actingAs($user)->put('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks/' . $desk->id . '/columns/' . $deskColumn->id, [
            'status' => 'Супер измененный статус' . $desk->id
        ]);

        $this->assertDatabaseHas('desk_columns', ['status' => 'Супер измененный статус' . $desk->id]);

        $response->assertStatus(200);
    }

    public function testDeleteColumn()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Тестовая',
            'description' => 'Как там и что',
        ]);

        $organization = Organization::where('name', 'Тестовая')->first();

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . "/projects", [
            'name' => 'Тестовый проект №1',
            'description' => 'Описание проекта №1'
        ]);

        $project = Project::where('name', 'Тестовый проект №1')->first();

        $deskTemplate = DesksTemplates::findOrFail(1);

        $this->actingAs($user)->post('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks', [
            'desk_template_id' => $deskTemplate->id
        ]);

        $desk = Desk::where('project_id', $project->id)->first();
        $deskColumn = DeskColumn::where('desk_id', $desk->id)->where('status', 'Супер измененный статус' . $desk->id)->first();


        $response = $this->actingAs($user)->delete('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks/' . $desk->id . '/columns/' . $deskColumn->id);
        $this->assertDatabaseMissing('desk_columns', ['status' => 'Супер измененный статус' . $desk->id]);

        $response->assertStatus(200);
    }
}
