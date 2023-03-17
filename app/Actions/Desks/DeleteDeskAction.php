<?php

namespace App\Actions\Desks;

use App\Models\Desk;

class DeleteDeskAction
{
    public function handle(Desk $desk)
    {
        return $desk->delete();
    }
}
