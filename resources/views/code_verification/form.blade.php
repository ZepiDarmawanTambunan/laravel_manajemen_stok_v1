@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Code Verification</h3>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="/code_verification/update" method="POST">
                @csrf
                <div class="form-group col-8">
                    <label>Kode Verifikasi Lama</label>
                    <input type="text" name="kode_verifikasi_lama"
                        class="form-control @error('kode_verifikasi_lama') is-invalid @enderror" id="kode_verifikasi_lama"
                        placeholder="Kode Verifikasi Lama">
                    @error('kode_verifikasi_lama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Kode Verifikasi Baru</label>
                    <input type="text" name="kode_verifikasi_baru"
                        class="form-control @error('kode_verifikasi_baru') is-invalid @enderror" id="kode_verifikasi_baru"
                        placeholder="Kode Verifikasi Baru" value="" required>
                    @error('kode_verifikasi_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
