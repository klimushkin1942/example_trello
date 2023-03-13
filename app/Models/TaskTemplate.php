<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'img_src', 'elapsed time', 'desk_column_template_id'
    ];
}
