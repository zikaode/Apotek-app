<?php

use App\Models\Obat;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\UserProfile;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard-app');
        // return redirect()->to('dashboard');
        // return dd(Obat::where('satuan', '=', 'vitamin')->get());
    });
});
