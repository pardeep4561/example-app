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



/* 
 |--------------------------------------------------------------------------
 | Using Controller Namespace For Routing
 |--------------------------------------------------------------------------
*/
use App\Http\Controllers\SMSController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('chat.index');
});



Route::get('/sms',[SMSController::class,"index"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/test',[SMSController::class,"test"])->name('test');

Route::get('/messages',[MessageController::class,'index'])->name("messages");
Route::get('/chat/{id}',[MessageController::class,'chat'])->name("chat");