<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


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

// Route::get('/', function () {
//     return view('index')->name('index');
// });

Route::get('/','IndexController')->name('index');

Auth::routes();

Route::group(['namespace'=>'User'], function() {
    Route::get('/users/{user}', 'IndexController')->name('user');
});

Route::group(['namespace'=>'Board'], function() {
    Route::get('/boards/{board}','IndexController')->name('board.index');
    Route::post('/boards','StoreController')->name('board.store');
    Route::get('/boards/create','CreateController')->name('image.create');
    Route::get('/boards/{board}/board','ShowController')->name('board.show');
    Route::get('/boards/{board}/edit','EditController')->name('board.edit');
    Route::patch('/boards/{board}/update','UpdateController')->name('board.update');
    Route::delete('/boards/{board}/destroy','DestroyController')->name('board.destroy');
});

Route::group(['namespace'=> 'Image', 'prefix'=>'images'], function() {
    Route::get('/{image}','IndexController')->name('image.index');
    Route::post('/','StoreController')->name('image.store');
    Route::get('/create','CreateController')->name('image.create');
    Route::post('/{image}/save','SaveController')->name('image.save');
    Route::post('/{image}/remove','RemoveController')->name('image.remove');
    Route::get('/{image}/show','ShowController')->name('image.show');
    Route::get('/{image}/edit','EditController')->name('image.edit');
    Route::patch('/{image}/update','UpdateController')->name('image.update');
    Route::get('/{image}/delete','DeleteController')->name('image.delete');
    Route::delete('/{image}/destroy','DestroyController')->name('image.destroy');

    Route::group(['namespace' => 'Comment', 'prefix' => '{image}/comments'], function () {
        Route::post('/', 'StoreController')->name('image.comment.store');
    });

    Route::group(['namespace' => 'Like', 'prefix' => '{image}/likes'], function () {
        // Route::post('/', 'StoreController')->name('image.like.store');
        // Route::post('/', 'DeleteController')->name('image.like.delete');
        Route::post('/', 'IndexController')->name('image.like.index');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
