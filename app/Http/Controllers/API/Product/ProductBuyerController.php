<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends Controller
{
    public function index(Product $product)
    {
        $productBuyer = $product->transactions()->with('buyer')->get()->pluck('buyer');
        return responseJson(200, 'success', $productBuyer);
    }
}
