<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller
{
    public function index($id)
    {
        $seller = User::has('products')->get()->find($id);
        if (!$seller) {
            return responseJson(404, 'not a seller');

        }
        $sellerProducts=$seller->products()->get();

        return responseJson(200,'success',$sellerProducts);

    }
    public function store(Request $request,$id)
    {
        $seller = User::has('products')->get()->find($id);
        if (!$seller) {
            return responseJson(404, 'not a seller');

        }
        $validator=validator()->make($request->all(),[
           'name'=>'required',
           'description'=>'required',
           'quantity'=>'required|min:1',
            'category_id'=>'required',
            'image'=>'required|image',
            'status'=>'required|in:'.Product::AVAILABLE_PRODUCT.','.Product::UNAVAILABLE_PRODUCT,
        ]);
        if($validator->fails())
        {
            return responseJson(409,'failed',$validator->errors());
        }
        $sellerProducts=$seller->products()->create([
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'status'=>$request->status,
            'category_id'=>$request->category_id,

            'image'=>$request->image->store('','images'),
        ]);

        return responseJson(200,'success',$sellerProducts);

    }
    public function update(Request $request,$user_id,$product_id)
    {
        //dd($request->all());

        $seller = User::has('products')->get()->find($user_id);
        if (!$seller) {
            return responseJson(404, 'not a seller');

        }
        $validator=validator()->make($request->all(),[
            'name'=>'nullable',
            'description'=>'nullable',
            'quantity'=>'nullable|min:1',
            'category_id'=>'nullable',
            'status'=>'nullable|in:'.Product::AVAILABLE_PRODUCT.','.Product::UNAVAILABLE_PRODUCT,
        ]);
        if($validator->fails())
        {
            return responseJson(409,'failed',$validator->errors());
        }
        $sellerProduct=$seller->products()->get()->find($product_id);
        if(!$sellerProduct)
        {
            return responseJson(404, 'product does not belong to this seller');

        }
        if($request->has('name'))
        {
            $sellerProduct->name=$request->name;

        }
        if($request->has('description'))
        {
            $sellerProduct->description=$request->description;
        }
        if($request->has('quantity'))
        {
            $sellerProduct->quantity=$request->quantity;
        }
        if($request->has('category_id'))
        {
            $sellerProduct->category_id=$request->category_id;
        }
        if($request->has('status'))
        {
            $sellerProduct->status=$request->status;
        }
        if($request->has('image'))
        {
            File::delete(public_path("img/$sellerProduct->image"));
            $sellerProduct->image=$request->image->store('','images');

        }
        $sellerProduct->save();


        return responseJson(200,'updated successfully',$sellerProduct);

    }
    public function destroy($user_id,$product_id)
    {
        $seller = User::has('products')->get()->find($user_id);
        if (!$seller) {
            return responseJson(404, 'not a seller');

        }
        $sellerProduct=$seller->products()->get()->find($product_id);
        if(!$sellerProduct)
        {
            return responseJson(404, 'product does not belong to this seller or doesnt exist');

        }
        File::delete(public_path("img/$sellerProduct->image"));
        $sellerProduct->delete();
        return responseJson(200,'deleted successfully',$sellerProduct);

    }
}
