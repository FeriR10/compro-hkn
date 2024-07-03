@extends('layout/master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Detail Pesanan</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header row">
                <div class="col-md-4">
                    <h3 class="card-title">Tanggal Pesanan: <strong>{{$cekorder->created_at->format('d-m-Y')}}</strong></h3>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <p class="card-title">Status: <strong class="badge badge-info">{{$cekorder->status}}</strong></p>
                </div>
                <div class="col-md-4 text-right">
                    <h3 class="card-title float-right">No Pesanan: <strong>{{$cekorder->id}}</strong></h3>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @else

                <div class="row mb-3 justify-content-end">
                    <div class="col-md-4">
                        <form action="/viewdetailorder/{{$cekorder->id}}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-end align-items-center">
                                <label for="cari" class="mr-2">Cari</label>
                                <select name="cari" class="form-control mr-2" id="">
                                    <option value="">Pilih barang</option>
                                    @foreach($optionRiwayats as $cek)
                                        <option value="{{$cek->id}}">{{$cek->barang->nama_barang}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>
                <style>
                    .table td,
                    .table th {
                        font-size: 90%;
                        vertical-align: middle !important;
                    }

                </style>
                <table class="table table-bordered table-striped text-center">
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
                            <td>@currency(($cek->harga_satuan * $cek->qty) * $cekorder->diskon->persen)</td>
                            <td>@currency(($cek->harga_satuan * $cek->qty)-($cek->harga_satuan * $cek->qty) * $cekorder->diskon->persen)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Total Harga</th>
                                    <th>@currency($totalharga)</th>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <th>@currency($totalharga * $cekorder->diskon->persen)</th>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <th>-</th>
                                </tr>
                                <tr class="bg-primary">
                                    <th>Total Bayar</th>
                                    <th>@currency($totalharga - ($totalharga * $cekorder->diskon->persen))</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Alamat Kirim</th>
                                <td>{{$alamat->alamat_kirim ?? '-'}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="text-center">Keterangan</th>
                            </tr>
                            <tr>
                                <td>{{$cekorder->keterangan ?? '-'}}</td>
                            </tr>
                        </table>
                        <div class="text-center mt-3">
                            <div class="badge badge-success mb-3">
                                <h5>Bukti Bayar</h5>
                            </div>
                            <div>
                                @if ($bukti == null)
                                <h5 class="text-danger">Bukti Bayar Tidak ada</h5>
                                @else
                                <img src="{{ asset('storage/' . $bukti) }}" width="200px">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection
