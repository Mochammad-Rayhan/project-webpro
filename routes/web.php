<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\GoogleController;


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


Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login');
     
});

Route::get('backend/beranda' , [BerandaController::class , 'berandaBackend'])->name('backend.beranda');
Route::get('backend/login' , [LoginController::class , 'loginBackend'])->name('backend.login');
Route::post('backend/login' , [LoginController::class , 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout' , [LoginController::class , 'logoutBackend'])->name('backend.logout');

//Route Resource
Route::resource('backend/user' , UserController::class , ['as' => 'backend'])->middleware('auth');
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/produk' , ProdukController::class , ['as' => 'backend'])->middleware('auth');
Route::resource('backend/supplier' , SupplierController::class , ['as' => 'backend'])->middleware('auth');
Route::resource('backend/masuk' , BarangmasukController::class , ['as' => 'backend'])->middleware('auth');
Route::resource('backend/keluar' , BarangkeluarController::class , ['as' => 'backend'])->middleware('auth');

// Google Cloud Console
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);