<?php

namespace App\Actions\Desks\DesksColumn;

use App\Models\Desk;
use App\Models\DeskColumn;

class UpdateDeskColumnAction
{
    public function handle(DeskColumn $column, $params)
    {
        return DeskColumn::with('desks')->findOrFail($column->id)->update([
            'status' => $params['status']
        ]);
    }
}
