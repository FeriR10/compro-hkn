<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <h3>{{ auth()->user()->role->role }}</h3>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li>
            <a href="/keranjang">
                <i class="fa-solid fa-cart-shopping"></i>

            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"> Account</i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Settings</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa- mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item" onClick="return confirm('Anda Yakin ?')">
                    <i class="fas fa- mr-2"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Modal 1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="list-group " style="width:100%">
                    <li class="list-group-item ">
                        @if (auth()->check())
                        <div class="alert alert-light form-group" role="alert">
                            NAMA : {{ auth()->user()->name }}
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            Email : {{ auth()->user()->email }}
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            Status : {{ auth()->user()->role->role }}<br>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            Alamat : @if(auth()->user()->profileuser)
                            {{ auth()->user()->profileuser->alamat }}
                            @else
                            Tidak ada data
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            Alamat Kirim :@if(auth()->user()->profileuser)
                            {{ auth()->user()->profileuser->alamat_kirim }}
                            @else
                            Tidak ada data
                            @endif
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            No Hp : @if(auth()->user()->profileuser)
                            {{ auth()->user()->profileuser->no_telpon }}
                            @else
                            Tidak ada data
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="alert alert-light form-group" role="alert">
                            Nama PIC :@if(auth()->user()->profileuser)
                            {{ auth()->user()->profileuser->nama_pic }}
                            @else
                            Tidak ada data
                            @endif
                            @endif
                        </div>
                    </li>

                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        </div>
    </div>
</div>
<!-- Modal 2 -->
