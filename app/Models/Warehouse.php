<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'code'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_warehouse')->using(ProductWarehouse::class)->withPivot('price', 'amount');
    }
}
