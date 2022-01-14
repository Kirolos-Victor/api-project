<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerCategoryController extends Controller
{
    public function index($id)
    {
        $seller=User::has('products')->get()->find($id);
        if(!$seller)
        {
            return responseJson(404,'not a seller');

        }
        $sellerCategories=$seller->products()->with('category')->get()->pluck('category');
        return responseJson(200,'success',$sellerCategories);
    }
}
