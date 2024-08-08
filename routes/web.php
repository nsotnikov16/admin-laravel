<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    app('admin')->title = 'Главная';
    return view('admin.main');
});

Route::get('/db', function () {
    app('admin')->title = 'Добавление таблицы в базу данных';
    app('admin')->breadcrumbs = [
        ['link' => '/', 'name' => 'Главная'],
        ['name' => app('admin')->title],
    ];
    return view('admin.db');
});

Route::get('/rows', function () {
    app('admin')->title = 'Записи';
    return view('admin.rows.list');
});

Route::get('/row', function () {
    app('admin')->title = 'Запись';
    return view('admin.rows.detail');
});

Route::get('/users', function () {
    app('admin')->title = 'Список пользователей';
    return view('admin.users.list');
});

Route::get('/users/groups', function () {
    app('admin')->title = 'Группы пользователей';
    return view('admin.users.groups');
}); */


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
