<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name', 'issuer', 'issued_at', 'expires_at',
        'credential_id', 'credential_url', 'image',
        'description', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
        'is_published' => 'boolean',
    ];
}
