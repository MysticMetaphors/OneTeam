<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'task_id',
        'issued_to',
        'content',
        'read_at',
        'updated_at',
        'is_deleted',
    ];
}
