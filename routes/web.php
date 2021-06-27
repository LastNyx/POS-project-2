<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
use App\Http\Livewire\Transaction;
use App\Http\Livewire\Dashboard;
use App\Http\Controllers\StrukController;

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


Auth::routes();

Route::group(['middleware'=> ['auth']], function () {
    Route::get('/products', Product::class);
    Route::get('/', Dashboard::class);
    Route::get('/transaction',Transaction::class);
    Route::get('/pdf', [StrukController::class, 'createPDF']);
});
