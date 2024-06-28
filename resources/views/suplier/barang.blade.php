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
                <h3 class="card-title">Data Barang<strong></strong></h3>
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
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori Barang</th>
                            <th>Kode Barang</th>
                            <th>QTY</th>
                            <th>Harga</th>
                            <th>Gambar Product</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($barang as $barang)
                            <tr>
                                <th>{{$barang->nama_barang}}</th>
                                <th>{{$barang->kategori->kategori_barang ?? '-'}}</th>
                                <th>{{$barang->kode_barang}}</th>
                                <th>{{$barang->qty}}</th>
                                <th>@currency($barang->harga)</th>
                                <th><img src="{{asset('storage/'.$barang->thumbnail)}}" width="100px" height="100px"></th>
                                <th><a href="/barang/{{$barang->id}}/edit" class="btn btn-warning">edit menu</a>
                               
                                <a href="/barang/{{$barang->id}}/delete" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS MENU BARANG INI?')" class="btn btn-danger"> Delete</a>

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

@endsection