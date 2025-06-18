<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tasks extends Model
{
    protected $fillable = [
        'deadline',
        'description',
        'is_deleted',
        'is_repeat',
        'issued_to',
        'priority',
        'project_id',
        'repeat_interval',
        'status',
        'title',
        'type'
    ];

    protected $with = ['subtasks', 'attachments'];

    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtasks::class, 'task_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class, 'task_id');
    }
}
