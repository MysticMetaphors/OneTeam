<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'task_id',
        'name',
        'owner',
        'image',
        'description',
        'status',
        'is_deleted',
        'start_date',
        'deadline',
    ];
}
