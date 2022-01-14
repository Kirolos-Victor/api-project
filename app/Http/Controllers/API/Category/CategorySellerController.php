<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellerController extends Controller
{
    public function index(Category $category){
        $categorySellers=$category
            ->products()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique();

        return responseJson(200,'success',$categorySellers);
    }
}
