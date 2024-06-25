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
                <h3 class="card-title">MENU<strong></strong></h3>
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
                        <tr>

                            <th>Kode Order</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cekorders as $cek )
                        <tr>
                            <th> {{$cek->id}} </th>
                            <th>
                                <button type="button" class="badge badge-light" data-toggle="modal"
                                    data-target="#riwayat-{{$cek->id}}">
                                    Lihat {{$cek->riwayat->count()}} barang
                                </button>
                                                <div class="modal fade" id="riwayat-{{$cek->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table id="example1" class="table table-bordered table-striped"
                                                                    style="text-align: center">
                                                                    <thead>
                                                                        <tr>

                                                                            <th>Kode Barang</th>
                                                                            <th>Nama Barang</th>
                                                                            <th>QTY</th>
                                                                            <th>Harga Satuan</th>
                                                                            <th>Total Harga</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($cek->riwayat as $riwayat)
                                                                        <tr>
                                                                            <th> {{$riwayat->id}} </th>
                                                                            <th> {{$riwayat->barang->nama_barang}} </th>
                                                                            <th> {{$riwayat->qty}} </th>
                                                                            <th> @currency($riwayat->harga_satuan)</th>
                                                                            <th> @currency($riwayat->total_harga)</th>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                            </th>
                            <th>@currency($cek->total_harga)</th>
                            
                            <th>
                                @if($cek->status == 'Aprove')
                                <span class="badge badge-success">Aprove</span>
                                @elseif($cek->status == 'Menunggu')
                                <span class="badge badge-warning">Belum Selesai</span>
                                <a href="historyorder/{{ $cek->id }}/update" class="badge badge-danger">Batal</a>
                                @elseif($cek->status == 'Dibatalkan')
                                <span class="badge badge-danger">Dibatalkan</span>
                                @endif
                               
                            </th>
                            
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
