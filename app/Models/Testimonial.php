<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_title',
        'client_country',
        'type', // 'video_reel', 'image_review', 'text_review'
        'content',
        'rating',
        'media_url',
        'thumbnail',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTypeArabicAttribute(): string
    {
        return match($this->type) {
            'video_reel' => 'فيديو ريلز طولي',
            'image_review' => 'تقييم مصور',
            default => 'تقييم كتابي موثق',
        };
    }

    public function getIconAttribute(): string
    {
        return match($this->type) {
            'video_reel' => 'fa-mobile-screen',
            'image_review' => 'fa-image',
            default => 'fa-comment-dots',
        };
    }

    public function getDisplayThumbnailAttribute(): ?string
    {
        if (!empty($this->thumbnail)) {
            return \App\Support\MediaHelper::formatDisplayUrl($this->thumbnail);
        }

        // If thumbnail is empty, auto-generate from media_url if YouTube or Google Drive
        if (!empty($this->media_url)) {
            $ytThumb = \App\Support\MediaHelper::fetchAndCacheYouTubeThumbnail($this->media_url);
            if ($ytThumb) {
                return $ytThumb;
            }

            if (str_contains($this->media_url, 'drive.google.com') || str_contains($this->media_url, 'googleusercontent.com')) {
                return \App\Support\MediaHelper::formatDisplayUrl($this->media_url);
            }
        }

        return asset('images/portfolio/social_4.webp');
    }

    public function getDisplayMediaAttribute(): ?string
    {
        if (empty($this->media_url)) {
            return null;
        }

        return \App\Support\MediaHelper::normalizeYouTubeUrl($this->media_url);
    }
}

