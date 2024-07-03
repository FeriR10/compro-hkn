<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: white; color: black;">
    <!-- Brand Logo -->
    <a  class="brand-link d-flex align-items-center" style="background-color: #212529; color: white; padding: 10px;">
        <i class="fa-solid fa-dumpster" style="margin-right: 10px;"></i>
        <span class="brand-text font-weight-bold">ECOMMERS</span>
        <div class="spinner-grow text-primary ml-auto" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- Tambahkan gambar profil di sini -->
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a  class="d-block fa-solid fa-user">
                    @if (auth()->user())
                    {{ auth()->user()->name }}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Tambahkan ikon ke tautan menggunakan kelas .nav-icon dengan font-awesome atau font ikon lainnya -->
                @if (auth()->user()->role_id == 1)
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard','dashboard/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/homepage" class="nav-link {{ request()->is('homepage','homepage/*') ? 'active' : '' }}" style="color: black;">
                        <i class="fa-solid fa-home"></i>
                        <p>Home Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/barangjual" class="nav-link {{ request()->is('barangjual','barangjual/*') ? 'active' : '' }}" style="color: black;">
                        <i class="fa-brands fa-shopify"></i>&nbsp;
                        <p>Shopping</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/keranjang" class="nav-link {{ request()->is('keranjang','keranjang/*') ? 'active' : '' }}" style="color: black;">
                    <i class="fa-solid fa-cart-plus"></i>&nbsp;
                        <p>Keranjang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/historypemesanan" class="nav-link {{ request()->is('historypemesanan','historypemesanan/*') ? 'active' : '' }}" style="color: black;">
                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                        <p>History Pesanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/order" class="nav-link {{ request()->is('order','order/*') ? 'active' : '' }}" style="color: black;">
                    <i class="fa-solid fa-cash-register"></i>&nbsp;
                        <p>Tool Pesanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengumuman" class="nav-link {{ request()->is('pengumuman','pengumuman/*') ? 'active' : '' }}" style="color: black;">
                    <i class="fa-regular fa-lightbulb"></i>&nbsp;
                        <p>Pengumuman</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('barang','barang/*','kategori','kategori/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('barang','barang/*','kategori','kategori/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'active' : '' }}" style="color: black;">
                      
                    <i class="fa-solid fa-wrench"></i>&nbsp;
                        <p>
                            Tool Barang
                            
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barang" class="nav-link {{ request()->is('barang','barang/*') ? 'active' : '' }}" style="color: black;">
                               
                                <i class="fa-brands fa-product-hunt"></i>&nbsp;
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tambah" class="nav-link {{ request()->is('tambah','tambah/*') ? 'active' : '' }}" style="color: black;">
                            <i class="fa-brands fa-product-hunt"></i>&nbsp;

                                <p>Tambah Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link {{ request()->is('kategori','kategori/*') ? 'active' : '' }}" style="color: black;">
                            <i class="fa-solid fa-briefcase"></i>&nbsp;
                                <p>Tambah Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/viewdiskon" class="nav-link {{ request()->is('viewdiskon','viewdiskon/*') ? 'active' : '' }}" style="color: black;">
                                <i class="fa-solid fa-percent"></i>&nbsp;
                                <p>Diskon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jenispayment" class="nav-link {{ request()->is('jenispayment','jenispayment/*') ? 'active' : '' }}" style="color: black;">
                            <i class="fa-brands fa-cc-visa"></i>&nbsp;
                                <p>Jenis Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('datauser','datauser/*' ,'registeradmin','registeradmin/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('datauser','datauser/*' ,'registeradmin','registeradmin/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-gears"></i>
                        <p>
                            USER
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/datauser" class="nav-link {{ request()->is('datauser','datauser/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/registeradmin" class="nav-link {{ request()->is('registeradmin','registeradmin/*') ? 'active' : '' }}" style="color: black;">
                            <i class="fa-solid fa-user-plus"></i>&nbsp;
                                <p>Tambah User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->role_id == 2)
                <li class="nav-item">
                    <a href="/homepage" class="nav-link {{ request()->is('homepage','homepage/*') ? 'active' : '' }}" style="color: black;">
                        <i class="fa-solid fa-house"></i>
                        <p>Home Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/barangjual" class="nav-link {{ request()->is('barangjual','barangjual/*') ? 'active' : '' }}" style="color: black;">
                    <i class="fa-brands fa-shopify"></i>&nbsp;
                        <p>Shopping</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/keranjang" class="nav-link {{ request()->is('keranjang','keranjang/*') ? 'active' : '' }}" style="color: black;">
                    <i class="fa-solid fa-cart-plus"></i>&nbsp;
                        <p>Keranjang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/historypemesanan" class="nav-link {{ request()->is('historypemesanan','historypemesanan/*') ? 'active' : '' }}" style="color: black;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>History Pesanan</p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role_id == 3)
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard','dashboard/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-house"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/order" class="nav-link {{ request()->is('order','order/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Tool Pesanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengumuman" class="nav-link {{ request()->is('pengumuman','pengumuman/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('barang','barang/*','kategori','kategori/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('barang','barang/*','kategori','kategori/*', 'tambah','tambah/*','viewdiskon','viewdiskon/*','creatediskon','creatediskon/*') ? 'active' : '' }}" style="color: black;">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Tool Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barang" class="nav-link {{ request()->is('barang','barang/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tambah" class="nav-link {{ request()->is('tambah','tambah/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Tambah Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link {{ request()->is('kategori','kategori/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Tambah Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/viewdiskon" class="nav-link {{ request()->is('viewdiskon','viewdiskon/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Diskon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jenispayment" class="nav-link {{ request()->is('jenispayment','jenispayment/*') ? 'active' : '' }}" style="color: black;">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Jenis Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
