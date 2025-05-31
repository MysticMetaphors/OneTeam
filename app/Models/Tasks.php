<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'issued_to',
        'description',
        'priority',
        'status',
        'is_deleted',
        'deadline',
        'title',
    ];
}
