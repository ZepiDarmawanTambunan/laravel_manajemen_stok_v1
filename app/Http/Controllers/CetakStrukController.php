<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Cart;

class CetakStrukController extends Controller
{
    public function cetak_struk_form()
    {
        $products = Product::all();
        $carts = Cart::where('kode_pegawai', auth()->user()->kode_pegawai)->get();
        return view('cetak_struk.form', compact('products', 'carts'));
    }

    public function cetak_struk_search(Request $request)
    {
        $data = Product::select("merk_barang as value", "kode_barang", "ukuran")
            ->where('merk_barang', 'LIKE', '%' . $request->search . '%')
            ->orWhere('kode_barang', 'LIKE', '%' . $request->search . '%')
            ->get();

        return response()->json($data);
    }

    public function cetak_struk(Request $request)
    {
        $pembayaran = (int)str_replace('.', '', str_replace('Rp. ', '', $request->pembayaran)) ?? '0';

        if ($pembayaran < $request->pembelian) {
            Alert::error('Gagak', 'Uang anda kurang');
            return redirect()->back();
        }

        $request->merge([
            'pembayaran' => $pembayaran,
        ]);

        $auth = auth()->user();
        $pembayaran = $request->pembayaran;
        $products = Product::all();
        $carts = Cart::where('kode_pegawai', $auth->kode_pegawai)->get();

        return view('cetak_struk.index', compact('pembayaran', 'products', 'carts', 'auth'));
    }

    public function cetak_struk_add(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|exists:products,kode_barang',
        ]);

        $cart = Cart::where('kode_barang', $request->kode_barang)->first();
        if ($cart) {
            $cart->update(['jumlah_barang' => $cart->jumlah_barang + 1]);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect()->back();
        }

        $product = Product::where('kode_barang', $request->kode_barang)->first();
        $validatedData['kode_pegawai'] = auth()->user()->kode_pegawai;
        $validatedData['jumlah_barang'] = 1;

        Cart::create($validatedData);
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function cetak_struk_plus($id)
    {
        $cart = Cart::where('id', $id)->first();

        if ($cart) {
            $jmlhbrg = $cart->update(['jumlah_barang' => $cart->jumlah_barang + 1]);
            // response()->json([
            //     'jumlah_barang' => $cart,
            // ]);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect()->back();
        } else {
            Alert::success('Error', 'Data gagal ditambahkan');
            return redirect()->back();
        }
    }

    public function cetak_struk_min($id)
    {
        $cart = Cart::where('id', $id)->first();

        if ($cart) {
            if ($cart->jumlah_barang == 1) {
                $cart->delete();
                Alert::success('Success', 'Data berhasil dikurangkan');
                return redirect()->back();
            }

            $cart->update(['jumlah_barang' => $cart->jumlah_barang - 1]);
            Alert::success('Success', 'Data berhasil dikurangkan');
            return redirect()->back();
        } else {
            Alert::success('Error', 'Data gagal dikurangkan');
            return redirect()->back();
        }
    }
}
