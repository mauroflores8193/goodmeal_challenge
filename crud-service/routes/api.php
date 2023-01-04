<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
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
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('stores', AdminStoreController::class);
    Route::apiResource('stores.products', AdminProductController::class)->shallow();
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/stores', [StoreController::class, 'index']);
