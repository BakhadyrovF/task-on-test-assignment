<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductWarehouse extends Pivot
{
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'price',
        'amount'
    ];

    public function price(): Attribute
    {
        return Attribute::make(fn($attribute) => $attribute / 100, fn($attribute) => $attribute * 100);
    }
}
