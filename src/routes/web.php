<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Controllers\ProductSeasonController;
use App\Models\Product;

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

// 一覧ページ
Route::get('/products', [ProductSeasonController::class, 'index'])->name('product.index');

// 一覧ページ 検索
Route::get('/products/search', [ProductSeasonController::class, 'search']);

/*
詳細ページ
*/
// 表示
Route::get('/products/{productId}', [ProductSeasonController::class, 'show'])->where('productId', '[0-9]+')->name('product.show');

// 更新
Route::patch('/products/{productId}/update', [ProductSeasonController::class, 'update'])->where('productId', '[0-9]+')->name('product.update');

// 削除
Route::delete('/products/{productId}/delete', function () {
    return view('welcome');
})->where('productId', '[0-9]+');

// 登録ページ
Route::get('/products/register', function () {
    return view('productRegister');
});

Route::post('/products/register', [ProductSeasonController::class, 'create'])->name('product.register');

/**
 * テスト用
 */

Route::get('/test', [test::class, 'test']);
