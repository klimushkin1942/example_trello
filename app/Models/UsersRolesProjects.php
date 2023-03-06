<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class UsersRolesProjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'organization_id',
        'project_id',
        'role_id'
    ];
}
