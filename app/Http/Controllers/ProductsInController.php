<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsIn;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductsIn::orderBy('nama_barang', 'asc')
                    ->get();
        return view('barang.barang_masuk', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('nama_barang', 'asc')->get();
        return view('barang.add_barang_masuk', compact('products'));
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
            'harga_satuan' => 'required|numeric',
            'tanggal_masuk' => 'required'
        ]);

        $validatedData['total_harga'] = $request->jumlah_barang * $request->harga_satuan;
        
        if ($validatedData) {
            $product = Product::where('nama_barang', $request->nama_barang)->first();
            $product->stok = (int)$product->stok + (int)$request->jumlah_barang;
            Product::where('nama_barang', $request->nama_barang)->update(['stok' => $product->stok]);
            ProductsIn::create($validatedData);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect('/barang_masuk');
        }

        Alert::error('Error', 'Data gagal ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = ProductsIn::where('id', $id)->first();
        return view('barang.edit_barang_masuk', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => ['required', Rule::unique('products')->ignore($request->id)],
            'jumlah_barang' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'tanggal_masuk' => 'required|date',
        ]);

        $stokBM = ProductsIn::where('id', $id)->first();
        $stokBarang = Product::where('nama_barang', $stokBM->nama_barang)->first();
        $stokBarang->stok -= $stokBM->jumlah_barang ;
        $updateStok = $stokBarang->stok + $request->jumlah_barang;
        Product::where('nama_barang', $stokBarang->nama_barang)->update(['stok' => $updateStok]);

        ProductsIn::where('id', $id)->update($validatedData);
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('/barang_masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stokDiHapus = ProductsIn::where('id', $id)->first();
        $stokBarang = Product::where('nama_barang', $stokDiHapus->nama_barang)->first();
        $stokBarang->stok -= $stokDiHapus->jumlah_barang;
        Product::where('nama_barang', $stokBarang->nama_barang)->update(['stok' => $stokBarang->stok]);
        ProductsIn::find($id)->delete();
        return redirect()->back();
    }
}
