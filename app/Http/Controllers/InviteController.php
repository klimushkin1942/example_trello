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
use App\Models\Organization;
use App\Models\Project;

class InviteController extends Controller
{
    public function inviteToOrganization(InviteOrganizationStoreRequest $request, Organization $org, $roleId, SendInviteOrganizationAction $action)
    {
        $this->authorize('can-invite-users-to-organization', [Invite::class, $org]);
        return $action->handle($request->validated(), $org, $roleId);
    }

    public function inviteToProjectExitsUser(InviteProjectStoreRequest $request, Organization $org,
                                                                       Project $project, $roleProId, SendInviteProjectAction $action)
    {
        $this->authorize('can-invite-users-to-project', [Invite::class, $org, $project]);
        return $action->handle($request->validated(), $org, $project, $roleProId);
    }

    public function acceptInviteToOrganization($token, AcceptInviteOrganizationAction $action)
    {
        return $action->handle($token);
    }
}
