<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendProductoController;
use App\Http\Controllers\BackendCategoriaController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\BackendContactoController;
use App\Http\Controllers\BackendDeseoController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
/*Backtend */
Route::get('backend', [BackendController::class, 'main'])->middleware('auth');
Route::resource('backend/categoria', BackendCategoriaController::class, ['names' => 'backend.categoria']);
Route::resource('backend/producto', BackendProductoController::class, ['names' => 'backend.producto']);
Route::get('backend/producto/{id}/finalizar', [BackendProductoController::class, 'finalizar']);
Route::resource('backend/contacto', BackendContactoController::class, ['names' => 'backend.contacto']);
Route::resource('backend/deseo', BackendDeseoController::class, ['names' => 'backend.deseo']);


/*Frontend*/
Route::resource('/home', FrontendController::class, ['names' => 'frontend']);
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/shop/{id}', [FrontendController::class, 'shopid'])->name('shopid');
Route::get('/shop/{name}/{id}', [FrontendController::class, 'single'])->name('single');
//Route::get('/index', [ProductoController::class, 'shop'])->name('shop');
Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

