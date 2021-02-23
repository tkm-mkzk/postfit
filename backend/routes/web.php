<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/', function () {
    return view('blog/index');
});

Route::get('blog/index', [BlogController::class, 'index'])->name('blog.index');

Route::group(['prefix' => 'blog', 'middleware' => 'auth'], function(){
    Route::get('create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('show/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
