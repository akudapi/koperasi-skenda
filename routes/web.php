<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/',[LoginController::class,'index'])->name('login');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register-proses',[LoginController::class,'register_proses'])->name('register-proses');


Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as' => 'admin.'] , function(){

    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    Route::get('/user',[UserController::class,'user'])->name('user');
    Route::get('/userCreate',[UserController::class,'usercreate'])->name('user.create');
    Route::post('/userStore',[UserController::class,'userstore'])->name('user.store');

    Route::get('/userEdit/{id}', [UserController::class, 'useredit'])->name('user.edit');
    Route::put('/userUpdate/{id}', [UserController::class, 'userupdate'])->name('user.update');
    Route::delete('/userDelete/{id}', [UserController::class, 'userdelete'])->name('user.delete');

    Route::get('/produk',[HomeController::class,'produk'])->name('produk');
    // Route::get('/create',[HomeController::class,'create'])->name('user.create');
    // Route::post('/store',[HomeController::class,'store'])->name('user.store');

    Route::get('/penjualan',[HomeController::class,'penjualan'])->name('penjualan');
    
});