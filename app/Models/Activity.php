<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'type', 'date', 'description', 'documentation'];

    protected $casts = [
        'date' => 'date',
        'documentation' => 'array',
    ];
}
