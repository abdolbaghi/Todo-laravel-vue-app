<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DailyItemController;

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

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/grouped', [ItemController::class, 'dailyGrouped']);
Route::get('/categories', [CategoriesController::class, 'index']);

Route::prefix('item')->group(function () {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});
Route::prefix('daily_item')->group(function () {

    Route::get('/', [DailyItemController::class, 'index'])->name('daily_item.index');
    Route::post('/store', [DailyItemController::class, 'store'])->name('daily_item.store');
    Route::put('/{DailyItem}', [DailyItemController::class, 'update'])->name('daily_item.update');
    Route::delete('/{DailyItem}', [DailyItemController::class, 'destroy'])->name('daily_item.destroy');
});
