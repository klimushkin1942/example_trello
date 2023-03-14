<?php

namespace App\Http\Controllers;

use App\Actions\Invites\AcceptInviteOrganizationAction;
use App\Actions\Invites\AcceptInviteProjectAction;
use App\Actions\Invites\SendInviteOrganizationAction;
use App\Actions\Invites\SendInviteProjectAction;
use App\Actions\Invites\SendInviteProjectExistsUserAction;
use App\Actions\Invites\SendInviteProjectNotExistsUserAction;
use App\Http\Requests\Invite\InviteProjectStoreRequest;
use App\Http\Requests\Invite\InviteOrganizationStoreRequest;
use App\Models\Invite;

class InviteController extends Controller
{
    public function inviteToOrganization(InviteOrganizationStoreRequest $request, $orgId, $roleId, SendInviteOrganizationAction $action)
    {
        return $action->handle($request->validated(), $orgId, $roleId);
    }

    public function inviteToProjectExitsUser(InviteProjectStoreRequest $request, $orgId,
                                                                       $projectId, $roleProId, SendInviteProjectAction $action)
    {
        return $action->handle($request->validated(), $orgId, $projectId, $roleProId);
    }

    public function acceptInviteToOrganization($token, AcceptInviteOrganizationAction $action)
    {
        return $action->handle($token);
    }
}
