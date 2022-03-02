<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Models\User;
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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/chat', [ChatController::class, 'getUsers']);
    Route::get('/chat/room/{id}', [ChatController::class, 'room']);
    Route::post('/chat/room/{id}', [ChatController::class, 'message']);
});
