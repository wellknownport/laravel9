<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers;

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

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/assets/{id}', [AssetsController::class, 'output'])
    ->where('id', '[0-9]+')
    ->name('asset');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Controllers\Admin\PagesController::class, 'home'])->name('home');
    Route::post('/posts/store', [Controllers\Admin\PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/create', [Controllers\Admin\PostsController::class, 'form'])->name('posts.create');
    Route::get('/posts/{id}/delete', [Controllers\Admin\PostsController::class, 'delete'])
        ->where('id', '[0-9]+')
        ->name('posts.delete');
    Route::get('/posts/{id}/update', [Controllers\Admin\PostsController::class, 'form'])
        ->where('id', '[0-9]+')
        ->name('posts.update');
});

