<?php

use Illuminate\Support\Facades\Route;

//Nhóm đường dẫn theo tiền tố
Route::prefix('admin')->group(function () {
    Route::get('product', function () {
        return "PRODUCT";
    });

    Route::get('category', function () {
        return "CATEGORY";
    });

    Route::get('users', function () {
        return "USER";
    });
});
