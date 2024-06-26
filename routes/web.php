<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});
/* Route::get('/posts', [PostController::class,"index"]);
Route::get('/posts/create', [PostController::class,"create"]);
Route::post('/posts', [PostController::class,"store"]);
Route::get('/posts/{id}',  [PostController::class,"show"]);
Route::get('/posts/{id}/edit',[PostController::class,"edit"]);
Route::put('/posts/{id}', [PostController::class,"update"]);
Route::delete('/posts/{id}',[PostController::class,"destroy"]); */

Route::resource("posts",PostController::class)->middleware("auth");
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
