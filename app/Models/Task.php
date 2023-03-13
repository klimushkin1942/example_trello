<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'img_src', 'elapsed_time', 'desk_column_id'
    ];

    public function deskColumn() : BelongsTo
    {
        return $this->belongsTo(DeskColumn::class);
    }
}
