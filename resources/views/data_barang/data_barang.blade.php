@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Stok Barang</h3>
                <p class="text-subtitle text-muted">Daftar Data Stok Barang</p>
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
                                    <th>Kode Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Ukuran Barang (ml)</th>
                                    <th>Kategori</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Tanggal Kadaluwarsa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->count())
                                    @foreach ($products as $product)
                                        <tr id="product{{ $product->id }}" class="data-barang">
                                            <td>{{ $product->kode_barang }}</td>
                                            <td>{{ $product->merk_barang }}</td>
                                            <td>{{ $product->ukuran }}</td>
                                            <td>{{ $product->kategori_barang }}</td>
                                            <td>Rp. {{ number_format($product->harga_jual, 0, '.', '.') }}</td>
                                            <td>{{ $product->stok }}</td>
                                            <td>{{ $product->expired }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-warning btn-user btn-edit"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->merk_barang }}"><i
                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-danger btn-user btn-delete"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->merk_barang }}"><i
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
                        url: '/daftar_barang/delete/' + Id,
                        success: function(data) {
                            Swal.fire('Deleted !', data.success, 'success')
                            $("#product" + Id).remove()
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
                    window.location = '/daftar_barang/edit/' + Id;
                } else {
                    Swal.fire('Data tidak jadi diedit')
                }
            })
        });
    </script>
@endsection
