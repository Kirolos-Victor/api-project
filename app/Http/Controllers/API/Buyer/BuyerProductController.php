<?php

namespace App\Http\Controllers\API\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
    public function index(User $user){
        //you can use pluck on relations too to get a specfic relation not all relations
        $buyerProducts=$user
            ->transactions()
            ->with('product')
            ->get()
            ->pluck('product')
            ->unique('id');
        return responseJson(200,'success',$buyerProducts);
    }
}
