<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'manufacture_date'];

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'product_warehouse')->using(ProductWarehouse::class)->withPivot('price', 'amount');
    }

    public function manufactureDate(): Attribute
    {
        return Attribute::get(fn($attribute) => Carbon::parse($attribute)->format('d-m-Y'));
    }
}
