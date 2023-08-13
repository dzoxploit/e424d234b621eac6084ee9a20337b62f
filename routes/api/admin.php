<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;

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

Route::post('admin/login',[LoginController::class, 'adminLogin'])->name('adminLogin');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
    // authenticated staff routes here 
    Route::get('dashboard',[LoginController::class, 'adminDashboard']);

    Route::get('news', [NewsController::class, 'indexAdmin']);
    Route::get('news/{newsId}', [NewsController::class, 'detailNews']);
    Route::post('news/create', [NewsController::class, 'createAdmin']);
    Route::post('news/update/{id}', [NewsController::class, 'update']);
    Route::delete('news/delete/{id}', [NewsController::class, 'delete']);
    Route::get('news/images/{filename}', [NewsController::class, 'show']);
});