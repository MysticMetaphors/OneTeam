<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'issued_to',
        'title',
        'description',
        'priority',
        'status',
        'is_deleted',
        'deadline'
    ];
}
