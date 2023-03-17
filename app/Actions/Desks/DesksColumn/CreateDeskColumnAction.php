<?php

namespace App\Actions\Desks\DesksColumn;

use App\Models\Desk;
use App\Models\DeskColumn;

class CreateDeskColumnAction
{
    public function handle(Desk $desk)
    {
        return DeskColumn::with('desks')->where('desk_id', $desk->id)->create([
            'desk_id' => $desk->id,
            'status' => 'Супер статус' . $desk->id
        ]);
    }
}
