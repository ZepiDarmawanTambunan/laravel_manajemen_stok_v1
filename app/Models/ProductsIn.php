<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsIn extends Model
{
    use HasFactory;
    protected $table = 'products_ins';
    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'harga_satuan',
        'tanggal_masuk',
    ];

}
