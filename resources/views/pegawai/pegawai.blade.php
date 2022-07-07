@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data Pegawai</h3>
          <p class="text-subtitle text-muted">Daftar Data Pegawai</p>
      </div>
  </div>
</div>  

<div class="col-12">
  <div class="card">
      <div class="card-header">
          <a href="/pegawai/add" class="btn btn-primary mt-3">Add Data</a>
      </div>
      <div class="card-content">
          <div class="card-body">
              <!-- Table with outer spacing -->
              <div class="table-responsive">
                  <table class="table table-lg">
                      <thead>
                          <tr>
                              <th>Kode Pegawai</th>
                              <th>Nama Pegawai</th>
                              <th>Role</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($employees->count())
                            @foreach ($employees as $employee)
                            <tr id="employee{{ $employee->id }}">
                                <td>{{ $employee->kode_pegawai }}</td>  
                                <td>{{ $employee->username }}</td>  
                                <td class="badges">
                                    <span class="badge {{ $employee->role == 'Admin' ? 'bg-primary' : 'bg-secondary'}}">{{ $employee->role }}</span>
                                </td>  
                                <td>
                                <a href="/pegawai/edit/{{ $employee->id }}" class="btn btn-warning btn-user"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-user btn-delete" data-id="{{ $employee->id }}" data-name="{{ $employee->username }}"><i class="fa-regular fa-trash-can"></i></a>
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
                    url: '/pegawai/delete/'+Id,
                    success: function (data) {
                        $("#employee"+Id).remove()              
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