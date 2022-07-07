<?php

use App\Http\Controllers\CetakPDFController;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\ProductsInController;
use App\Http\Controllers\SupplierController;
use App\Models\ProductOut;
use App\Models\ProductsIn;
use App\Models\Supplier;

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
    $warning = Product::where('stok', '<', 10)->where('stok', '>', 1)->count();
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

// Route Data Barang Keluar
Route::get('/barang_keluar', [ProductOutController::class, 'index'])->middleware('auth');
Route::get('/barang_keluar/add', [ProductOutController::class, 'create'])->middleware('auth');
Route::get('/barang_keluar/edit/{id}', [ProductOutController::class, 'edit'])->middleware('auth');
Route::get('/barang_keluar/delete/{id}', [ProductOutController::class, 'destroy'])->middleware('auth');
Route::post('/barang_keluar/store', [ProductOutController::class, 'store'])->middleware('auth');
Route::post('/barang_keluar/update/{id}', [ProductOutController::class, 'update'])->middleware('auth');

// Route Daftar Barang
Route::get('/daftar_barang', [ProductController::class, 'index'])->middleware('auth');
Route::get('/daftar_barang/add', [ProductController::class, 'create'])->middleware('auth');
Route::get('/daftar_barang/delete/{id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/daftar_barang/edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::post('/daftar_barang/store', [ProductController::class, 'store'])->middleware('auth');
Route::post('/daftar_barang/update/{id}', [ProductController::class, 'update'])->middleware('auth');

// Route Data Pegawai
Route::get('/pegawai', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('/pegawai/add', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/pegawai/edit/{id}', [EmployeeController::class, 'edit'])->middleware('auth');
Route::get('/pegawai/delete/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
Route::post('/pegawai/store', [EmployeeController::class, 'store'])->middleware('auth');
Route::post('/pegawai/update/{id}', [EmployeeController::class, 'update'])->middleware('auth');

// Route Supplier 
Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::get('/supplier/add', [SupplierController::class, 'create'])->middleware('auth');
Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit'])->middleware('auth');
Route::get('/supplier/delete/{id}', [SupplierController::class, 'destroy'])->middleware('auth');
Route::post('/supplier/store', [SupplierController::class, 'store'])->middleware('auth');
Route::post('/supplier/update/{id}', [SupplierController::class, 'update'])->middleware('auth');

// Route cetakPDF
Route::get('/cetakBM', [CetakPDFController::class, 'barang_masuk'])->middleware('auth');
Route::get('/cetakBK', [CetakPDFController::class, 'barang_keluar'])->middleware('auth');
Route::get('/cetak/bm', [CetakPDFController::class, 'cetak_bm'])->middleware('auth');
Route::get('/cetak/bk', [CetakPDFController::class, 'cetak_bk'])->middleware('auth');

Route::post('/filter', [ProductsInController::class, 'filter'])->middleware('auth');