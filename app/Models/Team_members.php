<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team_members extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'is_deleted',
    ];
}
