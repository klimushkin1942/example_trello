<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeskColumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'desk_id',
        'status',
    ];

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function desks()
    {
        return $this->belongsTo(Desk::class);
    }
}
