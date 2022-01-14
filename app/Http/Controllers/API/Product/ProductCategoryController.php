<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Product $product)
    {
        $productCategory=$product->category;
        return responseJson(200,'success',$productCategory);
    }
    public function update(Product $product,Request $request)
    {
        $validator=Validator()->make($request->all(),[
           'category_id'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(409,'failed',$validator->errors());

        }
        $product->update([
           'category_id'=>$request->category_id
        ]);
        return responseJson(200,'success',$product);

    }
}
