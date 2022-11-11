<?php

use App\Models\Obat;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
        // return dd(Route::current());
        // return dd(Obat::where('satuan', '=', 'vitamin')->get());
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
});
