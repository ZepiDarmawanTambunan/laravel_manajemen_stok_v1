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
        'kode_pegawai',
        'jumlah_barang',
        'keterangan',
        'harga_satuan',
        'total_harga',
        'tanggal_keluar'
    ];
}
