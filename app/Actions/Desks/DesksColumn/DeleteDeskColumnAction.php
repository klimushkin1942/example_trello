<?php

namespace App\Actions\Desks\DesksColumn;

use App\Models\DeskColumn;

class DeleteDeskColumnAction
{
    public function handle(DeskColumn $column)
    {
        return $column->delete();
    }
}
