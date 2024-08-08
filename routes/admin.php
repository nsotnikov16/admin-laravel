<?php

use App\Http\Controllers\Admin\EntitiesController;
use App\Http\Controllers\Admin\InsertsController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SeoController;
use Illuminate\Support\Facades\Route;

Route::/* middleware('auth')-> */prefix('admin')->name('admin.')->group(function () {
    Route::get('/', MainController::class)->name('main');
    Route::resource('entities', EntitiesController::class);
    Route::resource('seo', SeoController::class);
    Route::resource('pages', PagesController::class);
    Route::prefix('inserts')->name('inserts.')->group(function () {
        Route::get('/', [InsertsController::class, 'index'])->name('index');
        Route::post('/', [InsertsController::class, 'save'])->name('save');
    });
});
