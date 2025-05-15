<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 商品登録フォーム表示
Route::get('/products/register', [ProductController::class, 'create'])->name('products.register');
// 商品登録処理
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

// 商品一覧
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品詳細
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// 商品更新
Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');

// 商品削除
Route::post('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');

// 検索
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
