<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'title',
        'amount',
        'due_date',
        'status',
        'paid_amount',
        'paid_at',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getUrgencyInfoAttribute(): array
    {
        if ($this->status === 'paid') {
            return [
                'status' => 'paid',
                'label' => 'مسددة بالكامل',
                'badge' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
                'is_approaching' => false,
            ];
        }

        $today = Carbon::today();
        $dueDate = Carbon::parse($this->due_date)->startOfDay();
        $diffDays = $today->diffInDays($dueDate, false);

        if ($diffDays < 0) {
            return [
                'status' => 'overdue',
                'label' => 'متأخرة عن موعد السداد ('.abs($diffDays).' يوم)',
                'badge' => 'bg-rose-500/20 text-rose-300 border-rose-500/50 animate-pulse',
                'is_approaching' => true,
            ];
        }

        if ($diffDays <= 3) {
            return [
                'status' => 'approaching',
                'label' => $diffDays === 0 ? 'مستحقة السداد اليوم!' : 'موعد السداد خلال '.$diffDays.' أيام',
                'badge' => 'bg-amber-500/20 text-amber-300 border-amber-500/50',
                'is_approaching' => true,
            ];
        }

        return [
            'status' => 'pending',
            'label' => 'مستحقة في '.$dueDate->format('Y-m-d'),
            'badge' => 'bg-slate-500/20 text-slate-300 border-slate-500/30',
            'is_approaching' => false,
        ];
    }
}
