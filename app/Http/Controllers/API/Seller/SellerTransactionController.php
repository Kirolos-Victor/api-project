<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerTransactionController extends Controller
{
    public function index($id)
    {
        $seller=User::has('products')->get()->find($id);
        $sellerTransactions=$seller
            ->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();// we use collapse to remove multiple brackets and make it one collection [ [ {} ] ] => [{}]
        return responseJson(200,'success',$sellerTransactions);
    }
}
