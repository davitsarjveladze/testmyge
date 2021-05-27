<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CartController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/addProductInCart', [CartController::class, 'addProductInCart'])->name('addProductInCart');
Route::post('/removeProductFromCart', [CartController::class, 'removeProductFromCart'])->name('removeProductFromCart');
Route::post('/setCartProductQuantity', [CartController::class, 'setCartProductQuantity'])->name('setCartProductQuantity');
Route::get('/getUserCart', [CartController::class, 'getUserCart'])->name('getUserCart');

require __DIR__.'/auth.php';
