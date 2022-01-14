<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   // public function __construct(){
    //        $this->middleware('auth');
    //    }
    public function index()
    {
        $users=User::paginate(10);
        return responseJson(200,'success',$users);
    }


    public function store(Request $request)
    {
     //We can not use custom request class in APIs because it doesnt not return jason but its returns the main site url
        $validator=Validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());

        }
        $user=User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
        ]);
        return responseJson(200,'success',$user);
    }


    public function show(User $user)
    {
        return responseJson(200,'success',$user);
    }

    public function update(Request $request,User $user)
    {

        $validator=Validator()->make($request->all(),[
           'name'=>'nullable|string|min:5',
           'email'=>'nullable|email|unique:users,email,'.$user->id,
            'password'=>'nullable|min:6|confirmed'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'failed',$validator->errors());
        }
       if($request->has('name'))
       {
           $user->name=$request->name;
       }
        if($request->has('email'))
        {
            $user->email=$request->email;
        }
        if($request->has('password'))
        {
            $user->password=bcrypt($request->password);
        }
        $user->save();
        return responseJson(200,'updated successfully',$user);
    }

    public function destroy(User $user)
    {
        //we must use find method not findorfail which by default is used when we add model as parameters($user User)
        //so we must use it as below in APIs only

            $user->delete();
            return responseJson(200,'deleted successfully',$user);

    }
}
