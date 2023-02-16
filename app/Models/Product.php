<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'kode_barang',
        'merk_barang',
        'kategori_barang',
        'ukuran',
        'stok',
        'harga_jual',
        'expired'
    ];
}
