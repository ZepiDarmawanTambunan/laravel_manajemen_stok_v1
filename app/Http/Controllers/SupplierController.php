<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Code;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $code = Code::first()->code;
        return view('supplier.supplier', compact('suppliers', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = IdGenerator::generate(['table' => 'suppliers', 'field' => 'kode_supplier', 'length' => '7', 'prefix' => 'SUP-']);
        return view('supplier.add', compact('id'));
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
            'kode_supplier' => 'required|unique:suppliers',
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required|min:8|max:12|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        if ($validatedData) {
            Supplier::create($validatedData);
            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect('/supplier');
        } else {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_supplier' => ['required', Rule::unique('suppliers')->ignore($request->id)],
            'nama_supplier' => ['required', Rule::unique('suppliers')->ignore($request->id)],
            'alamat' => 'required',
            'no_telpon' => 'required|min:8|max:12|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        if ($validatedData) {
            Supplier::where('id', $id)->update($validatedData);
            Alert::success('Success', 'Data berhasil diupdate');
            return redirect('/supplier');
        } else {
            Alert::error('Error', 'Data gagal ditambahkan');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->delete();
        return redirect()->back();
    }
}
