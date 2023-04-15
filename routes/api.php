<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Master\ItemCategory\ItemCategoryApi;
use App\Http\Controllers\Master\ItemCategoryController;
use GuzzleHttp\Middleware;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH RELATED ROUTE

// LOGIN USER
Route::post('/login', [AuthController::class, 'loginUser']);


// LOGOUT USER
Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/logout', [AuthController::class, 'logout']);

});


Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function() {

    Route::get('/itemCategoryViewApi',[ItemCategoryApi::class, 'itemCategoryViewApi'])->name('itemCategoryViewApi');
    Route::get('/itemCategoryViewByIdApi/{id}',[ItemCategoryApi::class, 'itemCategoryViewByIdApi'])->name('itemCategoryViewByIdApi');

});

// ITEM CATEGORY ADD ROUTES 
Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function () {

    Route::post('/itemCategoryAddAction',[ItemCategoryApi::class, 'itemCategoryAddAction'])->name('itemCategoryAddAction');

});

