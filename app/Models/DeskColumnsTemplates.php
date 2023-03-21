<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskColumnsTemplates extends Model
{
    use HasFactory;

    protected $fillable = [
        'desk_template_id',
        'status',
    ];
}
