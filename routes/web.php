<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'showCatalog'])->name('catalog');

Route::post('/order', [OrderController::class, 'store'])->name('make_order');

Route::get('/product/{id}', [PageController::class, 'showProductPage'])->name('show_product');

Route::get('/dashboard', function () {
    return redirect(route('admin_panel'));
});


Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin'
], function () {

    Route::get('/', function () {
        return redirect(route('admin_orders'));
    })->name('admin_panel');

    Route::get('/products', [PageController::class, 'showAdminProducts'])->name('admin_products');

    Route::get('/products/deleted', [PageController::class, 'showAdminDeletedProducts'])->name('admin_deleted_products');

    Route::get('/orders', [PageController::class, 'showAdminOrders'])->name('admin_orders');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create_product');

        Route::post('/store', [ProductController::class, 'store'])->name('store_product');

        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit_product');

        Route::patch('/{id}/update', [ProductController::class, 'update'])->name('update_product');

        Route::delete('/{id}/delete', [ProductController::class, 'destroy'])->name('delete_product');

        Route::post('/{id}/restore', [ProductController::class, 'restore'])->name('restore_product');
    });
});

require __DIR__ . '/auth.php';
