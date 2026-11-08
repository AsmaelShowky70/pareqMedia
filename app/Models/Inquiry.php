<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_name',
        'company_name',
        'phone',
        'email',
        'service_interested',
        'service_type',
        'budget_range',
        'message',
        'status',
    ];
}
