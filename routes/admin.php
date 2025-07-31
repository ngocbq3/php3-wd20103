<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create'); //Hiển thị form thêm
    Route::post('/products/create', [ProductController::class, 'store'])->name('admin.products.store'); //thêm dữ liệu vào database
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit'); //Hiển thị form sửa
    Route::put('/products/{product}/edit', [ProductController::class, 'update'])->name('admin.products.update'); //Lưu dữ liệu sửa vào database
    Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.products.destroy'); // Xóa dữ liệu theo id
});
