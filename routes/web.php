<?php

use App\Http\Controllers\PostsController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

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
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Post'], function (){
    Route::get('/posts', 'IndexController')->name('posts.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');

    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.destroy');
});

//Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
//Route::get('/posts/create', [PostsController::class, 'create'])->name('post.create');
//
//Route::post('/posts', [PostsController::class, 'store'])->name('post.store');
//Route::get('/posts/{post}', [PostsController::class, 'show'])->name('post.show');
//Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('post.edit');
//Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('post.update');
//Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('post.destroy');

Route::get('/posts/update', [PostsController::class, 'update']);
Route::get('/posts/delete', [PostsController::class, 'delete']);
Route::get('/posts/restore', [PostsController::class, 'restore']);
Route::get('/posts/first_or_create', [PostsController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [PostsController::class, 'updateOrCreate']);

Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
