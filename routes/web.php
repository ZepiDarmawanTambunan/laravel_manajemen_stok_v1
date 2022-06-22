<?php

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductsInController;

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

// Route Dashboard
Route::get('/', function () {
    $total = Product::all()->count();
    $avail = Product::where('stok', '>', 10)->count();
    $warning = Product::where('stok', '<=', 10)->count();
    $outOfStock = Product::where('stok', '=', 0)->count();
    $data = [
        'total' => $total,
        'avail' => $avail,
        'warning' => $warning,
        'outOfStock' => $outOfStock,
        'today' => $today = Carbon::now()->isoFormat('dddd, D MMMM Y'),
    ];
    return view('dashboard', compact('data'));
})->middleware('auth');

// Route Login & Logout
Route::get('/login', [LoginController::class, 'index'])->name('login')
->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

// Route Barang Masuk
Route::get('/barang_masuk', [ProductsInController::class, 'index'])
->middleware('auth');
Route::get('/barang_masuk/add', [ProductsInController::class, 'create'])
->middleware('auth');
Route::get('/barang_masuk/edit/{id}', [ProductsInController::class, 'edit'])
->middleware('auth');
Route::get('/barang_masuk/delete/{id}', [ProductsInController::class, 'destroy'])
->middleware('auth');
Route::post('/barang_masuk/store', [ProductsInController::class, 'store'])
->middleware('auth');
Route::post('/barang_masuk/update/{id}', [ProductsInController::class, 'update'])
->middleware('auth');

// Route Daftar Barang
Route::get('/daftar_barang', [ProductController::class, 'index'])->middleware('auth');
Route::get('/daftar_barang/add', [ProductController::class, 'create'])->middleware('auth');
Route::get('/daftar_barang/delete/{id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/daftar_barang/edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::post('/daftar_barang/store', [ProductController::class, 'store'])->middleware('auth');
Route::post('/daftar_barang/update/{id}', [ProductController::class, 'update'])->middleware('auth');

// Route Data Pegawai
Route::resource('pegawai', EmployeeController::class);




