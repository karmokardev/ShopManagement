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
        'lot_no',
        'quantity',
        'buying_price',
        'total_price',
        'remaining_quantity',
        'purchase_date',
    ];

    protected $dates = ['purchase_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
