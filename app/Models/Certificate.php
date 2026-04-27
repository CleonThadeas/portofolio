<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['name', 'issuer', 'date', 'description', 'file_path', 'file_type'];

    protected $casts = [
        'date' => 'date',
    ];
}
