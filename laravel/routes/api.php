<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// restful api for a user
Route::prefix('users')->group(function (){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/' , [UserController::class,'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}' , [UserController::class,'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
// restful request for a product
Route::prefix('products')->group(function (){
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/' , [ProductController::class,'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}' , [ProductController::class,'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

/*
Route::get('search/{id}', [UserController::class, 'search']);
Route::get('index', [UserController::class, 'index']);
Route::post('register/' , [UserController::class,'register']);
Route::put('update/{id}' , [UserController::class,'update']);



Route::get('index', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::post('search', [ProductController::class, 'search']);
*/
