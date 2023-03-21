<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Organization;
use App\Models\Project;
use App\Models\DesksTemplates;
use App\Models\Desk;

class DeskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateDesk()
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

        $response = $this->actingAs($user)->post('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks', [
            'desk_template_id' => $deskTemplate->id
        ]);

        $this->assertDatabaseHas('desks', [
            'name' => 'Шаблон №0',
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteDesk()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $organization = Organization::where('name', 'Тестовая')->first();

        $project = Project::where('name', 'Тестовый проект №1')->first();

        $desk = Desk::where('project_id', $project->id)->first();

        $response = $this->actingAs($user)->delete('/api/organizations/' . $organization->id . '/projects/' . $project->id . '/desks/' . $desk->id);

        $response->assertStatus(200);
        return $this->assertDatabaseMissing('desks', ['id' => $desk->id]);
    }
}
