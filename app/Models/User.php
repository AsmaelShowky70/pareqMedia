<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';

    public const ROLE_CONTENT_CREATOR = 'content_creator';

    public const ROLE_MANAGER = 'manager';

    public const ROLE_EMPLOYEE = 'employee';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'department',
        'job_title',
        'avatar',
        'daily_quota',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, 'super_admin']);
    }

    public function isContentCreator(): bool
    {
        return $this->role === self::ROLE_CONTENT_CREATOR;
    }

    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER || $this->isContentCreator() || $this->isAdmin();
    }

    public function isEmployee(): bool
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    public function isPhotographer(): bool
    {
        $title = mb_strtolower($this->job_title ?? '');

        return $this->department === 'video'
            || str_contains($title, 'تصوير')
            || str_contains($title, 'مصور')
            || str_contains($title, 'photo');
    }

    public function managedProjects()
    {
        return $this->hasMany(Project::class, 'content_creator_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'cashier_user_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'created_by');
    }

    public function platformNotifications()
    {
        return $this->hasMany(PlatformNotification::class, 'user_id')->latest();
    }

    public function unreadNotificationsCount(): int
    {
        return $this->platformNotifications()->where('is_read', false)->count();
    }

    public function contentPlans()
    {
        return $this->hasMany(ContentPlan::class, 'content_creator_id');
    }

    public function getRoleNameArabicAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'المدير العام (صاحب الشركة)',
            self::ROLE_CONTENT_CREATOR => 'صانع محتوى (مدير مشاريع)',
            self::ROLE_MANAGER => 'مدير قسم',
            self::ROLE_EMPLOYEE => 'موظف تشغيلي',
            default => 'عضو بالفريق',
        };
    }

    public function getDepartmentNameArabicAttribute(): string
    {
        return match ($this->department) {
            'video' => 'قسم التصوير والإنتاج',
            'editing' => 'قسم المونتاج والبوست برودكشن',
            'design' => 'قسم تصميم الجرافيك',
            'media_buyer' => 'قسم الإعلانات والميديا باينج',
            'accounting' => 'قسم الحسابات والكاشير',
            'management' => 'الإدارة العامة',
            default => 'فريق العمل العام',
        };
    }
}
