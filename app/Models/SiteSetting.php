<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Retrieve a setting value by key, or return the default.
     */
    public static function get(string $key, $default = null)
    {
        try {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set or update a setting value.
     */
    public static function set(string $key, $value): void
    {
        try {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        } catch (\Throwable $e) {
            // Fail safely
        }
    }

    /**
     * Get all platform stats prepared for frontend views.
     */
    public static function getFrontendStats(): array
    {
        // 1. Calculate live real metrics from database
        $realProjects = 0;
        $realClients = 0;
        $realTeam = 0;

        try {
            $completedProjectsCount = Project::whereIn('status', ['completed', 'delivered'])->count();
            $portfolioCount = PortfolioItem::count();
            $realProjects = $completedProjectsCount > 0 ? ($completedProjectsCount + $portfolioCount) : $portfolioCount;
            if ($realProjects === 0) {
                $realProjects = Project::count() + $portfolioCount;
            }
        } catch (\Throwable $e) {}

        try {
            $realClients = Client::count();
        } catch (\Throwable $e) {}

        try {
            $realTeam = User::where('is_active', true)->count();
            if ($realTeam === 0) {
                $realTeam = User::count();
            }
        } catch (\Throwable $e) {}

        // 2. Retrieve configured settings with fallback defaults
        $syncMode = static::get('stat_sync_mode', 'custom'); // 'custom' or 'live'
        $customProjects = (int) static::get('stat_projects_count', 480);
        $customClients = (int) static::get('stat_clients_count', 125);
        $customYears = (int) static::get('stat_years_count', 6);
        $customTeam = (int) static::get('stat_team_count', 18);

        $projectsLabel = static::get('stat_projects_label', 'مشروع مكتمل بنجاح');
        $clientsLabel = static::get('stat_clients_label', 'عميل سعيد في 6 دول');
        $yearsLabel = static::get('stat_years_label', 'سنوات خبرة متواصلة');
        $teamLabel = static::get('stat_team_label', 'مبدع وخبير متخصص');

        // 3. Determine active displayed numbers based on sync mode
        if ($syncMode === 'live') {
            $projectsCount = $realProjects > 0 ? $realProjects : $customProjects;
            $clientsCount = $realClients > 0 ? $realClients : $customClients;
            $teamCount = $realTeam > 0 ? $realTeam : $customTeam;
            $yearsCount = $customYears;
        } else {
            $projectsCount = $customProjects;
            $clientsCount = $customClients;
            $teamCount = $customTeam;
            $yearsCount = $customYears;
        }

        return [
            'sync_mode' => $syncMode,
            'projects_count' => $projectsCount,
            'projects_label' => $projectsLabel,
            'clients_count' => $clientsCount,
            'clients_label' => $clientsLabel,
            'years_count' => $yearsCount,
            'years_label' => $yearsLabel,
            'team_count' => $teamCount,
            'team_label' => $teamLabel,
            // Real stats for admin inspection
            'real_projects' => $realProjects,
            'real_clients' => $realClients,
            'real_team' => $realTeam,
        ];
    }

    /**
     * Get promo video settings for the homepage.
     */
    public static function getPromoVideoData(): array
    {
        $defaultVideo = asset('videos/bariq.mp4');
        $defaultPoster = asset('videos/bariq-poster.jpg');

        $videoUrl = static::get('promo_video_url');
        $hasCustomVideo = !empty($videoUrl);

        if (!$hasCustomVideo) {
            $videoUrl = $defaultVideo;
        }

        $posterUrl = static::get('promo_poster_url');
        if (empty($posterUrl)) {
            $posterUrl = $defaultPoster;
        }

        $badge = static::get('promo_badge', 'فيديو شو ريل وكالة بريق الرسمي');
        $title = static::get('promo_title', 'شاهد إبداع بريق في دقيقة واحدة');
        $subtitle = static::get('promo_subtitle', 'أعمالنا السينمائية ومونتاجنا الإعلاني بملء الشاشة بجودة فائقة');
        $tag = static::get('promo_tag', 'PARIQ SHOWREEL • 4K');

        $youtubeId = \App\Support\MediaHelper::extractYouTubeId($videoUrl);

        return [
            'video_url' => $videoUrl,
            'poster_url' => $posterUrl,
            'badge' => $badge,
            'title' => $title,
            'subtitle' => $subtitle,
            'tag' => $tag,
            'is_youtube' => !empty($youtubeId),
            'youtube_id' => $youtubeId,
            'is_custom' => $hasCustomVideo,
        ];
    }

    /**
     * Get social media platform links.
     */
    public static function getSocialLinks(): array
    {
        return [
            'facebook' => static::get('social_facebook', 'https://www.facebook.com/bariq.dm/?locale=ar_AR'),
            'instagram' => static::get('social_instagram', 'https://www.instagram.com/pariqmedia?utm_source=ig_web_button_share_sheet&obrf=ZDNlZDc0MzIxNw=='),
            'tiktok' => static::get('social_tiktok', 'https://www.tiktok.com/@pariq82?is_from_webapp=1&sender_device=pc'),
            'whatsapp' => static::get('social_whatsapp', 'https://wa.me/201062330838?text=مرحباً%20بريق'),
        ];
    }
}

