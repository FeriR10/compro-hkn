<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExcelController;




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
    Route::get('/kategori', [BarangController::class, 'kategori']);
    Route::post('/kategori/create', [BarangController::class, 'createkategori']);
    Route::get('/editkategori/{id}', [BarangController::class, 'editkategori']);
    Route::put('/editkategori/{id}/update', [BarangController::class, 'editkategoriudpate']);

    Route::post('/keranjang/store-notif', [BarangController::class, 'storeNotif']);


    Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
    Route::get('/diskon', [KeranjangController::class, 'diskon']);
    Route::get('/cekout', [KeranjangController::class, 'cekout']);
    Route::post('/cekoutstore', [KeranjangController::class, 'cekoutstore']);
    Route::post('/keranjang/store', [KeranjangController::class, 'store']);
    Route::get('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang']);
    Route::get('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
    Route::get('/historyorder', [keranjangController::class, 'historyorder']);
    Route::get('/historyorder/{id}/update', [KeranjangController::class, 'historyorderupdate']);
    Route::get('/keranjang/hapus/{id}', [KeranjangController::class, 'destroy']);
    
    Route::get('/order', [DealerController::class, 'order']);
    Route::get('/aprove/{id}/payment', [DealerController::class, 'aprovepayment']);
    Route::get('/historypemesanan', [DealerController::class, 'historypemesanan']);
    Route::get('/historypemesanan/{id}/update', [DealerController::class, 'historypemsananupdate']);
    Route::get('/viewdetailorder/{id}', [DealerController::class, 'viewdetailorder']);
    Route::get('/homepage', [DealerController::class, 'homepage']);
    Route::get('/aprove/{id}/menunggu', [DealerController::class, 'aprove']);
    Route::get('/aprove/{id}/dp_lunas', [DealerController::class, 'dp_lunas']);
    Route::get('/aprove/{id}/lunas', [DealerController::class, 'lunas']);
    Route::get('/aprove/{id}/dibatalkan', [DealerController::class, 'dibatalkan']);
    Route::get('/editprofile', [DealerController::class, 'editprofile']);
    Route::put('/updateprofile/{id}', [DealerController::class, 'updateprofile']);
    Route::get('/export/{id}', [DealerController::class, 'exportpdf']);
    Route::get('/cekoutdibatalkan/{id}', [DealerController::class, 'cekoutdibatalkan']);
    

    Route::get('/jenispayment', [PaymentController::class, 'jenispayment']);
    Route::get('/paymentaktiv/{id}/update', [PaymentController::class, 'paymentaktiv']);
    Route::get('/paymentnon-aktiv/{id}/update', [PaymentController::class, 'paymentnonaktiv']);
    Route::post('/jenispayment/create', [PaymentController::class, 'store']);
    Route::post('/createuploadbuktibayar/{id}/update', [PaymentController::class, 'createuploadbuktibayar']);
    Route::get('/uploadbuktibayar/{id}', [PaymentController::class, 'uploadbuktibayar']);

    Route::get('/pengumuman', [PengumumanController::class, 'pengumuman']);
    Route::post('/createpengumuman-process', [PengumumanController::class, 'createpengumumanProcess']);
    Route::get('/delete/{id}', [PengumumanController::class, 'deletepengumuman']);

    Route::get('/history/export/{id}', [ExcelController::class, 'export']);
    Route::get('/historybyorder', [ExcelController::class, 'historybyorder']);


});
