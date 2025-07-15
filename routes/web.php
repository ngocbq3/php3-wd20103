<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

Route::get('/about-us', function () {
    return "ABOUT PAGE";
})->name('about'); //Đặt tên cho đường dẫn

Route::get('/contact', function () {
    return "CONTACT PAGE";
});

Route::get('/user/{id}', function ($id) {
    return "USER ID: $id";
});

Route::prefix('/admin')->group(function () {
    Route::get('/posts', function () {
        return "ADMIN POST";
    });
    Route::get('/posts/edit', function () {
        return "ADMIN POST EDIT";
    });
});

Route::name('product.')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('list');

    //Lấy 1 sản phẩm theo id
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('show');
    Route::get('/products/add', function () {
        return "Add product";
    })->name('add');
});

//Demo
Route::get('/demo', function () {
    return view('demo');
});
