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


Route::get('orders/show/baget', 'App\Http\Controllers\OrderController@showOrdersBaget')->name('orders.show');
Route::post('orders/get/json', 'App\Http\Controllers\OrderController@getOrdersJson')->name('orders.get.json');

Route::get('orders/create/', 'App\Http\Controllers\OrderController@showCreateForm');
Route::get('orders/edit/{id}', 'App\Http\Controllers\OrderController@showEditForm')->name('orders.edit');
Route::post('orders/create/', 'App\Http\Controllers\OrderController@showCreateFormPost');


Route::get('orders/print-pdf/{id}', [PDFController::class, 'generatePDFForPrint'])->name('orders.pdf.print');
Route::get('orders/download-pdf/{id}', [PDFController::class, 'generatePDFForDownload'])->name('orders.pdf.download');


Route::get('calendar/show', 'App\Http\Controllers\CalendarController@show');
Route::get('calendar/get/json', 'App\Http\Controllers\CalendarController@getOrdersJson')->name('orders.get.json');

Route::post('/register', 'App\Http\Controllers\RegisterUserController@registerUser')->name('register');
Route::post('/order/test', 'App\Http\Controllers\OrderController@test')->name('order.test');


