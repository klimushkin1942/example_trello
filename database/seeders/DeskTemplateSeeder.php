<?php

namespace Database\Seeders;

use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\DeskColumnsTemplates;
use App\Models\DesksTemplates;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskTemplate;
use Illuminate\Database\Seeder;

class DeskTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for ($indexDesk = 0; $indexDesk < 3; $indexDesk++) {
            $countColumns = rand(1, 6);
            $deskTemplate = DesksTemplates::create([
                'name' => 'Шаблон №' . $indexDesk
            ]);

            for ($i = 0; $i < $countColumns; $i++) {
                $deskColumnTemplate = DeskColumnsTemplates::create([
                    'desk_template_id' => $deskTemplate->id,
                    'status' => 'Колонка №' . $i,
                ]);

                $countTasks = rand(1, 5);

                for($j = 0; $j < $countTasks; $j++) {
                    TaskTemplate::create([
                        'title' => 'Название задания №' . $j,
                        'description' => 'Описание для задания №' . $j,
                        'img_src' => '/root/img_' . $j . '.jpg',
                        'elapsed_time' => rand(1, 90),
                        'desk_column_template_id' => $deskColumnTemplate->id
                    ]);
                }
            }
        }
    }
}
