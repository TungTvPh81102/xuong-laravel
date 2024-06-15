<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [ClientProductController::class, 'productDetail'])->name('product.detail');

// Mua bán hàng
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::get('order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');


Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);
Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('auth/register', [RegisterController::class, 'register']);;

// ADMIN

Route::prefix('admin')->as('admin.')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('catalogues')->as('catalogues.')->group(function () {
        Route::get('/', [CatalogueController::class, 'index'])->name('index');
        Route::get('create', [CatalogueController::class, 'create'])->name('create');
        Route::post('store', [CatalogueController::class, 'store'])->name('store');
        Route::get('trash', [CatalogueController::class, 'trash'])->name('trash');
        Route::get('show/{id}', [CatalogueController::class, 'show'])->name('show');
        Route::get('restore/{id}', [CatalogueController::class, 'restore'])->name('restore');
        Route::get('{id}/edit', [CatalogueController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CatalogueController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CatalogueController::class, 'delete'])->name('delete');
        Route::delete('destroy/{id}', [CatalogueController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('brands')->as('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('create', [BrandController::class, 'create'])->name('create');
        Route::post('store', [BrandController::class, 'store'])->name('store');
        Route::get('trash', [BrandController::class, 'trash'])->name('trash');
        Route::get('show/{id}', [BrandController::class, 'show'])->name('show');
        Route::get('restore/{id}', [BrandController::class, 'restore'])->name('restore');
        Route::get('{id}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BrandController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [BrandController::class, 'delete'])->name('delete');
        Route::delete('destroy/{id}', [BrandController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('sliders')->as('sliders.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('create', [SliderController::class, 'create'])->name('create');
        Route::post('store', [SliderController::class, 'store'])->name('store');
        Route::get('trash', [SliderController::class, 'trash'])->name('trash');
        Route::get('show/{id}', [SliderController::class, 'show'])->name('show');
        Route::get('restore/{id}', [SliderController::class, 'restore'])->name('restore');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [SliderController::class, 'delete'])->name('delete');
        Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->as('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('trash', [ProductController::class, 'trash'])->name('trash');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
        Route::get('restore/{id}', [ProductController::class, 'restore'])->name('restore');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
