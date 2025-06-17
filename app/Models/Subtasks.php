<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subtasks extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'title', 'is_completed'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Tasks::class);
    }
}
