<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'code',
        'description',
    ];

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function getTypeNameArabicAttribute(): string
    {
        return $this->type === 'revenue' ? 'إيرادات' : 'مصروفات وتكاليف';
    }
}
