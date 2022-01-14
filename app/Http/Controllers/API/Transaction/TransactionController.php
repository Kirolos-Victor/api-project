<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions=Transaction::paginate(10);
        return responseJson(200,'success',$transactions);
    }


    public function store(Request $request)
    {
        $validator=validator()->make($request->all(),[
            'quantity'=>'required|integer',
            'buyer_id'=>'required|integer',
            'product_id'=>'required|integer'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'Failed',$validator->errors());

        }
        $transaction=Transaction::create([
            'quantity'=>$request->quantity,
            'product_id'=>$request->product_id,
            'buyer_id'=>$request->buyer_id
        ]);

        return responseJson(200,'Created Successfully',$transaction);

    }


    public function show(Transaction $transaction)
    {
        return responseJson(200,'success',$transaction);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
