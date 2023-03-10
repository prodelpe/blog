<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');

    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');

    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('posts.update');

    Route::post('/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');
});

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/cinema', [IndexController::class, 'cinema'])->name('cinema');
