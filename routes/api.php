<?php

use App\Http\Controllers\API\Buyer\BuyerCategoryController;
use App\Http\Controllers\API\Buyer\BuyerController;
use App\Http\Controllers\API\Buyer\BuyerProductController;
use App\Http\Controllers\API\Buyer\BuyerSellerController;
use App\Http\Controllers\API\Buyer\BuyerTransactionController;
use App\Http\Controllers\API\Category\CategoryBuyerController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Category\CategoryProductController;
use App\Http\Controllers\API\Category\CategorySellerController;
use App\Http\Controllers\API\Category\CategoryTransactionController;
use App\Http\Controllers\API\Product\ProductBuyerController;
use App\Http\Controllers\API\Product\ProductCategoryController;
use App\Http\Controllers\API\Product\ProductController;
use App\Http\Controllers\API\Product\ProductTransactionController;
use App\Http\Controllers\API\Seller\SellerBuyerController;
use App\Http\Controllers\API\Seller\SellerCategoryController;
use App\Http\Controllers\API\Seller\SellerController;
use App\Http\Controllers\API\Seller\SellerProductController;
use App\Http\Controllers\API\Seller\SellerTransactionController;
use App\Http\Controllers\API\Transaction\TransactionCategoryController;
use App\Http\Controllers\API\Transaction\TransactionController;
use App\Http\Controllers\API\Transaction\TransactionSellerController;
use App\Http\Controllers\API\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users',UserController::class);
Route::apiResource('buyers',BuyerController::class);
Route::apiResource('sellers',SellerController::class);
Route::apiResource('categories',CategoryController::class);
Route::apiResource('transactions',TransactionController::class);
Route::apiResource('products',ProductController::class);
// transaction category
Route::get('transactions/{transaction}/category',[TransactionCategoryController::class,'index']);
// transaction_seller
Route::get('transactions/{transaction}/seller',[TransactionSellerController::class,'index']);
//buyer_transaction
Route::get('users/{user}/transactions',[BuyerTransactionController::class,'index']);
//buyer_product
Route::get('users/{user}/products',[BuyerProductController::class,'index']);
//buyer_sellers
Route::get('users/{user}/sellers',[BuyerSellerController::class,'index']);
//buyer_categories
Route::get('users/{user}/categories',[BuyerCategoryController::class,'index']);
//category_products
Route::get('categories/{category}/products',[CategoryProductController::class,'index']);
//category_sellers
Route::get('categories/{category}/sellers',[CategorySellerController::class,'index']);
//category_transactions
Route::get('categories/{category}/transactions',[CategoryTransactionController::class,'index']);
//category_buyers
Route::get('categories/{category}/buyers',[CategoryBuyerController::class,'index']);
//seller_transactions
Route::get('sellers/{user}/transactions',[SellerTransactionController::class,'index']);
//seller_categories
Route::get('sellers/{user}/categories',[SellerCategoryController::class,'index']);
//seller_buyers
Route::get('sellers/{user}/buyers',[SellerBuyerController::class,'index']);
//seller_products
Route::get('sellers/{user}/products',[SellerProductController::class,'index']);
Route::post('sellers/{user}/products',[SellerProductController::class,'store']);
Route::put('sellers/{user}/products/{product}',[SellerProductController::class,'update']);
Route::delete('sellers/{user}/products/{product}',[SellerProductController::class,'destroy']);
//product_transactions
Route::get('products/{product}/transactions',[ProductTransactionController::class,'index']);
//product_buyers
Route::get('products/{product}/buyers',[ProductBuyerController::class,'index']);
//product_category
Route::get('products/{product}/category',[ProductCategoryController::class,'index']);
Route::put('products/{product}/category',[ProductCategoryController::class,'update']);
