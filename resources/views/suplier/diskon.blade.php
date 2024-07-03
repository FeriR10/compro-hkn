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
                <h3 class="card-title">Menu Diskon<strong></strong></h3>
                <div class="card-tools">
                    
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                
            </div>
            <div class="card-body">
                <form action="/creatediskon-process" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>DISKON</label>
                        <input type="text" name="diskon" class="form-control" placeholder="INPUTKAN NOMERNYA SAJA. EX : 20 "
                            value="">

                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
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
                            <th>Diskon</th>
                        
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($diskon as $diskon)
                            <tr>
                                <th>{{$diskon->diskon}} %</th>
                                <th><a href="/diskon/{{ $diskon->id }}/delete" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DISKON INI?')" class="btn btn-danger"> Delete</a></th>
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