<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{
    public function index(Transaction $transaction)
    {
       $category=$transaction->product->category;
      return  responseJson(200,'success',$category);
    }
}
