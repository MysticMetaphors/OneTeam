<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
