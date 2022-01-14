<?php

namespace App\Http\Controllers\API\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerSellerController extends Controller
{
    public function index(User $user){
        $buyerSeller=$user
            ->transactions()
            ->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id');
        return responseJson(200,'success',$buyerSeller);
    }
}
