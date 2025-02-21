<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->as('admin.')->group(function () {

    //Routes for Category screen

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories', 'store')->name('categories.store');
        Route::get('/categories/{slug}/edit', 'edit')->name('categories.edit');
        Route::post('/categories/{slug}/update', 'update')->name('categories.update');
        Route::delete('/categories/{slug}', 'destroy')->name('categories.destroy');
    });

    Route::prefix('authors')->as('authors.')->controller(AuthorController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{slug}/edit', 'edit')->name('edit');
        Route::post('/{slug}/update', 'update')->name('update');
        Route::delete('/{slug}', 'destroy')->name('destroy');
    });

    Route::prefix('books')->as('books.')->controller(BookController::class) ->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');

        
    });

    Route::prefix('medias')->as('medias.')->controller(MediaController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{slug}/edit', 'edit')->name('edit');
        Route::post('/{slug}/update', 'update')->name('update');
        Route::delete('/{slug}', 'destroy')->name('destroy');

    });

    Route::prefix("teams")->as('teams.')->controller(TeamController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

    });

});



