<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'headline', 'tagline', 'about',
        'photo', 'cv_file', 'email', 'phone',
        'location', 'is_open_to_work',
    ];

    protected $casts = [
        'is_open_to_work' => 'boolean',
    ];

    // Dipakai di frontend: Profile::current()
    public static function current(): ?self
    {
        return static::first();
    }
}
