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
                <h3 class="card-title">Upload Bukti Transfer</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if(isset($upload) && $upload != null)
                <form action="/createuploadbuktibayar/{{$upload->id}}/update" method="POST"
                    enctype="multipart/form-data">
                    @else
                    <form action="/createuploadbuktibayar/0/update" method="POST" enctype="multipart/form-data">
                        @endif
                        <!-- form fields go here -->
                        @csrf

                        <div class="form-group">
                            <label for="">Total Harga</label>x
                            <input type="text" class="form-control" value="test" readonly>

                        </div>

                        <div>
                            <label>Upload Bukti Transfer</label>
                            {{-- <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt=""> --}}
                            <img src="" class="img-preview img-fluid" alt="">
                            <input type="file" accept=".jpg, .jpeg, .png, .svg, .webp" onchange="previewImg()"
                                id="image" name="bukti_bayar" class="form-control">
                            @if($errors->has('bukti_bayar'))
                            <span class="help-block" style="color: red">{{ $errors->first('bukti_bayar') }}</span>
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

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result
        }
    }

</script>
