<?php

namespace App\Http\Controllers;

use App\Models\PlatformNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = PlatformNotification::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(PlatformNotification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'تم تحديد الإشعار كمقروء.');
    }

    public function markAllAsRead()
    {
        PlatformNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'تم تحديد جميع الإشعارات كمقروءة.');
    }

    /**
     * API for real-time polling in Topbar & PWA
     */
    public function unreadFeed()
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['count' => 0, 'notifications' => []]);
        }

        $unreadCount = PlatformNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        $latestNotifications = PlatformNotification::where('user_id', $user->id)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => $n->type,
                    'title' => $n->title,
                    'message' => $n->message,
                    'icon' => $n->icon,
                    'action_url' => $n->action_url ?? '#',
                    'is_read' => $n->is_read,
                    'time_ago' => $n->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'count' => $unreadCount,
            'notifications' => $latestNotifications,
        ]);
    }
}
