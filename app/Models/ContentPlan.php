<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'content_creator_id',
        'task_id',
        'created_by',
        'title',
        'content_type',
        'platforms',
        'publish_date',
        'publish_time',
        'client_delivery_deadline',
        'content_url',
        'caption',
        'production_status',
        'publishing_status',
        'is_published',
        'published_at',
        'notes',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'client_delivery_deadline' => 'date',
        'published_at' => 'datetime',
        'platforms' => 'array',
        'is_published' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function contentCreator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'content_creator_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope accessible by user with strict Content Creator isolation
     */
    public function scopeAccessibleBy(Builder $query, User $user): Builder
    {
        if ($user->isAdmin()) {
            return $query;
        }

        if ($user->isContentCreator()) {
            return $query->where(function (Builder $q) use ($user) {
                $q->where('content_creator_id', $user->id)
                    ->orWhereHas('project', function (Builder $pq) use ($user) {
                        $pq->where('content_creator_id', $user->id);
                    })
                    ->orWhere('created_by', $user->id);
            });
        }

        // Regular employees / photographers are completely barred
        return $query->whereRaw('1 = 0');
    }

    /**
     * Scope for a specific month and year
     */
    public function scopeForMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->whereYear('publish_date', $year)
            ->whereMonth('publish_date', $month);
    }

    /**
     * Scope for client
     */
    public function scopeForClient(Builder $query, ?int $clientId): Builder
    {
        return $clientId ? $query->where('client_id', $clientId) : $query;
    }

    /**
     * Scope for content creator
     */
    public function scopeForCreator(Builder $query, ?int $creatorId): Builder
    {
        return $creatorId ? $query->where('content_creator_id', $creatorId) : $query;
    }

    /**
     * Check if post is overdue (scheduled date passed but not marked published)
     */
    public function getIsOverdueAttribute(): bool
    {
        if ($this->is_published || $this->publishing_status === 'published' || $this->publishing_status === 'cancelled') {
            return false;
        }

        return $this->publish_date && $this->publish_date->isPast() && ! $this->publish_date->isToday();
    }

    /**
     * Get days until publish or overdue days
     */
    public function getDaysDifferenceAttribute(): int
    {
        if (! $this->publish_date) {
            return 0;
        }

        $today = Carbon::today();

        return (int) $today->diffInDays($this->publish_date, false);
    }

    /**
     * Content Type badge details
     */
    public function getTypeBadgeAttribute(): array
    {
        return match ($this->content_type) {
            'reel' => [
                'icon' => 'fa-video',
                'label' => 'ريل (Reel)',
                'badge' => 'bg-pink-500/10 text-pink-400 border border-pink-500/20',
                'border' => 'border-pink-500',
            ],
            'carousel' => [
                'icon' => 'fa-images',
                'label' => 'كاروسيل (Carousel)',
                'badge' => 'bg-purple-500/10 text-purple-400 border border-purple-500/20',
                'border' => 'border-purple-500',
            ],
            'post' => [
                'icon' => 'fa-image',
                'label' => 'بوست تصميم (Post)',
                'badge' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
                'border' => 'border-blue-500',
            ],
            'story' => [
                'icon' => 'fa-circle-notch',
                'label' => 'ستوري (Story)',
                'badge' => 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
                'border' => 'border-amber-500',
            ],
            'video' => [
                'icon' => 'fa-film',
                'label' => 'فيديو (Video)',
                'badge' => 'bg-red-500/10 text-red-400 border border-red-500/20',
                'border' => 'border-red-500',
            ],
            'tiktok' => [
                'icon' => 'fa-brands fa-tiktok',
                'label' => 'تيك توك (TikTok)',
                'badge' => 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20',
                'border' => 'border-cyan-500',
            ],
            default => [
                'icon' => 'fa-file-lines',
                'label' => 'محتوى متنوع',
                'badge' => 'bg-gray-500/10 text-gray-400 border border-gray-500/20',
                'border' => 'border-gray-500',
            ],
        };
    }

    /**
     * Publishing status details
     */
    public function getPublishingStatusBadgeAttribute(): array
    {
        if ($this->is_published || $this->publishing_status === 'published') {
            return [
                'key' => 'published',
                'icon' => 'fa-circle-check',
                'label' => 'تم النشر',
                'class' => 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/30',
                'dot' => 'bg-emerald-400',
            ];
        }

        if ($this->is_overdue) {
            return [
                'key' => 'overdue',
                'icon' => 'fa-triangle-exclamation',
                'label' => 'متأخر عن النشر',
                'class' => 'bg-rose-500/15 text-rose-400 border border-rose-500/30 animate-pulse',
                'dot' => 'bg-rose-400',
            ];
        }

        if ($this->publish_date && $this->publish_date->isToday()) {
            return [
                'key' => 'today',
                'icon' => 'fa-bullhorn',
                'label' => 'مقرر نشره اليوم',
                'class' => 'bg-amber-500/20 text-amber-300 border border-amber-500/40 font-bold',
                'dot' => 'bg-amber-400',
            ];
        }

        return match ($this->publishing_status) {
            'postponed' => [
                'key' => 'postponed',
                'icon' => 'fa-hourglass-half',
                'label' => 'مؤجل',
                'class' => 'bg-amber-500/15 text-amber-400 border border-amber-500/30',
                'dot' => 'bg-amber-400',
            ],
            'cancelled' => [
                'key' => 'cancelled',
                'icon' => 'fa-ban',
                'label' => 'ملغي',
                'class' => 'bg-gray-500/15 text-gray-400 border border-gray-500/30',
                'dot' => 'bg-gray-400',
            ],
            default => [
                'key' => 'scheduled',
                'icon' => 'fa-calendar-clock',
                'label' => 'مجدول للنشر',
                'class' => 'bg-sky-500/15 text-sky-400 border border-sky-500/30',
                'dot' => 'bg-sky-400',
            ],
        };
    }

    /**
     * Production status details
     */
    public function getProductionStatusBadgeAttribute(): array
    {
        return match ($this->production_status) {
            'idea' => [
                'label' => 'فكرة / مسودة',
                'class' => 'bg-gray-500/15 text-gray-300 border border-gray-500/30',
            ],
            'in_production' => [
                'label' => 'قيد التجهيز والمونتاج',
                'class' => 'bg-blue-500/15 text-blue-300 border border-blue-500/30',
            ],
            'client_review' => [
                'label' => 'بانتظار موافقة العميل',
                'class' => 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/30',
            ],
            'ready_to_publish' => [
                'label' => 'جاهز للنشر (مكتمل)',
                'class' => 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 font-semibold',
            ],
            default => [
                'label' => 'قيد المتابعة',
                'class' => 'bg-purple-500/15 text-purple-300 border border-purple-500/30',
            ],
        };
    }

    /**
     * Toggle published state
     */
    public function togglePublished(): void
    {
        if ($this->is_published || $this->publishing_status === 'published') {
            $this->is_published = false;
            $this->publishing_status = 'scheduled';
            $this->published_at = null;
        } else {
            $this->is_published = true;
            $this->publishing_status = 'published';
            $this->published_at = now();
        }
        $this->save();
    }
}
