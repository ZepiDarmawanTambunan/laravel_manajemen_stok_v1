@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Barang</h3>
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
            <form action="/daftar_barang/update/{{ $product->id }}" method="POST">
                @csrf
                <div class="form-group col-8">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror"
                        id="kode_barang" placeholder="Kode Barang" value={{ $product->kode_barang }} readonly>
                    @error('kode_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Merk Barang</label>
                    <input type="text" name="merk_barang" class="form-control @error('merk_barang') is-invalid @enderror"
                        id="merk_barang" placeholder="Merk Barang" value="{{ $product->merk_barang }}">
                    @error('merk_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Ukuran Barang (ml)</label>
                    <input type="text" min="0" name="ukuran"
                        class="form-control @error('ukuran') is-invalid @enderror" id="ukuran"
                        placeholder="Ukuran Barang" value="{{ $product->ukuran }}">
                    @error('ukuran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Kategori Barang</label>
                    <input type="text" name="kategori_barang"
                        class="form-control @error('kategori_barang') is-invalid @enderror" id="kategori_barang"
                        placeholder="Kategori Barang" value="{{ $product->kategori_barang }}">
                    @error('kategori_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Stok Barang</label>
                    <input type="number" min="0" name="stok"
                        class="form-control @error('stok') is-invalid @enderror" id="stok" placeholder="Stok Barang"
                        value="{{ $product->stok }}" readonly>
                    @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror"
                        id="harga_jual" placeholder="Harga Jual" value="{{ $product->harga_jual }}">
                    @error('harga_jual')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Tanggal Kadaluwarsa</label>
                    <input type="date" name="expired" class="form-control @error('expired') is-invalid @enderror"
                        id="expired" placeholder="Tanggal Kadaluwarsa" value="{{ $product->expired }}">
                    @error('expired')
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
