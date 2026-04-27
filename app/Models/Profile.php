<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'headline', 'bio', 'photo', 'email', 'phone', 'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
