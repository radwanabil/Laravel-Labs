<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' =>[ 'auth']],function(){
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
  //  Route::get('/posts/deleted', [PostController::class, 'showDeletedPosts'])->name('posts.deleted-posts');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    //Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
  //  Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
    //Route::delete('/posts/{post}/{comment}/', [CommentController::class, 'delete'])->name('comments.delete');
});
Route::group(['middleware' =>[ 'auth']] , function(){
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::patch('/posts/restore',[PostController::class,'restore'])->name('posts.restore');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');