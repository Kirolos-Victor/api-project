<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product=Product::paginate();
        return responseJson(200,'Success',$product);
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {
        return responseJson(200,'Success',$product);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
