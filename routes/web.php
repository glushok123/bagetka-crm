<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

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


Route::get('orders/show/baget', 'App\Http\Controllers\OrderController@showOrdersBaget');

Route::get('orders/create/', 'App\Http\Controllers\OrderController@showCreateForm');
Route::post('orders/create/', 'App\Http\Controllers\OrderController@showCreateFormPost');

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::post('/register', 'App\Http\Controllers\RegisterUserController@registerUser')->name('register');
Route::post('/order/test', 'App\Http\Controllers\OrderController@test')->name('order.test');


