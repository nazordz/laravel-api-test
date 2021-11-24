<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::post('/user-logout', [UserController::class, 'logout']);

    Route::group(['prefix' => '/users'], function() {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'create']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'category-products'], function() {
        Route::get('/', [CategoryProductController::class, 'index']);
        Route::post('/', [CategoryProductController::class, 'create']);
        Route::put('/{id}', [CategoryProductController::class, 'update']);
        Route::delete('/', [CategoryProductController::class, 'destroy']);
    });

    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'create']);
        Route::post('/{id}', [ProductController::class, 'update']);
        Route::delete('/', [ProductController::class, 'destroy']);
    });

    Route::get('transactions', [TransactionController::class, 'index']);
    Route::get('transaction/{id}', [TransactionController::class, 'show']);
    Route::post('transaction', [TransactionController::class, 'create']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
