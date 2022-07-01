@extends('base.main')
@section('content')

<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Add Supplier</h3>
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
    <form action="/supplier/store" method="POST">
      @csrf
      <div class="form-group col-8">
        <label>Kode Supplier</label>
        <input type="text" name="kode_supplier" class="form-control @error('kode_supplier') is-invalid @enderror" id="kode_supplier" placeholder="Kode Supllier" value="{{ $id }}" readonly>
        @error('kode_supplier')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" id="nama_supplier" placeholder="Nama Supplier" value="{{ old('nama_supplier') }}">
        @error('nama_supplier')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
        @error('alamat')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group col-8">
        <label>No Telpon</label>
        <input type="text" name="no_telpon" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" placeholder="No Telpon" value="{{ old('no_telpon') }}">
        @error('no_telpon')
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