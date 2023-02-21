<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_organizations');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects');
    }

    public function users_roles_organizations()
    {
        return $this->belongsToMany(UsersRolesOrganizations::class);
    }
}
