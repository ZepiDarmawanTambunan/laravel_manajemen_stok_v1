@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Barang Keluar</h3>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/barang_keluar/store" method="POST">
                @csrf
                <div class="form-group col-8">
                    <label>Merk Barang</label>
                    <select class="form-select" name="merk_barang" id="merk_barang">
                        @foreach ($merkBarang as $item)
                            <option value="{!! $item !!}">{!! $item !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-8">
                    <label>Ukuran Barang (ml)</label>
                    <select class="form-select" name="ukuran" id="ukuran">
                    </select>
                </div>
                <div class="form-group col-8">
                    <label>Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" min="0"
                        class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah_barang"
                        placeholder="Jumlah Barang" value="{{ old('jumlah_barang') }}">
                    @error('jumlah_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Keterangan</label>
                    <select class="form-select" name="keterangan" id="keterangan">
                        <option value="terjual">Terjual</option>
                        <option value="kedaluwarsa">Kedaluwarsa</option>
                    </select>
                </div>
                <div class="form-group col-8">
                    <label>Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar"
                        class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar"
                        placeholder="Harga Satuan" value="{{ old('tanggal_keluar') ?? date('Y-m-d') }}">
                    @error('tanggal_keluar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let merkBarang = $('select[name="merk_barang"]').val();
            if (merkBarang) {
                jQuery.ajax({
                    url: '/merk_barang/' + merkBarang + '/ukuran',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('select[name="ukuran"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="ukuran"]').append(
                                '<option value="' + value + '">' + value +
                                '</option>');
                        });
                    }
                });
            }

            $('select[name="merk_barang"]').on('change', function() {
                merkBarang = $(this).val();
                if (merkBarang) {
                    jQuery.ajax({
                        url: '/merk_barang/' + merkBarang + '/ukuran',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="ukuran"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="ukuran"]').append(
                                    '<option value="' + value + '">' + value +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_origin"]').empty();
                }
            });
        });
    </script>
@endsection
