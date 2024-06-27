@extends('layout/master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-success close" data-dismiss="alert" sty>&times;</button>
                    {{Session::get('message')}}
                </div>
                @endif
                <h3 class="card-title">Tool Jenis Payment</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/jenispayment/create" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="">Nama Payment</label>
                    <input type="text" name="jenis_payment" class="form-control" value="">
                </div>
                
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
            <div class="card-body">
                
                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($payments as $payment)
                        <tr>
                            <th> {{$payment->jenis_payment}} </th>
                            <th>
                                @if($payment->status == 'aktiv')
                                <a href="paymentnon-aktiv/{{ $payment->id }}/update" class="badge badge-success">Aktiv</a>
                                @elseif($payment->status == 'non-aktiv')
                                <a href="paymentaktiv/{{ $payment->id }}/update" class="badge badge-danger">Non-Aktiv</a>
                                @endif
                               
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
