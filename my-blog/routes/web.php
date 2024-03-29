<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LocalizationController;
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



Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index')->middleware('auth');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show')->middleware('auth');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update')->middleware('auth');
Route::delete('blog-edit/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete')->middleware('auth');

Route::get('query', [BlogPostController::class, 'query']);

Route::get('blog-page', [BlogPostController::class, 'page'])->middleware('auth');
Route::get('blog-pdf/{blogPost}', [BlogPostController::class, 'pdf'])->name('blog.pdf')->middleware('auth');

Route::get('registration', [CustomAuthController::class, 'create'])->name('user.registration');
Route::post('registration', [CustomAuthController::class, 'store']);
Route::get('user-list', [CustomAuthController::class, 'userList'])->name('user.list')->middleware('auth');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'authentication']);
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('forgot-password', [CustomAuthController::class, 'tempPassword']);
Route::get('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'newPassword'])->name('new.password');
Route::post('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'storeNewPassword']);

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');