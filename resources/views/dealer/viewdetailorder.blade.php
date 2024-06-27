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
                    <a href="/tambah" class="btn btn-outline-secondary btn-sm">
                        Tambah
                    </a>
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
                @if(session('error'))
        <p>{{ session('error') }}</p>
    @else
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Harga Satuan</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach($cekorder->riwayat as $cek )
                        <tr>
                            <th> {{$cek->barang->kode_barang}} </th>
                            <th> {{$cek->barang->nama_barang}} </th>
                            <th> {{$cek->qty}} </th>
                            <th> @currency ($cek->harga_satuan) </th>
                            <th> @currency (($cek->harga_satuan * $cek->qty) * $cekorder->diskon->persen) </th>
                            <th> @currency ($cek->harga_satuan * $cek->qty)</th>
                            </tr>
                            
                        @endforeach
                       
                    </tbody>

                </table>
                
                @endif
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection