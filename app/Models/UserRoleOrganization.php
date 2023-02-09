<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleOrganization extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'user_id',
        'role_id'
    ];
}
