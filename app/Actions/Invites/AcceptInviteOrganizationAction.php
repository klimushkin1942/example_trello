<?php

namespace App\Actions\Invites;
use App\Models\Invite;
use App\Models\User;
class AcceptInviteOrganizationAction
{
    public function handle($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            abort(404);
        }

        $user = User::where('email', $invite->email)->first();

        $invite->delete();
        return [
            'token' => $user->createtoken('token')->plainTextToken
        ];
    }
}
