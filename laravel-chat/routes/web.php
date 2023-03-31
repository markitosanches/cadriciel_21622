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

use App\Http\Controllers\ChatsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('chat', [ChatsController::class, 'index'])->name('chat');
Route::get('messages', [ChatsController::class, 'fetchMessages'])->name('messages');
Route::post('messages', [ChatsController::class, 'sendMessage'])->name('send.message');