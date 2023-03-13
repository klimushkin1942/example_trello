<?php

namespace App\Actions\Desks;

use App\Models\Desk;

class DeleteDeskAction
{
    public function handle($deskId)
    {
        return Desk::destroy($deskId);
    }
}
