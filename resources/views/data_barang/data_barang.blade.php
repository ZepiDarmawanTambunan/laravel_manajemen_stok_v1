@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data Barang</h3>
          <p class="text-subtitle text-muted">Daftar Data Barang</p>
      </div>
  </div>
</div>  
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
@endif
<div class="col-12">
  <div class="card">
      <div class="card-header">
          <a href="/daftar_barang/add" class="btn btn-primary mt-3">Add Data</a>
      </div>
      <div class="card-content">
          <div class="card-body">
              <!-- Table with outer spacing -->
              <div class="table-responsive">
                  <table class="table table-lg">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode Barang</th>
                              <th>Nama Barang</th>
                              <th>Harga Satuan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($products as $product)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $product->id_barang }}</td>  
                              <td>{{ $product->nama_barang }}</td>  
                              <td>Rp. {{ number_format($product->harga_satuan, 0, '.', '.') }}</td>  
                              {{-- <td>
                                <a href="/barang_masuk/edit/{{ $product->id }}" class="btn btn-warning btn-user"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger btn-user btn-delete" data-id="{{ $product->id }}" data-name="{{ $product->nama_barang }}"><i class="fa-regular fa-trash-can"></i></a>
                              </td>   --}}
                            </tr>       
                          @endforeach          
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection