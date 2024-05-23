<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TestingHelperController;
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

Route::middleware(['guest'])->group(function(){

    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');

    Route::get('/register',[LoginController::class,'register'])->name('register');
    Route::post('/register-proses',[LoginController::class,'register_proses'])->name('register-proses');

});


Route::middleware(['auth'])->group(function(){

    // ROUTE DASHBOARD/HOME/HALAMAN AWAL
    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    // ROUTE UNTUK USER
    Route::get('/user',[UserController::class,'user'])->name('user');
    Route::get('/user/create',[UserController::class,'usercreate'])->name('user.create');
    Route::post('/user/store',[UserController::class,'userstore'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'useredit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'userupdate'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'userdelete'])->name('user.delete');

    // ROUTE UNTUK PRODUK
    Route::get('/produk',[ProdukController::class,'produk'])->name('produk');
    Route::post('/produk/store',[ProdukController::class,'produkstore'])->name('produk.store');
    Route::put('/produk/update/{id}', [ProdukController::class, 'produkupdate'])->name('produk.update');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'produkdelete'])->name('produk.delete');
    
    // ROUTE UNTUK PENJUALAN
    Route::get('/penjualan',[PenjualanController::class,'penjualan'])->name('penjualan');
    Route::post('/penjualan/tambah',[PenjualanController::class,'penjualantambah'])->name('penjualan.tambah');
    Route::post('/penjualan/kurang/{id}',[PenjualanController::class,'penjualankurang'])->name('penjualan.kurang');
    Route::delete('/penjualan/delete/{id}',[PenjualanController::class, 'penjualandelete'])->name('penjualan.delete');

    // ROUTE UNTUK LAPORAN
    Route::get('/laporan',[LaporanController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/{month}/{year}', [LaporanController::class, 'laporanbulanan'])->name('laporan.bulanan');

    // LOGOUT AKUN
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');

});