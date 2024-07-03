@extends('layout.master')

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
                <h3 class="card-title">MENU</h3>
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
                    <button type="button" class="btn btn-success close" data-dismiss="alert">&times;</button>
                    {{ Session::get('message') }}
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-end">
                            <form action="/barangjual" method="GET">
                                @csrf
                                <div class="d-flex align-items-center">
                                    <label for="cari" class="mr-2">Cari</label>
                                    <input type="text" class="form-control" name="cari" id="cari">
                                    <button title="Cari" type="submit" class="btn btn-primary ml-2">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if ($pencarian != null)
                                    <a href="/barangjual" class="btn btn-warning ml-2">
                                        <i class="fas fa-refresh"></i>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        @if ($pencarian != null)
                        <div class="d-flex justify-content-end mt-2">
                            <p>Hasil pencarian: <b>{{ $pencarian }}</b></p>
                        </div>
                        @endif
                    </div>
                </div>

                <hr>

                <form action="/keranjang/store" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($barangs as $barang)
                        <div class="col-sm-3 mb-3 mb-sm-0">
    <div class="card h-100">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">{{ $barang->nama_barang }}</h5>
        </div>
        <div class="card-body text-center">
            @if ($barang->thumbnail)
                <img src="{{ asset('storage/' . $barang->thumbnail) }}" class="img-fluid mb-3"
                    alt="{{ $barang->nama_barang }}" style="max-height: 200px;">
            @else
                <div class="text-center py-5">
                    <i class="fas fa-image fa-4x text-muted"></i>
                    <p class="mt-2">Gambar tidak tersedia</p>
                </div>
            @endif
            <p class="card-text">{{ $barang->kategori_barang }}</p>
            <p class="card-text">@currency($barang->harga)</p>
            <div class="form-check">
                <input type="checkbox" name="keranjang[{{ $barang->id }}]" class="form-control">
            </div>
        </div>
    </div>
</div>

                        @endforeach
                    </div>
                    <div class="text-center mt-3 fixed-btn"">
                        <button type="submit" class="btn btn-primary btn-lg ">Masukan Keranjang</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<style>
    .fixed-btn {
        position: fixed;
        bottom: 20px; /* Adjust as needed */
        right: 20px; /* Adjust as needed */
        z-index: 1000; /* Ensure it's above other content */
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

@endsection
