<?php

namespace App\Actions\Desks\DesksColumn;

use App\Models\Desk;
use App\Models\DeskColumn;

class UpdateDeskColumnAction
{
    public function handle($deskId, $deskColumnId, $credentials)
    {
        Desk::findOrFail($deskId);
        return DeskColumn::with('desks')->findOrFail($deskColumnId)->update([
            'status' => $credentials['status']
        ]);
    }
}
