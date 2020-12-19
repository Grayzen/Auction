<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('products/bid/{product}', [ProductController::class, 'bid'])->name('products.bid');
Route::post('products/bid/{product}', [ProductController::class, 'bidPost'])->name('products.offer');
Route::get('products/finish', [ProductController::class, 'finish'])->name('products.finish');
Route::resource('products', ProductController::class);

require __DIR__.'/auth.php';
