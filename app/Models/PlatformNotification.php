<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'icon',
        'action_url',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Send notification to a specific user.
     */
    public static function send(int $userId, string $type, string $title, string $message, string $icon = 'bell', ?string $actionUrl = null): self
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'icon' => $icon,
            'action_url' => $actionUrl,
            'is_read' => false,
        ]);
    }

    /**
     * Send notification to all General Managers / Admins.
     */
    public static function notifyGM(string $type, string $title, string $message, string $icon = 'bell', ?string $actionUrl = null): void
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        foreach ($admins as $admin) {
            self::send($admin->id, $type, $title, $message, $icon, $actionUrl);
        }
    }
}
