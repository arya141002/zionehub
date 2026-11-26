<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description',
        'thumbnail', 'gallery', 'demo_url', 'repo_url',
        'tech_stack', 'project_date',
        'is_featured', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'gallery' => 'array',
        'tech_stack' => 'array',
        'project_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
