<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;
    protected $table = 'product_outs';
    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'harga_satuan',
        'total_harga',
        'tanggal_keluar'
    ];
}
