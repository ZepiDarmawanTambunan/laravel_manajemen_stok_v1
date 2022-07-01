@extends('base.main')
@section('content')
<div class="page-title">
  <div class="row m-3">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Cetak Barang Keluar</h3>
          <p class="text-subtitle text-muted">Daftar Barang Keluar Bulan {{ date('F') }}</p>
      </div>
  </div>
</div>  
<div class="col-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Data Barang Keluar</h4>
          <a href="/cetak/bk" class="btn btn-primary mt-3">Cetak PDF</a>
      </div>
      <div class="card-content">
          <div class="card-body">
              <!-- Table with outer spacing -->
              <div class="table-responsive">
                  <table class="table table-lg">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode Pegawai</th>
                              <th>Nama Barang</th>
                              <th>Jumlah Barang</th>
                              <th>Keterangan</th>
                              <th>Harga Satuan</th>
                              <th>Total Harga</th>
                              <th>Tanggal Keluar</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($products->count())
                            @foreach ($products as $product)
                            <tr id="product{{ $product->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->kode_pegawai }}</td>
                                <td>{{ $product->nama_barang }}</td>  
                                <td>{{ $product->jumlah_barang }}</td>  
                                <td class="badges">
                                    <span class="badge {{ $product->keterangan == 'terjual' ? 'bg-success' : 'bg-warning'}}">{{ $product->keterangan }}</span>
                                </td>
                                <td>Rp. {{ number_format($product->harga_satuan, 0, '.', '.') }}</td>  
                                <td>Rp. {{ number_format($product->total_harga, 0, '.', '.') }}</td>  
                                <td>{{ $product->tanggal_keluar }}</td>   
                            </tr>       
                            @endforeach          
                          @else
                              <h4 class="text-center">
                                  Data masih kosong
                              </h4>
                          @endif
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection