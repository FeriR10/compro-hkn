<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            margin-bottom: 20px;
        }

        .content-header h1 {
            margin: 0;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-header {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            margin: 0;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .card-body {
            padding: 20px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            position: relative;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 90%;
        }

        .highlight th {
            background-color: #f8f8f8;
        }

        .card-footer {
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .row .col {
            flex: 1;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bg-primary {
            background-color: #007bff;
            color: #fff;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-success h5 {
            margin: 0;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .justify-content-end {
            display: flex;
            justify-content: flex-end;
        }

        .align-items-center {
            display: flex;
            align-items: center;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .form-control {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

    </style>
</head>

<body>
    <div class="container">
        <section class="content-header">
            <h1>Detail Pesanan</h1>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header row">
                    <div class="col">
                        <p class="card-title">Tanggal Pesanan: <strong>{{$export->created_at->format('d-m-Y')}}</strong>
                        </p>
                    </div>
                    <div class="col justify-content-center align-items-center">
                        <p class="card-title">Status: <strong class="badge badge-info">{{$export->status}}</strong></p>
                    </div>
                    <div class="col">
                        <p class="card-title">No Pesanan: <strong>2024-{{$export->id}}</strong></p>
                    </div>
                </div>
                <div class="card-body">


                    <hr>
                    @if(count($riwayat) > 4)
                    <table class="table table-bordered table-striped text-center" style="font-size: 50%;">
                        @else
                        <table class="table table-bordered table-striped text-center">
                            @endif
                            <thead>
                                <tr class="highlight">
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>QTY</th>
                                    <th>Harga Satuan</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $cek)
                                <tr>
                                    <td>{{$cek->barang->kode_barang}}</td>
                                    <td>{{$cek->barang->nama_barang}}</td>
                                    <td>{{$cek->qty}}</td>
                                    <td>@currency($cek->harga_satuan)</td>
                                    <td>@currency(($cek->harga_satuan * $cek->qty) * $export->diskon->persen)</td>
                                    <td>@currency(($cek->harga_satuan * $cek->qty)-($cek->harga_satuan * $cek->qty) *
                                        $export->diskon->persen)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Total Harga</th>
                                        <th>@currency($totalharga)</th>
                                    </tr>
                                    <tr>
                                        <th>Diskon</th>
                                        <th>@currency($totalharga * $export->diskon->persen)</th>
                                    </tr>
                                    <tr>
                                        <th>PPN</th>
                                        <th>-</th>
                                    </tr>
                                    <tr class="bg-primary">
                                        <th>Total Bayar</th>
                                        <th>@currency($totalharga - ($totalharga * $export->diskon->persen))</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Alamat Kirim</th>
                                </tr>
                                <tr>
                                    <td>{{$alamat->alamat_kirim ?? '-'}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                                <tr>
                                    <td>{{$export->keterangan ?? '-'}}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>

</html>
