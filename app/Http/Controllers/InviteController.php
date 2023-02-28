<?php

namespace App\Http\Controllers;

use App\Actions\Invites\AcceptInviteAction;
use App\Actions\Invites\SendInviteAction;
use App\Http\Requests\Invite\InviteStoreRequest;
use App\Mail\MailInvite;

class InviteController extends Controller
{
    public function store(InviteStoreRequest $request, $orgId, $roleId, SendInviteAction $action)
    {
        return $action->handle($request->validated(), $orgId, $roleId);
    }

    public function accept($token, AcceptInviteAction $action)
    {
        return $action->handle($token);
    }
}
