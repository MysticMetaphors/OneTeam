<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'issued_to',
        'title',
        'description',
        'action',
        'deadline',
        'priority',
        'status',
        'is_deleted',
    ];
}
