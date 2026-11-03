<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'treasury_account_id',
        'accounting_category_id',
        'type',
        'amount',
        'payment_method',
        'client_id',
        'project_id',
        'user_id',
        'created_by',
        'reference_number',
        'transaction_date',
        'description',
        'attachment',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function treasuryAccount()
    {
        return $this->belongsTo(TreasuryAccount::class);
    }

    public function category()
    {
        return $this->belongsTo(AccountingCategory::class, 'accounting_category_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getTypeNameArabicAttribute(): string
    {
        return match ($this->type) {
            'revenue' => 'إيراد مقبوض (+)',
            'expense' => 'مصروف مسدد (-)',
            'transfer' => 'تحويل بين حسابين (⇄)',
            default => 'معاملة',
        };
    }
}
