<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DealerController;




Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function(){
    
    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AuthController::class, 'loginProcess']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register-process', [AuthController::class, 'registerProcess']);
    
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/registeradmin', [AdminController::class, 'registeradmin']);
    Route::post('/tambahuser', [AdminController::class, 'tambahuserProcess']);
    Route::get('/datauser', [AdminController::class, 'datauser']);
    Route::get('/edituser/{id}', [AdminController::class, 'edituser']);
    Route::put('/updateuser/{id}', [AdminController::class, 'updateuser']);
    Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/view', [AdminController::class, 'view']);


    Route::get('/barang', [BarangController::class, 'barang']);
    Route::get('/tambah', [BarangController::class, 'tambah']);
    Route::post('/barang/create', [BarangController::class, 'create']);
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/delete', [BarangController::class, 'delete']);    
    Route::get('/barangjual', [BarangController::class, 'index']);
    Route::get('/viewdiskon', [BarangController::class, 'viewdiskon']);
    Route::get('/creatediskon', [BarangController::class, 'creatediskon']);
    Route::post('/creatediskon-process', [BarangController::class, 'creatediskonProcess']);
    Route::get('/diskon/{id}/delete', [BarangController::class, 'deletediskon']);


    Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
    Route::get('/diskon', [KeranjangController::class, 'diskon']);
    Route::get('/cekout', [KeranjangController::class, 'cekout']);
    Route::post('/cekoutstore', [KeranjangController::class, 'cekoutstore']);
    Route::post('/keranjang/store', [KeranjangController::class, 'store']);
    Route::get('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang']);
    Route::get('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
    Route::get('/historyorder', [keranjangController::class, 'historyorder']);

    
    Route::get('/order', [DealerController::class, 'order']);
    Route::get('/aprove/{id}/menunggu', [DealerController::class, 'aprove']);
});
