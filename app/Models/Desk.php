<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'name', 'id'
    ];

    public function deskColumns() : HasMany
    {
        return $this->hasMany(DeskColumn::class);
    }

    public function tasks() : HasManyThrough
    {
        return $this->hasManyThrough(Task::class, DeskColumn::class);
    }
}
