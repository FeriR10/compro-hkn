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
                <h3 class="card-title">KERANJANG<strong></strong></h3>
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
                            <th scope="col">Barang</th>
                            <th>Harga Satuan</th>
                            <th>QTY</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $keranjang)
                        <tr>

                            <td>{{ $keranjang->barang->nama_barang }}</td>
                            <td>@currency( $keranjang->barang->harga )</td>
                            <td> {{ $keranjang->qty }}</td>
                            <td>@currency( $keranjang->harga_satuan )</td>
                            <td>@currency( $keranjang->qty * $keranjang->barang->harga )</td>

                            <td>
                                <a href="/keranjang/kurang/{{ $keranjang->id }}" class="btn btn-danger">-</a>
                                <a href="/keranjang/tambah/{{ $keranjang->id }}" class="btn btn-primary">+</a>
                            </td>
                            <!-- <td><a href="/keranjang/delete/{{ $keranjang->id }}">delete</a></td> -->
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right font-weight-bold">total</td>
                            
                            <td>
                                @currency($totalHarga)
                            </td>
                         
                        </tr>
                        <td colspan="5" class="text-right font-weight-bold">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cekoout">
                                Cekout
                            </button>
                        </td>
                        </tr>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="cekoout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cekout Now</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="cekoutstore" method="POST">
                                @csrf
                                <table id="example1" class="table table-bordered table-striped"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Barang</th>
                                            <th>QTY</th>
                                            <th>Harga</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cekouts as $cekout)
                                        <tr>

                                            <td>{{ $cekout->barang->nama_barang }}</td>
                                            <td>{{ $cekout->qty }}</td>
                                            <td>@currency( $cekout->qty * $keranjang->barang->harga )</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <h2>Diskon yang Tersedia</h2>
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <div>
                                                    <label>Vocher tersedia</label>
                                                    <select name="diskon" class="form-control">
                                                        @foreach ($diskon as $d)
                                                        <option value="{{ $d->id }}">{{ $d->diskon }}% DISKON</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </tr>
                                        </thead>
                                    </table>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right font-weight-bold">total</td>


                                        </tr>
                                    </tfoot>
                                </table>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection
