<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOut;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class ProductOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductOut::all();
        return view('barang_keluar.barang_keluar', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('nama_barang', 'asc')->get();
        return view('barang_keluar.add', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = [];
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'tanggal_keluar' => 'required'
        ]);

        $getBarang = Product::where('nama_barang', $request->nama_barang)->first();
        
        $validatedData['kode_pegawai'] = auth()->user()->kode_pegawai;
        $validatedData['harga_satuan'] = $getBarang->harga_satuan;
        $validatedData['total_harga'] = $request->jumlah_barang * $getBarang->harga_satuan;
        
        if ($validatedData) {
            if ($getBarang->stok > $request->jumlah_barang){
                $product = Product::where('nama_barang', $request->nama_barang)->first();
                $product->stok = (int)$product->stok - (int)$request->jumlah_barang;
                Product::where('nama_barang', $request->nama_barang)->update(['stok' => $product->stok]);
                ProductOut::create($validatedData);
                Alert::success('Success', 'Data berhasil ditambahkan');
                return redirect('/barang_keluar');
            } else {
                Alert::error('Gagal !', 'Jumlah barang keluar melebihi stok barang saat ini !');
                return redirect()->back()->withInput($request->all());
            }
        } else {
            Alert::error('Error', 'Data gagal ditambahkan');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOut  $productOut
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOut $productOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOut  $productOut
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table('product_outs')->where('id', $id)->first();
        return view('barang_keluar.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductOut  $productOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jumlah_barang' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'tanggal_keluar' => 'required|date',
        ]);

        $getBarang = Product::where('nama_barang', $request->nama_barang)->first();
        $stokBKLama = ProductOut::where('id', $id)->first();
        // dd($stokBKLama->jumlah_barang);
        if ($validatedData) {
            
            if ($request->jumlah_barang) {
                $getBarang->update(['stok' => $stokBKLama->jumlah_barang]);

                if ($getBarang->stok > $request->jumlah_barang) {
                    $stokBK = ProductOut::where('id', $id)->first();
                    $stokBarang = Product::where('nama_barang', $stokBK->nama_barang)->first();
                    $stokBarang->stok += $stokBK->jumlah_barang ;
                    $updateStok = $stokBarang->stok - $request->jumlah_barang;
                    Product::where('nama_barang', $stokBarang->nama_barang)->update(['stok' => $updateStok]);
                    ProductOut::where('id', $id)->update($validatedData);
                    Alert::success('Success', 'Data berhasil diupdate');
                    return redirect('/barang_keluar');
                } else {
                    Alert::error('Gagal !', 'Jumlah barang keluar melebihi stok barang saat ini !');
                    return redirect()->back()->withInput($request->all());
                }
            }
        } else {
            Alert::error('Error', 'Data gagal ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOut  $productOut
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stokDiHapus = ProductOut::where('id', $id)->first();
        $stokBarang = Product::where('nama_barang', $stokDiHapus->nama_barang)->first();
        $stokBarang->stok += $stokDiHapus->jumlah_barang;
        Product::where('nama_barang', $stokBarang->nama_barang)->update(['stok' => $stokBarang->stok]);
        ProductOut::find($id)->delete();
        return redirect()->back();
    }
}
