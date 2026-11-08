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

    public function getCategoryArabicAttribute(): string
    {
        return match ($this->category) {
            'video_reels' => 'فيديوهات ريلز وقصيرة',
            'promo_video' => 'برومو وفيديوهات إعلانية',
            'social_design' => 'تصميمات سوشيال ميديا',
            'youtube_thumbnail' => 'أغلفة يوتيوب احترافية',
            'branding' => 'لوجو وهويات بصرية',
            'ad_results' => 'نتائج حملات إعلانية',
            default => 'عمل إبداعي',
        };
    }
}
