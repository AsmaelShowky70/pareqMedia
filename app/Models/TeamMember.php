<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'dept',
        'quote',
        'image_url',
        'icon',
        'gradient',
        'letter',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get real direct image URL supporting Google Drive links and local uploads.
     */
    public function getDisplayImageAttribute(): ?string
    {
        return \App\Support\MediaHelper::formatDisplayUrl($this->image_url);
    }
}

