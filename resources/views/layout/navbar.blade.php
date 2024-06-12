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
        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#keranjang">
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
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">@if (auth()->user())
                        {{ auth()->user()->name }}
                        @endif</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        </div>
    </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="keranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <div>
            <h1>Keranjang</h1>
            <table class="table">
                <thead>
                    <tr>
                        
                        <th scope="col">barang</th> 
                        <th>harga satuan</th> 
                        <th>qty</th>
                        <th>total harga</th>
                        <th>option</th>
                    </tr>
                </thead>
                <tbody>
                       
                </tbody>
                
                   
            </table>
        </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        </div>
    </div>
</div>
