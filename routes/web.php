<?php

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

Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');
Route::get('blog/post/{post}', 'App\Http\Controllers\Blog\PostController@show')->name('blog_single_post');
Route::get('blog/category/{category}', 'App\Http\Controllers\Blog\PostController@category')->name('blog_category');
Route::get('blog/tag/{tag}', 'App\Http\Controllers\Blog\PostController@tag')->name('blog_tag');


Auth::routes();

Route::middleware(['auth'])->group( function(){

    Route::resource('categories', 'App\Http\Controllers\CategoryController');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('posts', 'App\Http\Controllers\PostController');
    
    Route::get('trashed_posts', 'App\Http\Controllers\PostController@showTrashedPosts')->name('trashedPosts');
    Route::put('restore_post/{post}', 'App\Http\Controllers\PostController@restorePost')->name('restorePost');

    Route::resource('tags', 'App\Http\Controllers\TagController');

});

Route::middleware(['auth', 'admin'])->group( function (){

    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    
    Route::put('/user/update', 'App\Http\Controllers\UserController@update')->name('users.update');
    Route::post('users/{user}/makeAdministrator', 'App\Http\Controllers\UserController@makeAdministrator')->name('users.makeAdministrator');
});
Route::get('/users_edit_profile', 'App\Http\Controllers\UserController@edit')->name('users_edit_profile')->middleware('auth');