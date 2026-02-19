<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'total_amount',
    ];

    protected $dates = ['date'];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }
}

