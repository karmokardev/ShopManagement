<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'purchase_id',
        'quantity',
        'buying_price',
        'selling_price',
        'total_price',
        'sale_date',
    ];

    protected $dates = ['sale_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

