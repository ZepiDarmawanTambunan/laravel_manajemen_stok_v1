@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Dashboard</h3>
          <p class="text-subtitle text-muted">{{ date('l, d F Y') }}</p>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
      <h4 class="card-title">Example Content</h4>
  </div>
  <div class="card-body">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis laudantium tempore
      exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio reprehenderit
      distinctio incidunt! Vel aspernatur dicta consequatur!
  </div>
</div>
@endsection