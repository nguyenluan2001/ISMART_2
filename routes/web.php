<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Page;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Main\MainBlogController;
use App\Http\Controllers\Main\MainCartController;
use App\Http\Controllers\Main\MainCheckOutController;
use App\Http\Controllers\Main\MainProductController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Main\MainOrderController;
use App\Http\Controllers\Main\MainPageController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('allow_cors')->group(function () {
    Route::get('page/{slug}',[MainPageController::class,'index'])->name('page.index');
    Route::get('blog',[MainBlogController::class,'index'])->name('blog.index');
    Route::get('blog/{slug}',[MainBlogController::class,'show'])->name('blog.show');
    Route::get('cart', [MainCartController::class, 'index'])->name('cart.index');
    Route::post('cart/ajax', [MainCartController::class, 'ajax'])->name('cart.ajax');
    Route::get('cart/delete/{rowId?}', [MainCartController::class, 'delete'])->name('cart.delete');
    Route::get('checkout', [MainCheckOutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/ajax/district', [MainCheckOutController::class, 'ajax_district']);
    Route::post('checkout/ajax/ward', [MainCheckOutController::class, 'ajax_ward']);
    Route::post('order/store', [MainOrderController::class, 'store'])->name('order.store');
    Route::get('thanh-toan-thanh-cong', [MainCheckOutController::class, 'checkout_success'])->name('checkout.success');
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('page')->name('page.')->group(function () {
            Route::get('create', [PageController::class, 'create'])->name('create');
            Route::post('store', [PageController::class, 'store'])->name('store');
            Route::get('index', [PageController::class, 'index'])->name('index');
            Route::get('edit/{slug}', [PageController::class, 'edit'])->name('edit');
            Route::post('update/{slug}', [PageController::class, 'update'])->name('update');
            Route::get('delete/{slug}', [PageController::class, 'delete'])->name('delete');
        });
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('edit/{slug}', [ProductController::class, 'edit'])->name('edit');
            Route::post('update/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('delete/{product}', [ProductController::class, 'delete'])->name('delete');
            Route::get('category', [ProductCategoryController::class, 'index'])->name('category.index');
            Route::post('category', [ProductCategoryController::class, 'store'])->name('category.store');
            Route::post('search',[ProductController::class,'search'])->name('search');
            Route::get('/{status?}', [ProductController::class, 'index'])->name('index');
            Route::get('{product_cat_slug}/{product_sub_cat_slug}/{status?}',[ProductController::class,'product_by_category'])->name('product_by_category');

        });
        Route::prefix('ajax')->name('ajax.')->group(function () {
            Route::post('product_category', [AjaxController::class, 'product_category'])->name('product_category');
        });
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/{status?}', [AdminOrderController::class, 'index'])->name('index');
            Route::get('edit/{order}', [AdminOrderController::class, 'edit'])->name('edit');
            Route::post('update/{order}', [AdminOrderController::class, 'update'])->name('update');
            Route::get('delete/{order}', [AdminOrderController::class, 'delete'])->name('delete');
            Route::post('action', [AdminOrderController::class, 'action'])->name('action');
            Route::post('search',[AdminOrderController::class,'search'])->name('search');
        });
        Route::prefix('post')->name('post.')->group(function(){
            Route::get('/',[AdminPostController::class,'index'])->name('index');
            Route::get('/create',[AdminPostController::class,'create'])->name('create');
            Route::post('/store',[AdminPostController::class,'store'])->name('store');
            Route::get('/edit/{post}',[AdminPostController::class,'edit'])->name('edit');
            Route::post('update/{post}',[AdminPostController::class,'update'])->name('update');

        });
    });
    Auth::routes();
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('{product_cat_slug}/{product_sub_cat_slug}', [MainProductController::class, 'product_by_category'])->name('product.category');
    Route::get('{product_cat_slug}/{product_sub_cat_slug}/filter', [MainProductController::class, 'product_by_category_filter'])->name('product.category.filter');
    Route::get('{product_slug}', [MainProductController::class, 'show'])->name('product.show');
    Route::post('search',[MainProductController::class,'search'])->name('product.search');
    Route::post('cart/add/{product}', [MainCartController::class, 'add'])->name('cart.add');
});
