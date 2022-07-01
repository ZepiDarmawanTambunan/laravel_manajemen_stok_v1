<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_outs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pegawai');
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->enum('keterangan', ['terjual', 'kedaluwarsa']);
            $table->integer('harga_satuan')->default(0);
            $table->integer('total_harga')->default(0);
            $table->date('tanggal_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_outs');
    }
};
