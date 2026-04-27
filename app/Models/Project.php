<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'tech_stack',
        'thumbnail', 'demo_link', 'repo_link', 'is_published', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
