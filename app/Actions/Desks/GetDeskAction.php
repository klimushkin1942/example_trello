<?php

namespace App\Actions\Desks;

use App\Models\Desk;

class GetDeskAction
{
    public function handle(Desk $desk)
    {
        return $desk->with('deskColumns.tasks')->get();
    }
}
