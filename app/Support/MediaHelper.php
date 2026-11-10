<?php

namespace App\Support;

use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Extract Google Drive File ID from various link formats.
     */
    public static function extractGoogleDriveId(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        // Standard link patterns: /file/d/{id}, id={id}, /d/{id}, /uc?id={id}
        if (preg_match('/(?:file\/d\/|id=|open\?id=|\/d\/|uc\?export=view&id=|thumbnail\?id=)([a-zA-Z0-9_-]{25,})/i', $url, $matches)) {
            return $matches[1];
        }

        // If user pasted just the raw ID string
        if (preg_match('/^[a-zA-Z0-9_-]{28,45}$/', $url)) {
            return $url;
        }

        return null;
    }

    /**
     * Download and cache a Google Drive image locally to public/uploads/drive_cache/.
     * Returns the local relative URL (e.g. /uploads/drive_cache/{id}.png) or fallback CDN URL.
     */
    public static function downloadAndCacheGoogleDrive(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $id = self::extractGoogleDriveId($url);
        if (!$id) {
            return $url;
        }

        $cacheDir = public_path('uploads/drive_cache');
        if (!file_exists($cacheDir)) {
            @mkdir($cacheDir, 0755, true);
        }

        // Check if already downloaded
        $existing = glob($cacheDir . DIRECTORY_SEPARATOR . $id . '.*');
        if (!empty($existing)) {
            return '/uploads/drive_cache/' . basename($existing[0]);
        }

        // Download candidates in order of reliability
        $candidates = [
            'https://lh3.googleusercontent.com/d/' . $id,
            'https://drive.google.com/thumbnail?id=' . $id . '&sz=w1600',
            'https://drive.google.com/uc?export=view&id=' . $id,
        ];

        foreach ($candidates as $candidate) {
            $ch = curl_init($candidate);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
            $data = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            curl_close($ch);

            if ($httpCode === 200 && is_string($data) && strlen($data) > 300) {
                // Detect extension
                $ext = 'png';
                if (str_contains($contentType, 'jpeg') || str_contains($contentType, 'jpg') || str_starts_with($data, "\xFF\xD8\xFF")) {
                    $ext = 'jpg';
                } elseif (str_contains($contentType, 'webp') || (strlen($data) > 12 && substr($data, 8, 4) === 'WEBP')) {
                    $ext = 'webp';
                } elseif (str_contains($contentType, 'svg') || str_contains($data, '<svg')) {
                    $ext = 'svg';
                } elseif (str_contains($contentType, 'gif') || str_starts_with($data, 'GIF8')) {
                    $ext = 'gif';
                }

                $filename = $id . '.' . $ext;
                $filepath = $cacheDir . DIRECTORY_SEPARATOR . $filename;
                @file_put_contents($filepath, $data);

                return '/uploads/drive_cache/' . $filename;
            }
        }

        // Fallback to high-speed CDN if cURL fails
        return 'https://lh3.googleusercontent.com/d/' . $id;
    }

    /**
     * Extract YouTube 11-character Video ID from any YouTube URL.
     */
    public static function extractYouTubeId(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);
        if (preg_match('/(?:youtube\.com\/(?:watch\?.*v=|shorts\/|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Fetch YouTube thumbnail and cache it locally in uploads/portfolio/.
     */
    public static function fetchAndCacheYouTubeThumbnail(?string $videoUrl): ?string
    {
        $ytId = self::extractYouTubeId($videoUrl);
        if (!$ytId) {
            return null;
        }

        $uploadDir = public_path('uploads/portfolio');
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $filename = 'yt_' . $ytId . '.jpg';
        $filepath = $uploadDir . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($filepath) && filesize($filepath) > 1000) {
            return '/uploads/portfolio/' . $filename;
        }

        // Try maxresdefault first, then hqdefault
        $candidates = [
            'https://img.youtube.com/vi/' . $ytId . '/maxresdefault.jpg',
            'https://img.youtube.com/vi/' . $ytId . '/hqdefault.jpg',
        ];

        foreach ($candidates as $cand) {
            $ch = curl_init($cand);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            $data = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // YouTube returns a tiny ~1097 byte transparent/blank gif on 404 for maxres
            if ($httpCode === 200 && is_string($data) && strlen($data) > 3000) {
                @file_put_contents($filepath, $data);
                return '/uploads/portfolio/' . $filename;
            }
        }

        // Fallback directly to hqdefault
        return 'https://img.youtube.com/vi/' . $ytId . '/hqdefault.jpg';
    }

    /**
     * Format any image URL for display in Blade views:
     * - Checks local cache for Google Drive links
     * - Returns proper asset() or external URL
     */
    public static function formatDisplayUrl(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        // Check if it's a Google Drive link
        if (str_contains($url, 'drive.google.com') || str_contains($url, 'googleusercontent.com')) {
            $id = self::extractGoogleDriveId($url);
            if ($id) {
                $cacheDir = public_path('uploads/drive_cache');
                $existing = glob($cacheDir . DIRECTORY_SEPARATOR . $id . '.*');
                if (!empty($existing)) {
                    return asset('uploads/drive_cache/' . basename($existing[0]));
                }
                // Try caching right now
                $cached = self::downloadAndCacheGoogleDrive($url);
                if ($cached && !str_starts_with($cached, 'http')) {
                    return asset(ltrim($cached, '/'));
                }
                return 'https://lh3.googleusercontent.com/d/' . $id;
            }
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return asset(ltrim($url, '/'));
    }
}
