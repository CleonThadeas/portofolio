<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'type', 'date', 'description', 'documentation', 'is_featured'];

    protected $casts = [
        'date' => 'date',
        'documentation' => 'array',
        'is_featured' => 'boolean',
    ];
}
