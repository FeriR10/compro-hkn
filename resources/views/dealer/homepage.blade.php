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
                <h3 class="card-title">Home Page<strong></strong></h3>
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
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr class="highlight">
                            <th>Tanggal</th>
                            <th>NO Order</th>
                            <th>Jumlah </th>
                            <th>Jenis Payment</th>
                            <th>Status Payment</th>
                            <th>Status Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($home as $item)

                        <tr>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->total_harga}}</td>
                            <td>{{$item->payment->jenis_payment->jenis_payment ?? ''}}</td>
                            <td>
                                {{$item->status ?? ''}}
                            </td>
                            <td>@if ($item->status == 'Menunggu' || $item->status == 'DP lunas' || $item->status == 'Lunas')
                                    @if ($item->payment->status == 'Berhasil Bayar')
                                    <span class="badge badge-success">Delivered</span>
                                    @elseif($item->payment->status == 'Belum Di Transfer')
                                    <span class="badge badge-warning">On Process</span>
                                    @endif
                                @elseif($item->status == 'Dibatalkan')
                                <span class="badge badge-danger">Dibatalkan</span>
                                @endif</td>
                            
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
