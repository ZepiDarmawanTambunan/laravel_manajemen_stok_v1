@extends('base.main')
@section('content')

<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Add Barang</h3>
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
    <form action="/daftar_barang/store" method="POST">
      @csrf
      <div class="form-group col-8">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" placeholder="Kode Barang" value="{{ $productId }}" readonly>
        @error('kode_barang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang') }}">
        @error('nama_barang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>Harga Satuan</label>
        <input type="text" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" placeholder="Harga Satuan" value="{{ old('harga_satuan') }}">
        @error('harga_satuan')
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