<?php

namespace App\Actions\Tasks;

use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\Task;

class UpdateTaskAction
{
    public function handle(Task $task, $params)
    {
        if (empty($params['img_src'])) {
            return $task->update($params);
        }

        $params['img_src']->store('/images');
        $params['img_src'] = $params['img_src']->getClientOriginalName();
        return $task->update($params);
    }
}
