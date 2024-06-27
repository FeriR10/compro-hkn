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
    
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Menu</h1>
                    </div>
                    
                </div>
            </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
    
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Menu</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                <form role="form" action="/barang/{{ $barang->id }}/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <textarea name="nama_barang" class="form-control">{{ $barang->nama_barang}}</textarea>
                </div>
                <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                            @foreach($kategoris as $barangkategori)
                            <option @if($barang->kategori_id == $barangkategori->id) selected @endif value="{{$barangkategori->id}}">{{$barangkategori->kategori_barang}}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <label for="">Kode Barang</label>
                    <textarea name="kode_barang" class="form-control">{{ $barang->kode_barang }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">QTY</label>
                    <textarea name="qty" class="form-control">{{ $barang->qty }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <textarea name="harga" class="form-control">{{ $barang->harga }}</textarea>
                </div>
                <div>
                
                <div class="form-group">
                    <label for="">Gambar Product</label>
                    <input type="hidden" name="oldImage" value="{{$barang->thumbnail}}">
                    <input type="file" accept="image/*" name="thumbnail" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
    
        </section>
        <!-- /.content -->
  
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
