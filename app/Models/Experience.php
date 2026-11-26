<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'position', 'type', 'location', 'company_url',
        'start_date', 'end_date', 'description', 'tech_stack',
        'sort_order', 'is_published',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'tech_stack' => 'array',
        'is_published' => 'boolean',
    ];
}
