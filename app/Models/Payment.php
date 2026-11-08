<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'client_id',
        'invoice_id',
        'project_id',
        'cashier_user_id',
        'cashier_id',
        'amount',
        'payment_type',
        'payment_method',
        'payment_date',
        'transaction_reference',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function cashier()
    {
        // Support both schema naming variants: cashier_user_id and cashier_id
        $fk = !empty($this->attributes['cashier_user_id']) ? 'cashier_user_id' : 'cashier_id';
        return $this->belongsTo(User::class, $fk);
    }

    public function getPaymentTypeArabicAttribute(): string
    {
        return match ($this->payment_type) {
            'down_payment' => 'دفعة مقدمة (تعاقد)',
            'milestone' => 'دفعة مرحلية',
            'final_clearance' => 'تصفية حساب وتسليم',
            'quick_service' => 'خدمة سريعة (كاشير)',
            default => 'سداد حساب',
        };
    }

    public function getPaymentMethodArabicAttribute(): string
    {
        return match ($this->payment_method) {
            'instapay' => 'إنستاباي (InstaPay)',
            'vodafone_cash' => 'فودافون كاش / محافظ',
            'cash' => 'نقداً بالخزينة (Cash)',
            'bank_transfer' => 'تحويل بنكي رسمي',
            'credit_card' => 'فيزا / بطاقة ائتمان',
            default => 'أخرى',
        };
    }
}
