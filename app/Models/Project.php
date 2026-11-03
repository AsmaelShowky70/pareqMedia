<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'content_creator_id',
        'title',
        'category',
        'total_budget',
        'start_date',
        'deadline',
        'status',
        'description',
        'submitted_to_gm_at',
        'gm_approval_status',
        'delivery_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'total_budget' => 'decimal:2',
        'submitted_to_gm_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contentCreator()
    {
        return $this->belongsTo(User::class, 'content_creator_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function contentPlans()
    {
        return $this->hasMany(ContentPlan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function installments()
    {
        return $this->hasMany(ClientInstallment::class);
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    /**
     * Scope projects based on user role and isolation policy.
     * Content Creators can ONLY see their assigned projects.
     */
    public function scopeAccessibleBy(Builder $query, User $user): Builder
    {
        if ($user->isAdmin()) {
            return $query;
        }

        if ($user->isContentCreator()) {
            return $query->where('content_creator_id', $user->id);
        }

        if ($user->isEmployee()) {
            return $query->whereHas('tasks', function ($q) use ($user) {
                $q->where('assigned_to', $user->id);
            });
        }

        return $query;
    }

    public function getCategoryArabicAttribute(): string
    {
        return match ($this->category) {
            'video_production' => 'إنتاج وتصوير فيديو',
            'social_media' => 'إدارة حسابات سوشيال ميديا',
            'media_buying' => 'إعلانات ممولة وميديا باينج',
            'branding' => 'هوية بصرية وبراندينج',
            'full_campaign' => 'حملة تسويقية متكاملة',
            default => 'مشروع عام',
        };
    }

    public function getStatusArabicAttribute(): string
    {
        return match ($this->status) {
            'planning' => 'تخطيط وتحضير',
            'in_progress' => 'جاري العمل',
            'review' => 'مراجعة واعتماد صانع المحتوى',
            'delivered' => 'تم التسليم للمدير العام',
            'completed' => 'معتمد ومكتمل بنجاح',
            'cancelled' => 'ملغي',
            default => 'غير محدد',
        };
    }

    public function getNetProfitAttribute(): float
    {
        $revenue = (float) $this->payments()->sum('amount');
        $expenses = (float) $this->expenses()->sum('amount');

        return $revenue - $expenses;
    }

    public function getProfitMarginPercentageAttribute(): float
    {
        if ($this->total_budget <= 0) {
            return 0.0;
        }
        $revenue = (float) $this->payments()->sum('amount');
        if ($revenue <= 0) {
            $revenue = (float) $this->total_budget;
        }
        $expenses = (float) $this->expenses()->sum('amount');
        $profit = $revenue - $expenses;

        return round(($profit / $revenue) * 100, 1);
    }
}
