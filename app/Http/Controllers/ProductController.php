<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsIn;
use App\Models\ProductOut;
use App\Models\Code;
use App\Models\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('kode_barang', 'asc')->get();
        $code = Code::first()->code;
        return view('data_barang.data_barang', compact('products', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = IdGenerator::generate(['table' => 'products', 'field' => 'kode_barang', 'length' => '6', 'prefix' => 'B-']);
        return view('data_barang.add', compact('id'));
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
            'kode_barang' => 'required|unique:products',
            'merk_barang' => 'required',
            'kategori_barang' => 'required',
            'ukuran' => 'required',
            'stok' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'expired' => 'required|date',
        ]);

        $product = Product::where('merk_barang', $request->merk_barang)
        ->where('ukuran', $request->ukuran)->first();

        if($product != null){
            $product->update(['stok' => $request->stok]);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect('/daftar_barang');
        }

        if ($validatedData) {
            Product::create($validatedData);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect('/daftar_barang');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('data_barang.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_barang' => ['required', Rule::unique('products')->ignore($request->id)],
            'merk_barang' => 'required',
            'stok' => 'required|integer',
            'ukuran' => 'required',
            'harga_jual' => 'required',
            'expired' => 'required',
            'kategori_barang' => 'required',
        ]);

        Product::where('id', $id)->update($validatedData);
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('/daftar_barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $productsIn = ProductsIn::where('merk_barang', $product->merk_barang)
        ->where('ukuran', $product->ukuran)->get();
        $productOut = ProductOut::where('merk_barang', $product->merk_barang)
        ->where('ukuran', $product->ukuran)->get();
        $cart = Cart::where('kode_barang', $product->kode_barang)->first();
        
        if($productsIn != null){
            $productsIn->each->delete();
        }

        if($productOut != null){
            $productOut->each->delete();
        }

        if($cart != null){
            $cart->delete();
        }

        $product->delete();
        return redirect()->back();
    }

    public function getUkuran($value)
    {
        $ukuran = Product::where('merk_barang', $value)->pluck('ukuran');
        return json_encode($ukuran);
    }
}
