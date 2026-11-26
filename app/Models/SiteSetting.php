<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name', 'site_tagline', 'logo', 'favicon', 'og_image',
        'meta_title', 'meta_description', 'meta_keywords',
        'primary_color', 'footer_text', 'google_analytics_id',
        'maintenance_mode',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];

    public static function current(): self
    {
        $attributes = cache()->rememberForever(
            'site_setting',
            fn () => static::first()?->getAttributes() ?? []
        );

        return (new static)->forceFill($attributes);
    }

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('site_setting'));
    }
}
