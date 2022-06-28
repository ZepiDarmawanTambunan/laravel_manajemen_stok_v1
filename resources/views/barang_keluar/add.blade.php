@extends('base.main')
@section('content')

<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Add Barang Keluar</h3>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <form action="/barang_keluar/store" method="POST">
      @csrf
      <div class="form-group col-8">
        <label>Nama Barang</label>
        <select class="form-select" name="nama_barang" id="nama_barang">
          @foreach ($products as $product)
              <option value="{!! $product->nama_barang !!}">{!! $product->nama_barang !!}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-8">
        <label>Jumlah Barang</label>
        <input type="text" name="jumlah_barang" class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah_barang" placeholder="Jumlah Barang" value="{{ old('jumlah_barang') }}">
        @error('jumlah_barang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>Tanggal Keluar</label>
        <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar" placeholder="Harga Satuan" value="{{ old('tanggal_keluar') }}">
        @error('tanggal_keluar')
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