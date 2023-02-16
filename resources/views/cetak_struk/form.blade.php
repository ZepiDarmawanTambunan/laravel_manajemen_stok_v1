@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 id="title">Cetak Struk Pelanggan</h3>
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
            <form action="/cetak_struk/add" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <h5 class="text-start fw-bold mb-0">Product</h5>
                    </div>
                    <div class="col">
                        <input type="text" id="search" class="form-control">
                        <input type="hidden" name="kode_barang" id="kode_barang" class="form-control">
                    </div>
                    <div class="col-12 col-md-2 mt-2 mt-md-0">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

            @php
                $harga_pembelian = 0;
            @endphp

            <form action="/cetak_struk" method="POST" class="mt-5">
                @csrf
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Merk Barang</th>
                                <th>Ukuran (ml)</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($carts->count())
                                @foreach ($carts as $cart)
                                    @php
                                        $item = $products->where('kode_barang', $cart->kode_barang)->first();
                                        $harga = $item->harga_jual;
                                        $total_harga = $harga * $cart->jumlah_barang;
                                        $harga_pembelian += $total_harga;
                                    @endphp

                                    <tr id="product{{ $cart->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->merk_barang }}</td>
                                        <td>{{ $item->ukuran }}</td>
                                        <td class="row">
                                            <div class="col-4">
                                                <a href="/cetak_struk/min/{{ $cart->id }}"
                                                    class="btn btn-sm rounded btn-danger" id="min">
                                                    <i class="fas fa-minus" style="font-size: 10px;"></i>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                {{ $cart->jumlah_barang }}
                                            </div>
                                            <div class="col-4">
                                                <a href="/cetak_struk/plus/{{ $cart->id }}"
                                                    class="btn btn-sm rounded btn-primary" id="plus">
                                                    <i class="fas fa-plus" style="font-size: 10px;"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>Rp. {{ number_format($harga, 0, '.', '.') }}</td>
                                        <td>Rp. {{ number_format($total_harga, 0, '.', '.') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <h4 class="text-center">
                                    Data kosong
                                </h4>
                            @endif
                        </tbody>
                    </table>
                </div>


                @if ($carts->count() >= 1)
                    <div class="row mt-4">
                        <div class="col offset-xl-8">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3 col-xl-5">
                                    <span>Total Pembelian: </span>
                                </div>
                                <div class="col-8 col-xl-7">
                                    <span>Rp. {{ number_format($harga_pembelian, 0, '.', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl offset-xl-8 my-3">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3 col-xl-5">
                                    <span>Pembayaran: </span>
                                </div>
                                <div class="col-8 col-xl-7">
                                    <input type="text" class="form-control" name="pembayaran" id="pembayaran">
                                    <input type="hidden" name="pembelian" value="{{ $harga_pembelian }}">
                                </div>
                            </div>
                        </div>

                        <div class="col offset-xl-8">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3 col-xl-5">
                                    <span>Kembalian: </span>
                                </div>
                                <div class="col-8 col-xl-7">
                                    <span id="kembalian"> Rp. 0</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl offset-xl-10 mt-3 d-xl-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Print</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        const pembayaran = document.getElementById('pembayaran');
        const kembalian = document.getElementById('kembalian');

        const harga_pembelian = {!! json_encode($harga_pembelian) !!};

        if (pembayaran != null) {
            pembayaran.addEventListener('input', handlePembayaran);

            function handlePembayaran(e) {
                pembayaran.value = number_format(e.target.value, "Rp. ");
                let uang = e.target.value == "" ? 0 : e.target.value.split(" ")[1].split(".").join("");
                let calculate = parseFloat(uang) - harga_pembelian;
                kembalian.textContent = calculate < 0 ? `Rp. -${number_format(calculate.toString())}` :
                    `Rp. ${number_format(calculate.toString())}`;
            }
        }

        var path = "/cetak_struk/search";

        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        console.log(data);
                        data = data.map(e => {
                            return {
                                value: e.kode_barang + ' - ' + e.value + ' ' + e.ukuran +
                                    'ml',
                                kode_barang: e.kode_barang,
                                ukuran: e.ukuran
                            }
                        });
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                console.log(ui);
                $('#kode_barang').val(ui.item.kode_barang);
                $('#search').val(ui.item.label);
                console.log(ui);
                return false;
            }
        });
    </script>
@endsection
