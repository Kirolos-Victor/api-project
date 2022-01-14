<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return responseJson(200,'Success',$categories);
    }

    public function store(Request $request)
    {
        $validator=validator()->make($request->all(),[
           'name'=>'required|string',
           'description'=>'required'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'Fail',$validator->errors());

        }
        $category=Category::create([
           'name'=>$request->name,
            'description'=>$request->description
        ]);

        return responseJson(200,'Created Successfully',$category);

    }


    public function show(Category $category)
    {
        return responseJson(200,'Success',$category);

    }


    public function update(Request $request, Category $category)
    {

        $validator=validator()->make($request->all(),[
            'name'=>'nullable|string',
            'description'=>'nullable'
        ]);
        if($validator->fails())
        {
            return responseJson(400,'Failed',$validator->errors());

        }
        if($request->has('name'))
        {
            $category->name=$request->name;
        }
        if($request->has('description'))
        {
            $category->description=$request->description;
        }
        $category->save();
        return responseJson(200,'Updated Successfully',$category);

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return responseJson(200,'Deleted Successfully',$category);

    }
}
