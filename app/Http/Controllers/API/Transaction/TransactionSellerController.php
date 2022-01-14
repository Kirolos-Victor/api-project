<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends Controller
{
    public function index(Transaction $transaction)
    {
       $seller=$transaction->product->seller;
      return  responseJson(200,'success',$seller);
    }
}
