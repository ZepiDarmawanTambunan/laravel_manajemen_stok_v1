<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOut;
use App\Models\Code;
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
        $code = Code::first()->code;
        return view('barang_keluar.barang_keluar', compact('products', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('merk_barang', 'asc')->get();
        $merkBarang = $products->pluck('merk_barang')->unique();
        return view('barang_keluar.add', compact('products', 'merkBarang'));
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
            'merk_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'keterangan' => 'required',
            'tanggal_keluar' => 'required',
            'ukuran' => 'required',
        ]);
        $getBarang = Product::where('merk_barang', $request->merk_barang)
            ->where('ukuran', $request->ukuran)->first();

        $validatedData['kode_pegawai'] = auth()->user()->kode_pegawai;
        if ($request->keterangan == 'terjual') {
            $validatedData['harga_satuan'] = $getBarang->harga_jual;
            $validatedData['total_harga'] = $request->jumlah_barang * $getBarang->harga_jual;
        } else {
            $validatedData['harga_satuan'] = $getBarang->harga_jual;
            $validatedData['total_harga'] = $request->jumlah_barang * $getBarang->harga_jual;
            $validatedData['total_harga'] = -abs($validatedData['total_harga']);
        }

        if ($validatedData) {
            if ($getBarang->stok >= $request->jumlah_barang) {
                $product = Product::where('merk_barang', $request->merk_barang)->first();
                $product->stok = (int)$product->stok - (int)$request->jumlah_barang;
                Product::where('merk_barang', $request->merk_barang)
                    ->where('ukuran', $request->ukuran)->update(['stok' => $product->stok]);
                ProductOut::create($validatedData);
                Alert::success('Success', 'Data berhasil ditambahkan');
                return redirect('/barang_keluar');
            } else {
                Alert::error('Gagal !', 'Jumlah barang keluar melebihi stok barang saat ini !');
                return back();
            }
        } else {
            Alert::error('Error', 'Data gagal ditambahkan');
            return back();
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
        $merkBarang = Product::pluck('merk_barang')->unique();
        return view('barang_keluar.edit', compact('product', 'merkBarang'));
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
            'ukuran' => 'nullable',
        ]);

        $validatedData['total_harga'] = $validatedData['harga_satuan'] * $validatedData['jumlah_barang'];
        $getBarang = Product::where('merk_barang', $request->merk_barang)
            ->where('ukuran', $request->ukuran)->first();
        $stokVal = $getBarang->stok;

        $stokBKLama = ProductOut::where('id', $id)->first();

        // dd($stokBKLama->jumlah_barang);
        if ($validatedData) {

            if ($request->jumlah_barang) {
                // $getBarang->update(['stok' => $stokBKLama->jumlah_barang]);

                if ($getBarang->stok + $stokBKLama->jumlah_barang >= $request->jumlah_barang) {
                    $stokBK = ProductOut::where('id', $id)->first();
                    $stokBarang = Product::where('merk_barang', $stokBK->merk_barang)
                        ->where('ukuran', $stokBK->ukuran)->first();
                    $stokBarang->stok += $stokBK->jumlah_barang;
                    $updateStok = $stokBarang->stok - $request->jumlah_barang;
                    Product::where('merk_barang', $stokBarang->merk_barang)
                        ->where('ukuran', $stokBarang->ukuran)->update(['stok' => $updateStok]);
                    ProductOut::where('id', $id)->update($validatedData);
                    Alert::success('Success', 'Data berhasil diupdate');
                    return redirect('/barang_keluar');
                } else {
                    Alert::error('Gagal !', 'Jumlah barang keluar melebihi stok barang saat ini !');
                    return back();
                }
            }
        } else {
            $getBarang->update(['stok' => $stokVal]);
            Alert::error('Error', 'Data gagal ditambahkan');
            return back();
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
        $stokBarang = Product::where('merk_barang', $stokDiHapus->merk_barang)
            ->where('ukuran', $stokDiHapus->ukuran)->first();
        $stokBarang->stok += $stokDiHapus->jumlah_barang;
        Product::where('merk_barang', $stokBarang->merk_barang)
            ->where('ukuran', $stokBarang->ukuran)->update(['stok' => $stokBarang->stok]);
        ProductOut::find($id)->delete();
        return back();
    }
}
