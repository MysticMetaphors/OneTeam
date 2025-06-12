<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'made_by',
        'title',
        'description',
        'action',
        'type',
        'is_deleted',
    ];
}
