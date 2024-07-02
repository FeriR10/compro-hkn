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
            <div class="card-header row">
                <div class="col-md-4">
                    <h3 class="card-title">Data Barang <strong>{{$cekorder->created_at->format('d-m-Y')}}</strong></h3>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <p class="card-title">Status : <strong>{{$cekorder->status}}</strong></p>
                </div>
                <div class="col-md-4 text-right">
                    <h3 class="card-title float-right">No Order : <strong>{{$cekorder->id}}</strong></h3>

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

                <div class="row mb-3 justify-content-end">
                    <div class="col-md-4">
                        <form action="/viewdetailorder/{{$cekorder->id}}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-end align-items-center">
                                <label for="cari" class="mr-2">Cari</label>
                                <select name="cari" class="form-control mr-2" id="">
                                    <option value="">Piih barang</option>
                                    @foreach($optionRiwayats as $cek )
                                        <option value="{{$cek->id}}" > {{$cek->barang->nama_barang}} </option>
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

                <table id="example2" class="table table-bordered table-striped" style="text-align: center">
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

                        @foreach($riwayat as $cek )
                        <tr>
                            <th> {{$cek->barang->kode_barang}} </th>
                            <th> {{$cek->barang->nama_barang}} </th>
                            <th> {{$cek->qty}} </th>
                            <th> @currency ($cek->harga_satuan) </th>
                            <th> @currency (($cek->harga_satuan * $cek->qty) * $cekorder->diskon->persen) </th>
                            <th> @currency (($cek->harga_satuan * $cek->qty)-($cek->harga_satuan * $cek->qty) *
                                $cekorder->diskon->persen)</th>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm">
                        <table id="" class="table table-bordered table-striped ">
                            <thead>
                                <tr style="width: 50%;">
                                    <th>Total Harga</th>
                                    <th>@currency ($totalharga)</th>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <th>@currency ($totalharga * $cekorder->diskon->persen)</th>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <th>-</th>
                                </tr>
                                <tr class="highlight">
                                    <th>Total Bayar</th>
                                    <th>@currency (($totalharga)-($totalharga * $cekorder->diskon->persen))</th>
                                </tr>
                            </thead>



                        </table>
                        <table id="" class="table table-bordered table-striped ">
                            <tr>
                                <th>Alamat Kirim</th>
                                <th>{{$alamat->alamat_kirim ?? '-'}}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm">
                        <!--sapace-->
                            <table id="" class="table table-bordered table-striped ">
                                <tr>
                                    <td class="text-center">Keterangan</td>
                                </tr>
                                <tr>
                                    <td>{{$cekorder->keterangan ?? '-'}}</td>
                                </tr>
                            </table>
                        <!--sapace-->
                    </div>
                    <div class="col-sm text-center">
                        <table>
                            <tr>
                                <td>
                                    <div class="badge badge-success">
                                        <h5>Bukti Bayar</h5>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="">
                                    @if ($bukti == null)
                                    <h5 class="text-danger">Bukti Bayar Tidak ada</h5>
                                    @else
                                    <img src="{{ asset('storage/' . $bukti) }}" width="200px">
                                    @endif

                                </td>
                            </tr>
                        </table>

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
