<!DOCTYPE html>
<html>
<head>
    <title>History by Order</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No Order</th>
                <th>Nama Pembeli</th>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tanggal Pemesanan</th>
                <th>Diskon</th>
                <th>Jenis Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $cek)
            <tr>
                <td>2024-{{ $cek->cekout->id }}</td>
                <td>{{ $cek->user->name }}</td>
                <td>{{ $cek->barang->nama_barang }}</td>
                <td>{{ $cek->qty }}</td>
                <td>@currency($cek->total_harga)</td>
                <td>{{ $cek->cekout->status }}</td>
                <td>{{ $cek->cekout->keterangan ?? '-' }}</td>
                <td>{{ $cek->created_at->format('d-m-Y') }}</td>
                <td>{{ $cek->cekout->diskon->diskon }}%</td>
                <td>{{ $cek->cekout->payment->jenis_payment->jenis_payment }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
