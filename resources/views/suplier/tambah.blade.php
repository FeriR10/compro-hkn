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
                <h3 class="card-title">Tambah Barang</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/barang/create" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="">
                    
                </div>
                
                <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control">
                            @foreach($kategoris as $barangkategori)
                            <option value="{{$barangkategori->id}}">{{$barangkategori->kategori_barang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" value=""></text>
                </div>
                <div class="form-group">
                    <label for="">QTY</label>
                    <input type="text" name="qty" class="form-control" value=""></text>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" class="form-control" value=""></text>
                </div>
                <div>
                <label>Thumbnail</label>
                    {{-- <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt=""> --}}
                    <img src="" class="img-preview img-fluid" alt="">
                    <input type="file" accept=".jpg, .jpeg, .png, .svg, .webp" onchange="previewImg()" id="image" name="thumbnail" class="form-control">
                    @if($errors->has('thumbnail'))
                    <span class="help-block" style="color: red">{{ $errors->first('thumbnail') }}</span>
                    @endif
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
</div>
<!-- /.content-wrapper -->

@endsection


<script>
    function previewImg() {
        const image = document.querySelector('#image')
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block'

        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result
        }
    }
</script>