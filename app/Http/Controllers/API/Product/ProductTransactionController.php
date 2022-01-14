<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index(Product $product)
    {
        $productTransaction=$product->transactions;
        return responseJson(200,'success',$productTransaction);
    }
}
