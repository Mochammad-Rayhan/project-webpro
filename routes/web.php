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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\RegisterController;



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


// Route::get('/', function () {
//     // return view('welcome');
//     return redirect()->route('frontend.v_layouts');
     
// });

// Route::get('/frontend', function () {
//     return view('frontend.v_layouts.app');
// })->name('frontend.v_layouts');

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', [HomeController::class, 'producthome'])->name('home');

Route::get('backend/register', [RegisterController::class, 'index'])
    ->name('register');

Route::post('backend/register', [RegisterController::class, 'store'])
    ->name('register.store');

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

// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/data', [CartController::class, 'getCart'])->name('cart.data');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth');
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');
Route::post('/midtrans/callback', [CartController::class, 'callback']);

// Success page
Route::post('/cart/clear', function() {
    session()->forget('cart');
    return response()->json(['success' => true]);
});
// Route::get('/checkout/success', function() {
//     return view('success');
// });
Route::get('/checkout/success/{order_id}', [CartController::class, 'success'])->name('checkout.success')->middleware('auth');

// Raja Ongkir
Route::get('/get-provinces', [CartController::class, 'getProvinces']);
Route::get('/get-cities/{province_id}', [CartController::class, 'getCities']);
Route::post('/cek-ongkir', [CartController::class, 'cekOngkir']);

// Riwayat Pesanan
Route::get('/riwayat', [OrderController::class, 'riwayat'])
    ->middleware('auth')
    ->name('orders.riwayat');


// Produk
Route::get('/produk', [ProdukController::class, 'list'])->name('produk.list');
Route::get('/produk/{id}', [ProdukController::class, 'detail'])
    ->name('produk.detail');


// Profile
Route::get('/profile', function () {
    return view('frontend.v_profile.profile');
})->name('profile');
Route::post('/profile/update', [UserController::class, 'updateProfile'])
    ->name('profile.update');

// password
Route::middleware('auth')->group(function () {
    Route::get('/password', [UserController::class, 'formPassword'])->name('password.form');
    Route::post('/password', [UserController::class, 'updatePassword'])->name('password.update');
    });