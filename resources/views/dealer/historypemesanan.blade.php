@extends('layout/master')


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">History Transaksi<strong></strong></h3>
                <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-success close" data-dismiss="alert" sty>&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                <style>
                    .table td,
                    .table th {
                        font-size: 90%;
                        vertical-align: middle !important;
                    }

                </style>
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr class="highlight">
                            <th>Tanggal</th>
                            <th>No Order</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Jenis Payment</th>
                            <th>Status Payment</th>
                            <th>Bukti Transfer</th>
                            <th>Status Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cekorders as $cek )
                        <tr>
                            <td>{{ $cek->created_at->format('d-m-Y') }}</td>
                            <td>2024-{{$cek->id}}</td>
                            <td><a class="badge badge-primary" href="/viewdetailorder/{{ $cek->id }}">View Detail</a></td>
                            <td>@currency($cek->total_harga)</td>
                            <td>{{$cek->payment->jenis_payment->jenis_payment ?? '-'}}</td>
                            <td>{{$cek->payment->status ?? '-'}}</td>
                            <td>{{$cek->payment->bukti_transfer ?? ''}} <a class="badge badge-primary"
                                    href="/uploadbuktibayar/{{ $cek->payment_id }}">Upload</a></td>
                            <td>
                            @if ($cek->status == 'Menunggu' || $cek->status == 'DP lunas' || $cek->status == 'Lunas')
                                    @if ($cek->payment && $cek->payment->status == 'Belum Di Transfer')
                                        <a href="" class="badge badge-warning btn-sm">On Process</a>
                                    @elseif ($cek->payment && $cek->payment->status == 'Berhasil Bayar')
                                    <a href="" class="badge badge-success">Delivered</a>
                                    @else
                                    <span></span>
                                    @endif
                                @elseif($cek->status == 'Dibatalkan')
                                <span class="badge badge-danger">Transaksi dibatalkan</span>
                                @endif
                            </td>       
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- Modal -->

@endsection
