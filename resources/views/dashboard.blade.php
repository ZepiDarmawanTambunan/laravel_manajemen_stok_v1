@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row">
      <div class="col-12 col-md-6">
          <h3>Dashboard</h3>
      </div>
      <div class="col-12 d-flex justify-content-end">
        <p class="text-subtitle text-muted mx-3">Date : {{ date('l, d F Y') }}</p>
        <p class="text-subtitle text-muted">|</p>
        <p class="text-subtitle text-muted mx-3">Time : <span id="rtc"></span></p>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
      <h4 class="card-title">Selamat datang Di Sistem Manajemen Stok Barang Toko Jago</h4>
  </div>
  <div class="card-body">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis laudantium tempore
      exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio reprehenderit
      distinctio incidunt! Vel aspernatur dicta consequatur!
  </div>
</div>
@endsection