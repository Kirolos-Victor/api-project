<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends Controller
{
    public function index(Category $category)
    {
        $categorySellers = $category
            ->products()
            ->has('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->values();

        return responseJson(200,'success',$categorySellers);
    }
}
