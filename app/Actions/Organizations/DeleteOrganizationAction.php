<?php

namespace App\Actions\Organizations;

use App\Models\Organization;

class DeleteOrganizationAction
{
    public function handle($id)
    {
        return Organization::destroy($id);
    }
}
