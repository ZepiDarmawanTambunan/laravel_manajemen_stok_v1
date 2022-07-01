<?php

namespace App\Http\Controllers;

use App\Models\ProductsIn;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\ProductOut;

class CetakPDFController extends Controller
{
    public function barang_masuk(){
        $products = ProductsIn::all();
        return view('cetakPDF.bm', compact('products'));
    } 

    public function cetak_bm()
    {
        $products = ProductsIn::all();
        $pdf = PDF::loadview('cetakPDF.cetakbm', ['products' => $products]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }

    public function barang_keluar()
    {
        $products = ProductOut::all();
        return view('cetakPDF.bk', compact('products'));
    }

    public function cetak_bk()
    {
        $products = ProductOut::all();
        $pdf = PDF::loadview('cetakPDF.cetakbk', ['products' => $products]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }    
}
