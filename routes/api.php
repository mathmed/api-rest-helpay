<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\GoogleDriveController;


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

/*
  Product routes
*/
Route::prefix('products')->group(function (){
    Route::get('/', [ProductController::class, 'list'])->name('products.list');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::delete('{id}', [ProductController::class, 'delete'])->name('products.delete');
});

/*
  Purchase routes
*/
Route::post('purchase', [PurchaseController::class, 'store'])->name('purchase.store');

/*
  Google routes
*/
Route::get('/google/callback', [GoogleDriveController::class, 'callback']);
 