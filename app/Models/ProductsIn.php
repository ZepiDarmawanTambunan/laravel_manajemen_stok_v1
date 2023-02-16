<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsIn extends Model
{
    use HasFactory;
    protected $table = 'products_ins';
    protected $fillable = [
        'kode_pegawai',
        'kode_supplier',
        'merk_barang',
        'ukuran',
        'jumlah_barang',
        'harga_satuan',
        'total_harga',
        'tanggal_masuk',
        'expired',
    ];

}
