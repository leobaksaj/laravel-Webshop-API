<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProductController;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::resource('products', ProductController::class );
Route::resource('categories', CategoryController::class );
Route::resource('price-lists', PriceListController::class);
Route::resource('contract-lists', ContractListController::class);
Route::resource('orders', OrderController::class);

Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter'); //filtriranje proizvoda
Route::get('/products/{product}', [ProductController::class, 'showProduct']);                  //ispis jednog proizvoda 
Route::get('/products', [ProductController::class, 'index']);# ->name('products.index');       //ispis proizvoda sa paginacijom
Route::get('/categories/{category}/products', [ProductController::class, 'indexByCategory']);  //ispis proizvoda po kategoriji sa paginacijom

Route::post('/orders', [OrderController::class, 'create']);

Route::post('/products/{product}/add-category', [ProductController::class, 'addCategory'])->name('products.addCategory');
Route::post('/products/{product}/price-lists', [ProductController::class, 'addPriceList']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
