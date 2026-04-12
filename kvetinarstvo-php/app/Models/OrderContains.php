<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderContains extends Model
{
    protected $table = 'order_contains';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
