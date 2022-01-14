<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerBuyerController extends Controller
{
    public function index($id)
    {
        $seller=User::has('products')->get()->find($id);
        if(!$seller)
        {
            return responseJson(404,'not a seller');

        }
        $sellerBuyers=$seller->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer');
        return responseJson(200,'success',$sellerBuyers);
    }
}
