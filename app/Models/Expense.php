<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'amount',
        'payment_method',
        'project_id',
        'created_by',
        'spent_at',
        'notes',
        'receipt_file',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'spent_at' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getCategoryArabicAttribute(): string
    {
        return match ($this->category) {
            'ad_spend' => 'ميزانيات إعلانات ممولة (Ad Spend)',
            'freelancers' => 'أجور عمل حر وتصوير خارجي',
            'software_tools' => 'اشتراكات برامج وأدوات (Adobe, AI)',
            'equipment' => 'معدات تصوير وصيانة',
            'office_rent' => 'إيجار المقر ومصاريف تشغيل',
            default => 'مصروفات عامة متنوعة',
        };
    }
}
