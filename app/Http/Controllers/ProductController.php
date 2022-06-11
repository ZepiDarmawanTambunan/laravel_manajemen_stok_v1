<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('data_barang.data_barang', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_barang.add');
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
            'nama_barang' => 'required|unique:products',
            'harga_satuan' => 'required|integer',
        ]);

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
            'nama_barang' => ['required', Rule::unique('products')->ignore($request->id)],
            'harga_satuan' => 'required|numeric',
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
        Product::where('id_barang', $id)->delete();
        return redirect()->back();
    }
}
