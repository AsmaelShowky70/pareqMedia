<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'client_name',
        'client_country',
        'category',
        'media_type',
        'media_url',
        'thumbnail_url',
        'video_url',
        'thumbnail',
        'metrics',
        'description',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get displayable thumbnail URL, supporting Google Drive, YouTube covers, and local files.
     */
    public function getDisplayThumbnailAttribute(): ?string
    {
        $thumb = $this->thumbnail ?: $this->thumbnail_url;
        if (!empty($thumb) && $thumb !== '/images/portfolio/social_1.webp') {
            return \App\Support\MediaHelper::formatDisplayUrl($thumb);
        }

        // If thumbnail was default/empty, check if media_url or video_url has a Google Drive link
        foreach ([$this->media_url, $this->video_url] as $candidate) {
            if (!empty($candidate) && (str_contains($candidate, 'drive.google.com') || str_contains($candidate, 'googleusercontent.com'))) {
                return \App\Support\MediaHelper::formatDisplayUrl($candidate);
            }
        }

        // If thumbnail is empty or was legacy mock, check if video is YouTube
        if (!empty($this->video_url)) {
            $ytThumb = \App\Support\MediaHelper::fetchAndCacheYouTubeThumbnail($this->video_url);
            if ($ytThumb) {
                return \App\Support\MediaHelper::formatDisplayUrl($ytThumb);
            }
        }

        return !empty($thumb) ? \App\Support\MediaHelper::formatDisplayUrl($thumb) : asset('images/portfolio/social_1.webp');
    }

    /**
     * Ensure Google Drive links mistakenly saved in video_url are not treated as video streams.
     */
    public function getVideoUrlAttribute($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (str_contains($value, 'drive.google.com') || str_contains($value, 'googleusercontent.com')) {
            return null;
        }

        return $value;
    }

    public function getCategoryArabicAttribute(): string
    {
        return match ($this->category) {
            'promo', 'promo_video' => 'برومو وفيديوهات إعلانية',
            'reels', 'video_reels' => 'فيديوهات ريلز وقصيرة',
            'design', 'social_design', 'youtube_thumbnail' => 'تصميمات جرافيك وأغلفة',
            'campaigns', 'ad_results' => 'حملات إعلانية ونتائج ROAS',
            'branding' => 'هوية بصرية وبراندينج',
            default => 'عمل إبداعي',
        };
    }
}
