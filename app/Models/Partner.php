<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'logo_url',
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
     * Get direct displayable logo URL, converting Google Drive links and caching them automatically.
     */
    public function getDisplayLogoAttribute(): ?string
    {
        return \App\Support\MediaHelper::formatDisplayUrl($this->logo_url);
    }
}
