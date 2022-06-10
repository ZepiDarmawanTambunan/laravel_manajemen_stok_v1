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
                          @if ($products->count())
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->id_barang }}</td>  
                                <td>{{ $product->nama_barang }}</td>  
                                <td>Rp. {{ number_format($product->harga_satuan, 0, '.', '.') }}</td>  
                                <td>
                                <a href="/daftar_barang/edit/{{ $product->id_barang }}" class="btn btn-warning btn-user"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger btn-user btn-delete" data-id="{{ $product->id_barang }}" data-name="{{ $product->nama_barang }}"><i class="fa-regular fa-trash-can"></i></a>
                                </td>  
                            </tr>       
                            @endforeach
                          @else
                              <h4 class="text-center">Data masih kosong</h4>
                          @endif          
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

<script>
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var dataId = $(this).attr('data-id')
        var dataName = $(this).attr('data-name')
        Swal.fire({
            title: 'Are you sure want to delete ' + dataName + ' ?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/daftar_barang/delete/" + dataId + ""
                Swal.fire(
                    'Deleted!',
                    'Data berhasil dihapus',
                    'success'
                )
            } else {
                Swal.fire('Data tidak jadi dihapus')
            }
        })
    })
</script>
@endsection