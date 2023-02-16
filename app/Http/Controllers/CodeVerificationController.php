<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CodeVerificationController extends Controller
{
    public function form()
    {
        $code = Code::first();
        return view('code_verification.form', compact('code'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'kode_verifikasi_lama' => 'required',
            'kode_verifikasi_baru' => 'required',
        ]);

        $code = Code::first();
        if($validatedData['kode_verifikasi_lama'] == $code->code){
            $code->update(['code' => $validatedData['kode_verifikasi_baru']]);
            Alert::success('Success', 'Data berhasil diupdate');
            return redirect('/code_verification/form');
        }

        Alert::error('Error', 'Kode Verifikasi Lama Salah!');
        return redirect()->back();
    }
}
