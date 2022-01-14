<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index(Category $category){
        $categoryProducts=$category->products;
        return responseJson(200,'success',$categoryProducts);
    }
}
