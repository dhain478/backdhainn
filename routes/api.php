<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaptopController;
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

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/assets/search', [AssetController::class, 'search']);
    Route::post('/assets', [AssetController::class, 'store']);
    Route::get('/assets', [AssetController::class, 'index']);
    Route::get('/assets/{asset}', [AssetController::class, 'show']);
    Route::put('/assets/{asset}', [AssetController::class, 'update']);
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy']);

    Route::post('/laptops/search', [LaptopController::class, 'search']);
    Route::post('/laptops', [LaptopController::class, 'store']);
    Route::get('/laptops', [LaptopController::class, 'index']);

    Route::group(['middleware'=>'owner'], function() {
        Route::get('/laptops/{laptop}', [LaptopController::class, 'show']);
        Route::put('/laptops/{laptop}', [LaptopController::class, 'update']);
        Route::delete('/laptops/{laptop}', [LaptopController::class, 'destroy']);
    });

});

