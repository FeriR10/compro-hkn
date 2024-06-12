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
                <h3 class="card-title">AKUN USER<strong></strong></h3>
                <div class="card-tools">
                    <a href="/registeradmin" class="btn btn-outline-secondary btn-sm">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Alamat</th>
                            <th>Alamat Kirim</th>
                            <th>NO TELPON</th>
                            <th>Nama PIC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->role}}</td>
                                <!-- cek if $user->profileuser is not null -->
                                @if($user->profileuser)
                                    <td>{{$user->profileuser->alamat}}</td>
                                    <td>{{$user->profileuser->alamat_kirim}}</td>
                                    <td>{{$user->profileuser->no_telpon}}</td>
                                    <td>{{$user->profileuser->nama_pic}}</td>
                                @else
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                                
                                <td>
                                    <a href="/datauser/{{ $user->id }}/edit" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection