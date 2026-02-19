<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'remaining_quantity',
        'unit_price',
        'total_cost',
        'date',
    ];

    protected $dates = ['date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }


    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Optional helper
    public function isOutOfStock()
    {
        return $this->remaining_quantity <= 0;
    }
}
