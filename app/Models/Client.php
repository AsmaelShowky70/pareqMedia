<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_name',
        'phone',
        'email',
        'country',
        'service_package',
        'monthly_retainer',
        'status',
        'notes',
    ];

    protected $casts = [
        'monthly_retainer' => 'decimal:2',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function installments()
    {
        return $this->hasMany(ClientInstallment::class)->orderBy('due_date', 'asc');
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function contentPlans()
    {
        return $this->hasMany(ContentPlan::class)->orderBy('publish_date', 'asc');
    }

    public function getTotalPaidAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getTotalInvoicedAttribute(): float
    {
        return (float) $this->invoices()->sum('total_amount');
    }

    public function getBalanceDueAttribute(): float
    {
        return max(0, $this->total_invoiced - $this->total_paid);
    }
}
