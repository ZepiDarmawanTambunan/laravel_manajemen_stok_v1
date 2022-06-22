@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row">
    <div class="col-12 d-flex justify-content-end">
      <p class="text-subtitle text-muted mx-3">Date : {{ $data['today'] }}</p>
      <p class="text-subtitle text-muted">|</p>
      <p class="text-subtitle text-muted mx-3">Time : <span id="rtc"></span></p>
    </div>
    <div class="col-12 col-md-6 m-3">
        <h3>Dashboard</h3>
    </div>
    <div class="container">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">Selamat Datang di Sistem Manajemen Stok Barang Toko Jago</h4>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row g-3 mb-4 ">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card px-2 shadow">
          <div class="card-body">
              <p class="card-title text-primary">TOTAL DAFTAR BARANG</p>           
          </div>
          <div class="card-footer bg-white">
              <h5 class="text-start fw-bold">{{ $data['total'] }}</h5>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card px-2 shadow">
          <div class="card-body">
              <p class="card-title text-success">STOK BARANG TERSEDIA</p>           
          </div>
          <div class="card-footer bg-white">
              <h5 class="text-start fw-bold">{{ $data['avail'] }}</h5>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card px-2 shadow">
          <div class="card-body">
              <p class="card-title text-warning">STOK BARANG SEDIKIT</p>
          </div>
          <div class="card-footer bg-white">
              <h5 class="text-start fw-bold">{{ $data['warning'] }}</h5>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <div class="card px-2 shadow">
          <div class="card-body">
              <p class="card-title text-danger">STOK BARANG HABIS</p>
          </div>
          <div class="card-footer bg-white">
              <h5 class="text-start fw-bold">{{ $data['outOfStock'] }}</h5>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection