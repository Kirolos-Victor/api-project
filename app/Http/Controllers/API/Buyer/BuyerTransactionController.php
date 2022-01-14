<?php

namespace App\Http\Controllers\API\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerTransactionController extends Controller
{
    public function index(User $user){
        $buyerTransactions=$user->transactions;
        return responseJson(200,'success',$buyerTransactions);
    }
}
