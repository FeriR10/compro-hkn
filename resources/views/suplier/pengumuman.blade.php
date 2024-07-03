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

                <form action="/createpengumuman-process" method="POST" enctype="multipart/form-data">


                    <!-- form fields go here -->
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" >

                    </div>
                    <div>
                        <label>Upload Bukti Transfer</label>
                        <img src="" class="img-preview img-fluid" alt="">
                        <input type="file" accept=".jpg, .jpeg, .png, .svg, .webp" onchange="previewImg()" id="image"
                            name="thumbnail" class="form-control">
                        @if($errors->has('thumbnail'))
                        <span class="help-block" style="color: red">{{ $errors->first('thumbnail') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
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
                            <th>Kategori</th>
                            <th>Title</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($pengumumans as $pengumuman)
                      <tr>
                      <th><img src="{{asset('storage/'.$pengumuman->thumbnail)}}" width="100px" height="100px"></th>

                        <td>{{ $pengumuman->title }}</td>
                        <td><a class="btn btn-danger" href="/delete/{{ $pengumuman->id }}">Delete</a></td>
                      @endforeach
                    </tbody>
                </table>
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
