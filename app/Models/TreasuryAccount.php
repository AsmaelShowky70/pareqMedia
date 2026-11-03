<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'account_number',
        'balance',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function getTypeNameArabicAttribute(): string
    {
        return match ($this->type) {
            'instapay' => 'انستاباي (InstaPay)',
            'vodafone_cash' => 'فودافون كاش / محفظة ذكية',
            'bank' => 'حساب بنكي تجاري',
            'cash' => 'خزينة نقدية (كاش المقر)',
            default => 'حساب مالي',
        };
    }
}
