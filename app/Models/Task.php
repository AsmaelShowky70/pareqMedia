<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client_id',
        'assigned_to',
        'created_by',
        'title',
        'department',
        'status',
        'delivery_deadline',
        'daily_delivery_deadline',
        'material_link',
        'delivery_link',
        'notes',
        'priority',
        'completed_at',
        // Photographer & Location fields
        'location_address',
        'location_map_url',
        'location_lat',
        'location_lng',
        'geofence_radius_meters',
        'photographer_accepted_at',
        'photographer_start_lat',
        'photographer_start_lng',
        'photographer_arrived_at',
        'photographer_arrival_lat',
        'photographer_arrival_lng',
        'photographer_arrival_distance_meters',
        'attendance_status',
    ];

    protected $casts = [
        'delivery_deadline' => 'date',
        'completed_at' => 'datetime',
        'photographer_accepted_at' => 'datetime',
        'photographer_arrived_at' => 'datetime',
        'location_lat' => 'float',
        'location_lng' => 'float',
        'photographer_start_lat' => 'float',
        'photographer_start_lng' => 'float',
        'photographer_arrival_lat' => 'float',
        'photographer_arrival_lng' => 'float',
        'geofence_radius_meters' => 'integer',
        'photographer_arrival_distance_meters' => 'integer',
    ];

    public const STATUS_NOT_STARTED = 'not_started';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_ON_LEAVE = 'on_leave';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NOT_STARTED => [
                'name' => 'لم تبدأ',
                'badge' => 'bg-slate-500/15 text-slate-400 border-slate-500/30',
                'color' => '#64748b',
            ],
            self::STATUS_IN_PROGRESS => [
                'name' => 'جاري العمل',
                'badge' => 'bg-amber-500/15 text-amber-400 border-amber-500/30',
                'color' => '#f59e0b',
            ],
            self::STATUS_COMPLETED => [
                'name' => 'مكتمل',
                'badge' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30',
                'color' => '#10b981',
            ],
            self::STATUS_CANCELLED => [
                'name' => 'إلغاء المشروع',
                'badge' => 'bg-rose-500/15 text-rose-400 border-rose-500/30',
                'color' => '#ef4444',
            ],
            self::STATUS_ON_LEAVE => [
                'name' => 'اجازه',
                'badge' => 'bg-purple-500/15 text-purple-300 border-purple-500/30',
                'color' => '#a855f7',
            ],
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStatusLabelAttribute(): string
    {
        $statuses = self::getStatuses();

        return $statuses[$this->status]['name'] ?? 'غير محدد';
    }

    public function getStatusBadgeAttribute(): string
    {
        $statuses = self::getStatuses();

        return $statuses[$this->status]['badge'] ?? 'bg-gray-500/10 text-gray-400';
    }

    public function getDepartmentArabicAttribute(): string
    {
        return match ($this->department) {
            'editing' => 'مونتاج وبوست برودكشن',
            'video' => 'تصوير سينمائي وميداني',
            'design' => 'تصميم جرافيك وهويات',
            'media_buyer' => 'إعلانات ممولة وميديا باينج',
            'management' => 'إدارة ومتابعة',
            default => 'عام',
        };
    }

    /**
     * Urgency Status for Colored Cards based on Delivery Deadline.
     * Red: very close (<= 1 day or overdue)
     * Yellow: approaching (<= 3 days)
     * Green: plenty of time remaining (> 3 days or open)
     */
    public function getUrgencyInfoAttribute(): array
    {
        if ($this->status === self::STATUS_COMPLETED) {
            return [
                'code' => 'completed',
                'label' => 'تم التسليم بنجاح',
                'border_class' => 'border-emerald-500/60 hover:border-emerald-400',
                'bg_class' => 'bg-emerald-950/20',
                'badge_class' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
                'dot_color' => 'bg-emerald-400',
                'color_name' => 'أخضر',
            ];
        }

        if (! $this->delivery_deadline) {
            return [
                'code' => 'green',
                'label' => 'وقت مفتوح متاح',
                'border_class' => 'border-emerald-500/40 hover:border-emerald-400',
                'bg_class' => 'bg-emerald-950/10',
                'badge_class' => 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30',
                'dot_color' => 'bg-emerald-400',
                'color_name' => 'أخضر',
            ];
        }

        $today = Carbon::today();
        $deadline = Carbon::parse($this->delivery_deadline)->startOfDay();
        $diffDays = $today->diffInDays($deadline, false); // negative if overdue

        if ($diffDays <= 1) {
            return [
                'code' => 'red',
                'label' => $diffDays < 0 ? 'متأخر عن موعد التسليم!' : 'تسليم عاجل جداً (اليوم أو خلال 24 ساعة)',
                'border_class' => 'border-rose-500 shadow-lg shadow-rose-950/50 hover:border-rose-400',
                'bg_class' => 'bg-gradient-to-br from-rose-950/30 via-brand-card to-rose-950/20',
                'badge_class' => 'bg-rose-500/25 text-rose-300 border-rose-500/50 animate-pulse',
                'dot_color' => 'bg-rose-500',
                'color_name' => 'أحمر',
            ];
        }

        if ($diffDays <= 3) {
            return [
                'code' => 'yellow',
                'label' => 'موعد التسليم يقترب (خلال '.$diffDays.' أيام)',
                'border_class' => 'border-amber-500 shadow-md shadow-amber-950/40 hover:border-amber-400',
                'bg_class' => 'bg-gradient-to-br from-amber-950/25 via-brand-card to-amber-950/15',
                'badge_class' => 'bg-amber-500/20 text-amber-300 border-amber-500/40',
                'dot_color' => 'bg-amber-400',
                'color_name' => 'أصفر',
            ];
        }

        return [
            'code' => 'green',
            'label' => 'متبقي متسع كافي من الوقت ('.$diffDays.' يوم)',
            'border_class' => 'border-emerald-500/50 shadow-sm hover:border-emerald-400',
            'bg_class' => 'bg-gradient-to-br from-emerald-950/20 via-brand-card to-emerald-950/10',
            'badge_class' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
            'dot_color' => 'bg-emerald-400',
            'color_name' => 'أخضر',
        ];
    }

    public function getAttendanceStatusArabicAttribute(): string
    {
        return match ($this->attendance_status) {
            'on_the_way' => 'في الطريق لموقع التصوير',
            'checked_in' => 'تم تسجيل الحضور في الموقع',
            'shoot_completed' => 'انتهى التصوير وتم تسليم الماتريال',
            default => 'في انتظار التحرك',
        };
    }
}
