<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ChildController;
use App\Models\Item;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ItemController::class, 'index']);
Route::get('/item/delete/{item}',[ItemController::class, 'destroy']);
Route::post('/item/store',[ItemController::class, 'store']);
Route::post('/child/store',[ChildController::class, 'store']);
Route::get('/child/delete/{child}',[ChildController::class, 'destroy']);
Route::get('/cron', [ItemController::class, 'update']);