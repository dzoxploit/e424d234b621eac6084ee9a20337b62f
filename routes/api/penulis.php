<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ArtisController;

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

Route::post('penulis/login',[LoginController::class, 'penulisLogin'])->name('penulisLogin');
Route::group( ['prefix' => 'penulis','middleware' => ['auth:penulis-api','scopes:penulis'] ],function(){
    // authenticated staff routes here 
    Route::get('dashboard',[LoginController::class, 'penulisDashboard']);

    Route::get('news', [NewsController::class, 'indexPenulis']);
    Route::get('news/{newsId}', [NewsController::class, 'detailNews']);
    Route::post('news/create', [NewsController::class, 'createPenulis']);
    Route::post('news/update/{id}', [NewsController::class, 'update']);
    Route::delete('news/delete/{id}', [NewsController::class, 'delete']);
    Route::get('news/images/{filename}', [NewsController::class, 'show']);

    Route::get('kategori', [KategoriController::class, 'index']);
    Route::get('kategori/{id}', [KategoriController::class, 'detail']);
    Route::post('kategori/create', [KategoriController::class, 'store']);
    Route::post('kategori/update/{id}', [KategoriController::class, 'update']);
    Route::delete('kategori/delete/{id}', [KategoriController::class, 'delete']);
   
    Route::get('artis', [ArtisController::class, 'index']);
    Route::get('artis/{id}', [ArtisController::class, 'detail']);
    Route::post('artis/create', [ArtisController::class, 'store']);
    Route::post('artis/update/{id}', [ArtisController::class, 'update']);
    Route::delete('artis/delete/{id}', [ArtisController::class, 'delete']);
   
});