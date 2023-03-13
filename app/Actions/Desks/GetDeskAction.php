<?php

namespace App\Actions\Desks;

use App\Models\Desk;

class GetDeskAction
{
    public function handle($deskId)
    {
        $desk = Desk::findOrFail($deskId);
        return Desk::with('deskColumns.tasks')->find($desk->id);
    }
}
