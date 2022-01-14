<?php

namespace App\Http\Controllers\API\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerCategoryController extends Controller
{
    public function index(User $user){
        $buyerCategories=$user
            ->transactions()
            ->with('product.category')
            ->get()
            //pluck must be written like relation (product.category) MUST!!
            ->pluck('product.category')
            ->unique('id');
        return responseJson(200,'success',$buyerCategories);
    }
}
