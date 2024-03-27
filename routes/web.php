<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('layouts.home');
})->name('admin')->middleware('admin');

Route::get('/director', function () {
    return view('layouts.director');
})->name('director')->middleware('director');

Route::get('/nurse', function () {
    return view('layouts.nurse');
})->name('nurse')->middleware('nurse');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->name('item');
Route::get('/create/items', [App\Http\Controllers\ItemController::class, 'create'])->name('item.create');
Route::post('items',  [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');

// Define PUT route for updating an existing wards
Route::put('items/{item}', [App\Http\Controllers\ItemController::class, 'create'])->name('item.update');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('c');
Route::get('/create/categories', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('categories',  [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');



Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase');
Route::get('/purchases/items', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchases.create');
Route::post('purchases',  [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/get-items', [App\Http\Controllers\PurchaseController::class, 'getItems'])->name('get-items');
Route::get('/get-item-price/{id}', [App\Http\Controllers\PurchaseController::class, 'getItemPrice']);
Route::get('/get-selling-price/{itemId}',  [App\Http\Controllers\PurchaseController::class, 'getSellingPrice'])->name('get-selling-price');
Route::get('/get-buying_price/{itemId}',  [App\Http\Controllers\PurchaseController::class, 'getBuyingPrice'])->name('get-buying_price');




Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
Route::post('orders',  [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
Route::delete('/orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
Route::get('/orders/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit'])->name('order.edit');
Route::put('/orders/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');

Route::get('/stock', [App\Http\Controllers\StockController::class, 'index'])->name('stock.index');
Route::delete('/stocks/{id}', [App\Http\Controllers\StockController::class, 'destroy'])->name('stock.destroy');

