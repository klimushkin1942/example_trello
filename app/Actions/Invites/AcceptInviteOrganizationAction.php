<?php

namespace App\Actions\Invites;
use App\Models\Invite;
use App\Models\User;
class AcceptInviteOrganizationAction
{
    public function handle($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        $user = User::where('email', $invite->email)->firstOrFail();

        $invite->delete();
        return [
            'token' => $user->createtoken('token')->plainTextToken
        ];
    }
}
