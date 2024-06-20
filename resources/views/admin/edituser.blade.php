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
                <form role="form" action="/updateuser/{{ $users->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nama</label>
                    <textarea name="name" class="form-control">{{ $users->name}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <textarea name="email" class="form-control">{{ $users->email }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control">{{ $users->profileuser->alamat ?? 'alamat kosong'}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Alamat Kirim</label>
                    <textarea name="alamat_kirim" class="form-control">{{ $users->profileuser->alamat_kirim ?? 'alamat kirim kosong'}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">NO TELPON</label>
                    <textarea name="no_telpon" class="form-control">{{ $users->profileuser->no_telpon ?? 'no telpon kosong'}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Nama PIC</label>
                    <textarea name="nama_pic" class="form-control">{{ $users->profileuser->nama_pic ?? 'nama pic kosong'}}</textarea>
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
