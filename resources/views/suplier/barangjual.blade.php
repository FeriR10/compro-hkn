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
                <form  action="/keranjang/store" method="POST">
                    @csrf
                    <div class="row">
                        @foreach($barangs as $barang)
                        <div class="col-sm-3 mb-3 mb-sm-0 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">
                                        <h5 class="card-title-center">{{$barang->nama_barang}}</h5>
                                    </div>

                                    <img src="{{asset('storage/'.$barang->thumbnail)}}" width="100%" height="200px><br>
                                
                                <p class=" card-text">{{$barang->kategori_barang}}</p>
                                    <p class="card-text">@currency($barang->harga)</p>
                                    <input type="checkbox" name="keranjang[{{ $barang->id }}]" class="form-control">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div>
                    <button type="submite" class="btn btn-primary" >Masukan Keranjang</button>
                    </div>
                </form>
                <!-- Button trigger modal -->
               

                <!-- Modal -->
               
                
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

@endsection
