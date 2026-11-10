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
     * Get direct displayable logo URL, converting Google Drive links automatically.
     */
    public function getDisplayLogoAttribute(): ?string
    {
        $url = $this->logo_url;
        if (empty($url)) {
            return null;
        }

        if (str_contains($url, 'drive.google.com')) {
            if (preg_match('/(?:file\/d\/|id=)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                return 'https://lh3.googleusercontent.com/d/' . $matches[1];
            }
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return asset(ltrim($url, '/'));
    }
}
