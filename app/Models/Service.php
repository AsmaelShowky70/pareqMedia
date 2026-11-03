<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'category',
        'icon',
        'short_description',
        'full_description',
        'starting_price',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starting_price' => 'decimal:2',
    ];

    public static function getCategories(): array
    {
        return [
            'video_shooting' => 'تصوير فيديو وإنتاج سينمائي',
            'video_editing' => 'مونتاج فيديو وبوست برودكشن',
            'graphic_design' => 'تصميم جرافيك وهويات بصرية',
            'media_buying' => 'إعلانات ممولة وميديا باينج (Meta, TikTok)',
            'social_media' => 'إدارة حسابات السوشيال ميديا',
            'branding' => 'بناء الهوية البصرية واللوجو',
            'marketing_strategy' => 'خطط تسويقية وسيناريو إعلاني',
            'other' => 'خدمة تسويقية عامة',
        ];
    }

    public function getCategoryArabicAttribute(): string
    {
        $categories = self::getCategories();

        return $categories[$this->category] ?? 'خدمة تسويقية';
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class);
    }
}
