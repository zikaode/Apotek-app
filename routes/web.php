<?php

use App\Models\Obat;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\SupplierController;

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

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/penjualan/kasir', [PenjualanController::class, 'create'])->name('penjualan.kasir');
    Route::get('/penjualan/kasirmin/{id}', [PenjualanController::class, 'min'])->name('kasir.min');
    Route::get('/penjualan/kasirdel/{id}', [PenjualanController::class, 'del'])->name('kasir.del');
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian');
    Route::get('/penjualan/bukti/{id}', [PenjualanController::class, 'bukti'])->name('penjualan.bukti');
    Route::post('penjualan/add', [PenjualanController::class, 'add'])->name('kasir.add');
    Route::post('penjualan/transaksi', [PenjualanController::class, 'transaksi'])->name('kasir.transaksi');
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post(
        '/supplier/add',
        [SupplierController::class, 'store']
    )->name('supplier.add');
    Route::post(
        '/supplier/{supplier}/edit',
        [SupplierController::class, 'update']
    )->name('supplier.update');
    Route::get(
        '/supplier/{id?}/delete',
        [SupplierController::class, 'destroy']
    )->name('supplier.delete');
    Route::get('penjualan/reset', function () {
        session()->forget('kasir');
        return redirect(route('penjualan.kasir'));
    })->name('kasir.reset');
    Route::get('penjualan/add', function () {
        return redirect(route('penjualan.kasir'));
    })->name('kasir.add.redirect');
    Route::get('penjualan/transaksi', function () {
        return redirect(route('penjualan.kasir'));
    })->name('kasir.transaksi.redirect');
    Route::get(
        '/user',
        [UserController::class, 'index']
    )->name('user');
    Route::post(
        '/user/add',
        [UserController::class, 'store']
    )->name('user.add');
    Route::post(
        '/user/delete',
        [UserController::class, 'destroy']
    )->name('user.delete');
    Route::get(
        '/pengaturan',
        [PengaturanController::class, 'index']
    )->name('pengaturan');
    Route::get(
        '/obat',
        [ObatController::class, 'index']
    )->name('obat');
    Route::post(
        '/obat/add',
        [ObatController::class, 'store']
    )->name('obat.add');
    Route::post(
        '/obat/{obat}/edit',
        [ObatController::class, 'update']
    )->name('obat.update');
    Route::get(
        '/obat/{id?}/delete',
        [ObatController::class, 'destroy']
    )->name('obat.delete');
    Route::get(
        '/pengaturan/opname-edit',
        [PengaturanController::class, 'opname']
    )->name('pengaturan.opname');
    Route::get(
        '/pengaturan/obat-edit',
        [PengaturanController::class, 'obat']
    )->name('pengaturan.obat');
    Route::post(
        '/pengaturan/edit',
        [PengaturanController::class, 'update']
    )->name('pengaturan.edit');
    Route::get(
        '/kategori',
        [KategoriController::class, 'index']
    )->name('kategori');
    Route::post(
        '/kategori/add',
        [KategoriController::class, 'store']
    )->name('kategori.add');
    Route::get(
        '/kategori/{id?}/delete',
        [KategoriController::class, 'destroy']
    )->name('kategori.delete');
});
