<?php

namespace App\Actions\Desks;

use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\DeskColumnsTemplates;
use App\Models\DesksTemplates;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskTemplate;

class CreateDeskAction
{
    public function handle($projectId, $deskId)
    {
        $deskTemplate = DesksTemplates::findOrFail($deskId);
        $project = Project::findOrFail($projectId);
        $newDesk = Desk::create([
            'name' => $deskTemplate->name,
            'project_id' => $project->id,
        ]);

        $deskColumnsTemplates = DeskColumnsTemplates::where('desk_template_id', $deskTemplate->id)->get();
        foreach ($deskColumnsTemplates as $deskColumnTemplates) {
            $newDeskColumn = DeskColumn::create([
                'status' => $deskColumnTemplates->status,
                'desk_id' => $newDesk->id
            ]);
            $taskTemplates = TaskTemplate::where('desk_column_template_id', $newDeskColumn->id)->get();
            foreach ($taskTemplates as $taskTemplate) {

                Task::create([
                    'title' => $taskTemplate->title,
                    'description' => $taskTemplate->description,
                    'img_src' => $taskTemplate->img_src,
                    'elapsed_time' => $taskTemplate->elapsed_time,
                    'desk_column_id' => $newDeskColumn->id
                ]);
            }
        }

    }
}
