<?php

namespace App\Actions\Users;
use App\Models\User;
class GetAllUserAction
{
    public function handle()
    {
        return User::orderBy('created_at', 'asc')
            ->limit(5)
            ->get();
    }
}
