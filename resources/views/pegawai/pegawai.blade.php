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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($employees->count())
                                    @foreach ($employees as $employee)
                                        <tr id="employee{{ $employee->id }}">
                                            <td>{{ $employee->kode_pegawai }}</td>
                                            <td>{{ $employee->username }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-warning btn-user btn-edit"
                                                            data-id="{{ $employee->id }}"
                                                            data-name="{{ $employee->username }}"><i
                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-danger btn-user btn-delete"
                                                            data-id="{{ $employee->id }}"
                                                            data-name="{{ $employee->username }}"><i
                                                                class="fa-regular fa-trash-can"></i></a>
                                                    </div>
                                                </div>
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
        $('.btn-delete').on('click', function() {
            var Id = $(this).data('id')
            var name = $(this).data('name')

            Swal.fire({
                title: 'Code Verification',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == {!! json_encode($code) !!}) {
                        return true;
                    } else {
                        Swal.fire('Kode Salah')
                        return false;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: '/pegawai/delete/' + Id,
                        success: function(data) {
                            Swal.fire('Deleted !', data.success, 'success')
                            $("#employee" + Id).remove()
                        },
                        error: function(data) {
                            console.log('Error', data);
                        }
                    });
                } else {
                    Swal.fire('Data tidak jadi dihapus')
                }
            })
        });

        $('.btn-edit').on('click', function() {
            var Id = $(this).data('id')
            var name = $(this).data('name')

            Swal.fire({
                title: 'Code Verification',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == {!! json_encode($code) !!}) {
                        return true;
                    } else {
                        Swal.fire('Kode Salah')
                        return false;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '/pegawai/edit/' + Id;
                } else {
                    Swal.fire('Data tidak jadi diedit')
                }
            })
        });
    </script>
@endsection
