<!DOCTYPE html>
<html>
<head>
	<title>Laporan Barang Masuk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
  <div class="container mt-5">
    <div class="text-center">
      <h5>Data Barang Masuk</h4>
    </div>
      <table class='table table-bordered'>
        <thead>
          <tr>
            <th>No</th>
              <th>Kode Supplier</th>
              <th>Kode Pegawai</th>
              <th>Nama Barang</th>
              <th>Jumlah Barang</th>
              <th>Harga Satuan</th>
              <th>Total Harga</th>
              <th>Tanggal Masuk</th>
          </tr>
        </thead>
        <tbody>
          @if ($products->count())
            @foreach ($products as $product)
            <tr id="product{{ $product->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->kode_supplier }}</td>
                <td>{{ $product->kode_pegawai }}</td>
                <td>{{ $product->nama_barang }}</td>  
                <td>{{ $product->jumlah_barang }}</td>  
                <td>Rp. {{ number_format($product->harga_satuan, 0, '.', '.') }}</td>  
                <td>Rp. {{ number_format($product->total_harga, 0, '.', '.') }}</td>  
                <td>{{ $product->tanggal_masuk }}</td>   
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
</body>
</html>