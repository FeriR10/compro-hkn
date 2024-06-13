<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <!-- <img src="{{ asset('assets/images/logodishub.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 img-fluid" style="opacity: .8"> -->
        <span class="brand-text font-weight-light"> <i class="fa-solid fa-dumpster"></i>ECOMMERS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="/dashboard" class="d-block fa-solid fa-user">
                    @if (auth()->user())
                    {{ auth()->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        
        <!-- pp -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                   <a href="/barangjual" class="nav-link {{ request()->is('dealer') ? 'active' : '' }}" >
                   <i class="fa-solid fa-bag-shopping"></i>
                       <p>SHOP</p>
                   </a>
               </li>
               <li class="nav-item">
                   <a href="/keranjang" class="nav-link {{ request()->is('dealer') ? 'active' : '' }}" >
                   <i class="fa-solid fa-cart-shopping"></i>
                       <p>KERANJANG</p>
                   </a>
               </li>
               <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ request()->is('admin') ? 'active' : '' }}" >
                                <i class="nav-icon fas fa-house"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                <li class="nav-item has-treeview {{ request()->is('barang','barang/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('barang','barang/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        BARANG
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barang" class="nav-link {{ request()->is('barang','barang/*') ? 'active' : '' }}" >
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>DATA BARANG</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tambah" class="nav-link {{ request()->is('tambah','tambah/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>TAMBAH DATA BARANG</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/viewdiskon" class="nav-link {{ request()->is('viewdiskon','viewdiskon/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>DISKON</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/creatediskon" class="nav-link {{ request()->is('creatediskon','creatediskon/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>TAMBAH DISKON</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('datauser','datauser/*' ,'registeradmin','registeradmin/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('datauser','datauser/*' ,'registeradmin','registeradmin/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gears"></i>
                    <p>
                        USER
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/datauser" class="nav-link {{ request()->is('datauser','datauser/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>DATA USER</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/registeradmin" class="nav-link {{ request()->is('registeradmin','registeradmin/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>TAMBAH USER</p>
                    </a>
                </li>
                
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
