<?php

namespace App\Enums;

use App\Models\Role;
enum RoleTypes: string
{
    case ADMIN = '1';
    case USER = '2';
    case OBSERVER = '3';
}
