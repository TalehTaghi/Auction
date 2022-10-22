<?php

use App\Http\Controllers\LotCategoryController;
use App\Http\Controllers\LotController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('lots/get-by-categories', [LotController::class, 'getByCategories']);
Route::resources([
    'categories' => LotCategoryController::class,
    'lots' => LotController::class
]);
