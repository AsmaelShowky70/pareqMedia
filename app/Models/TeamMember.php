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
        $url = $this->image_url;
        if (empty($url)) {
            return null;
        }

        // Convert Google Drive links to direct CDN view URLs
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
