<?php

namespace App\Actions\Tasks;

use App\Models\DeskColumn;
use App\Models\Desk;

class CreateTaskAction
{
    public function handle(Desk $desk, DeskColumn $column, $params)
    {
        if (empty($params['img_src'])) {
            $params['img_src'] = '/storage/app/public/images/123.jpg';
        }

        $params['img_src']->store('/images');
        $params['img_src'] = $params['img_src']->getClientOriginalName();

        return $desk->tasks()->create([
            'title' => $params['title'],
            'description' => $params['description'],
            'img_src' => $params['img_src'],
            'elapsed_time' => $params['elapsed_time'],
            'desk_column_id' => $column->id
        ]);
    }
}
