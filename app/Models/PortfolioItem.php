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
            'promo', 'promo_video' => 'برومو وفيديوهات إعلانية',
            'reels', 'video_reels' => 'فيديوهات ريلز وقصيرة',
            'design', 'social_design', 'youtube_thumbnail' => 'تصميمات جرافيك وأغلفة',
            'campaigns', 'ad_results' => 'حملات إعلانية ونتائج ROAS',
            'branding' => 'هوية بصرية وبراندينج',
            default => 'عمل إبداعي',
        };
    }
}
