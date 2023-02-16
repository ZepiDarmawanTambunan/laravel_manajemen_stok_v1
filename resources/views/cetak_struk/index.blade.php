<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 340px;
        }

        .header {
            margin: 0;
            text-align: center;
        }

        h2,
        p {
            margin: 0;
        }

        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1>div {
            text-align: left;
        }

        .flex-container-1 .right {
            text-align: right;
            width: 200px;
        }

        .flex-container-1 .left {
            width: 200px;
        }

        .flex-container {
            width: 340px;
            display: flex;
        }

        .flex-container>div {
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
        }

        ul {
            display: contents;
        }

        ul li {
            display: block;
        }

        hr {
            border-style: dashed;
        }

        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
        $pembelian = 0;
    @endphp

    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <h2>Toko LY Jambi Grosir</h2>
            <small>Jl. Kom. Pol. Zainal Abidin No.7, Talang
                Banjar, Kec. Jambi Tim., Kota Jambi,
                Jambi 36123, Indonesia
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li>{{ $auth->username }}</li>
                    <li>{{ date('d/m/Y') }}</li>
                </ul>
            </div>
        </div>
        <hr>
        @if ($carts->count())
            <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
                <div style="text-align: left;">Nama Product</div>
                <div>Harga/Qty</div>
                <div>Total</div>
            </div>
            @foreach ($carts as $cart)
                @php
                    $item = $products->where('kode_barang', $cart->kode_barang)->first();
                    $total_harga = $item->harga_jual * $cart->jumlah_barang;
                    $pembelian += $total_harga;
                @endphp

                <div class="flex-container" style="text-align: right">
                    <div style="text-align: left;">
                        {{ $cart->jumlah_barang . 'x ' . Str::limit($item->merk_barang, 13).' '.Str::limit($item->ukuran, 4).'ml' }}</div>
                    <div>Rp. {{ number_format($item->harga_jual, 0, '.', '.') }}</div>
                    <div>Rp. {{ number_format($total_harga, 0, '.', '.') }}</div>
                </div>
            @endforeach
        @endif
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Grand Total</li>
                    <li>Pembayaran</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp. {{ number_format($pembelian, 0, '.', '.') }}</li>
                    <li>Rp. {{ number_format($pembayaran, 0, '.', '.') }}</li>
                    <li>Rp. {{ number_format($pembayaran - $pembelian, 0, '.', '.') }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
