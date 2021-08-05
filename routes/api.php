<?php

use App\Http\Controllers\API\AssetController;
use App\Http\Controllers\API\StockController;
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

Route::get('assets', [AssetController::class, 'index']);

Route::get('stocks/popular', [StockController::class, 'popular']);
Route::get('stocks/{ticker}', [StockController::class, 'show']);
