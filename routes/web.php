<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/cart', [WelcomeController::class, 'cart'])->name('cart');
Route::get('/cars/shoppingcart', [WelcomeController::class, 'shoppingcart']);
