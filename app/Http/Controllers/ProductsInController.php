<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsIn;
use App\Models\Supplier;
use App\Models\Code;
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
        $products = ProductsIn::orderBy('merk_barang', 'asc')
                    ->get();
        $code = Code::first()->code;
        return view('barang_masuk.barang_masuk', compact('products', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(auth()->user()->username);
        $suppliers = Supplier::all();
        $products = Product::orderBy('merk_barang', 'asc')->get();
        $merkBarang = $products->pluck('merk_barang')->unique();
        return view('barang_masuk.add_barang_masuk', compact('products', 'suppliers', 'merkBarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'merk_barang' => 'required',
            'kode_supplier' => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'total_harga' => 'required',
            'tanggal_masuk' => 'required',
            'expired' => 'required',
            'ukuran' => 'nullable'
        ]);

        $validatedData['kode_pegawai'] = auth()->user()->kode_pegawai;

        if ($validatedData) {
            $product = Product::where('merk_barang', $request->merk_barang)
            ->where('ukuran', $request->ukuran)->first();
            $product->stok = (int)$product->stok + (int)$request->jumlah_barang;
            Product::where('merk_barang', $request->merk_barang)
            ->where('ukuran', $request->ukuran)
            ->update(['stok' => $product->stok]);
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
        // $suppliers = Supplier::all();
        $product = ProductsIn::where('id', $id)->first();
        $merkBarang = Product::pluck('merk_barang')->unique();
        return view('barang_masuk.edit_barang_masuk', compact('product', 'merkBarang'));
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
            'jumlah_barang' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'ukuran' => 'nullable',
            'expired' => 'required|date',
        ]);
        $validatedData['total_harga'] = $validatedData['harga_satuan'] * $validatedData['jumlah_barang'];

        $stokBM = ProductsIn::where('id', $id)->first();
        $stokBarang = Product::where('merk_barang', $stokBM->merk_barang)
        ->where('ukuran', $request->ukuran)->first();
        $stokBarang->stok -= $stokBM->jumlah_barang ;
        $updateStok = $stokBarang->stok + $request->jumlah_barang;
        Product::where('merk_barang', $stokBarang->merk_barang)
        ->where('ukuran', $request->ukuran)->update(['stok' => $updateStok]);
        
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
        $stokBarang = Product::where('merk_barang', $stokDiHapus->merk_barang)
        ->where('ukuran', $stokDiHapus->ukuran)->first();
        $stokBarang->stok -= $stokDiHapus->jumlah_barang;
        Product::where('merk_barang', $stokBarang->merk_barang)
        ->where('ukuran', $stokBarang->ukuran)->update(['stok' => $stokBarang->stok]);
        ProductsIn::find($id)->delete();
        return response()->json([
            'success' => 'Data berhasil dihapus',
        ]);
    }

    public function filter(Request $request)
    {
        $start = $request->dari;
        $end = $request->sampai;
        $code = Code::first()->code;
        $products = ProductsIn::whereBetween('tanggal_masuk', [$start, $end])->get();
        return view('barang_masuk.barang_masuk', compact('products', 'code'));
    }
}
