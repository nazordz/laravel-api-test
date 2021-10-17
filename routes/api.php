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

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'create']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'destroy']);

    Route::get('category-products', [CategoryProductController::class, 'index']);
    Route::post('category-products', [CategoryProductController::class, 'create']);
    Route::put('category-products/{id}', [CategoryProductController::class, 'update']);
    Route::delete('category-products', [CategoryProductController::class, 'destroy']);

    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'create']);
    Route::post('products/{id}', [ProductController::class, 'update']);
    Route::delete('products', [ProductController::class, 'destroy']);

    Route::get('transactions', [TransactionController::class, 'index']);
    Route::get('transaction/{id}', [TransactionController::class, 'show']);
    Route::post('transaction', [TransactionController::class, 'create']);
});

Route::get('/', function() {
    return ['status' => 'success'];
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
