@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data Supplier</h3>
          <p class="text-subtitle text-muted">Daftar Data Supplier</p>
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
                              <th>Kode Supplier</th>
                              <th>Nama Supplier</th>
                              <th>Alamat</th>
                              <th>No Telpon</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($suppliers->count())
                            @foreach ($suppliers as $supplier)
                            <tr id="supplier{{ $supplier->id }}" class="data-barang">
                                <td>{{ $supplier->kode_supplier }}</td>  
                                <td>{{ $supplier->nama_supplier }}</td>  
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->no_telpon }}</td>
                                <td>
                                <a href="/supplier/edit/{{ $supplier->id }}" class="btn btn-warning btn-user"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-user btn-delete" data-id="{{ $supplier->id }}" data-name="{{ $supplier->nama_barang }}"><i class="fa-regular fa-trash-can"></i></a>
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
    $('.btn-delete').on('click', function(){
        var Id = $(this).data('id')
        var name = $(this).data('name')
        Swal.fire({
            title: "Are you sure want to delete "+name+" ?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: '/daftar_barang/delete/'+Id,
                    success: function (data) {
                        $("#product"+Id).remove()              
                        Swal.fire('Deleted !', 'Data berhasil dihapus', 'success')
                    },
                    error: function (data) {
                        console.log('Error', data);
                    }
                });
            } else {
                Swal.fire('Data tidak jadi dihapus')
            }
        })
    })
</script>
@endsection