<?php

namespace App\Actions\Desks\DesksColumn;

use App\Models\DeskColumn;
use App\Models\Desk;

class DeleteDeskColumnAction
{
    public function handle($deskId, $deskColumnId)
    {
        $desk = Desk::findOrFail($deskId);
        return DeskColumn::destroy($deskColumnId);
    }
}
