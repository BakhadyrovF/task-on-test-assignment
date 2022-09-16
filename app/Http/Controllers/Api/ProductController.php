<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __invoke()
    {
        $products = Product::with('warehouses')
            ->orderByDesc('manufacture_date')->get();

    }
}
