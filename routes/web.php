<?php

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
use App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('all-logs',[App\Http\Controllers\admin\LogsController::class,'getAllLogs']);
Route::get('logfile/{id}',[App\Http\Controllers\admin\LogsController::class,'getTicketLog']);
Route::get('addreply',[App\Http\Controllers\admin\ReplyController::class,'add']);
Route::get('getreplies',[App\Http\Controllers\admin\ReplyController::class,'getReplies'])->name('getreplies');
Route::get('delete/{id}/{resp_emp}/{emp_name}',[App\Http\Controllers\admin\TicketController::class,'delete'])->middleware('auth');
Route::get('sheet',[App\Http\Controllers\admin\TicketController::class,'index'])->middleware('auth');
Route::get('insert',[App\Http\Controllers\admin\TicketController::class,'insert'])->middleware('auth');
Route::get('edit',[App\Http\Controllers\admin\TicketController::class,'edit'])->middleware('auth');
