<?php

use App\Models\Obat;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaturanController;

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
    Route::get('/', function () {
        return view('dashboard-app');
    })->name('dashboard');
    Route::get('/penjualan', function () {
        return view('dashboard-app');
        // return dd(Route::current());
        // return dd(Obat::where('satuan', '=', 'vitamin')->get());
    })->name('penjualan');
    Route::get('/pembelian', function () {
        return view('dashboard-app');
        // return dd(Route::current());
        // return dd(Obat::where('satuan', '=', 'vitamin')->get());
    })->name('pembelian');
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

Route::get('/test', [TestController::class, 'index']);
